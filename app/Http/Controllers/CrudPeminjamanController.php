<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CrudPeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $users = User::all();

        // // Mendapatkan semua data mstr_brng
        // $mstr_brngs = Product::all();
        // return view('crud.peminjaman.index', [
        //     'users' => $users,
        //     'mstr_brngs' => $mstr_brngs
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return View('crud.peminjaman.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $data = $request ->validate([
        //     'id_user' => 'required|string',
        //     'merek_mobil' => 'required|string',
        //     'model_mobil' => 'required|string',
        //     'harga_sewa' => 'required|string',
        //     'tangal_mulai' => 'nullable|date',
        //     'tanggal_selesai' => 'nullable|date',
        //     'verifikasi_mobil' => 'nullable|string',
        //     'name' => 'required|string',
        //     'alamat' => 'required|string',
        //     'nomer_telepon' => 'required|string',
        //     'nomer_sim' => 'required|string',
        //     'nomer_plat' => 'required|string',
        //     'email' => 'required|string',
        // ]);

        // // Buat objek Carbon untuk tanggal mulai dan tanggal selesai
        // $data['tangal_mulai'] = $data['tangal_mulai'] ? Carbon::createFromFormat('d/m/Y', $data['tangal_mulai'])->format('Y-m-d') : null;
        // $data['tanggal_selesai'] = $data['tanggal_selesai'] ? Carbon::createFromFormat('d/m/Y', $data['tanggal_selesai'])->format('Y-m-d') : null;
        // // $data['verifikasi_mobil'] = $data['verifikasi_mobil'] ? 'Padding' : null;
        // Peminjaman::create($data);


        // session()->flash('success','New post has been added!');
        // return redirect()->route('peminjamanBarang');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
