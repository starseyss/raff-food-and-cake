<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    // ================= GET ALL =================
    public function index()
    {
        return UserAddress::where('user_id', Auth::id())->get();
    }

    // ================= STORE =================
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'nama_penerima' => 'nullable',
            'hp' => 'required',
            'alamat' => 'required',
            'tanggal' => 'nullable'
        ]);

        $data['user_id'] = Auth::id();

        // default ke nama kalau penerima kosong
        $data['nama_penerima'] = $data['nama_penerima'] ?? $data['nama'];

        // kalau belum ada alamat → jadi utama
        if (!UserAddress::where('user_id', Auth::id())->exists()) {
            $data['is_main'] = true;
        }

        UserAddress::create($data);

        return response()->json(['success' => true]);
    }

    // ================= UPDATE =================
    public function update(Request $request, $id)
    {
        $alamat = UserAddress::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        $data = $request->validate([
            'nama' => 'required',
            'nama_penerima' => 'nullable',
            'hp' => 'required',
            'alamat' => 'required',
            'tanggal' => 'nullable'
        ]);

        $data['nama_penerima'] = $data['nama_penerima'] ?? $data['nama'];

        $alamat->update($data);

        return response()->json(['success' => true]);
    }

    // ================= DELETE =================
    public function destroy($id)
    {
        $alamat = UserAddress::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        $isMain = $alamat->is_main;

        $alamat->delete();

        // kalau yang dihapus adalah alamat utama → set ulang
        if ($isMain) {
            $newMain = UserAddress::where('user_id', Auth::id())->first();
            if ($newMain) {
                $newMain->update(['is_main' => true]);
            }
        }

        return response()->json(['success' => true]);
    }

    // ================= SET MAIN =================
    public function setMain($id)
    {
        UserAddress::where('user_id', Auth::id())
            ->update(['is_main' => false]);

        UserAddress::where('user_id', Auth::id())
            ->where('id', $id)
            ->update(['is_main' => true]);

        return response()->json(['success' => true]);
    }
}