<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mobil; // Impor model Mobil
use Illuminate\Http\Request;
use App\Models\Merek;
use Illuminate\Support\Facades\Storage;

class MobilController extends Controller
{
    public function index()
    {
        // Ambil data mobil dengan data mereknya sekaligus, 10 data per halaman
        $mobils = Mobil::with('merek')->latest()->paginate(10);

        return view('admin.mobil.index', compact('mobils'));
    }

     public function create()
    {
        // Ambil semua data merek untuk ditampilkan di dropdown
        $mereks = Merek::orderBy('nama_merek')->get();
        return view('admin.mobil.create', compact('mereks'));
    }

    /**
     * Menyimpan mobil baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi semua input termasuk gambar
        $validated = $request->validate([
            'nama_mobil' => 'required|string|max:255',
            'merek_id' => 'required|exists:mereks,id',
            'deskripsi' => 'required|string',
            'no_polisi' => 'required|string|unique:mobils|max:20',
            'harga_sewa' => 'required|integer',
            'bahan_bakar' => 'required|string',
            'tahun' => 'required|integer|min:1990',
            'kapasitas' => 'required|integer',
            'transmisi' => 'required|string',
            'tipe_mobil' => 'required|string',
            'jumlah_kursi' => 'required|integer',
            'gambar' => 'required|array|min:4|max:4', // Pastikan ada 4 gambar
            'gambar.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'aksesoris' => 'nullable|array', // Validasi setiap gambar
        ]);

        // 2. Proses upload gambar
        $gambarPaths = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                // Simpan file ke public/storage/mobil-images dan dapatkan path-nya
                $path = $file->store('mobil-images', 'public');
                $gambarPaths[] = $path;
            }
        }
        
        // Gabungkan path gambar ke dalam data yang akan disimpan
        $validated['gambar'] = json_encode($gambarPaths);

        // 3. Simpan data mobil ke database
        Mobil::create($validated);

        // 4. Kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.mobil.index')->with('success', 'Mobil baru berhasil ditambahkan!');
    }

    public function destroy(Mobil $mobil)
    {
        // Cek apakah mobil ini memiliki relasi dengan data penyewaan (rentals)
        // Hanya cek untuk rental yang masih aktif (belum selesai atau dibatalkan)
        if ($mobil->rentals()->whereIn('status', ['menunggu_pembayaran', 'menunggu_konfirmasi', 'sudah_dibayar'])->exists()) {
            return redirect()->route('admin.mobil.index')->with('error', 'Gagal menghapus! Mobil ini memiliki riwayat penyewaan aktif dan tidak dapat dihapus.');
        }

        // Hapus gambar-gambar terkait dari storage
        if ($mobil->gambar) {
            $gambarPaths = json_decode($mobil->gambar, true);
            if (is_array($gambarPaths)) {
                foreach ($gambarPaths as $path) {
                    Storage::disk('public')->delete($path);
                }
            }
        }

        // Hapus data dari database
        $mobil->delete();

        return redirect()->route('admin.mobil.index')->with('success', 'Data mobil berhasil dihapus!');
    }

public function edit(Mobil $mobil)
{
    $mereks = Merek::orderBy('nama_merek')->get();
    return view('admin.mobil.edit', compact('mobil', 'mereks'));
}

/**
 * Mengupdate data mobil di database.
 */
public function update(Request $request, Mobil $mobil)
{
    // LENGKAPI ATURAN VALIDASI DI SINI
    $validated = $request->validate([
        'nama_mobil' => 'required|string|max:255',
        'merek_id' => 'required|exists:mereks,id',
        'deskripsi' => 'required|string',
        'no_polisi' => 'required|string|max:20|unique:mobils,no_polisi,' . $mobil->id,
        'harga_sewa' => 'required|integer',        // Sudah ada
        'bahan_bakar' => 'required|string',       // Tambahkan ini
        'tahun' => 'required|integer|min:1990',   // Tambahkan ini
        'kapasitas' => 'required|integer',        // Tambahkan ini
        'transmisi' => 'required|string',       // Tambahkan ini
        'tipe_mobil' => 'required|string',      // Tambahkan ini
        'jumlah_kursi' => 'required|integer',     // Tambahkan ini
        'gambar' => 'nullable|array|min:4|max:4',
        'gambar.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        'aksesoris' => 'nullable|array', 
    ]);

    // Cek jika ada gambar baru yang di-upload
    if ($request->hasFile('gambar')) {
        // ... (logika hapus gambar lama dan upload baru) ...
        $gambarPaths = [];
        foreach ($request->file('gambar') as $file) {
            $path = $file->store('mobil-images', 'public');
            $gambarPaths[] = $path;
        }
        $validated['gambar'] = json_encode($gambarPaths);
    }
    
    // Update data mobil di database
    $mobil->update($validated);

    return redirect()->route('admin.mobil.index')->with('success', 'Data mobil berhasil diperbarui!');
}

}