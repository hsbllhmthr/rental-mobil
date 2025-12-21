@extends('layouts.app')

@section('title', 'Ubah Password')

@section('content')
<div class="password-container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="register-header">
        <h1>Ubah Password</h1>
        <p>Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.</p>
    </div>
    
    <form class="form-wrapper" action="{{ route('password.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group-large">
            <label for="current_password">Password Saat Ini</label>
            <input type="password" id="current_password" name="current_password" required>
        </div>

        <div class="form-group-large">
            <label for="password">Password Baru</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group-large" style="position: relative; margin-bottom:15px;">
    <label for="password_confirmation">Konfirmasi Password Baru</label>
    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Masukkan Konfirmasi Password" required
        style="width:100%; padding:10px 40px 10px 10px; border:1px solid #ccc; border-radius:6px;">
    <span onclick="togglePassword('password_confirmation', this)" 
          style="position:absolute; top:70%; right:12px; transform:translateY(-50%);
                 cursor:pointer; background:#fff; padding-left:4px;">
        <i class="fa fa-eye"></i>
    </span>
</div>

        <div class="profile-form-actions">
        <a href="{{ route('profile.edit') }}" class="btn btn-outline">Kembali</a>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </div>
    </form>
</div>

<script>
function togglePassword(fieldId, icon) {
    const input = document.getElementById(fieldId);
    if(input.type === "password"){
        input.type = "text";
        icon.innerHTML = '<i class="fa fa-eye-slash"></i>'; // optional: ganti icon saat aktif
    } else {
        input.type = "password";
        icon.innerHTML = '<i class="fa fa-eye"></i>';
    }
}
</script>
@endsection