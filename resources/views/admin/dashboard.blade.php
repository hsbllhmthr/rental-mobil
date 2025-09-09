@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Dashboard</h1>
    </div>

    <div class="stats-grid">
        {{-- Menunggu Pembayaran --}}
        <div class="stat-card blue">
            <h2>{{ $menungguPembayaran }}</h2>
            <p>Menunggu Pembayaran</p>
            <a href="{{ route('admin.sewa.menunggu_pembayaran') }}">Rincian &rarr;</a>
        </div>

        {{-- Menunggu Konfirmasi --}}
        <div class="stat-card green">
            <h2>{{ $menungguKonfirmasi }}</h2>
            <p>Menunggu Konfirmasi</p>
            <a href="{{ route('admin.sewa.menunggu_konfirmasi') }}">Rincian &rarr;</a>
        </div>

        {{-- Belum Dikembalikan --}}
        <div class="stat-card blue">
            <h2>{{ $belumDikembalikan }}</h2>
            <p>Belum Dikembalikan</p>
            <a href="{{ route('admin.sewa.pengembalian') }}">Rincian &rarr;</a>
        </div>

        {{-- Total Merek --}}
        <div class="stat-card orange">
            <h2>{{ $totalMerek }}</h2>
            <p>Total Merek</p>
            <a href="{{ route('admin.merek.index') }}">Rincian &rarr;</a>
        </div>

        {{-- Jumlah Mobil --}}
        <div class="stat-card green">
            <h2>{{ $jumlahMobil }}</h2>
            <p>Jumlah Mobil</p>
            <a href="{{ route('admin.mobil.index') }}">Rincian &rarr;</a>
        </div>

        {{-- Total Sewa --}}
        <div class="stat-card orange">
            <h2>{{ $totalSewa }}</h2>
            <p>Total Sewa</p>
            <a href="{{ route('admin.sewa.data_sewa') }}">Rincian &rarr;</a>
        </div>

        {{-- Total User --}}
        <div class="stat-card dark-blue">
            <h2>{{ $totalUser }}</h2>
            <p>User</p>
            <a href="{{ route('admin.pengguna.index') }}">Rincian &rarr;</a>
        </div>
    </div>
@endsection