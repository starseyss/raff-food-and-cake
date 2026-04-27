<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $produk = Produk::latest()->get();

        $activeProduct = $produk->where('is_available', true)->count();
        $unavailableProduct = $produk->where('is_available', false)->count();

        // ================= HITUNG BEST SELLER (MIN 15 TERJUAL) =================
        $terjual = $this->getTerjualData();

        $bestSeller = $produk->filter(function ($p) use ($terjual) {
            return ($terjual[$p->id] ?? 0) >= 15;
        })->count();
        // =====================================================================

        $editMode = false;
        $editData = null;

        if ($request->has('edit')) {
            $editMode = true;
            $editData = Produk::find($request->edit);
        }

        return view('admin.product', compact('produk', 'editMode', 'editData', 'activeProduct', 'unavailableProduct', 'bestSeller'));
    }

    // ================= HITUNG TERJUAL DARI ORDER =================
    private function getTerjualData()
    {
        $orders = \App\Models\Order::where('payment_status', 'paid')->get();

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

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'kategori' => 'required|string|max:50',
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'deskripsi' => 'nullable|string',
            'varian' => 'nullable|array',
            'varian.*' => 'nullable|string|max:255',
            'diskon' => 'nullable|numeric|min:0|max:100',
            'is_promo' => 'nullable',
            'is_available' => 'nullable'
        ]);

        // ===============================
        // FOLDER UPLOAD
        // ===============================
        $folderTujuan = public_path('image-product');

        if (!file_exists($folderTujuan)) {
            mkdir($folderTujuan, 0777, true);
        }

        // ===============================
        // UPLOAD FOTO
        // ===============================
        $namaFileFoto = null;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');

            $namaFileFoto = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $file->move($folderTujuan, $namaFileFoto);
        }

        // ===============================
        // VARIAN
        // ===============================
        $varian = '';

        if ($request->has('varian') && is_array($request->varian)) {
            $varian = collect($request->varian)
                ->map(fn($item) => trim($item))
                ->filter(fn($item) => !empty($item))
                ->implode(',');
        }

        // ===============================
        // SIMPAN KE DATABASE
        // ===============================
        Produk::create([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'kategori' => $request->kategori,
            'foto' => $namaFileFoto,
            'deskripsi' => $request->deskripsi,
            'varian' => $varian,
            'is_promo' => $request->is_promo ? 1 : 0,
            'diskon' => $request->diskon ?? 0,
            'is_available' => $request->is_available ? 1 : 0,
        ]);

        return back()->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('admin.edit-product', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'kategori' => 'required|string|max:50',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'deskripsi' => 'nullable|string',
            'varian' => 'nullable|array',
            'diskon' => 'nullable|numeric|min:0|max:100',
            'is_available' => 'nullable'
        ]);

        // FOTO BARU (OPTIONAL)
        if ($request->hasFile('foto')) {

            if ($produk->foto && file_exists(public_path('image-product/' . $produk->foto))) {
                unlink(public_path('image-product/' . $produk->foto));
            }

            $file = $request->file('foto');
            $namaFileFoto = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('image-product'), $namaFileFoto);

            $produk->foto = $namaFileFoto;
        }

        // VARIAN
        $varian = '';

        if ($request->has('varian') && is_array($request->varian)) {
            $varian = collect($request->varian)
                ->map(fn($item) => trim($item))
                ->filter()
                ->implode(',');
        }

        // UPDATE DATA
        $produk->update([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'varian' => $varian,
            'is_promo' => $request->is_promo ? 1 : 0,
            'diskon' => $request->diskon ?? 0,
            'is_available' => $request->is_available ? 1 : 0,
        ]);

        return redirect()->route('admin.product')->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->foto && file_exists(public_path('image-product/' . $produk->foto))) {
            unlink(public_path('image-product/' . $produk->foto));
        }

        $produk->delete();

        return back()->with('success', 'Produk dihapus!');
    }
}