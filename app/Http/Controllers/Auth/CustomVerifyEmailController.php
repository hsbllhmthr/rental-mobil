<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Verified;

class CustomVerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param  string  $hash
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request, $id, $hash)
    {
        // 1. Cari user berdasarkan ID
        $user = User::find($id);

        // Jika user tidak ditemukan, batalkan.
        if (! $user) {
            abort(404, 'User tidak ditemukan.');
        }
        
        // 2. Jika user sudah terverifikasi, langsung arahkan ke beranda.
        if ($user->hasVerifiedEmail()) {
            // Jika belum login, login-kan
            if (!Auth::check()) {
                Auth::login($user);
            }
            return redirect()->route('home')->with('status', 'Email Anda sudah terverifikasi!');
        }

        // 3. Verifikasi hash. Ini adalah bagian keamanan yang penting.
        // Memastikan link tidak diubah.
        if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            abort(403, 'Tautan verifikasi tidak valid.');
        }

        // 4. Tandai email sebagai terverifikasi dan picu event 'Verified'.
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        // 5. Login-kan user dan arahkan ke beranda dengan pesan sukses.
        Auth::login($user);

        $request->session()->regenerate();
        
        return redirect()->route('home')->with('status', 'Selamat, akun Anda telah berhasil di verifikasi!');
    }
}
