@extends('layouts.app')

@section('title', 'Cari Mobil')

@section('content')
    <div class="search-page-container">
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Beranda</a> / <span>Cari Mobil</span>
        </nav>

        <div class="search-header">
            <h1>Temukan Mobil Sesuai Keinginan Anda</h1>
            <p>Pilih mobil dan atur filter, lalu lanjutkan pemesanan.</p>
        </div>

        {{-- Form ini akan mengirim data dengan metode GET --}}
        <form class="search-form" action="{{ route('mobil.search') }}" method="GET">
            <div class="main-search-bar">
                {{-- `request('search')` untuk mengingat input pencarian --}}
                <input type="text" name="search" placeholder="Cari mobil disini..." value="{{ request('search') }}">
                <button type="submit">Cari Mobil</button>
            </div>

            <div class="filter-bar">
    <select name="bahan_bakar">
        <option value="">Pilih Bahan Bakar</option>
        @foreach ($bahan_bakar_options as $option)
            <option value="{{ $option->bahan_bakar }}" {{ request('bahan_bakar') == $option->bahan_bakar ? 'selected' : '' }}>
                {{ $option->bahan_bakar }}
            </option>
        @endforeach
    </select>

    <select name="kapasitas">
        <option value="">Pilih Kapasitas</option>
        <option value="2" {{ request('kapasitas') == 2 ? 'selected' : '' }}>2 Orang</option>
        <option value="4" {{ request('kapasitas') == 4 ? 'selected' : '' }}>4 Orang</option>
        <option value="5" {{ request('kapasitas') == 5 ? 'selected' : '' }}>5 Orang</option>
        <option value="7" {{ request('kapasitas') == 7 ? 'selected' : '' }}>7 Orang</option>
    </select>

    <select name="transmisi">
        <option value="">Pilih Transmisi</option>
        @foreach ($transmisi_options as $option)
            <option value="{{ $option->transmisi }}" {{ request('transmisi') == $option->transmisi ? 'selected' : '' }}>
                {{ $option->transmisi }}
            </option>
        @endforeach
        <option value="Manual & Otomatis" {{ request('transmisi') == 'Manual & Otomatis' ? 'selected' : '' }}>
        Manual & Otomatis
        </option>
    </select>
    
    <select name="tipe_mobil">
        <option value="">Pilih Tipe Mobil</option>
            @foreach ($tipe_mobil_options as $option)
            <option value="{{ $option->tipe_mobil }}" {{ request('tipe_mobil') == $option->tipe_mobil ? 'selected' : '' }}>
                {{ $option->tipe_mobil }}
        </option>
        @endforeach
         <option value="SUV" {{ request('tipe_mobil') == 'SUV' ? 'selected' : '' }}>
        SUV
    </option>
    </select>

    {{-- TAMBAHKAN KEMBALI DROPDOWN INI --}}
    <select name="fitur">
        <option value="">Pilih Fitur Tambahan</option>
        <option value="GPS" {{ request('fitur') == 'GPS' ? 'selected' : '' }}>GPS</option>
        <option value="Bluetooth" {{ request('fitur') == 'Bluetooth' ? 'selected' : '' }}>Bluetooth</option>
        <option value="Parking Camera" {{ request('fitur') == 'Parking Camera' ? 'selected' : '' }}>Parking Camera</option>
    </select>
</div>
        </form>
    </div>

    {{-- ============================================= --}}
    {{--           HASIL PENCARIAN TAMPIL DI SINI        --}}
    {{-- ============================================= --}}
    <div class="search-results-container">
        {{-- Kita gunakan kembali style .car-cards-container dari halaman utama --}}
        <div class="car-cards-container">
            @forelse ($mobils as $mobil)
                <a href="{{ route('car.detail', $mobil->id) }}" class="card-link">
                    <article class="car-card">
                        @php
                            $gambarPertama = json_decode($mobil->gambar)[0] ?? 'images/default-car.png';
                        @endphp
                        <img src="{{ asset('storage/' . $gambarPertama) }}" alt="{{ $mobil->nama_mobil }}" class="car-image">
                        <div class="car-card-body">
                            <h3>{{ $mobil->merek->nama_merek }} {{ $mobil->nama_mobil }}</h3>
                            <div class="car-price">
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
                                    <span>{{ $mobil->kapasitas }} orang</span>
                                </div>
                                <div class="spec-item">
                                    <img src="{{ asset('images/icons/icon-gear.png') }}" alt="Fuel Icon">
                                    <span>{{ $mobil->transmisi }}</span>
                                </div>
                            </div>
                        </div>
                    </article>
                </a>
            @empty
    <div class="no-results-container">
        <p>Mobil tidak ditemukan. Coba gunakan kata kunci atau filter yang berbeda.</p>
        
        <div class="suggestion-box">
    <h3>Mungkin Anda bisa coba di tempat lain?</h3>
    <p>Berikut adalah beberapa rekomendasi rental mobil populer di Makassar:</p>
    <ul class="suggestion-list">
        <li class="suggestion-item">
            <a href="https://www.google.com/search?q=TRAC+Astra+Rent+Car+Makassar" target="_blank">
                <strong>TRAC Astra Rent Car</strong>
                <span>Menyediakan berbagai jenis kendaraan dengan layanan profesional di Makassar.</span>
            </a>
        </li>
        <li class="suggestion-item">
            <a href="https://www.google.com/search?q=Global+Rent+Car+Makassar" target="_blank">
                <strong>Global Rent Car Makassar</strong>
                <span>Pilihan populer untuk sewa mobil lepas kunci maupun dengan supir.</span>
            </a>
        </li>
        <li class="suggestion-item">
            <a href="https://www.google.com/search?q=Lio+Rent+Car+Makassar" target="_blank">
                <strong>Lio Rent Car Makassar</strong>
                <span>Dikenal dengan pilihan mobil yang beragam dan berlokasi dekat bandara.</span>
            </a>
        </li>
    </ul>
</div>
    </div>
@endforelse
        </div>
        
        {{-- Tampilkan link pagination --}}
        <div style="margin-top: 40px; display: flex; justify-content: center;">
             {{ $mobils->links('vendor.pagination.custom') }}
        </div>
    </div>
@endsection