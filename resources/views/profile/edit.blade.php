@extends('layouts.app')

@section('title', 'Pengaturan Profil')

@section('content')
<div class="profile-page-container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="profile-header">
        <h1>Pengaturan Profil</h1>
        <p>Perbarui informasi profil dan alamat email akun Anda.</p>
    </div>
    
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="profile-form-grid">
            {{-- Nama Lengkap --}}
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            </div>

            {{-- Email --}}
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            {{-- Nomor Telepon --}}
            <div class="form-group">
                <label for="nomor_telepon">Telepon</label>
                <input type="tel" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon', $user->nomor_telepon) }}" required>
            </div>
            
            {{-- Alamat --}}
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" id="alamat" name="alamat" value="{{ old('alamat', $user->alamat) }}" required>
            </div>

            {{-- Foto KTP Saat Ini --}}
            <div class="form-group">
                <label>Foto KTP saat ini</label>
                <div class="document-preview">
                    @if($user->foto_ktp)
                        <img src="{{ asset('storage/' . $user->foto_ktp) }}" alt="Foto KTP" class="profile-document-image">
                    @else
                        <span class="no-image">Belum ada foto KTP.</span>
                    @endif
                </div>
            </div>

            {{-- Foto KK Saat Ini --}}
            <div class="form-group">
                <label>Foto KK saat ini</label>
                <div class="document-preview">
                    @if($user->foto_kk)
                        <img src="{{ asset('storage/' . $user->foto_kk) }}" alt="Foto KK" class="profile-document-image">
                    @else
                        <span class="no-image">Belum ada foto KK.</span>
                    @endif
                </div>
            </div>

            {{-- Ubah Foto KTP --}}
            <div class="form-group">
                <input type="file" id="foto_ktp" name="foto_ktp" class="file-input">
                <label for="foto_ktp" class="file-label">Pilih File...</label>
            </div>

            {{-- Ubah Foto KK --}}
            <div class="form-group">
                <input type="file" id="foto_kk" name="foto_kk" class="file-input">
            <label for="foto_kk" class="file-label">Pilih File...</label>
            </div>
        </div>

        <div class="profile-form-actions">
            <a href="{{ route('home') }}" class="btn btn-outline">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection