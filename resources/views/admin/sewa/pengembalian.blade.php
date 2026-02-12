@extends('layouts.admin')

@section('title', 'Pengembalian Mobil')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="page-header">
        <h1 class="page-title">Pengembalian Mobil</h1>
    </div>

    <div class="data-card">
        <div class="data-card-header">
            <div class="search-bar">
                <input type="text" placeholder="Cari kode sewa atau nama penyewa...">
            </div>
        </div>
        <div class="data-card-body">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Sewa</th>
                        <th>Mobil</th>
                        <th>Tgl. Mulai</th>
                        <th>Tgl. Selesai</th>
                        <th>Total</th>
                        <th>Penyewa</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rentals as $rental)
                    <tr>
                        <td>{{ $rentals->firstItem() + $loop->index }}</td>
                        <td>TRX{{ str_pad($rental->id, 5, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $rental->mobil?->nama_mobil ?? 'Mobil Dihapus' }}</td>
                        <td>{{ $rental->tanggal_mulai->format('d-m-Y') }}</td>
                        <td>{{ $rental->tanggal_selesai->format('d-m-Y') }}</td>
                        <td>Rp {{ number_format($rental->total_biaya, 0, ',', '.') }}</td>
                       <td>
                            <a href="#" class="link-to-detail"
                            data-modal-target="#view-user-modal"
                            data-name="{{ $rental->user->name ?? '' }}"
                            data-email="{{ $rental->user->email ?? '' }}"
                            data-telepon="{{ $rental->user->nomor_telepon ?? '' }}"
                            data-alamat="{{ $rental->user->alamat ?? '' }}"
                            data-ktp="{{ $rental->user->foto_ktp ? asset('storage/' . $rental->user->foto_ktp) : '' }}"
                            data-kk="{{ $rental->user->foto_kk ? asset('storage/' . $rental->user->foto_kk) : '' }}">
                                {{ $rental->user->name ?? 'User Dihapus' }}
                            </a>
                        </td>
                        <td>
                            @php
                                $statusClass = '';
                                if ($rental->status == 'sudah_dibayar') {
                                    $statusClass = 'status-paid';
                                } elseif ($rental->status == 'selesai') {
                                    $statusClass = 'status-completed';
                                }
                            @endphp
                            <div class="status-dropdown">
                                <button class="status-badge {{ $statusClass }} dropdown-toggle">
                                    {{ ucwords(str_replace('_', ' ', $rental->status)) }}
                                </button>
                                <div class="dropdown-menu">
                                    {{-- Form untuk status "Sudah Dibayar" --}}
                                    <form action="{{ route('admin.sewa.update_status', $rental->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="sudah_dibayar">
                                        <button type="submit" class="dropdown-item">Sudah Dibayar</button>
                                    </form>
                                    {{-- Form untuk status "Selesai" --}}
                                    <form action="{{ route('admin.sewa.update_status', $rental->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="selesai">
                                        <button type="submit" class="dropdown-item">Selesai</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                        <td class="action-cell">
                            <a href="#" class="btn btn-icon btn-edit" title="Lihat Detail"
                               data-modal-target="#view-sewa-modal"
                               data-kode="TRX{{ str_pad($rental->id, 5, '0', STR_PAD_LEFT) }}"
                               data-mobil="{{ $rental->mobil?->nama_mobil ?? 'Mobil Dihapus' }}"
                               data-mulai="{{ $rental->tanggal_mulai->format('d-m-Y') }}"
                               data-selesai="{{ $rental->tanggal_selesai->format('d-m-Y') }}"
                               data-durasi="{{ $rental->tanggal_mulai->diffInDays($rental->tanggal_selesai, false) +1}} Hari"
                               data-penyewa="{{ $rental->user->name ?? 'User Dihapus' }}"
                               data-total="Rp {{ number_format($rental->total_biaya, 0, ',', '.') }}"
                               data-status="{{ ucwords(str_replace('_', ' ', $rental->status)) }}"
                               data-bukti="{{ $rental->bukti_pembayaran ? asset('storage/' . $rental->bukti_pembayaran) : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" style="text-align: center;">Tidak ada mobil yang sedang dalam proses sewa.</td>
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

    {{-- Memanggil file partial untuk pop-up detail sewa --}}
    @include('admin.sewa.partials.detail-sewa-modal')
@include('admin.pengguna.partials.detail-pengguna-modal')
@endsection