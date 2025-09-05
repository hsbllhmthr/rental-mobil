@extends('layouts.admin')

@section('title', 'Kelola Data Merek')

@section('content')
    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Header Halaman --}}
    <div class="page-header">
        <h1 class="page-title">Kelola Data Merek Mobil</h1>
        <a href="#" class="btn btn-primary" data-modal-target="#add-merek-modal">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Tambah Merek
        </a>
    </div>

    {{-- Kartu Data --}}
    <div class="data-card">
        <div class="data-card-header">
            <div class="search-bar">
                <input type="text" placeholder="Cari merek...">
            </div>
        </div>
        <div class="data-card-body">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Merek</th>
                        <th>Tgl. Dibuat</th>
                        <th>Tgl. Update</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mereks as $merek)
                    <tr>
                        <td>{{ $mereks->firstItem() + $loop->index }}</td>
                        <td>{{ $merek->nama_merek }}</td>
                        <td>{{ $merek->created_at->format('Y-m-d H:i') }}</td>
                        <td>{{ $merek->updated_at->format('Y-m-d H:i') }}</td>
                        <td class="action-cell">
                            {{-- Tombol Edit --}}
                            <a href="#" class="btn btn-icon btn-edit" title="Edit" 
                               data-modal-target="#edit-merek-modal"
                               data-id="{{ $merek->id }}"
                               data-nama="{{ $merek->nama_merek }}"
                               data-action="{{ route('admin.merek.update', $merek->id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                            </a>
                            {{-- Tombol Hapus --}}
                            <form action="{{ route('admin.merek.destroy', $merek->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-icon btn-delete" title="Hapus" 
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus merek ini?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align: center;">Tidak ada data merek.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="data-card-footer">
    <span class="showing-entries">
        Showing {{ $mereks->firstItem() }} to {{ $mereks->lastItem() }} of {{ $mereks->total() }} entries
    </span>

    {{-- Memanggil template pagination kustom kita --}}
    {{ $mereks->links('vendor.pagination.custom') }}
</div>
    </div>

    {{-- Pop-up Tambah Merek --}}
    <div id="add-merek-modal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Tambah Merek Baru</h2>
                <span class="close-button">&times;</span>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.merek.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama_merek">Nama Merek</label>
                        <input type="text" id="nama_merek" name="nama_merek" placeholder="Contoh: Honda" required>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn btn-secondary close-btn">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Pop-up Edit Merek --}}
    <div id="edit-merek-modal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Edit Merek</h2>
                <span class="close-button">&times;</span>
            </div>
            <div class="modal-body">
                <form id="edit-merek-form" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="edit_nama_merek">Nama Merek</label>
                        <input type="text" id="edit_nama_merek" name="nama_merek" required>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn btn-secondary close-btn">Batal</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection