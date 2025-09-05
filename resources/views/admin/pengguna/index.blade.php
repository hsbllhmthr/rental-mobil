@extends('layouts.admin')

@section('title', 'Kelola Data Pengguna')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Kelola Data Pengguna</h1>
    </div>

    <div class="data-card">
        <div class="data-card-header">
            <div class="search-bar">
                <input type="text" placeholder="Cari nama atau email pengguna...">
            </div>
        </div>
        <div class="data-card-body">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telp</th>
                        <th>Alamat</th>
                        <th>KTP</th>
                        <th>KK</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td>{{ $users->firstItem() + $loop->index }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->nomor_telepon }}</td>
                        <td>{{ Str::limit($user->alamat, 20) }}</td>
                        <td>
                            {{-- Pastikan user punya foto KTP --}}
                            @if($user->foto_ktp)
                                <a href="{{ asset('storage/' . $user->foto_ktp) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $user->foto_ktp) }}" alt="KTP" class="table-image">
                                </a>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                             {{-- Pastikan user punya foto KK --}}
                            @if($user->foto_kk)
                                <a href="{{ asset('storage/' . $user->foto_kk) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $user->foto_kk) }}" alt="KK" class="table-image">
                                </a>
                            @else
                                -
                            @endif
                        </td>
                        <td class="action-cell">
                            <a href="#" class="btn btn-icon btn-edit" title="Lihat Detail"
                               data-modal-target="#view-user-modal"
                               data-name="{{ $user->name }}"
                               data-email="{{ $user->email }}"
                               data-telepon="{{ $user->nomor_telepon }}"
                               data-alamat="{{ $user->alamat }}"
                               data-ktp="{{ $user->foto_ktp ? asset('storage/' . $user->foto_ktp) : '' }}"
                               data-kk="{{ $user->foto_kk ? asset('storage/' . $user->foto_kk) : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="text-align: center;">Tidak ada data pengguna.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="data-card-footer">
            <span class="showing-entries">
                Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries
            </span>
            <div class="pagination">
                {{ $users->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>

    {{-- Memanggil pop-up detail pengguna --}}
    @include('admin.pengguna.partials.detail-pengguna-modal')

@endsection