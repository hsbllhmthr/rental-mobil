@extends('layouts.app')

@section('title', 'Riwayat Sewa')

@section('content')
<div class="page-container" style="padding: 40px 125px;">
    <div class="page-header">
        <h1 class="page-title">Riwayat Sewa Anda</h1>
    </div>

    <div class="data-card">
        <div class="data-card-body">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Sewa</th>
                        <th>Nama Mobil</th>
                        <th>Tgl. Mulai</th>
                        <th>Tgl. Selesai</th>
                        <th>Total Biaya</th>
                        <th>Status</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rentals as $rental)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>TRX{{ str_pad($rental->id, 5, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $rental->mobil->merek->nama_merek }} {{ $rental->mobil->nama_mobil }}</td>
                        <td>{{ $rental->tanggal_mulai->format('d-m-Y') }}</td>
                        <td>{{ $rental->tanggal_selesai->format('d-m-Y') }}</td>
                        <td>Rp {{ number_format($rental->total_biaya, 0, ',', '.') }}</td>
                        <td>
                            <span class="status-badge status-{{ str_replace('_', '-', $rental->status) }}">
                                {{ ucwords(str_replace('_', ' ', $rental->status)) }}
                            </span>
                        </td>
                        <td class="action-cell">
                        <a href="{{ route('rental.waiting', $rental->id) }}" class="btn btn-icon btn-edit" title="Lihat Detail">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        @if ($rental->status == 'menunggu_pembayaran')
                            <a href="#" class="btn btn-icon btn-primary" title="Unggah Bukti Bayar"
                            data-modal-target="#upload-proof-modal"
                            data-action="{{ route('rental.upload_proof', $rental->id) }}">
                                <i class="fa-solid fa-upload"></i>
                            </a>
                        @endif
                    </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="text-align: center;">Anda belum memiliki riwayat sewa.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection