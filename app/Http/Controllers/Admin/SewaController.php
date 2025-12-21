<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\Request;

class SewaController extends Controller
{
    /**
     * Menampilkan data sewa yang menunggu pembayaran.
     */
    public function menungguPembayaran()
{
    $rentals = Rental::where('status', 'menunggu_pembayaran')
        ->orderBy('id', 'desc')
        ->paginate(10);

    return view('admin.sewa.menunggu-pembayaran', compact('rentals'));
}


    /**
     * Mengupdate status rental.
     */
    public function updateStatus(Request $request, Rental $rental)
{
    // Validasi input status agar bisa menerima semua pilihan
     $request->validate([
        'status' => 'required|string|in:menunggu_pembayaran,menunggu_konfirmasi,sudah_dibayar,dibatalkan,selesai',
    ]);

    // Update status di database
    $rental->update([
        'status' => $request->status,
    ]);

    // Kembali ke halaman sebelumnya dengan pesan sukses
    return redirect()->back()->with('success', 'Status sewa berhasil diperbarui!');
}

    public function menungguKonfirmasi()
{
    // Query diubah agar HANYA mengambil status 'menunggu_konfirmasi'
    $rentals = Rental::where('status', 'menunggu_konfirmasi')
                ->with(['user', 'mobil'])
                ->latest()
                ->paginate(10);
    
    return view('admin.sewa.menunggu-konfirmasi', compact('rentals'));
}

public function pengembalian()
{
    // Ambil data rental yang statusnya 'sudah_dibayar'
    $rentals = Rental::where('status', 'sudah_dibayar')
                ->with(['user', 'mobil'])
                ->latest()
                ->paginate(10);
    
    return view('admin.sewa.pengembalian', compact('rentals'));
}

public function dataSewa()
{
    // Ambil semua data rental, terlepas dari statusnya
    $rentals = Rental::with(['user', 'mobil'])->latest()->paginate(10);
    
    return view('admin.sewa.data-sewa', compact('rentals'));
}

}