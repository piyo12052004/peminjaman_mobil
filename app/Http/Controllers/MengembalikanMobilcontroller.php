<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MengembalikanMobilcontroller extends Controller
{
    public function index(){

        return view('MengembalikanMobil/index');
    }

    public function returnCar(Request $request)
{
    // Ambil nomor plat mobil dari input pengguna
    $nomorPlat = $request->input('nomer_plat');

    // Temukan data peminjaman berdasarkan nomor plat mobil
    $peminjaman = Peminjaman::where('nomer_plat', $nomorPlat)->first();

    if ($peminjaman) {
        // Hapus entri peminjaman dari tabel Peminjaman
        $peminjaman->delete();

        // Memperbarui status verifikasi mobil di tabel Product
        $product = Product::where('nomer_plat', $nomorPlat)->first();
        if ($product) {
            $product->verifikasi_mobil = 'Tersedia';
            $product->save();
        }

        // Redirect dengan pesan sukses
        return redirect('/peminjamanBarang')->with('berhasil', 'Berhasil dikembalikan.');
    } else {
        // Mobil tidak ditemukan
        return redirect()->back()->with('error', 'Mobil dengan nomor plat tersebut tidak ditemukan.');
    }
}


}
