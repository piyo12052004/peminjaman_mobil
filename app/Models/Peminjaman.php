<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'mstr_pinjam';
    protected $primaryKey = 'id_peminjaman';

    protected $fillable = [
        'merek_mobil',
        'model_mobil',
        'harga_sewa',
        'nomer_plat',
        'tangal_mulai',
        'tanggal_selesai',
        'verifikasi_mobil',
        'name',
        'alamat',
        'nomer_telepon',
        'nomer_sim',
        'email',
    ];

    public function author()
    {
        return $this->belongsTo(User::class,'id_user');
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
