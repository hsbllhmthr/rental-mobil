@extends('layouts.app')

@section('title', 'Daftar Akun Baru')

@section('content')
<div class="register-container">
    <div class="register-header">
        <h1>Daftar Akun Baru Tri Manunggal</h1>
        <p>Silahkan Masukkan Data Anda Dengan Benar</p>
    </div>
    
    <form action="{{ route('register.submit') }}" method="POST" enctype="multipart/form-data">
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

        <div class="form-grid">
            {{-- Nama Lengkap --}}
            <div class="form-group-large">
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" placeholder="Masukkan Nama Lengkap" required>
            </div>

            {{-- Nomor Telepon --}}
           <div class="form-group-large">
    <label for="phone">Nomor Telepon</label>
    <input type="tel" id="phone" name="nomor_telepon" placeholder="Masukkan Nomor Telepon" required>
</div>

            {{-- Alamat Rumah --}}
            <div class="form-group-large">
    <label for="address">Alamat Rumah</label>
    <input type="text" id="address" name="alamat" placeholder="Masukkan Alamat Rumah" required>
</div>

            {{-- Alamat Email --}}
            <div class="form-group-large">
                <label for="email">Alamat Email</label>
                <input type="email" id="email" name="email" placeholder="Masukkan Alamat Email" required>
            </div>

            {{-- Upload Foto KTP --}}
            <div class="form-group-large">
                <label for="ktp_photo">Upload Foto KTP</label>
                <div class="file-upload-wrapper">
                    <input type="file" id="ktp_photo" name="ktp_photo" class="file-input" required>
                    <label for="ktp_photo" class="file-label">Pilih File...</label>
                </div>
            </div>

            {{-- Upload Foto Kartu Keluarga --}}
            <div class="form-group-large">
                <label for="kk_photo">Upload Foto Kartu SIM A</label>
                <div class="file-upload-wrapper">
                    <input type="file" id="kk_photo" name="kk_photo" class="file-input" required>
                    <label for="kk_photo" class="file-label">Pilih File...</label>
                </div>
            </div>
{{-- Password --}}
<div class="form-group-large" style="position: relative; margin-bottom:15px;">
    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="Masukkan Password" required
        style="width:100%; padding:10px 40px 10px 10px; border:1px solid #ccc; border-radius:6px;">
    <span onclick="togglePassword('password', this)" 
          style="position:absolute; top:70%; right:12px; transform:translateY(-50%);
                 cursor:pointer; background:#fff; padding-left:4px;">
        <i class="fa fa-eye"></i>
    </span>
</div>

{{-- Konfirmasi Password --}}
<div class="form-group-large" style="position: relative; margin-bottom:15px;">
    <label for="password_confirmation">Konfirmasi Password</label>
    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Masukkan Ulang Password" required
        style="width:100%; padding:10px 40px 10px 10px; border:1px solid #ccc; border-radius:6px;">
    <span onclick="togglePassword('password_confirmation', this)" 
          style="position:absolute; top:70%; right:12px; transform:translateY(-50%);
                 cursor:pointer; background:#fff; padding-left:4px;">
        <i class="fa fa-eye"></i>
    </span>
</div>

        </div>

        <button type="submit" class="btn-register-submit">Daftarkan Akun</button>
    </form>

    <p class="login-prompt">
        Sudah punya akun ? <a href="#" id="login-btn">Masuk Disini</a>
    </p>
</div>
<script>
function togglePassword(fieldId, el) {
  var input = document.getElementById(fieldId);
  var icon = el.querySelector("i");
  if (input.type === "password") {
    input.type = "text";
    icon.classList.remove("fa-eye");
    icon.classList.add("fa-eye-slash");
  } else {
    input.type = "password";
    icon.classList.remove("fa-eye-slash");
    icon.classList.add("fa-eye");
  }
}
</script>

@endsection