@extends('layouts.admin')

@section('title', 'Tambah Data Mobil')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Tambah Mobil Baru</h1>
    </div>

    <form class="form-wrapper" action="{{ route('admin.mobil.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
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
            <input type="text" id="nama_mobil" name="nama_mobil" value="{{ old('nama_mobil') }}" placeholder="Contoh: Avanza Veloz" required>
        </div>
        <div class="form-group">
            <label for="merek_id">Merek Mobil</label>
            <select id="merek_id" name="merek_id" required>
                <option value="">Pilih Merek</option>
                @foreach ($mereks as $merek)
                    <option value="{{ $merek->id }}" {{ old('merek_id') == $merek->id ? 'selected' : '' }}>{{ $merek->nama_merek }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi Mobil</label>
            <textarea id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi') }}</textarea>
        </div>
        <div class="form-group">
            <label for="no_polisi">No. Polisi</label>
            <input type="text" id="no_polisi" name="no_polisi" value="{{ old('no_polisi') }}" placeholder="Contoh: DD 1234 XYZ" required>
        </div>
        <div class="form-group">
            <label for="harga_sewa">Harga / Hari (Rp)</label>
            <input type="number" id="harga_sewa" name="harga_sewa" value="{{ old('harga_sewa') }}" placeholder="Contoh: 350000" required>
        </div>
        <div class="form-group">
            <label for="bahan_bakar">Jenis Bahan Bakar</label>
            <select id="bahan_bakar" name="bahan_bakar" required>
                <option value="Bensin" {{ old('bahan_bakar') == 'Bensin' ? 'selected' : '' }}>Bensin</option>
                <option value="Diesel" {{ old('bahan_bakar') == 'Diesel' ? 'selected' : '' }}>Diesel</option>
            </select>
        </div>
        <div class="form-group">
            <label for="tahun">Tahun Registrasi</label>
            <input type="number" id="tahun" name="tahun" value="{{ old('tahun') }}" placeholder="Contoh: 2022" required>
        </div>
        <div class="form-group">
    <label for="kapasitas">Kapasitas Orang</label>
    <select id="kapasitas" name="kapasitas" required>
        <option value="">Pilih Kapasitas</option>
        <option value="2" {{ old('kapasitas') == 2 ? 'selected' : '' }}>2 Orang</option>
        <option value="4" {{ old('kapasitas') == 4 ? 'selected' : '' }}>4 Orang</option>
        <option value="5" {{ old('kapasitas') == 5 ? 'selected' : '' }}>5 Orang</option>
        <option value="7" {{ old('kapasitas') == 7 ? 'selected' : '' }}>7 Orang</option>
        <option value="8" {{ old('kapasitas') == 8 ? 'selected' : '' }}>8 Orang</option>
    </select>
</div>
        <div class="form-group">
            <label for="transmisi">Transmisi</label>
            <select id="transmisi" name="transmisi" required>
                <option value="Matic" {{ old('transmisi') == 'Matic' ? 'selected' : '' }}>Matic</option>
                <option value="Manual" {{ old('transmisi') == 'Manual' ? 'selected' : '' }}>Manual</option>
                <option value="Matic & Manual" {{ old('transmisi') == 'Matic & Manual' ? 'selected' : '' }}>Matic & Manual</option>
            </select>
        </div>
        <div class="form-group">
            <label for="tipe_mobil">Tipe Mobil</label>
            <select id="tipe_mobil" name="tipe_mobil" required>
                <option value="MPV" {{ old('tipe_mobil') == 'MPV' ? 'selected' : '' }}>MPV (Keluarga)</option>
                <option value="SUV" {{ old('tipe_mobil') == 'SUV' ? 'selected' : '' }}>SUV (Medan Berat)</option>
                <option value="Hatchback" {{ old('tipe_mobil') == 'Hatchback' ? 'selected' : '' }}>Hatchback (City Car)</option>
            </select>
        </div>
        <div class="form-group">
            <label for="jumlah_kursi">Jumlah Kursi</label>
            <input type="number" id="jumlah_kursi" name="jumlah_kursi" value="{{ old('jumlah_kursi') }}" placeholder="Contoh: 4" required>
        </div>
        <div class="form-group">
            <label for="gambar">Upload 4 Gambar Mobil (Wajib 4)</label>
            <input type="file" id="gambar" name="gambar[]" multiple required>
        </div>

        @include('admin.mobil.partials.aksesoris-checkboxes')
        
        <div class="form-actions">
            <a href="{{ route('admin.mobil.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
@endsection