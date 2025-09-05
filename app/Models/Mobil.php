<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;

    protected $fillable = [
        'merek_id',
        'nama_mobil',
        'no_polisi',
        'harga_sewa',
        'bahan_bakar',
        'tahun',
        'deskripsi',
        'kapasitas',
        'transmisi',
        'tipe_mobil',
        'jumlah_kursi',
        'gambar',
        'aksesoris'
    ];

    protected $casts = [
        'aksesoris' => 'array',
    ];
    
    public function merek()
    {
        return $this->belongsTo(Merek::class);
    }
}