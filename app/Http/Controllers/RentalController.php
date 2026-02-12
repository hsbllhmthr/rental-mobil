<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RentalController extends Controller
{
    /**
     * Menampilkan form pemesanan
     */
    public function create(Mobil $mobil)
    {
        return view('pemesanan', compact('mobil'));
    }

    /**
     * Menyimpan data rental baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'mobil_id'   => 'required|exists:mobils,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date'   => 'required|date|after:start_date',
            'use_driver' => 'required|in:Ya,Tidak',
        ]);

        $mobil = Mobil::findOrFail($validated['mobil_id']);
        
        // Kalkulasi durasi dan biaya
        $tanggalMulai = new \DateTime($validated['start_date']);
        $tanggalSelesai = new \DateTime($validated['end_date']);
        $durasiHari = $tanggalSelesai->diff($tanggalMulai)->days + 1;

        $biayaMobilTotal = $mobil->harga_sewa * $durasiHari;
        $biayaDriverTotal = ($validated['use_driver'] === 'Ya') ? (150000 * $durasiHari) : 0;
        $totalBiaya = $biayaMobilTotal + $biayaDriverTotal;

        $rental = Rental::create([
            'user_id'          => Auth::id(),
            'mobil_id'         => $mobil->id,
            'tanggal_mulai'    => $validated['start_date'],
            'tanggal_selesai'  => $validated['end_date'],
            'total_biaya'      => $totalBiaya,
            'payment_deadline' => now()->addHour(),
            'status'           => 'menunggu_pembayaran',
        ]);
        
        return redirect()->route('rental.waiting', $rental->id);
    }

    /**
     * Menampilkan halaman "menunggu pembayaran".
     */
    public function waitingPage($rental_id)
    {
        $rental = Rental::findOrFail($rental_id);

        // Pastikan hanya pemilik rental yang bisa melihat
        if ($rental->user_id != Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        return view('menunggu-pembayaran', compact('rental'));
    }

    /**
     * Proses Upload Bukti Pembayaran
     */
    public function uploadProof(Request $request, $rental_id)
    {
        // Gunakan findOrFail dengan ID untuk memastikan data ditemukan
        $rental = Rental::findOrFail($rental_id);

        // Validasi Kepemilikan (Gunakan != untuk menghindari tipe data int vs string)
        if ($rental->user_id != Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengunggah bukti pada transaksi ini.');
        }

        // 1. Validasi File
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'bukti_pembayaran.required' => 'Silakan pilih file gambar terlebih dahulu.',
            'bukti_pembayaran.image'    => 'File harus berupa gambar.',
            'bukti_pembayaran.max'      => 'Ukuran gambar maksimal adalah 2MB.',
        ]);

        try {
            if ($request->hasFile('bukti_pembayaran')) {
                // 2. Simpan file ke storage/app/public/bukti_pembayaran
                $filePath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

                // Hapus foto lama jika ingin menghemat storage (Opsional)
                if ($rental->bukti_pembayaran) {
                    Storage::disk('public')->delete($rental->bukti_pembayaran);
                }

                // 3. Update status dan path file
                $rental->update([
                    'bukti_pembayaran' => $filePath,
                    'status'           => 'menunggu_konfirmasi',
                ]);

                return redirect()->back()->with('success', 'Bukti pembayaran berhasil diunggah! Mohon tunggu konfirmasi admin.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengunggah: ' . $e->getMessage());
        }

        return redirect()->back()->with('error', 'Gagal mengunggah file.');
    }

    /**
     * Cek Ketersediaan Mobil (AJAX)
     */
    public function cekKetersediaan(Request $request, Mobil $mobil)
    {
        $data = $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
        ]);

        $isBooked = Rental::where('mobil_id', $mobil->id)
            ->whereIn('status', ['menunggu_pembayaran', 'menunggu_konfirmasi', 'sudah_dibayar'])
            ->where(function ($query) use ($data) {
                $query->where('tanggal_mulai', '<=', $data['end_date'])
                      ->where('tanggal_selesai', '>=', $data['start_date']);
            })
            ->exists();

        return response()->json([
            'tersedia' => !$isBooked,
            'pesan'    => $isBooked ? 'Mobil tidak tersedia pada tanggal tersebut.' : 'Mobil tersedia!'
        ]);
    }
}