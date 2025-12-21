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
                Tri Manunggala adalah perusahaan rental mobil yang hadir untuk memenuhi berbagai kebutuhan transportasi Anda. Kami menyewakan berbagai jenis mobil, dan siap menyediakan kendaraan sesuai dengan keinginan pelanggan, baik untuk perjalanan keluarga, bisnis, maupun acara khusus.
            </p>
            <p>
                Dengan pelayanan ramah, harga bersahabat, dan armada yang selalu terawat, kami berkomitmen membuat pelanggan merasa senyaman mungkin. Bersama Tri Manunggala, setiap perjalanan anda selalu terjamin, terpercaya, aman, dan nyaman!
            </p>
        </section>

        <section class="about-section">
            <h2>Visi </h2>
            <p>
                Menjadi perusahaan rental mobil terpercaya di Sulawesi Selatan yang memberikan pelayanan terbaik, armada berkualitas, serta pengalaman perjalanan yang aman, nyaman, dan berkesan bagi setiap pelanggan.
            </p>
        </section>

        <section class="about-section">
            <h2>Misi </h2>
            {{-- Menggunakan Unordered List untuk Misi --}}
            <ul>
                <li>Menyediakan berbagai jenis mobil sesuai kebutuhan dan keinginan pelanggan.</li>
                <li>Mengutamakan kenyamanan, keamanan, dan kepuasan pelanggan dalam setiap layanan.</li>
                <li>Menjaga kualitas armada dengan perawatan berkala agar selalu prima saat digunakan.</li>
                <li>Memberikan pelayanan yang ramah, profesional, dan tepat waktu.</li>
                <li>Menyajikan informasi mobil secara jujur dan sesuai kondisi asli, tanpa melebih-lebihkan, agar pelanggan merasa aman dan terhindar dari kerugian.</li>
            </ul>
        </section>
    </div>
@endsection