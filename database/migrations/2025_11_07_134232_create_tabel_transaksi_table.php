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
            $table->unsignedInteger('total_biaya')->default(0);
            $table->foreignId('id_jenis_fk')
                  ->constrained('tabel_jenis_kendaraan', 'id_jenis');
            $table->foreignId('id_petugas_fk')
                  ->nullable()
                  ->constrained('users', 'id') 
                  ->onDelete('set null');

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
