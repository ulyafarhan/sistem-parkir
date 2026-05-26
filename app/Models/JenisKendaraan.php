<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisKendaraan extends Model
{
    use HasFactory;
    
    protected $table = 'tabel_jenis_kendaraan';
    
    protected $primaryKey = 'id_jenis';

    protected $fillable = [
        'nama_jenis',
        'tarif_per_hari',
    ];

    public function transaksi(): HasMany
    {
        return $this->hasMany(Transaksi::class, 'id_jenis_fk');
    }
}