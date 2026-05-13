<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    // ================= HITUNG TERJUAL =================
    private function getTerjualData()
    {
        $orders = Order::where('payment_status', 'paid')->get();

        $terjual = [];

        foreach ($orders as $order) {
            $items = json_decode($order->cart_data, true);

            if (!$items) continue;

            foreach ($items as $item) {
                $productId = $item['id'];
                $qty = $item['qty'];

                if (!isset($terjual[$productId])) {
                    $terjual[$productId] = 0;
                }

                $terjual[$productId] += $qty;
            }
        }

        return $terjual;
    }

    // ================= HITUNG RATING RATA-RATA =================
    private function getRatingData()
    {
        $ratings = DB::table('ratings')
            ->select('product_id', DB::raw('AVG(rating) as avg_rating'))
            ->groupBy('product_id')
            ->get();

        $data = [];

        foreach ($ratings as $r) {
            $data[$r->product_id] = round($r->avg_rating, 1);
        }

        return $data;
    }

    // ================= HOME PAGE =================
    public function index()
    {
        $produk = Produk::where('is_available', true)->latest()->get();

        $terjual = $this->getTerjualData();
        $rating = $this->getRatingData();

        foreach ($produk as $p) {
            $p->total_terjual = $terjual[$p->id] ?? 0;
            $p->rating = $rating[$p->id] ?? 0;
        }

        $randomProduk = Produk::where('is_available', true)->inRandomOrder()->take(7)->get();

        foreach ($randomProduk as $p) {
            $p->total_terjual = $terjual[$p->id] ?? 0;
            $p->rating = $rating[$p->id] ?? 0;
        }

        return view('landing.home', compact('produk', 'randomProduk'));
    }

    // ================= DETAIL PRODUK =================
    public function details($id)
    {
        $produk = Produk::where('is_available', true)->findOrFail($id);

        $terjual = $this->getTerjualData();
        $rating = $this->getRatingData();

        // ambil semua komentar untuk produk ini (read-only)
$produk->rating_details = DB::table('ratings')
    ->leftJoin('users', 'ratings.user_id', '=', 'users.id')
    ->where('ratings.product_id', $produk->id)
    ->select(
        'ratings.*',
        'users.name as user_name'
    )
    ->orderBy('ratings.created_at', 'desc')
    ->get();

        $produk->total_terjual = $terjual[$produk->id] ?? 0;
        $produk->rating = $rating[$produk->id] ?? 0;


        $produkLain = Produk::where('id', '!=', $id)
            ->where('is_available', true)
            ->inRandomOrder()
            ->take(8)
            ->get();

        foreach ($produkLain as $p) {
            $p->total_terjual = $terjual[$p->id] ?? 0;
            $p->rating = $rating[$p->id] ?? 0;
        }

        return view('landing.details', compact('produk', 'produkLain'));
    }

// ================= SEARCH =================
public function search(Request $request)
{
    $q = $request->query('q', $request->query('search', ''));
    
    $query = Produk::query()->where('is_available', true);
    
    if (!empty($q)) {
        $query->where(function($builder) use ($q) {
            $builder->where('nama_produk', 'LIKE', "%{$q}%")
                   ->orWhere('deskripsi', 'LIKE', "%{$q}%")
                   ->orWhere('kategori', 'LIKE', "%{$q}%");
        });
    }
    
    $produk = $query->latest()->get();
    
    $terjual = $this->getTerjualData();
    $rating = $this->getRatingData();
    
    foreach ($produk as $p) {
        $p->total_terjual = $terjual[$p->id] ?? 0;
        $p->rating = $rating[$p->id] ?? 0;
    }
    
    return view('landing.menu', compact('produk', 'q'));
}

// ================= MENU / FILTER =================    
public function menu(Request $request)
{
    $query = Produk::query()->where('is_available', true);
    
    // ================= SEARCH =================
    $q = $request->query('search', '');
    if (!empty($q)) {
        $query->where(function($builder) use ($q) {
            $builder->where('nama_produk', 'LIKE', "%{$q}%")
                   ->orWhere('deskripsi', 'LIKE', "%{$q}%")
                   ->orWhere('kategori', 'LIKE', "%{$q}%");
        });
    }

    // ================= FILTER KATEGORI (ANTI GAGAL 🔥) =================
    if ($request->filled('kategori')) {
        $query->whereRaw('LOWER(kategori) = ?', [strtolower($request->kategori)]);
    }

    // ================= FILTER PROMO =================
    if ($request->filter === 'promo') {
        $query->where('is_promo', 1);
    }

    // ================= TERMURAH =================
    if ($request->filter === 'termurah') {
        $query->orderBy('harga', 'asc');
    }

    // ================= AMBIL DATA =================
    $produk = $query->latest()->get();

    // ================= HITUNG DATA TAMBAHAN =================
    $terjual = $this->getTerjualData();
    $rating = $this->getRatingData();

    foreach ($produk as $p) {
        $p->total_terjual = $terjual[$p->id] ?? 0;
        $p->rating = $rating[$p->id] ?? 0;
    }

    // ================= TERLARIS (SETELAH HITUNG) =================
    if ($request->filter === 'terlaris') {
        $produk = $produk->sortByDesc('total_terjual')->values();
    }

    return view('landing.menu', compact('produk'));
}

}