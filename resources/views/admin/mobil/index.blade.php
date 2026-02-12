@extends('layouts.admin')

@section('title', 'Kelola Data Mobil')

@section('content')
    @if(session('success'))
        <div class="alert alert-success" style="padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px; color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" style="padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px; color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;">
            {{ session('error') }}
        </div>
    @endif

    {{-- Header Halaman --}}
    <div class="page-header">
        <h1 class="page-title">Kelola Data Mobil</h1>
        <a href="{{ route('admin.mobil.create') }}" class="btn btn-primary">
             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Tambah Mobil
        </a>
    </div>

    {{-- Kartu Data --}}
    <div class="data-card">
        <div class="data-card-header">
            <div class="search-bar">
                <input type="text" placeholder="Cari mobil...">
            </div>
        </div>
        <div class="data-card-body">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mobil</th>
                        <th>Merek</th>
                        <th>No. Polisi</th>
                        <th>Harga/Hari</th>
                        <th>Bahan Bakar</th>
                        <th>Tahun</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mobils as $mobil)
                    <tr>
                        <td>{{ $mobils->firstItem() + $loop->index }}</td>
                        <td>{{ $mobil->nama_mobil }}</td>
                        <td>{{ $mobil->merek->nama_merek }}</td>
                        <td>{{ $mobil->no_polisi }}</td>
                        <td>Rp {{ number_format($mobil->harga_sewa, 0, ',', '.') }}</td>
                        <td>{{ $mobil->bahan_bakar }}</td>
                        <td>{{ $mobil->tahun }}</td>
                        <td class="action-cell">
                            <a href="{{ route('admin.mobil.edit', $mobil->id) }}" class="btn btn-icon btn-edit" title="Edit">
                               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                            </a>
                            <form action="{{ route('admin.mobil.destroy', $mobil->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus mobil ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-icon btn-delete" title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="text-align: center;">Tidak ada data mobil.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="data-card-footer">
            <span class="showing-entries">
                Showing {{ $mobils->firstItem() }} to {{ $mobils->lastItem() }} of {{ $mobils->total() }} entries
            </span>
            <div class="pagination">
                {{ $mobils->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
