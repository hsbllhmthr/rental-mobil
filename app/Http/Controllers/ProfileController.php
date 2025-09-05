<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\Rental; 

use Illuminate\Support\Facades\Storage;
class ProfileController extends Controller
{
        public function riwayatSewa()
    {
        // Ambil semua data rental milik user yang sedang login
        $rentals = Rental::where('user_id', Auth::id())
                    ->with('mobil.merek') // Ambil data mobil beserta mereknya
                    ->latest()
                    ->paginate(10);
        
        return view('profile.riwayat-sewa', compact('rentals'));
    }
        public function editPassword()
    {
        return view('profile.password-edit');
    }

    public function updatePassword(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        // Update password di database
        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('password.edit')->with('success', 'Password berhasil diubah!');
    }
    /**
     * Menampilkan halaman form edit profil.
     */
    public function edit(): View
    {
        // Mengambil data user yang sedang login
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Mengupdate informasi profil pengguna.
     */
    public function update(Request $request): RedirectResponse
{
    $user = User::find(Auth::id());

    // Validasi input, termasuk file gambar yang sekarang opsional
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'nomor_telepon' => ['required', 'string', 'max:15'],
        'alamat' => ['required', 'string'],
        'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        'foto_ktp' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        'foto_kk' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
    ]);
    
    // Proses upload foto KTP jika ada file baru
    if ($request->hasFile('foto_ktp')) {
        // Hapus file lama jika ada
        if ($user->foto_ktp) {
            Storage::disk('public')->delete($user->foto_ktp);
        }
        // Simpan file baru dan update path-nya
        $validated['foto_ktp'] = $request->file('foto_ktp')->store('user_documents/ktp', 'public');
    }

    // Proses upload foto KK jika ada file baru
    if ($request->hasFile('foto_kk')) {
        if ($user->foto_kk) {
            Storage::disk('public')->delete($user->foto_kk);
        }
        $validated['foto_kk'] = $request->file('foto_kk')->store('user_documents/kk', 'public');
    }

    $user->update($validated);

    return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui!');
}

    /**
     * (Opsional) Method untuk menghapus akun.
     * Anda bisa biarkan ini jika tidak membutuhkan fungsionalitas hapus akun.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->to('/');
    }
}