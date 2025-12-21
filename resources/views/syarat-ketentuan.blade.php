@extends('layouts.app')

@section('title', 'Syarat dan Ketentuan')

@section('content')
    <div class="page-container" style="padding: 40px 125px;">
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Beranda</a> / <span>Syarat dan Ketentuan</span>
        </nav>

        <div class="static-page-header">
            <h1>SYARAT PENYEWAAN MOBIL</h1>
        </div>

        <div class="static-page-content">
            <h2>1. MENYERAHKAN KARTU IDENTITAS ASLI (KTP, KTM, KTA, SIM C)</h2>


            <h2>2. MENUNJUKKAN SIM A</h2>
         

            <h2>3. MENITIPKAN MOTOR SEBAGAI JAMINAN</h2>
            <h2>4. BUKA JAM 07.00 HINGGA 22.00. BILAMANA PENGEMBALIAN MOBIL MELEWATI BATAS WAKTU (DIATAS JAM TUTUP) MAKA PENYEWAAN AKAN TERAKUMULASI PADA HARI BERIKUTNYA</h2>
 <h2>5. JIKA PENYEWAAN DIATAS 7 HARI. ALAMAT RUMAH PENYEWA HARUS DISURVEI</h2>
            {{-- Lanjutkan dengan semua pasal dan isi syarat ketentuan Anda --}}
        </div>
    </div>
@endsection