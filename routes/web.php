<?php

use App\Http\Controllers\CreateProductController;
use App\Http\Controllers\CrudPeminjamanController;
use App\Http\Controllers\MengembalikanMobilcontroller;
use App\Http\Controllers\NotePeminjamanMobilController;
use App\Http\Controllers\peminjamanBarangController;
use App\Http\Controllers\ProductSearchController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// crud produk
Route::get('/dashboard', [CreateProductController::class,'index'])->middleware(['auth', 'verified'])->middleware(['auth','admin'])->name('dashboard');
Route::resource('/crud/produk', CreateProductController::class);

// crud peminjaman
Route::get('/crud/peminjaman', [CrudPeminjamanController::class,'index'])->middleware(['auth', 'verified'])->name('crud.peminjaman');
Route::resource('/CrudPeminjaman/peminjaman', CrudPeminjamanController::class);


// peminjaman 
Route::get('/peminjamanBarang',[peminjamanBarangController::class,'index'])->middleware(['auth', 'verified'])->name('peminjamanBarang');
Route::get('/peminjamanBarang/search', [peminjamanBarangController::class, 'search']);

// note Peminjaman
Route::get('/notePeminjamanMobil',[NotePeminjamanMobilController::class,'index'])->middleware(['auth', 'verified'])->name('notePeminjamanMobil');
Route::put('/notePeminjamanMobil/{id}',[NotePeminjamanMobilController::class,'updateVerifikasi'])->middleware(['auth', 'verified'])->name('notePeminjamanMobil.update');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // mengembalikan mobil
    Route::get('/MengembalikanMobil',[ MengembalikanMobilcontroller::class,'index'])->name('MengembalikanMobil');
    Route::post('/return-Car',[ MengembalikanMobilcontroller::class,'returnCar'])->name('returnCar');

});

require __DIR__.'/auth.php';
