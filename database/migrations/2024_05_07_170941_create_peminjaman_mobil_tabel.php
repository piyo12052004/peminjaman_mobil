<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mstr_pinjam', function (Blueprint $table) {
            $table->id('id_peminjaman');
            $table->string('id_user');
            $table->string('id_product');
            $table->string('merek_mobil');
            $table->string('model_mobil');
            $table->string('nomer_plat')->unique();
            $table->string('harga_sewa');
            $table->date('tangal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->string('verifikasi_mobil');
            $table->string('name');
            $table->string('alamat');
            $table->string('nomer_telepon')->unique();
            $table->string('nomer_sim')->unique();
            $table->string('email')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman_mobil_tabel');
    }
};
