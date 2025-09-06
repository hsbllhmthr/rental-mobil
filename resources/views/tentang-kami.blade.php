@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
    {{-- Bagian Banner Atas --}}
    <div class="about-us-banner">
        <img src="{{ asset('images/banner-about.jpg') }}" alt="Tentang Kami Banner">
    </div>

    <div class="about-us-container">
        {{-- Breadcrumb --}}
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Beranda</a> / <span>Tentang Kami</span>
        </nav>

        {{-- Konten Utama --}}
        <section class="about-section">
            <h2>Tentang Tri Manunggala</h2>
            <p>
                TRI BERKAH ABADI adalah Perusahaan yang bergerak dibidang transportasi pariwisata dan tour travel, dimana kami menyediakan jasa angkutan wisata sesuai dengan keinginan konsumen dan jasa paket wisata dengan tujuan Sulawesi Selatan.
            </p>
            <p>
                Dasar Pemikiran menyadari akan iklim pariwisata di indonesia yang saat ini cenderung sangat cepat pekembangannya, serta untuk mendukung program pemerintah dalam memajukan sektor pariwisata nasional “TRI BERKAH ABADI” turut hadir meramaikan dunia Pariwisata di Indonesia khususnya Provinsi Sulawesi Selatan, maka terbentuklah CV. Tri Berkah Abadi pada Tahun 2021 yang berdomisili di Gedung Perkantoran HQ Delft Apartment UG 12 Jl. Sunset Boulevard Blok 5B/16 Citraland City, Centre Point of Indonesia (CPI)
            </p>
        </section>

        <section class="about-section">
            <h2>Visi </h2>
            <p>
                Menjadi Perusahaan berkelas dan profesional di dalam bidang Transportasi Darat sehingga tercipta mitra bisnis strategis dan terpercaya di bidang jasa transportasi yang selalu fokus pada peningkatan pelayanan serta selalu berorientasi pada kepuasan pelanggan.
            </p>
        </section>

        <section class="about-section">
            <h2>Misi </h2>
            {{-- Menggunakan Unordered List untuk Misi --}}
            <ul>
                <li>Meningkatkan kepuasan Customer dengan menetapkan kualitas layanan yang terbaik.</li>
                <li>Mengembangkan serta mempertahankan kualitas perusahaan agar dapat menjadi pemimpin pasar.</li>
                <li>Bersama dengan Pelanggan dan karyawan, membangun bisnis yang berkelanjutan.</li>
            </ul>
        </section>
    </div>
@endsection