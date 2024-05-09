<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class NotePeminjamanMobilController extends Controller
{
    public function index(){
        $id_user = auth()->user()->id;
    
        // Mengambil data peminjaman yang dimiliki oleh user yang sedang login
        $posts = Peminjaman::where('id_user', $id_user)
                            ->whereIn('verifikasi_mobil', ['success', 'padding'])
                            ->get();
    
        // Mengirimkan data ke view
        return view('notePeminjamanMobil', compact('posts'));
    }



    public function updateVerifikasi(Request $request, $id_peminjaman){
        // Validasi data
        $validatedData = $request->validate([
            'verifikasi_mobil' => 'nullable|string',
        ]);
    
        // Cari mobil berdasarkan ID
        $peminjaman = Peminjaman::findOrFail($id_peminjaman);
    
        // Update kolom 'verifikasi_mobil' dengan nilai yang dikirimkan dari form
        $peminjaman->verifikasi_mobil = $request->input('verifikasi_mobil', $peminjaman->verifikasi_mobil);
        $peminjaman->verifikasi_mobil = $request->input('verifikasi_mobil', $peminjaman->verifikasi_mobil);
    
        // Simpan perubahan
        $peminjaman->save();
    
        // Redirect ke halaman dashboard dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Verifikasi mobil berhasil diperbarui.');
    }
}
