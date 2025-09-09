@extends('layouts.app')

@section('title', 'Syarat dan Ketentuan')

@section('content')
    <div class="static-page-container">
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Beranda</a> / <span>Syarat & Ketentuan</span>
        </nav>

        <div class="static-page-header">
            <h1>Syarat dan Ketentuan</h1>
        </div>

        <div class="static-page-content">
            <h2>1. Definisi</h2>
            <p>...</p>

            <h2>2. Ketentuan Penyewaan</h2>
            <p>...</p>

            <h2>3. Kewajiban Penyewa</h2>
            <p>...</p>
            
            {{-- Lanjutkan dengan semua pasal dan isi syarat ketentuan Anda --}}
        </div>
    </div>
@endsection