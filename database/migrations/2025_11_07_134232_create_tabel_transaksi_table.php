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
        Schema::create('tabel_transaksi', function (Blueprint $table) {
            $table->string('id_tiket')->primary();
            $table->dateTime('jam_masuk');
            $table->dateTime('jam_keluar')->nullable();
            $table->integer('total_biaya')->unsigned()->default(0);

            // Foreign key untuk Jenis Kendaraan
            $table->unsignedBigInteger('id_jenis_fk');
            $table->foreign('id_jenis_fk')->references('id_jenis')->on('tabel_jenis_kendaraan');

            $table->unsignedBigInteger('id_petugas_fk')->nullable();
            $table->foreign('id_petugas_fk')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabel_transaksi');
    }
};
