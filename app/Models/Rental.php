<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mobil_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'total_biaya',
        'payment_deadline',
        'status',
        'bukti_pembayaran',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'payment_deadline' => 'datetime',
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}

public function mobil()
{
    return $this->belongsTo(Mobil::class);
}

}