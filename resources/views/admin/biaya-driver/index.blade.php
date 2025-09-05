@extends('layouts.admin')

@section('title', 'Kelola Biaya Driver')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="page-header">
        <h1 class="page-title">Kelola Biaya Driver</h1>
    </div>

    <div class="driver-fee-card">
        <div class="data-card-body">
            <form action="{{ route('admin.biaya_driver.update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="biaya_driver">Harga Biaya Driver per Hari (Rp)</label>
                    <input type="number" id="biaya_driver" name="biaya_driver" 
                           class="form-control" 
                           value="{{ old('biaya_driver', $biayaDriver) }}" 
                           required>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </>
@endsection