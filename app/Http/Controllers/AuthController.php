<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function create()
    {
        return view('register');
    }

    /**
     * Menangani proses logout.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Arahkan ke halaman utama setelah logout
        return redirect('/'); 
    }

    public function store(Request $request)
    {
        // 1. Validasi semua input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:15',
            'alamat' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'ktp_photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'kk_photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 2. Proses upload file
        $ktpPath = $request->file('ktp_photo')->store('user_documents/ktp', 'public');
        $kkPath = $request->file('kk_photo')->store('user_documents/kk', 'public');

        // 3. Buat user baru di database
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'nomor_telepon' => $validated['nomor_telepon'],
            'alamat' => $validated['alamat'],
            'password' => Hash::make($validated['password']), // Enkripsi password
            'foto_ktp' => $ktpPath,
            'foto_kk' => $kkPath,
        ]);

        // 4. Picu event 'Registered' yang akan mengirim email verifikasi
        event(new Registered($user));

        // 5. Arahkan ke halaman utama dengan pesan status
        return redirect()->route('home')->with('status', 'Pendaftaran berhasil! Silakan cek email Anda untuk tautan verifikasi.');
    }

    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        // Cek agar admin tidak login dari form ini (opsional tapi bagus)
        if (Auth::user()->role === 'admin') {
            Auth::logout();
            return back()->withErrors(['email' => 'Akun admin harus login melalui halaman admin.'])->onlyInput('email');
        }
        
        $request->session()->regenerate();
        return redirect()->intended(route('home'));
    }

    return back()->with('login_error', true)->withInput();
}
}