<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Rental; // Impor model Rental
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RentalController extends Controller
{
    public function create(Mobil $mobil)
    {
        return view('pemesanan', compact('mobil'));
    }

    /**
     * Menyimpan data rental baru.
     */
    public function store(Request $request, Mobil $mobil)
    {
        // 1. Validasi input
        $validated = $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'use_driver' => 'required|in:Ya,Tidak',
            // Tambahkan validasi lain jika perlu
        ]);
        
        // 2. Kalkulasi di sisi server (lebih aman)
        $tanggalMulai = new \DateTime($validated['start_date']);
        $tanggalSelesai = new \DateTime($validated['end_date']);
        $durasiHari = $tanggalSelesai->diff($tanggalMulai)->days;

        $biayaMobilTotal = $mobil->harga_sewa * $durasiHari;
        $biayaDriverTotal = ($validated['use_driver'] === 'Ya') ? (150000 * $durasiHari) : 0;
        $totalBiaya = $biayaMobilTotal + $biayaDriverTotal;

        // 3. Buat record rental baru
        $rental = Rental::create([
            'user_id' => Auth::id(),
            'mobil_id' => $mobil->id,
            'tanggal_mulai' => $validated['start_date'],
            'tanggal_selesai' => $validated['end_date'],
            'total_biaya' => $totalBiaya,
            'payment_deadline' => now()->addHours(24), // Set deadline 24 jam dari sekarang
            'status' => 'menunggu_pembayaran',
        ]);
        
        // 4. Arahkan ke halaman tunggu pembayaran dengan data rental yang baru dibuat
        return redirect()->route('rental.waiting', $rental->id);
    }

    /**
     * Menampilkan halaman "menunggu pembayaran".
     */
    public function waitingPage(Rental $rental)
    {
        // Pastikan user hanya bisa melihat pesanannya sendiri
        if ($rental->user_id !== Auth::id()) {
            abort(403);
        }
        return view('menunggu-pembayaran', compact('rental'));
    }

    public function uploadProof(Request $request, Rental $rental)
{
    // Pastikan user hanya bisa mengupload bukti untuk pesanannya sendiri
    if ($rental->user_id !== Auth::id()) {
        abort(403);
    }

    // 1. Validasi file yang diupload
    $request->validate([
        'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // 2. Simpan file baru
    $filePath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

    // 3. Update data di database
    $rental->update([
        'bukti_pembayaran' => $filePath,
        'status' => 'menunggu_konfirmasi', // Ubah statusnya
    ]);

    // 4. Arahkan kembali dengan pesan sukses
return redirect()->back();

}

    public function cekKetersediaan(Request $request, Mobil $mobil)
    {
        // Validasi input tanggal
        $data = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Query untuk mencari rental yang bentrok
        $isBooked = Rental::where('mobil_id', $mobil->id)
            ->whereIn('status', ['menunggu_pembayaran', 'menunggu_konfirmasi', 'sudah_dibayar'])
            ->where(function ($query) use ($data) {
                $query->where('tanggal_mulai', '<=', $data['end_date'])
                    ->where('tanggal_selesai', '>=', $data['start_date']);
            })
            ->exists(); // Cukup cek apakah ada data yang cocok

        if ($isBooked) {
            return response()->json([
                'tersedia' => false,
                'pesan' => 'Mobil tidak tersedia pada rentang tanggal tersebut. Silakan pilih tanggal lain.'
            ]);
        }

        return response()->json([
            'tersedia' => true,
            'pesan' => 'Mobil tersedia! Silakan lanjutkan pemesanan.'
        ]);
    }

}