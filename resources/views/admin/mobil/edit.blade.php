@extends('layouts.admin')

@section('title', 'Edit Data Mobil')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Edit Mobil: {{ $mobil->nama_mobil }}</h1>
    </div>

    <form class="form-wrapper" action="{{ route('admin.mobil.update', $mobil->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div class="form-group">
            <label for="nama_mobil">Nama Mobil</label>
            <input type="text" id="nama_mobil" name="nama_mobil" value="{{ old('nama_mobil', $mobil->nama_mobil) }}" required>
        </div>
        <div class="form-group">
            <label for="merek_id">Merek Mobil</label>
            <select id="merek_id" name="merek_id" required>
                <option value="">Pilih Merek</option>
                @foreach ($mereks as $merek)
                    <option value="{{ $merek->id }}" {{ old('merek_id', $mobil->merek_id) == $merek->id ? 'selected' : '' }}>
                        {{ $merek->nama_merek }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi Mobil</label>
            <textarea id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi', $mobil->deskripsi) }}</textarea>
        </div>
        <div class="form-group">
            <label for="no_polisi">No. Polisi</label>
            <input type="text" id="no_polisi" name="no_polisi" value="{{ old('no_polisi', $mobil->no_polisi) }}" required>
        </div>
        <div class="form-group">
            <label for="harga_sewa">Harga / Hari (Rp)</label>
            <input type="number" id="harga_sewa" name="harga_sewa" value="{{ old('harga_sewa', $mobil->harga_sewa) }}" required>
        </div>
        <div class="form-group">
            <label for="bahan_bakar">Jenis Bahan Bakar</label>
            <select id="bahan_bakar" name="bahan_bakar" required>
                <option value="Bensin" {{ old('bahan_bakar', $mobil->bahan_bakar) == 'Bensin' ? 'selected' : '' }}>Bensin</option>
                <option value="Diesel" {{ old('bahan_bakar', $mobil->bahan_bakar) == 'Diesel' ? 'selected' : '' }}>Diesel</option>
            </select>
        </div>
        <div class="form-group">
            <label for="tahun">Tahun Registrasi</label>
            <input type="number" id="tahun" name="tahun" value="{{ old('tahun', $mobil->tahun) }}" required>
        </div>
        <div class="form-group">
            <label for="kapasitas">Kapasitas Orang</label>
            <input type="number" id="kapasitas" name="kapasitas" value="{{ old('kapasitas', $mobil->kapasitas) }}" required>
        </div>
        <div class="form-group">
            <label for="transmisi">Transmisi</label>
            <select id="transmisi" name="transmisi" required>
                <option value="Manual" {{ old('transmisi', $mobil->transmisi) == 'Manual' ? 'selected' : '' }}>Manual</option>
                <option value="Otomatis" {{ old('transmisi', $mobil->transmisi) == 'Otomatis' ? 'selected' : '' }}>Otomatis</option>
                <option value="Manual & Otomatis" {{ old('transmisi', $mobil->transmisi) == 'Manual & Otomatis' ? 'selected' : '' }}>Manual & Otomatis</option>
            </select>
        </div>
        <div class="form-group">
            <label for="tipe_mobil">Tipe Mobil</label>
            <select id="tipe_mobil" name="tipe_mobil" required>
                <option value="MPV" {{ old('tipe_mobil', $mobil->tipe_mobil) == 'MPV' ? 'selected' : '' }}>MPV (Keluarga)</option>
                <option value="SUV" {{ old('tipe_mobil', $mobil->tipe_mobil) == 'SUV' ? 'selected' : '' }}>SUV (Medan Berat)</option>
                <option value="Hatchback" {{ old('tipe_mobil', $mobil->tipe_mobil) == 'Hatchback' ? 'selected' : '' }}>Hatchback (City Car)</option>
            </select>
        </div>
        <div class="form-group">
            <label for="jumlah_kursi">Jumlah Kursi</label>
            <input type="number" id="jumlah_kursi" name="jumlah_kursi" value="{{ old('jumlah_kursi', $mobil->jumlah_kursi) }}" required>
        </div>
        
        <div class="form-group">
            <label>Gambar Saat Ini</label>
            <div class="current-images">
                @if($mobil->gambar)
                    @foreach(json_decode($mobil->gambar) as $image)
                        <img src="{{ asset('storage/' . $image) }}" alt="Gambar Mobil" width="100" style="margin-right: 10px; border-radius: 8px;">
                    @endforeach
                @else
                    <p>Tidak ada gambar.</p>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="gambar">Upload Gambar Baru (Opsional)</label>
            <small style="display: block; margin-bottom: 8px; color: #888;">Kosongkan jika tidak ingin mengubah gambar. Jika diisi, 4 gambar lama akan diganti.</small>
            <input type="file" id="gambar" name="gambar[]" multiple>
        </div>

        @include('admin.mobil.partials.aksesoris-checkboxes', ['mobil' => $mobil])
        <div class="form-actions">
            
            <a href="{{ route('admin.mobil.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Update Mobil</button>
        </div>
    </form>
@endsection