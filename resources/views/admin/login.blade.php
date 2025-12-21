<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Tri Manunggal Rent</title>

    {{-- Mengimpor Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    /* CSS untuk Halaman Login Admin */
    body, html {
        margin: 0;
        padding: 0;
        height: 100%;
        font-family: 'Poppins', 'General Sans', sans-serif;
        background-color: #040F2B; /* Latar belakang biru */
    }
    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
        box-sizing: border-box;
    }
    .login-card {
        background: white;
        border-radius: 12px;
        padding: 40px 50px; /* Padding diperkecil */
        width: 100%;
        max-width: 450px; /* Lebar maksimal diperkecil */
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        box-sizing: border-box;
    }
    .login-header {
        text-align: center;
        margin-bottom: 30px; /* Jarak dikurangi */
    }
    .login-header h1 {
        font-size: 22px; /* Font diperkecil */
        font-weight: 600;
        color: #333333;
        margin: 0 0 10px 0;
    }
    .login-header p {
        font-size: 15px; /* Font diperkecil */
        color: #A3A3A3;
        margin: 0;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        font-size: 14px; /* Font diperkecil */
        font-weight: 600;
        color: #333333;
        margin-bottom: 8px; /* Jarak dikurangi */
    }
    .form-group input {
        width: 100%;
        height: 50px; /* Tinggi input diperkecil */
        padding: 0 15px;
        border-radius: 8px;
        border: 1px #A3A3A3 solid;
        font-size: 15px; /* Font diperkecil */
        font-family: 'Poppins', sans-serif;
        box-sizing: border-box;
    }
    .btn-submit {
        width: 100%;
        height: 50px; /* Tinggi tombol diperkecil */
        margin-top: 15px;
        background: #118AEC;
        border: none;
        border-radius: 8px;
        color: white;
        font-size: 16px; /* Font diperkecil */
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .btn-submit:hover {
        background-color: #0d73c7;
    }
    .error-messages {
        margin-top: 20px;
        padding: 15px;
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
        border-radius: 8px;
        font-size: 14px; /* Font disesuaikan */
    }
</style>
</head>
<body>

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h1>Selamat Datang Admin</h1>
                <p>Silahkan Masukkan Alamat Email<br>dan Password Anda</p>
            </div>

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input type="email" id="email" name="email" placeholder="Masukkan Alamat Email" value="{{ old('email') }}" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan Password" required>
                </div>
                <button type="submit" class="btn-submit">Masuk</button>
            </form>
            
            @if ($errors->any())
                <div class="error-messages">
                    {{ $errors->first() }}
                </div>
            @endif
        </div>
    </div>

</body>
</html>