<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Rental::with(['user', 'mobil']);

        // Filter berdasarkan tanggal jika ada input
        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('tanggal_mulai', [$request->tanggal_awal, $request->tanggal_akhir]);
        }

        // Ambil semua data yang cocok (tanpa pagination untuk laporan)
        $rentals = $query->latest()->get();

        return view('admin.laporan.index', compact('rentals'));
    }

    public function cetakPdf(Request $request)
    {
        $query = Rental::with(['user', 'mobil']);

        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;

        // Terapkan filter tanggal yang sama seperti di halaman laporan
        if ($tanggal_awal && $tanggal_akhir) {
            $query->whereBetween('tanggal_mulai', [$tanggal_awal, $tanggal_akhir]);
        }

        $rentals = $query->latest()->get();

        // Buat PDF dari view baru yang akan kita buat
        $pdf = Pdf::loadView('admin.laporan.pdf', compact('rentals', 'tanggal_awal', 'tanggal_akhir'));
        
        // Tampilkan PDF di browser sebagai preview
        return $pdf->stream('laporan-pendapatan.pdf');
    }
}