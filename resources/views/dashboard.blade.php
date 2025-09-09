@extends('layouts.app')

@section('title', 'Homepage Rental Mobil')

@section('content')
    <section class="hero-section">
        <img src="{{ asset('images/hero-image.png') }}" alt="Banner rental mobil">
    </section>
    
    <section class="car-listing">
        <div class="car-listing-header">
            <h2>Mobil Yang Tersedia Untuk Anda</h2>
        </div>

        <div class="car-cards-container">
            @if($mobils->isEmpty())
                <p>Belum ada mobil yang tersedia saat ini.</p>
            @else
                @foreach ($mobils as $mobil)
                

                    <a href="{{ route('car.detail', $mobil->id) }}" class="card-link">
                        <article class="car-card">
                            @php
                                // Ambil gambar pertama dari array gambar
                                $gambarPertama = json_decode($mobil->gambar)[0] ?? 'images/default-car.png';
                            @endphp
                            <img src="{{ asset('storage/' . $gambarPertama) }}" alt="{{ $mobil->nama_mobil }}" class="car-image">
                            <div class="car-card-body">
                                {{-- Menggabungkan Merek dan Nama Mobil --}}
                                <h3>{{ $mobil->merek->nama_merek }} {{ $mobil->nama_mobil }}</h3>
                                <div class="car-price">
                                    {{-- Format harga agar lebih mudah dibaca --}}
                                    <span class="price-amount">Rp{{ number_format($mobil->harga_sewa, 0, ',', '.') }}</span>
                                    <span class="price-period">/Hari</span>
                                </div>
                                <hr class="separator">
                                <div class="car-specs">
                                    <div class="spec-item">
                                        <img src="{{ asset('images/icons/icon-seat.png') }}" alt="Seat Icon">
                                        <span>{{ $mobil->jumlah_kursi }} Kursi</span>
                                    </div>
                                    <div class="spec-item">
                                        <img src="{{ asset('images/icons/icon-calendar.png') }}" alt="Calendar Icon">
                                        <span>{{ $mobil->tahun }}</span>
                                    </div>
                                    <div class="spec-item">
                                        <img src="{{ asset('images/icons/icon-fuel.png') }}" alt="Fuel Icon">
                                        <span>{{ $mobil->bahan_bakar }}</span>
                                    </div>
                                    <div class="spec-item">
                                        <img src="{{ asset('images/icons/icon-users.png') }}" alt="Fuel Icon">
                                        <span>{{ $mobil->kapasitas }} Orang</span>
                                    </div>
                                    <div class="spec-item">
                                        <img src="{{ asset('images/icons/icon-gear.png') }}" alt="Fuel Icon">
                                        <span>{{ $mobil->transmisi }}</span>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </a>
                @endforeach
            @endif
        </div>
    </section>

    {{-- Anda bisa menambahkan seksi "Pilihan Populer" di sini dengan logika yang sama --}}

@endsection