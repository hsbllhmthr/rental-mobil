@extends('layouts.app')

@section('title', 'Riwayat Sewa')

@section('content')
<div class="page-content-wrapper"> 
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
                        <td data-label="No">{{ $rentals->firstItem() + $loop->index }}</td>
                        <td data-label="Kode Sewa">TRX{{ str_pad($rental->id, 5, '0', STR_PAD_LEFT) }}</td>
                        <td data-label="Nama Mobil">{{ $rental->mobil->merek->nama_merek }} {{ $rental->mobil->nama_mobil }}</td>
                        <td data-label="Tgl. Mulai">{{ $rental->tanggal_mulai->format('d-m-Y') }}</td>
                        <td data-label="Tgl. Selesai">{{ $rental->tanggal_selesai->format('d-m-Y') }}</td>
                        <td data-label="Total Biaya">Rp {{ number_format($rental->total_biaya, 0, ',', '.') }}</td>
                        <td data-label="Status">
                            @php
                                $statusClass = 'status-' . str_replace('_', '-', $rental->status);
                            @endphp
                            <span class="status-badge {{ $statusClass }}">
                                {{ ucwords(str_replace('_', ' ', $rental->status)) }}
                            </span>
                        </td>
                        <td data-label="Opsi" class="action-cell">
                            <div class="flex items-center space-x-2">
                                <a href="#" class="btn btn-icon btn-edit" title="Lihat Detail"
                                   data-modal-target="#view-sewa-modal"
                                   data-kode="TRX{{ str_pad($rental->id, 5, '0', STR_PAD_LEFT) }}"
                                   data-mobil="{{ $rental->mobil->merek->nama_merek ?? 'Mobil Dihapus' }}"
                                   data-mulai="{{ $rental->tanggal_mulai->format('d-m-Y') }}"
                                   data-selesai="{{ $rental->tanggal_selesai->format('d-m-Y') }}"
                                   data-durasi="{{ $rental->tanggal_mulai->diffInDays($rental->tanggal_selesai, false) +1}} Hari"
                                   data-penyewa="{{ $rental->user->name ?? 'User Dihapus' }}"
                                   data-total="Rp {{ number_format($rental->total_biaya, 0, ',', '.') }}"
                                   data-status="{{ ucwords(str_replace('_', ' ', $rental->status)) }}"
                                   data-bukti="{{ $rental->bukti_pembayaran ? asset('storage/' . $rental->bukti_pembayaran) : '' }}">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                @if ($rental->status == 'menunggu_pembayaran')
                                    <a href="{{ route('rental.waiting', $rental->id) }}" class="btn btn-icon btn-primary" title="Lanjutkan Pembayaran">
                                        <i class="fa-solid fa-upload"></i>
                                    </a>
                                @endif
                            </div>
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
        <div class="data-card-footer">
            <span class="showing-entries">
                Showing {{ $rentals->firstItem() }} to {{ $rentals->lastItem() }} of {{ $rentals->total() }} entries
            </span>
            <div class="pagination">
                {{ $rentals->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
</div>
@endsection