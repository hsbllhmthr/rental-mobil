<?php

namespace App\Http\Controllers;

use App\Models\Mobil; // Impor model Mobil
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // ADDED: Import Auth facade

class HomeController extends Controller
{
    public function index()
    {
        // --- TEMPORARY DEBUGGING START ---
        // if (Auth::check()) {
        //     dd('User is logged in: ' . Auth::user()->email);
        // } else {
        //     dd('User is NOT logged in.');
        // }
        // --- TEMPORARY DEBUGGING END ---

        // Ambil data mobil terbaru dari database, beserta data mereknya.
        // Kita batasi hanya 6 mobil untuk ditampilkan di halaman utama.
        $mobils = Mobil::with('merek')->latest()->take(6)->get();

        // Kirim data mobil ke view 'dashboard'
        return view('dashboard', compact('mobils'));
    }

   public function searchPage(Request $request)
{
    // Ambil semua pilihan unik dari database untuk filter
    $tipe_mobil_options = Mobil::select('tipe_mobil')->whereNotNull('tipe_mobil')->where('tipe_mobil', '!=', '')->distinct()->get();
    $transmisi_options = Mobil::select('transmisi')->whereNotNull('transmisi')->where('transmisi', '!=', '')->distinct()->get();
    $bahan_bakar_options = Mobil::select('bahan_bakar')->whereNotNull('bahan_bakar')->where('bahan_bakar', '!=', '')->distinct()->get();
    $kapasitas_options = Mobil::select('kapasitas')->whereNotNull('kapasitas')->distinct()->orderBy('kapasitas', 'asc')->get();

    // Mulai query builder
    $query = Mobil::with('merek');

    // Terapkan filter jika ada input
    if ($request->filled('search')) {
        $query->where('nama_mobil', 'like', '%' . $request->search . '%');
    }
    if ($request->filled('bahan_bakar')) {
        $query->where('bahan_bakar', $request->bahan_bakar);
    }
    if ($request->filled('kapasitas')) {
        $query->where('kapasitas', $request->kapasitas);
    }
    if ($request->filled('transmisi')) {
        $query->where('transmisi', $request->transmisi);
    }
    if ($request->filled('tipe_mobil')) {
        $query->where('tipe_mobil', $request->tipe_mobil);
    }
    if ($request->filled('fitur')) {
        $query->whereJsonContains('aksesoris', $request->fitur);
    }

    // Eksekusi query dengan pagination
    // withQueryString() penting agar filter tetap aktif saat pindah halaman
    $mobils = $query->latest()->paginate(9)->withQueryString();

    // Kirim data hasil pencarian dan pilihan filter ke view
    return view('cari-mobil', [
        'mobils' => $mobils,
        'tipe_mobil_options' => $tipe_mobil_options,
        'transmisi_options' => $transmisi_options,
        'bahan_bakar_options' => $bahan_bakar_options,
        'kapasitas_options' => $kapasitas_options,
    ]);
}

public function tentangKami()
{
    return view('tentang-kami');
}
public function kontak()
{
    return view('kontak');
}

public function syaratKetentuan()
{
    return view('syarat-ketentuan');
}

}