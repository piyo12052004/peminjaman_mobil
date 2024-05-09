<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateProductController extends Controller
{
    public function index(){
        if(Auth::id()){
            $usertype=Auth()->user()->usertype;
            if($usertype == 'user'){
                return View('/peminjamanBarang');
            }elseif($usertype=='admin'){
                    $product = Product::with('author')->get();
                    $data = Peminjaman::all();
                    return view(
                        'dashboard',[
                        'product' => $product,
                        // 'posts' => $posts,
                        // 'peminjaman' => $peminjaman,
                        'data' => $data
                        ]
                );
            }
        }
    }

    // creacted
    public function create()
    {
        return view('crud.produk.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'merek_mobil' => 'required|max:255',
            'model_mobil' => 'required|max:255',
            'harga_sewa' => 'required|numeric|min:0',
            'nomer_plat' => ['required', 'string', 'unique:' . Product::class],
        ]);
    
        $data['verifikasi_mobil'] = 'Tersedia';
    
        // Simpan data produk baru
        Product::create($data);
    
        session()->flash('success', 'New post has been added!');
        return redirect('/dashboard');
    }
    

    // update
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('/crud/produk/edit', compact('product'));
    }

//     public function update(Request $request, $id)
// {
//     // Validasi data yang dikirimkan
//     $validatedData = $request->validate([
//         'merek_mobil' => 'required|string',
//         'model_mobil' => 'required|string',
//         'harga_sewa' => 'required|string',
//         'tangal_mulai' => 'nullable|date',
//         'tanggal_selesai' => 'nullable|date',
//         'verifikasi_mobil' => 'nullable|string',
//     ]);

//     $product = Product::findOrFail($id);

//     $product->merek_mobil = $validatedData['merek_mobil'];
//     $product->model_mobil = $validatedData['model_mobil'];
//     $product->harga_sewa = $validatedData['harga_sewa'];
//     $product->tangal_mulai = Carbon::createFromFormat('d/m/Y', $validatedData['tangal_mulai'])->format('Y-m-d');
//     $product->tanggal_selesai = Carbon::createFromFormat('d/m/Y', $validatedData['tanggal_selesai'])->format('Y-m-d');
//     $product->verifikasi_mobil = $validatedData['verifikasi_mobil'];
//     // Simpan perubahan ke dalam database
//     $product->save();

//     $peminjaman = $product->peminjaman;
//     if ($peminjaman) {
//         $peminjaman->merek_mobil = $product->merek_mobil;
//         $peminjaman->model_mobil = $product->model_mobil;
//         $peminjaman->nomer_plat = $product->nomer_plat;
//         $peminjaman->harga_sewa = $product->harga_sewa;
//         $peminjaman->tanggal_mulai = $product->tanggal_mulai;
//         $peminjaman->tanggal_selesai = $product->tanggal_selesai;
//         $peminjaman->save();
//     }
//     // Redirect dengan pesan sukses
//     return redirect('/peminjamanBarang')->with('success', 'Post has been updated!');
// }

public function update(Request $request, $id)
{
    // Validasi data yang dikirimkan
    $validatedData = $request->validate([
        'merek_mobil' => 'required|string',
        'model_mobil' => 'required|string',
        'harga_sewa' => 'required|string',
        'tangal_mulai' => 'nullable|date',
        'tanggal_selesai' => 'nullable|date',
        'verifikasi_mobil' => 'nullable|string',
    ]);

    // Temukan produk berdasarkan ID
    $product = Product::findOrFail($id);

    // Simpan data produk yang lama
    $oldProductData = $product->toArray();

    // Update data produk
    $product->merek_mobil = $validatedData['merek_mobil'];
    $product->model_mobil = $validatedData['model_mobil'];
    $product->harga_sewa = $validatedData['harga_sewa'];
    $product->tangal_mulai = Carbon::createFromFormat('d/m/Y', $validatedData['tangal_mulai'])->format('Y-m-d');
    $product->tanggal_selesai = Carbon::createFromFormat('d/m/Y', $validatedData['tanggal_selesai'])->format('Y-m-d');
    $product->verifikasi_mobil = $validatedData['verifikasi_mobil'];

    // Simpan perubahan ke dalam database

    $user = auth()->user();
    // Jika verifikasi mobil telah berubah dan menjadi sukses
    if ($validatedData['verifikasi_mobil'] == 'Padding' && $oldProductData['verifikasi_mobil'] != 'Padding') {
        // Buat entri baru dalam tabel Peminjaman
        $peminjaman = new Peminjaman();
        $peminjaman->id_product = $product->id;
        $peminjaman->id_user = auth()->user()->id; 
        $peminjaman->merek_mobil = $product->merek_mobil; 
        $peminjaman->model_mobil = $product->model_mobil; 
        $peminjaman->nomer_plat = $product->nomer_plat; 
        $peminjaman->harga_sewa = $product->harga_sewa; 
        $peminjaman->tangal_mulai = $product->tangal_mulai; 
        $peminjaman->tanggal_selesai = $product->tanggal_selesai; 
        $peminjaman->verifikasi_mobil = $product->verifikasi_mobil; 
        $peminjaman->name = $user->name;
        $peminjaman->alamat = $user->alamat; 
        $peminjaman->nomer_telepon = $user->nomer_telepon; 
        $peminjaman->nomer_sim = $user->nomer_sim;
        $peminjaman->email = $user->email;
        // $peminjaman->tanggal_peminjaman = now();
        $peminjaman->save();
    }
    $product->save();
    // Redirect dengan pesan sukses
    return redirect('/peminjamanBarang')->with('success', 'Post has been updated!');
}



// delete
    public function destroy($id_peminjaman)
    {
        $data = Product::find($id_peminjaman);

        if ($data) {
            $data->delete();

            return redirect('/dashboard')->with('delet', 'Data has been deleted!');
        } else {
            return redirect('/dashboard')->with('error', 'Data not found!');
        }
    }   
}
