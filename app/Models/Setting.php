<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;
    public $timestamps = false; // Kita tidak butuh created_at/updated_at
    protected $fillable = ['key', 'value'];
}
