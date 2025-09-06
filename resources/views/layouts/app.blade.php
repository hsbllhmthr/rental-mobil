<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rental Mobil Tri Manunggala')</title>
    
    {{-- Memanggil file CSS kustom Anda --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{-- Menghubungkan Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

    <div class="page-container">
        
        {{-- HEADER KUSTOM ANDA --}}
        <header class="header">
            <nav class="nav-menu">
                <ul>
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li><a href="{{ route('mobil.search') }}">Cari Mobil</a></li>
                    <li><a href="{{ route('tentang.kami') }}">Tentang Kami</a></li>
                    <li><a href="{{ route('kontak') }}">Kontak</a></li>
                </ul>
            </nav>
            <div class="auth-buttons">
                @auth
                {{-- Tampilan Jika User Sudah Login ---}}
                <div class="user-dropdown">
                    <button type="button" class="dropdown-toggle">
                        {{ Auth::user()->name }}
                        <span class="arrow-down">&#9662;</span>
                    </button>
                    <div class="dropdown-menu">
                        <a href="{{ route('profile.edit') }}" class="dropdown-item">Pengaturan Profil</a>
                        <a href="{{ route('password.edit') }}" class="dropdown-item">Ubah Password</a>
                        <a href="{{ route('riwayat.sewa') }}" class="dropdown-item">Riwayat Sewa</a>
                        <hr class="dropdown-divider">
                        {{-- Tombol Logout dipindahkan ke sini --}}
                        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                            @csrf
                            <button type="submit" class="dropdown-item">Keluar</button>
                        </form>
                    </div>
                </div>
                @else
                    {{-- Tampilan Jika User Belum Login (Tamu) --}}
                    <a href="{{ route('register') }}">Daftar</a>
                    <a href="#" class="btn-login" data-modal-target="#login-modal">Masuk</a>
                @endauth
            </div>
        </header>

        {{-- KONTEN UTAMA HALAMAN --}}
        <main>
            @yield('content')
        </main>

        {{-- FOOTER KUSTOM ANDA --}}
        <footer class="footer">
            <div class="footer-content">
                <div class="footer-column about">
                    <h3>Tri Manunggala Car</h3>
                    <p>Penyedia layanan rental mobil terpercaya dengan koleksi kendaraan berkualitas untuk kebutuhan perjalanan Anda.</p>
                </div>
                <div class="footer-column">
                    <h3>Menu Utama</h3>
                    <ul>
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li><a href="{{ route('mobil.search') }}">Cari Mobil</a></li>
                        <li><a href="{{ route('tentang.kami') }}">Tentang Kami</a></li>
                        <li><a href="{{ route('kontak') }}">Kontak</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                <h3>Kontak Informasi</h3>
                <ul class="contact-list">
                    <li>
                        <strong>Telepon</strong>
                        <span>+62 813-5581-1336</span>
                    </li>
                    <li>
                        <strong>Alamat Email</strong>
                        <span>trimanunggala@gmail.com</span>
                    </li>
                    <li>
                        <strong>Alamat</strong>
                        <span>Tamalanrea, Makassar City, South Sulawesi, 90245</span>
                    </li>
                </ul>
            </div>
                <div class="footer-column">
                    <h3>Social Media</h3>
                    <div class="social-icons">
                        <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                        <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook"></i></a>
                    </div>
                </div>
            </div>
        </footer>

    </div>

    {{-- ============================================= --}}
    {{--              SEMUA KODE POP-UP                --}}
    {{-- ============================================= --}}

    {{-- Pop-up Login --}}
    <div id="login-modal" class="modal-overlay">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <div class="modal-header">
                <h1>Selamat Datang di Tri Manunggala Rent</h1>
                <p>Silahkan Masukkan Alamat Email <br> dan Password Anda</p>
            </div>
            <form action="{{ route('login.submit') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="login_email">Alamat Email</label>
                    <input type="email" id="login_email" name="email" placeholder="Masukkan Alamat Email" required>
                </div>
                <div class="form-group">
                    <label for="login_password">Password</label>
                    <input type="password" id="login_password" name="password" placeholder="Masukkan Password" required>
                </div>
                <button type="submit" class="btn-login-submit">Masuk</button>
            </form>
            <p class="form-prompt">Belum Punya Akun ? <a href="{{ route('register') }}" id="register-link">Daftar Disini</a></p>
        </div>
    </div>

    {{-- Pop-up Peringatan Login Diperlukan --}}
    <div id="require-login-modal" class="modal-overlay">
       <div class="modal-content text-center">
           <span class="close-button">&times;</span>
           <div class="modal-icon">
               <i class="fa-solid fa-triangle-exclamation"></i>
           </div>
           <h2>Login Diperlukan</h2>
           <p>Anda harus masuk ke akun Anda terlebih dahulu untuk dapat merental mobil ini.</p>
           <button class="btn-rental" id="go-to-login-btn" style="margin: 0 auto;">Masuk Sekarang</button>
       </div>
    </div>

    {{-- Pop-up Registrasi Sukses --}}
    <div id="success-modal" class="modal-overlay">
        <div class="modal-content text-center">
            <span class="close-button">&times;</span>
            <div class="modal-icon success">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <h2>Pendaftaran Berhasil!</h2>
            <p>Akun Anda telah berhasil dibuat. Selamat datang di Tri Manunggala Rent!</p>
            <button class="btn-primary close-btn" style="padding: 10px 30px;">Oke</button>
        </div>
    </div>

    {{-- Pop-up untuk Unggah Bukti Pembayaran --}}
    <div id="upload-proof-modal" class="modal-overlay">
       <div class="modal-content">
           <div class="modal-header">
               <h1>Unggah Bukti Pembayaran Anda</h1>
               <p>Pilih file gambar (JPG, PNG) maksimal ukuran 2 MB</p>
           </div>
           <div class="modal-body">
               <form id="upload-proof-form" method="POST" enctype="multipart/form-data">
                   @csrf
                   <div class="form-group">
                       <label for="bukti_pembayaran" class="file-upload-dropzone">
                           <div id="upload-prompt">
                               <img src="{{ asset('images/icons/upload.png') }}" alt="Upload Icon" class="upload-icon">
                           </div>
                           <img id="image-preview" src="#" alt="Image Preview" class="image-preview"/>
                       </label>
                       <input type="file" id="bukti_pembayaran" name="bukti_pembayaran" required>
                   </div>
                   <div class="form-actions-vertical">
                       <button type="submit" class="btn-login-submit">Unggah</button>
                       <button type="button" class="btn-link close-btn">Batalkan</button>
                   </div>
               </form>
           </div>
       </div>
    </div>


    {{-- ============================================= --}}
    {{--        KODE JAVASCRIPT YANG TERPUSAT        --}}
    {{-- ============================================= --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

                        // --- LOGIKA BARU UNTUK USER DROPDOWN DI HEADER ---
            const userDropdownToggle = document.querySelector('.user-dropdown .dropdown-toggle');
            if (userDropdownToggle) {
                const userDropdownMenu = userDropdownToggle.nextElementSibling;
                
                userDropdownToggle.addEventListener('click', function(event) {
                    event.stopPropagation(); // Mencegah event klik menyebar ke window
                    userDropdownMenu.classList.toggle('show');
                });

                // Menutup dropdown jika klik di luar
                window.addEventListener('click', function(event) {
                    if (!userDropdownToggle.contains(event.target)) {
                        userDropdownMenu.classList.remove('show');
                    }
                });
            }


            // --- Ambil data dari server (Blade) dan simpan ke variabel JS ---
            const isLoggedIn = JSON.parse('@json(auth()->check())');
            const registrationSuccess = JSON.parse('@json(session()->has("registration_success"))');

            // --- Ambil semua elemen modal yang dibutuhkan ---
            const loginModal = document.getElementById('login-modal');
            const requireLoginModal = document.getElementById('require-login-modal');
            const successModal = document.getElementById('success-modal');
            
            // --- Logika umum untuk membuka semua modal ---
            document.querySelectorAll('[data-modal-target]').forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    const modalId = button.getAttribute('data-modal-target');
                    const modal = document.querySelector(modalId);
                    
                    if (modal) {
                        // Logika spesifik untuk mengisi action form upload
                        if (modal.id === 'upload-proof-modal') {
                            const form = document.getElementById('upload-proof-form');
                            if(form) {
                                form.action = button.dataset.action;
                            }
                        }
                        modal.style.display = 'flex';
                    }
                });
            });

            // --- Logika untuk tombol "Masuk Sekarang" di modal peringatan ---
            const goToLoginBtn = document.getElementById('go-to-login-btn');
            if (goToLoginBtn && requireLoginModal && loginModal) {
                goToLoginBtn.addEventListener('click', () => {
                    requireLoginModal.style.display = 'none';
                    loginModal.style.display = 'flex';
                });
            }

            // --- Logika untuk tombol RENTAL SEKARANG di halaman detail ---
            document.addEventListener('click', function(event) {
                if (event.target && event.target.id === 'rental-now-btn') {
                    event.preventDefault();
                    if (!isLoggedIn) {
                        if (requireLoginModal) requireLoginModal.style.display = 'flex';
                    } else {
                        window.location.href = event.target.href; // Arahkan ke halaman pemesanan
                    }
                }
            });

            // --- Logika untuk menampilkan modal sukses ---
            if (registrationSuccess && successModal) {
                successModal.style.display = 'flex';
            }

            // --- Logika untuk preview gambar upload ---
            const fileInput = document.getElementById('bukti_pembayaran');
            if (fileInput) {
                const uploadPrompt = document.getElementById('upload-prompt');
                const imagePreview = document.getElementById('image-preview');

                fileInput.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            imagePreview.src = e.target.result;
                            imagePreview.style.display = 'block';
                            uploadPrompt.style.display = 'none';
                        }
                        reader.readAsDataURL(this.files[0]);
                    }
                });
            }

            // --- Logika umum untuk menutup semua modal ---
            document.querySelectorAll('.modal-overlay .close-button, .modal-overlay .close-btn').forEach(button => {
                button.addEventListener('click', () => {
                    button.closest('.modal-overlay').style.display = 'none';
                });
            });
            window.addEventListener('click', (event) => {
                if (event.target.classList.contains('modal-overlay')) {
                    event.target.style.display = 'none';
                }
            });
        });
    </script>
    
    @stack('scripts')
    
</body>
</html>