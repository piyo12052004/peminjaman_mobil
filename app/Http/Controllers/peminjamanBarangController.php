<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Product;
use Illuminate\Http\Request;

class peminjamanBarangController extends Controller
{
    public function index(){
        $peminjaman = Peminjaman::whereNotNull('verifikasi_mobil')->get();
        // dd($verifikasi_mobil);
        return view('peminjamanBarang',[
            'posts' => Product::all(),
            'peminjaman' => $peminjaman
        ]);
    }

    public function search(Request $request){
        $search = $request->search;
        $posts = Peminjaman::where(function($query) use ($search){
            $query->where('model_mobil','like',"%$search%")
            ->orWhere('merek_mobil','like',"%$search%");
        })
        ->get();

        return View('peminjamanBarang',compact('posts','search'));
    }

    
    
}
