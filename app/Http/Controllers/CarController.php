<?php

namespace App\Http\Controllers;

use App\Models\Mobil; // Pastikan Model Mobil di-import
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Menampilkan halaman detail untuk mobil tertentu.
     */
    public function show(Mobil $mobil)
    {
        // Dengan Route Model Binding (Mobil $mobil), 
        // Laravel otomatis mencari mobil di database berdasarkan ID di URL.
        // Kita hanya perlu mengirimkannya ke view.
        return view('detail-car', compact('mobil'));
    }
}