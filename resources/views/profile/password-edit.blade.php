@extends('layouts.app')

@section('title', 'Ubah Password')

@section('content')
<div class="password-container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="register-header">
        <h1>Ubah Password</h1>
        <p>Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.</p>
    </div>
    
    <form class="form-wrapper" action="{{ route('password.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group-large">
            <label for="current_password">Password Saat Ini</label>
            <input type="password" id="current_password" name="current_password" required>
        </div>

        <div class="form-group-large">
            <label for="password">Password Baru</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group-large">
            <label for="password_confirmation">Konfirmasi Password Baru</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div class="profile-form-actions">
        <a href="{{ route('profile.edit') }}" class="btn btn-outline">Kembali</a>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </div>
    </form>
</div>
@endsection