<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; // Impor model User
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Ambil data semua user, kecuali admin, lalu paginasi
        $users = User::where('role', '!=', 'admin')->latest()->paginate(10);

        return view('admin.pengguna.index', compact('users'));
    }
}