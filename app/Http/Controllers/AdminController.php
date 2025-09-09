<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\Merek;
use App\Models\Mobil;
use App\Models\Rental;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Menampilkan form login untuk admin.
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Menangani proses login admin.
     */
    public function login(Request $request): RedirectResponse
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba untuk login
        if (Auth::attempt($credentials)) {
            // Cek apakah user yang login adalah admin
            if (Auth::user()->role === 'admin') {
                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard'));
            }
            
            // Jika berhasil login tapi bukan admin, logout lagi dan beri error
            Auth::logout();
            return back()->withErrors([
                'email' => 'Anda bukan admin.',
            ])->onlyInput('email');
        }

        // Jika kredensial salah
        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak cocok dengan data kami.',
        ])->onlyInput('email');
    }

    /**
     * Menampilkan dashboard admin.
     */
    public function dashboard()
    {
        // Hitung semua data statistik
        $menungguPembayaran = Rental::where('status', 'menunggu_pembayaran')->count();
        $menungguKonfirmasi = Rental::where('status', 'menunggu_konfirmasi')->count();
        $belumDikembalikan = Rental::where('status', 'sudah_dibayar')->count();
        $totalMerek = Merek::count();
        $jumlahMobil = Mobil::count();
        $totalSewa = Rental::count();
        $totalUser = User::where('role', 'user')->count();

        // Kirim semua data ke view
        return view('admin.dashboard', compact(
            'menungguPembayaran',
            'menungguKonfirmasi',
            'belumDikembalikan',
            'totalMerek',
            'jumlahMobil',
            'totalSewa',
            'totalUser'
        ));
    }

    /**
     * Menangani proses logout admin.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login.form');
    }
}