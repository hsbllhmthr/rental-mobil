@extends('layouts.admin')

@section('title', 'Laporan Pendapatan')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Laporan Pendapatan</h1>
    </div>

    {{-- Form Filter Tanggal --}}
    <form class="filter-form-layout" action="{{ route('admin.laporan.index') }}" method="GET">
        <div class="form-group">
            <label for="tanggal_awal">Tanggal Awal</label>
            <input type="date" id="tanggal_awal" name="tanggal_awal" value="{{ request('tanggal_awal') }}">
        </div>
        <div class="form-group">
            <label for="tanggal_akhir">Tanggal Akhir</label>
            <input type="date" id="tanggal_akhir" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}">
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Lihat Laporan</button>
        </div>
    </form>

    {{-- Tabel Hasil Laporan --}}
    <div class="data-card" style="margin-top: 30px;">
        <div class="data-card-body">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Sewa</th>
                        <th>Mobil</th>
                        <th>Penyewa</th>
                        <th>Tanggal Sewa</th>
                        <th>Total Biaya</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rentals as $rental)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>TRX{{ str_pad($rental->id, 5, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $rental->mobil->nama_mobil ?? 'N/A' }}</td>
                        <td>{{ $rental->user->name ?? 'N/A' }}</td>
                        <td>{{ $rental->tanggal_mulai->format('d-m-Y') }}</td>
                        <td>Rp {{ number_format($rental->total_biaya, 0, ',', '.') }}</td>
                        <td>
                            <span class="status-badge status-{{ str_replace('_', '-', $rental->status) }}">
                                {{ ucwords(str_replace('_', ' ', $rental->status)) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align: center;">Tidak ada data untuk ditampilkan. Silakan pilih rentang tanggal.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="data-card-footer">
            <a href="{{ route('admin.laporan.cetak_pdf', request()->query()) }}" target="_blank" class="btn btn-secondary">
                Cetak Laporan
            </a>
        </div>
    </div>
@endsection