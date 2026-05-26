<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            JenisKendaraanSeeder::class,
        ]);

        User::factory()->create([
            'nama_petugas' => 'Test User',
            'shift' => 'pagi',
            'password' => bcrypt('password'),
        ]);
    }
}