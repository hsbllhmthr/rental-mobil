<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Tri Manunggal Car</title>
    
    {{-- Mengimpor Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    {{-- Memanggil CSS Khusus Admin --}}
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <div class="admin-layout">
        
        {{-- SIDEBAR NAVIGASI --}}
        <aside class="admin-sidebar">
            <div class="sidebar-header">
                <h2>Admin Tri Manunggal</h2>
            </div>
            <nav class="sidebar-nav">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->is('admin/dashboard*') ? 'active' : '' }}">
                    <img src="{{ asset('svg/dashboard.png') }}" alt="Dashboard Icon">
                    <span>Dashboard</span>
                </a>

                <div class="has-submenu">
                    <a href="#" class="submenu-toggle">
                        <img src="{{ asset('svg/sewa.png') }}" alt="Sewa Icon">
                        <span>Sewa</span>
                        <span class="arrow-down">&#9662;</span>
                    </a>
                    <div class="submenu">
                        <a href="{{ route('admin.sewa.menunggu_pembayaran') }}" class="{{ request()->is('admin/sewa/menunggu-pembayaran*') ? 'active' : '' }}">
                            Menunggu Pembayaran
                        </a>
                        <a href="{{ route('admin.sewa.menunggu_konfirmasi') }}" class="{{ request()->is('admin/sewa/menunggu-konfirmasi*') ? 'active' : '' }}">
                            Menunggu Konfirmasi
                        </a>
                        <a href="{{ route('admin.sewa.pengembalian') }}" class="{{ request()->is('admin/sewa/pengembalian*') ? 'active' : '' }}">
                            Pengembalian
                        </a>
                        <a href="{{ route('admin.sewa.data_sewa') }}" class="{{ request()->is('admin/sewa/data-sewa*') ? 'active' : '' }}">
                    Data Sewa
                </a>
                    </div>
                </div>

                <div class="has-submenu">
                    <a href="#" class="submenu-toggle">
                        <img src="{{ asset('svg/mobil.png') }}" alt="Mobil Icon">
                        <span>Mobil</span>
                        <span class="arrow-down">&#9662;</span>
                    </a>
                    <div class="submenu">
                        <a href="{{ route('admin.merek.index') }}" class="{{ request()->is('admin/merek*') ? 'active' : '' }}">Data Merek</a>
                        <a href="{{ route('admin.mobil.index') }}" class="{{ request()->is('admin/mobil*') ? 'active' : '' }}">Data Mobil</a>
                    </div>
                </div>

                <a href="{{ route('admin.biaya_driver.index') }}" class="{{ request()->is('admin/biaya-driver*') ? 'active' : '' }}">
                    <img src="{{ asset('svg/driver.png') }}" alt="Driver Icon">
                    <span>Biaya Driver</span>
                </a>

                <a href="{{ route('admin.pengguna.index') }}" class="{{ request()->is('admin/pengguna*') ? 'active' : '' }}">
                    <img src="{{ asset('svg/pengguna.png') }}" alt="Pengguna Icon">
                    <span>Pengguna</span>
                </a>
                
                <a href="{{ route('admin.laporan.index') }}" class="{{ request()->is('admin/laporan*') ? 'active' : '' }}">
                <img src="{{ asset('svg/laporan.png') }}" alt="Laporan Icon">
                <span>Laporan</span>
            </a>
            </nav>
            <div class="sidebar-footer">
                 <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </aside>

        {{-- KONTEN UTAMA --}}
        <main class="admin-content">
            @yield('content')
        </main>

    </div>

    {{-- HTML UNTUK LIGHTBOX GAMBAR --}}
    <div id="lightbox-modal" class="lightbox-overlay">
        <span class="lightbox-close">&times;</span>
        <img class="lightbox-content" id="lightbox-image">
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Logika untuk membuka submenu
            document.querySelectorAll('.submenu-toggle').forEach(toggle => {
                toggle.addEventListener('click', function(event) {
                    event.preventDefault();
                    const parent = this.closest('.has-submenu');
                    parent.classList.toggle('open');
                    const submenu = parent.querySelector('.submenu');
                    submenu.style.display = parent.classList.contains('open') ? 'block' : 'none';
                });
            });

            // Logika untuk semua modal/pop-up
            document.querySelectorAll('[data-modal-target]').forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    const modalId = button.getAttribute('data-modal-target');
                    const modal = document.querySelector(modalId);
                    
                    if (modal) {
                        // Logika spesifik untuk mengisi pop-up DETAIL PENGGUNA
                        if (modal.id === 'view-user-modal') {
                            modal.querySelector('#view-user-name').innerText = button.dataset.name;
                            modal.querySelector('#view-user-email').innerText = button.dataset.email;
                            modal.querySelector('#view-user-telepon').innerText = button.dataset.telepon;
                            modal.querySelector('#view-user-alamat').innerText = button.dataset.alamat;
                            modal.querySelector('#view-user-ktp').src = button.dataset.ktp;
                            modal.querySelector('#view-user-kk').src = button.dataset.kk;
                            modal.querySelector('#view-user-title').innerText = 'Detail Pengguna: ' + button.dataset.name;
                        }

                        // Logika spesifik untuk mengisi pop-up EDIT MEREK
                        if (modal.id === 'edit-merek-modal') {
                            const form = modal.querySelector('#edit-merek-form');
                            const inputNama = modal.querySelector('#edit_nama_merek');
                            form.action = button.dataset.action;
                            inputNama.value = button.dataset.nama;
                        }
                        
                        // Logika spesifik untuk mengisi pop-up DETAIL SEWA
                        if (modal.id === 'view-sewa-modal') {
                            modal.querySelector('#view-sewa-kode').innerText = button.dataset.kode;
                            modal.querySelector('#view-sewa-mobil').innerText = button.dataset.mobil;
                            modal.querySelector('#view-sewa-mulai').innerText = button.dataset.mulai;
                            modal.querySelector('#view-sewa-selesai').innerText = button.dataset.selesai;
                            modal.querySelector('#view-sewa-durasi').innerText = button.dataset.durasi;
                            modal.querySelector('#view-sewa-penyewa').innerText = button.dataset.penyewa;
                            modal.querySelector('#view-sewa-total').innerText = button.dataset.total;
                            modal.querySelector('#view-sewa-status').innerText = button.dataset.status;
                            
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

            // Logika untuk dropdown status
            document.addEventListener('click', function(event) {
                const isDropdownToggle = event.target.matches('.dropdown-toggle');
                // Tutup semua dropdown jika klik di luar
                if (!isDropdownToggle && event.target.closest('.status-dropdown') === null) {
                    document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                        menu.classList.remove('show');
                    });
                    return;
                }
                // Toggle dropdown yang diklik
                if (isDropdownToggle) {
                    const currentMenu = event.target.nextElementSibling;
                    const isCurrentlyShown = currentMenu.classList.contains('show');
                    // Tutup semua dropdown dulu
                    document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                        menu.classList.remove('show');
                    });
                    // Jika dropdown yang diklik tadinya belum terbuka, buka sekarang
                    if (!isCurrentlyShown) {
                        currentMenu.classList.add('show');
                    }
                }
            });

            // Logika untuk Lightbox Gambar
            const lightboxModal = document.getElementById('lightbox-modal');
            if (lightboxModal) {
                const lightboxImage = document.getElementById('lightbox-image');
                const lightboxClose = lightboxModal.querySelector('.lightbox-close');

                document.querySelectorAll('.lightbox-trigger').forEach(image => {
                    image.style.cursor = 'pointer';
                    image.addEventListener('click', () => {
                        lightboxModal.style.display = 'block';
                        lightboxImage.src = image.src;
                    });
});

                lightboxClose.addEventListener('click', () => {
                    lightboxModal.style.display = 'none';
                });

                lightboxModal.addEventListener('click', (event) => {
                    if (event.target === lightboxModal) {
                        lightboxModal.style.display = 'none';
                    }
                });
            }
        });
    </script>
</body>
</html>