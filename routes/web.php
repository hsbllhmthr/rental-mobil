<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\MerekController;
use App\Http\Controllers\Admin\MobilController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SewaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Admin\BiayaDriverController;
use App\Http\Controllers\Admin\LaporanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// == HALAMAN PENGGUNA (USER-FACING) ==
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/offline', function () {
    return view('offline');
});

Route::get('/syarat-ketentuan', [HomeController::class, 'syaratKetentuan'])->name('syarat.ketentuan');

Route::get('/tentang-kami', [HomeController::class, 'tentangKami'])->name('tentang.kami');

Route::get('/cari-mobil', [HomeController::class, 'searchPage'])->name('mobil.search');

Route::get('/mobil/{mobil}', [CarController::class, 'show'])->name('car.detail');

Route::get('/register', [AuthController::class, 'create'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.submit');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/rental/{mobil}', [RentalController::class, 'create'])->middleware('auth')->name('rental.create');

Route::get('/kontak', [HomeController::class, 'kontak'])->name('kontak');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/cek-ketersediaan/{mobil}', [RentalController::class, 'cekKetersediaan'])->name('rental.cek_ketersediaan');
    Route::get('/riwayat-sewa', [ProfileController::class, 'riwayatSewa'])->name('riwayat.sewa');
    Route::get('/password/edit', [ProfileController::class, 'editPassword'])->name('password.edit');
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/rental/{mobil}', [RentalController::class, 'create'])->name('rental.create');
    Route::post('/rental/{mobil}', [RentalController::class, 'store'])->name('rental.store');
    Route::get('/menunggu-pembayaran/{rental}', [RentalController::class, 'waitingPage'])->name('rental.waiting');
    Route::post('/pembayaran/{rental}/upload', [RentalController::class, 'uploadProof'])->name('rental.upload_proof');
    
});

Route::get('/pengguna', [UserController::class, 'index'])->name('admin.pengguna.index');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');


// == HALAMAN ADMIN ==
Route::prefix('admin')->group(function () {
    // Rute untuk menampilkan form login admin
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login.form');
    // Rute untuk memproses login
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.submit');

    // Grup route yang HANYA BISA DIAKSES SETELAH LOGIN SEBAGAI ADMIN
    Route::middleware(['auth', 'admin'])->group(function () {
        
        Route::get('/laporan', [LaporanController::class, 'index'])->name('admin.laporan.index');
        Route::get('/laporan/cetak-pdf', [LaporanController::class, 'cetakPdf'])->name('admin.laporan.cetak_pdf');

        Route::get('/biaya-driver', [BiayaDriverController::class, 'index'])->name('admin.biaya_driver.index');
        Route::post('/biaya-driver', [BiayaDriverController::class, 'update'])->name('admin.biaya_driver.update');
        
        // Rute Dashboard Admin
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // --- SEMUA ROUTE CRUD SEHARUSNYA DI DALAM SINI ---

        // Route untuk Merek
        Route::get('/merek', [MerekController::class, 'index'])->name('admin.merek.index');
        Route::post('/merek', [MerekController::class, 'store'])->name('admin.merek.store');
        Route::put('/merek/{merek}', [MerekController::class, 'update'])->name('admin.merek.update');
        Route::delete('/merek/{merek}', [MerekController::class, 'destroy'])->name('admin.merek.destroy');

        // Route untuk Mobil
        Route::get('/mobil', [MobilController::class, 'index'])->name('admin.mobil.index');
        Route::get('/mobil/create', [MobilController::class, 'create'])->name('admin.mobil.create');
        Route::post('/mobil', [MobilController::class, 'store'])->name('admin.mobil.store');
        Route::get('/mobil/{mobil}/edit', [MobilController::class, 'edit'])->name('admin.mobil.edit'); // Nama diperbaiki
        Route::put('/mobil/{mobil}', [MobilController::class, 'update'])->name('admin.mobil.update'); // Route yang hilang ditambahkan
        Route::delete('/mobil/{mobil}', [MobilController::class, 'destroy'])->name('admin.mobil.destroy');

        Route::get('/sewa/menunggu-pembayaran', [SewaController::class, 'menungguPembayaran'])->name('admin.sewa.menunggu_pembayaran');
        Route::post('/sewa/{rental}/status', [SewaController::class, 'updfateStatus'])->name('admin.sewa.update_status');
        Route::get('/sewa/menunggu-konfirmasi', [SewaController::class, 'menungguKonfirmasi'])->name('admin.sewa.menunggu_konfirmasi');
        Route::post('/sewa/{rental}/status', [SewaController::class, 'updateStatus'])->name('admin.sewa.update_status');
        Route::get('/sewa/pengembalian', [SewaController::class, 'pengembalian'])->name('admin.sewa.pengembalian');
        Route::get('/sewa/data-sewa', [SewaController::class, 'dataSewa'])->name('admin.sewa.data_sewa');
    });
});

require __DIR__.'/password_reset.php';
require __DIR__.'/email_verification.php';