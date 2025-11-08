<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Gunakan Authenticatable
use Illuminate\Notifications\Notifiable;

// Ganti "extends Model" menjadi "extends Authenticatable" agar bisa login
class Petugas extends Authenticatable
{
    use HasFactory, Notifiable;

    // Sesuaikan dengan spesifikasi database Anda
    protected $table = 'tabel_petugas';
    
    protected $primaryKey = 'id_petugas';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'nama_petugas',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
}