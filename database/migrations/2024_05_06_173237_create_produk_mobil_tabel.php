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
        Schema::create('mstr_mobil', function (Blueprint $table) {
            $table->id();
            $table->string('merek_mobil');
            $table->string('model_mobil');
            $table->string('nomer_plat')->unique();
            $table->string('harga_sewa');
            $table->date('tangal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->string('verifikasi_mobil')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_mobil_tabel');
    }
};
