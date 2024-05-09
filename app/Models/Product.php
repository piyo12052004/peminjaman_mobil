<?php

namespace App\Models;

use App\Events\ProductCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'mstr_mobil';


    protected $fillable = [
        'merek_mobil',
        'model_mobil',
        'harga_sewa',
        'nomer_plat',
        'tangal_mulai',
        'tanggal_selesai',
        'verifikasi_mobil',
    ];

    protected $dispatchesEvents = [
        'created' => ProductCreated::class,
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'id');
    }
    public function peminjam()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
