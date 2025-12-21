<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Rental Mobil Tri Manunggal')</title>
    
    {{-- Include PWA Meta Tags --}}
    <x-pwa-head />
    
    {{-- Memanggil file CSS kustom Anda --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{-- Menghubungkan Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

    <div class="page-container">
        
        {{-- PWA Install Button (Optional) --}}
        <div id="pwa-install-container" style="display: none;">
            <button id="pwa-install-btn" class="fixed bottom-20 right-4 bg-blue-500 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-blue-600 transition-colors z-50" style="z-index: 1000;">
                📱 Install App
            </button>
        </div>
        
        {{-- HEADER KUSTOM ANDA --}}
        {{-- HEADER DENGAN MENU HAMBURGER --}}
        <header class="header">
            {{-- Logo atau Brand Name --}}
            <div class="brand-logo">
                <a href="{{ route('home') }}">Tri Manunggal</a>
            </div>

            {{-- Desktop Navigation (tampil di desktop) --}}
            <nav class="nav-menu desktop-nav">
                <ul>
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li><a href="{{ route('mobil.search') }}">Cari Mobil</a></li>
                    <li><a href="{{ route('tentang.kami') }}">Tentang Kami</a></li>
                    <li><a href="{{ route('kontak') }}">Kontak</a></li>
                    <li><a href="{{ route('syarat.ketentuan') }}">Syarat & Ketentuan</a></li>
                </ul>
            </nav>

            {{-- Desktop Auth Buttons --}}
            <div class="auth-buttons desktop-auth">
                @auth
                    {{-- Dropdown Pengguna --}}
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
                            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                                @csrf
                                <button type="submit" class="dropdown-item">Keluar</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('register') }}">Daftar</a>
                    <a href="#" class="btn-login" data-modal-target="#login-modal">Masuk</a>
                @endauth
            </div>

            {{-- Hamburger Menu Button (tampil di mobile) --}}
            <button class="hamburger-menu" id="hamburger-toggle">
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
            </button>
        </header>

        {{-- Mobile Navigation Overlay --}}
        <div class="mobile-nav-overlay" id="mobile-nav-overlay">
            <div class="mobile-nav-content">
                {{-- Close Button --}}
                <button class="mobile-nav-close" id="mobile-nav-close">
                    <i class="fas fa-times"></i>
                </button>

                {{-- Mobile Navigation Menu --}}
                <nav class="mobile-nav">
                    <ul class="mobile-nav-list">
                        <li><a href="{{ route('home') }}" class="mobile-nav-item">Beranda</a></li>
                        <li><a href="{{ route('mobil.search') }}" class="mobile-nav-item">Cari Mobil</a></li>
                        <li><a href="{{ route('tentang.kami') }}" class="mobile-nav-item">Tentang Kami</a></li>
                        <li><a href="{{ route('kontak') }}" class="mobile-nav-item">Kontak</a></li>
                        <li><a href="{{ route('syarat.ketentuan') }}" class="mobile-nav-item">Syarat & Ketentuan</a></li>
                    </ul>

                    {{-- Mobile Auth Section --}}
                    <div class="mobile-auth-section">
                        @auth
                            {{-- User Info --}}
                            <div class="mobile-user-info">
                                <div class="mobile-user-avatar">
                                    <i class="fas fa-user-circle"></i>
                                </div>
                                <span class="mobile-user-name">{{ Auth::user()->name }}</span>
                            </div>

                            {{-- User Menu --}}
                            <div class="mobile-user-menu">
                                <a href="{{ route('profile.edit') }}" class="mobile-auth-item">
                                    <i class="fas fa-user-cog"></i>
                                    Pengaturan Profil
                                </a>
                                <a href="{{ route('password.edit') }}" class="mobile-auth-item">
                                    <i class="fas fa-lock"></i>
                                    Ubah Password
                                </a>
                                <a href="{{ route('riwayat.sewa') }}" class="mobile-auth-item">
                                    <i class="fas fa-history"></i>
                                    Riwayat Sewa
                                </a>
                                <form method="POST" action="{{ route('logout') }}" class="mobile-logout-form">
                                    @csrf
                                    <button type="submit" class="mobile-auth-item logout-btn">
                                        <i class="fas fa-sign-out-alt"></i>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        @else
                            {{-- Guest Buttons --}}
                            <div class="mobile-guest-buttons">
                                <a href="{{ route('register') }}" class="mobile-btn mobile-btn-register">
                                    <i class="fas fa-user-plus"></i>
                                    Daftar
                                </a>
                                <button class="mobile-btn mobile-btn-login" data-modal-target="#login-modal">
                                    <i class="fas fa-sign-in-alt"></i>
                                    Masuk
                                </button>
                            </div>
                        @endauth
                    </div>
                </nav>
            </div>
        </div>

        {{-- KONTEN UTAMA HALAMAN --}}
        <main>
            @yield('content')
        </main>

        {{-- FOOTER KUSTOM ANDA --}}
        <footer class="footer">
            <div class="footer-content">
                <div class="footer-column about">
                    <h3>Tri Manunggal</h3>
                    <p>Penyedia layanan rental mobil yang terpercaya dengan melayani sepenuh hati demi menghadirkan kenyamanan terbaik untuk setiap pelanggan.</p>
                </div>
                <div class="footer-column">
                    <h3>Menu Utama</h3>
                    <ul class="contact-list">
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li><a href="{{ route('mobil.search') }}">Cari Mobil</a></li>
                        <li><a href="{{ route('tentang.kami') }}">Tentang Kami</a></li>
                        <li><a href="{{ route('kontak') }}">Kontak</a></li>
                        <li><a href="{{ route('syarat.ketentuan') }}">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Kontak Informasi</h3>
                    <ul class="contact-list">
                        <li><strong>Telepon : </strong><span>081355811336</span></li>
                        <li><strong>Alamat Email : </strong><span>trimanunggal@gmail.com</span></li>
                        <li><strong>Alamat : </strong><span>Tamalanrea, Makassar City, South Sulawesi, 902455</span></li>
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
                <h1>Selamat Datang di <br> Tri Manunggal</h1>
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
    <div style="position: relative;">
        <input type="password" id="login_password" name="password" placeholder="Masukkan Password" required>
        <span id="togglePassword" 
              style="position:absolute; right:20px; top:50%; transform:translateY(-50%); cursor:pointer;">
            <i class="fa fa-eye"></i>
        </span>
    </div>
</div>


                <button type="submit" class="btn-login-submit">Masuk</button>
            </form>
            <p class="form-prompt">Belum Punya Akun ? <a href="{{ route('register') }}">Daftar Disini</a></p>
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
            <p>Akun Anda telah berhasil dibuat. Selamat datang di Tri Manunggal!</p>
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
                               <img src="{{ asset('images/icons/icon-upload.png') }}" alt="Upload Icon" class="upload-icon">
                               <span class="upload-text">Klik untuk memilih file atau tarik ke sini</span>
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
    
    {{-- Memanggil pop-up detail sewa dari partials --}}
    @include('partials.detail-sewa-modal')

    {{-- PWA Offline/Online Status Indicator (Optional) --}}
    <div id="pwa-status-indicator" style="display: none; position: fixed; top: 0; left: 0; right: 0; background: #f59e0b; color: white; text-align: center; padding: 8px; z-index: 9999; font-size: 14px;">
        <span id="pwa-status-text">Anda sedang offline</span>
    </div>

    {{-- ============================================= --}}
    {{--        KODE JAVASCRIPT YANG TERPUSAT        --}}
    {{-- ============================================= --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        // --- Toggle Password Visibility ---
const togglePassword = document.getElementById("togglePassword");
const passwordInput = document.getElementById("login_password");

if (togglePassword && passwordInput) {
    togglePassword.addEventListener("click", function () {
        const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
        passwordInput.setAttribute("type", type);

        // Ganti ikon
        this.innerHTML = type === "password" 
            ? '<i class="fa fa-eye"></i>' 
            : '<i class="fa fa-eye-slash"></i>';
    });
}

            // --- Data dari server (kode yang sudah ada) ---
            const isLoggedIn = JSON.parse('@json(auth()->check())');
            const registrationSuccess = JSON.parse('@json(session()->has("registration_success"))');

            // --- Elemen modal yang sudah ada ---
            const loginModal = document.getElementById('login-modal');
            const requireLoginModal = document.getElementById('require-login-modal');
            const successModal = document.getElementById('success-modal');
            
            // --- HAMBURGER MENU ELEMENTS ---
            const hamburgerToggle = document.getElementById('hamburger-toggle');
            const mobileNavOverlay = document.getElementById('mobile-nav-overlay');
            const mobileNavClose = document.getElementById('mobile-nav-close');

            // --- PWA ELEMENTS ---
            const pwaInstallContainer = document.getElementById('pwa-install-container');
            const pwaInstallBtn = document.getElementById('pwa-install-btn');
            const pwaStatusIndicator = document.getElementById('pwa-status-indicator');
            const pwaStatusText = document.getElementById('pwa-status-text');

            // --- PWA FUNCTIONS ---
            function showPwaInstallButton() {
                if (pwaInstallContainer) {
                    pwaInstallContainer.style.display = 'block';
                }
            }

            function hidePwaInstallButton() {
                if (pwaInstallContainer) {
                    pwaInstallContainer.style.display = 'none';
                }
            }

            function showPwaStatus(message, isOnline = true) {
                if (pwaStatusIndicator && pwaStatusText) {
                    pwaStatusText.textContent = message;
                    pwaStatusIndicator.style.background = isOnline ? '#10b981' : '#f59e0b';
                    pwaStatusIndicator.style.display = 'block';
                    
                    // Auto hide after 3 seconds
                    setTimeout(() => {
                        pwaStatusIndicator.style.display = 'none';
                    }, 3000);
                }
            }

            // --- PWA EVENT LISTENERS ---
            // Online/Offline status monitoring
            window.addEventListener('online', () => {
                showPwaStatus('Koneksi internet tersambung kembali', true);
            });

            window.addEventListener('offline', () => {
                showPwaStatus('Anda sedang offline', false);
            });

            // PWA Install functionality is handled by the pwa-head component script
            // We just need to show/hide the install button container

            // --- HAMBURGER MENU FUNCTIONS ---
            function openMobileNav() {
                if (mobileNavOverlay && hamburgerToggle) {
                    mobileNavOverlay.classList.add('active');
                    hamburgerToggle.classList.add('active');
                    document.body.classList.add('mobile-nav-open');
                    document.body.style.overflow = 'hidden';
                }
            }

            function closeMobileNav() {
                if (mobileNavOverlay && hamburgerToggle) {
                    mobileNavOverlay.classList.remove('active');
                    hamburgerToggle.classList.remove('active');
                    document.body.classList.remove('mobile-nav-open');
                    document.body.style.overflow = '';
                }
            }

            // --- HAMBURGER EVENT LISTENERS ---
            if (hamburgerToggle) {
                hamburgerToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    if (mobileNavOverlay && mobileNavOverlay.classList.contains('active')) {
                        closeMobileNav();
                    } else {
                        openMobileNav();
                    }
                });
            }

            if (mobileNavClose) {
                mobileNavClose.addEventListener('click', function(e) {
                    e.preventDefault();
                    closeMobileNav();
                });
            }

            // Tutup mobile nav saat click overlay (bukan content)
            if (mobileNavOverlay) {
                mobileNavOverlay.addEventListener('click', function(e) {
                    if (e.target === mobileNavOverlay) {
                        closeMobileNav();
                    }
                });
            }

            // Tutup mobile nav saat click navigation items
            document.querySelectorAll('.mobile-nav-item').forEach(item => {
                item.addEventListener('click', function() {
                    closeMobileNav();
                });
            });

            // Handle mobile auth buttons
            document.querySelectorAll('.mobile-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    if (this.getAttribute('data-modal-target')) {
                        // Untuk tombol login, tutup nav setelah modal terbuka
                        setTimeout(() => {
                            closeMobileNav();
                        }, 150);
                    } else {
                        // Untuk tombol register, tutup nav langsung
                        closeMobileNav();
                    }
                });
            });

            // Tutup mobile nav saat window resize ke desktop
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    closeMobileNav();
                }
            });

            // Prevent scroll propagation saat mobile nav terbuka
            if (mobileNavOverlay) {
                mobileNavOverlay.addEventListener('touchmove', function(e) {
                    if (e.target === mobileNavOverlay) {
                        e.preventDefault();
                    }
                }, { passive: false });
            }

            // --- KODE MODAL YANG SUDAH ADA (jangan dihapus) ---
            
            // Logika umum untuk membuka semua modal
            document.querySelectorAll('[data-modal-target]').forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    
                    const modalId = button.getAttribute('data-modal-target');
                    const modal = document.querySelector(modalId);
                    
                    if (modal) {
                        // Logika spesifik untuk mengisi action form upload
                        if (modal.id === 'upload-proof-modal') {
                            const form = document.getElementById('upload-proof-form');
                            if(form) form.action = button.dataset.action;
                        }
                        
                        // Logika untuk mengisi pop-up DETAIL SEWA
                        if (modal.id === 'view-sewa-modal') {
                            modal.querySelector('#view-sewa-kode').innerText = button.dataset.kode || '-';
                            modal.querySelector('#view-sewa-mobil').innerText = button.dataset.mobil || '-';
                            modal.querySelector('#view-sewa-mulai').innerText = button.dataset.mulai || '-';
                            modal.querySelector('#view-sewa-selesai').innerText = button.dataset.selesai || '-';
                            modal.querySelector('#view-sewa-durasi').innerText = button.dataset.durasi || '-';
                            modal.querySelector('#view-sewa-penyewa').innerText = button.dataset.penyewa || '-';
                            modal.querySelector('#view-sewa-total').innerText = button.dataset.total || '-';
                            modal.querySelector('#view-sewa-status').innerText = button.dataset.status || '-';
                            
                            const buktiContainer = modal.querySelector('#view-sewa-bukti-container');
                            const buktiUrl = button.dataset.bukti;
                            if (buktiUrl) {
                                buktiContainer.innerHTML = `<a href="${buktiUrl}" target="_blank"><img src="${buktiUrl}" alt="Bukti Pembayaran" class="bukti-pembayaran-img"></a>`;
                            } else {
                                buktiContainer.innerHTML = `<span>Belum ada bukti pembayaran.</span>`;
                            }
                        }
                        
                        modal.style.display = 'flex';
                    }
                });
            });

            // Logika untuk tombol "Masuk Sekarang" di modal peringatan
            const goToLoginBtn = document.getElementById('go-to-login-btn');
            if (goToLoginBtn && requireLoginModal && loginModal) {
                goToLoginBtn.addEventListener('click', () => {
                    requireLoginModal.style.display = 'none';
                    loginModal.style.display = 'flex';
                });
            }

            // Logika untuk tombol RENTAL SEKARANG di halaman detail
            document.addEventListener('click', function(event) {
                if (event.target && event.target.id === 'rental-now-btn') {
                    event.preventDefault();
                    if (!isLoggedIn) {
                        if (requireLoginModal) requireLoginModal.style.display = 'flex';
                    } else {
                        window.location.href = event.target.href;
                    }
                }
            });

            // Logika untuk menampilkan modal sukses
            if (registrationSuccess && successModal) {
                successModal.style.display = 'flex';
            }

            // Logika untuk preview gambar upload
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

            // Logika umum untuk menutup semua modal
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

            // Logika untuk User Dropdown di Header (Desktop)
            const userDropdownToggle = document.querySelector('.user-dropdown .dropdown-toggle');
            if (userDropdownToggle) {
                const userDropdownMenu = userDropdownToggle.nextElementSibling;
                userDropdownToggle.addEventListener('click', function(event) {
                    event.stopPropagation();
                    userDropdownMenu.classList.toggle('show');
                });
                window.addEventListener('click', function(event) {
                    if (!userDropdownToggle.contains(event.target)) {
                        userDropdownMenu.classList.remove('show');
                    }
                });
            }
        });
        </script>
    
    @stack('scripts')
    
</body>
</html>