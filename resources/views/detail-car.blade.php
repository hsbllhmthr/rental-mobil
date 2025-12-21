@extends('layouts.app')

{{-- Judul halaman akan dinamis sesuai nama mobil --}}
@section('title', 'Detail - ' . $mobil->merek->nama_merek . ' ' . $mobil->nama_mobil)

@section('content')
<div class="detail-container">
    
    {{-- Breadcrumb Navigation --}}
    <nav class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <a href="#">{{ $mobil->merek->nama_merek }}</a> / <span>Detail</span>
    </nav>

    <div class="detail-content">
        
        {{-- Kolom Kiri: Galeri, Deskripsi, & Fitur --}}
        <div class="detail-left-column">
    @php
        // Decode data gambar dari JSON. Buat array kosong jika tidak ada gambar.
        $gambarMobil = json_decode($mobil->gambar, true) ?? [];

        // Ambil gambar pertama sebagai gambar utama. Jika tidak ada, gunakan gambar default.
        $gambarUtama = !empty($gambarMobil) ? array_shift($gambarMobil) : 'images/default-car.png';
        
        // Sisa gambar di dalam array akan menjadi thumbnail (maksimal 3).
        $thumbnailGambar = array_slice($gambarMobil, 0, 3);
    @endphp

    {{-- Galeri Gambar --}}
    <div class="car-gallery">
        <img class="main-image" src="{{ asset('storage/' . $gambarUtama) }}" alt="{{ $mobil->nama_mobil }}">
        <div class="thumbnail-images">
            {{-- Looping hanya untuk gambar thumbnail --}}
            @foreach ($thumbnailGambar as $gambar)
                <img src="{{ asset('storage/' . $gambar) }}" alt="Thumbnail">
            @endforeach
        </div>
    </div>

            {{-- Deskripsi & Fitur --}}
            <div class="car-details-lower">
                <div class="description-section">
                    <h2>Deskripsi Kendaraan</h2>
                    <p>{{ $mobil->deskripsi }}</p>
                </div>

                <div class="features-section">
                    <h2>Fitur & Aksesoris Kendaraan</h2>
                    <table class="features-table">
                        <thead>
                            <tr>
                                <th>Fitur</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                // Daftar semua kemungkinan aksesoris
                                $allAksesoris = [
                                    'USB Charging Port', 'Power Door Locks', 'AntiLock Braking System',
                                    'Brake Assist', 'Power Steering', 'Driver Airbag', 'Passenger Airbag',
                                    'Power Windows', 'Bluetooth', 'Central Locking', 'Crash Sensor', 'GPS', 'Parking Camera'
                                ];
                            @endphp

                            @foreach ($allAksesoris as $aksesoris)
                            <tr>
                                <td>{{ $aksesoris }}</td>
                                {{-- Cek apakah aksesoris ini ada di data mobil --}}
                                @if(in_array($aksesoris, $mobil->aksesoris ?? []))
                                    <td style="color: green;">Tersedia</td>
                                @else
                                    <td style="color: #888;">Tidak Ada</td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Informasi & Pemesanan --}}
        <div class="car-info-card">
            <h1>{{ $mobil->merek->nama_merek }} {{ $mobil->nama_mobil }}</h1>
            <p class="price-label">Total Harga Sewa</p>
            <div class="price-details">
                <span class="price-amount-detail">Rp{{ number_format($mobil->harga_sewa, 0, ',', '.') }}</span>
                <span class="price-period-detail">/hari</span>
            </div>
            
            <h3 class="spec-title">Rincian Singkat</h3>
            <ul class="spec-list">
                <li><img src="{{ asset('images/icons/icon-seat.png') }}"> Jumlah Kursi : {{ $mobil->jumlah_kursi }} Kursi</li>
                <li><img src="{{ asset('images/icons/icon-calendar.png') }}"> Tahun Keluaran : {{ $mobil->tahun }}</li>
                <li><img src="{{ asset('images/icons/icon-fuel.png') }}"> Bahan Bakar : {{ $mobil->bahan_bakar }}</li>
                <li><img src="{{ asset('images/icons/icon-gear.png') }}"> Transmisi : {{ $mobil->transmisi }}</li>
                <li><img src="{{ asset('images/icons/icon-users.png') }}"> Jumlah Penumpang : {{ $mobil->kapasitas }} Orang</li>
            </ul>

            <a href="{{ route('rental.create', $mobil->id) }}" class="btn-rental" id="rental-now-btn">Pesan Mobil</a>
        </div>
    </div>
</div>
@endsection