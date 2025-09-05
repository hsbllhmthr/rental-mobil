<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class BiayaDriverController extends Controller
{
    public function index()
    {
        // Ambil data biaya driver dari database, jika tidak ada beri nilai default 150000
        $biayaDriver = Setting::where('key', 'biaya_driver_harian')->first()->value ?? 150000;

        return view('admin.biaya-driver.index', compact('biayaDriver'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'biaya_driver' => 'required|integer|min:0',
        ]);

        // Gunakan updateOrCreate untuk menyimpan atau memperbarui data
        Setting::updateOrCreate(
            ['key' => 'biaya_driver_harian'],
            ['value' => $request->biaya_driver]
        );

        return redirect()->back()->with('success', 'Biaya driver berhasil diperbarui!');
    }
}