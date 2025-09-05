<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merek; // Impor model Merek
use Illuminate\Http\Request;

class MerekController extends Controller
{
    /**
     * Menampilkan daftar semua merek.
     */
    public function index()
    {
        // Ambil semua data merek dari database, urutkan dari yang terbaru
       $mereks = Merek::latest()->paginate(5);

        // Kirim data ke view
        return view('admin.merek.index', compact('mereks'));
    }

    /**
     * Menyimpan merek baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'nama_merek' => 'required|string|unique:mereks|max:255',
        ]);

        // 2. Simpan data ke database
        Merek::create([
            'nama_merek' => $request->nama_merek,
        ]);

        // 3. Kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.merek.index')->with('success', 'Merek baru berhasil ditambahkan!');
    }

    public function destroy(Merek $merek)

    {
    // Hapus data merek yang dipilih
    $merek->delete();

    // Kembali ke halaman index dengan pesan sukses
    return redirect()->route('admin.merek.index')->with('success', 'Merek berhasil dihapus!');
    }

    public function update(Request $request, Merek $merek)
    {
    // Validasi input
    $request->validate([
        'nama_merek' => 'required|string|unique:mereks,nama_merek,' . $merek->id . '|max:255',
    ]);

    // Update data merek
    $merek->update([
        'nama_merek' => $request->nama_merek,
    ]);

    // Kembali ke halaman index dengan pesan sukses
    return redirect()->route('admin.merek.index')->with('success', 'Merek berhasil diperbarui!');
    }
}