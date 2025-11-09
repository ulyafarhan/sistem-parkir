<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisKendaraan;

class JenisKendaraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisKendaraan::create([
            'nama_jenis' => 'MOBIL',
            'tarif_per_hari' => 5000,
        ]);

        JenisKendaraan::create([
            'nama_jenis' => 'MOTOR',
            'tarif_per_hari' => 2000,
        ]);
    }
}