<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage Rental Mobil</title>
    
    {{-- Memanggil file CSS yang sudah kita buat --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

    <div class="page-container">
        
        {{-- Menggunakan tag <header> untuk bagian kepala halaman --}}
        <header class="header">
            
            {{-- Menggunakan tag <nav> untuk navigasi --}}
            <nav class="nav-menu">
                <ul>
                    <li><a href="#">Beranda</a></li>
                    <li><a href="#">Cari Mobil</a></li>
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Kontak</a></li>
                </ul>
            </nav>

            <div class="auth-buttons">
                <a href="{{ route('register') }}">Daftar</a>
                <a href="#" class="btn-login" id="login-btn">Masuk</a>
            </div>

        </header>

        {{-- Menggunakan tag <main> untuk konten utama halaman --}}
        {{-- Menggunakan tag <main> untuk konten utama halaman --}}
<main>
    <section class="hero-section">
        <img src="{{ asset('images/hero-image.png') }}" alt="Banner rental mobil">
    </section>
    
    {{-- ============================================= --}}
    {{-- === KONTEN BARU DITAMBAHKAN DI SINI === --}}
    {{-- ============================================= --}}
    <section class="car-listing">
    
    <div class="car-listing-header">
        <h2>Mobil Yang Tersedia Untuk Anda</h2>
    </div>

    <div class="car-cards-container">
        
        {{-- Kartu Mobil 1 --}}
        <a href="{{ route('car.detail', ['slug' => 'toyota-avanza-veloz']) }}" class="card-link">
        <article class="car-card">
            <img src="{{ asset('images/car.jpg') }}" alt="Toyota Avanza Veloz" class="car-image">
            <div class="car-card-body">
                <h3>Mobil Toyota Avanza Veloz</h3>
                <div class="car-price">
                    <span class="price-amount">Rp350.000</span>
                    <span class="price-period">/Hari</span>
                </div>
                    {{-- ... (kode kartu mobil sebelumnya) ... --}}
                <hr class="separator">
                <div class="car-specs">
                    {{-- BARIS PERTAMA --}}
                    <div class="spec-item">
                        <img src="{{ asset('images/icons/icon-seat.png') }}" alt="Seat Icon">
                        <span>4 Seat</span>
                    </div>
                    <div class="spec-item">
                        <img src="{{ asset('images/icons/icon-calendar.png') }}" alt="Calendar Icon">
                        <span>2023</span>
                    </div>
                    <div class="spec-item">
                        <img src="{{ asset('images/icons/icon-fuel.png') }}" alt="Fuel Icon">
                        <span>Bensin</span>
                    </div>
                    {{-- BARIS KEDUA --}}
                    <div class="spec-item">
                        <img src="{{ asset('images/icons/icon-door.png') }}" alt="Door Icon">
                        <span>4 Pintu</span>
                    </div>
                    <div class="spec-item">
                        <img src="{{ asset('images/icons/icon-users.png') }}" alt="Users Icon">
                        <span>7 Orang</span>
                    </div>
                </div>
            </div>
        </article>
        </a>

        {{-- Kartu Mobil 2 --}}
        <article class="car-card">
            <img src="{{ asset('images/car.jpg') }}" alt="Mitsubishi Pajero" class="car-image">
            <div class="car-card-body">
                <h3>Mobil Mitsubishi Pajero</h3>
                <div class="car-price">
                    <span class="price-amount">Rp800.000</span>
                    <span class="price-period">/Hari</span>
                </div>
                <hr class="separator">
                <div class="car-specs">
                    {{-- BARIS PERTAMA --}}
                    <div class="spec-item">
                        <img src="{{ asset('images/icons/icon-seat.png') }}" alt="Seat Icon">
                        <span>4 Seat</span>
                    </div>
                    <div class="spec-item">
                        <img src="{{ asset('images/icons/icon-calendar.png') }}" alt="Calendar Icon">
                        <span>2023</span>
                    </div>
                    <div class="spec-item">
                        <img src="{{ asset('images/icons/icon-fuel.png') }}" alt="Fuel Icon">
                        <span>Bensin</span>
                    </div>
                    {{-- BARIS KEDUA --}}
                    <div class="spec-item">
                        <img src="{{ asset('images/icons/icon-door.png') }}" alt="Door Icon">
                        <span>4 Pintu</span>
                    </div>
                    <div class="spec-item">
                        <img src="{{ asset('images/icons/icon-users.png') }}" alt="Users Icon">
                        <span>7 Orang</span>
                    </div>
                </div>
            </div>
        </article>

        {{-- Kartu Mobil 3 --}}
        <article class="car-card">
            <img src="{{ asset('images/car.jpg') }}" alt="Honda Brio" class="car-image">
            <div class="car-card-body">
                <h3>Mobil Honda Brio</h3>
                <div class="car-price">
                    <span class="price-amount">Rp250.000</span>
                    <span class="price-period">/Hari</span>
                </div>
                <hr class="separator">
                <div class="car-specs">
                    {{-- BARIS PERTAMA --}}
                    <div class="spec-item">
                        <img src="{{ asset('images/icons/icon-seat.png') }}" alt="Seat Icon">
                        <span>4 Seat</span>
                    </div>
                    <div class="spec-item">
                        <img src="{{ asset('images/icons/icon-calendar.png') }}" alt="Calendar Icon">
                        <span>2023</span>
                    </div>
                    <div class="spec-item">
                        <img src="{{ asset('images/icons/icon-fuel.png') }}" alt="Fuel Icon">
                        <span>Bensin</span>
                    </div>
                    {{-- BARIS KEDUA --}}
                    <div class="spec-item">
                        <img src="{{ asset('images/icons/icon-door.png') }}" alt="Door Icon">
                        <span>4 Pintu</span>
                    </div>
                    <div class="spec-item">
                        <img src="{{ asset('images/icons/icon-users.png') }}" alt="Users Icon">
                        <span>7 Orang</span>
                    </div>
                </div>
            </div>
        </article>
    </div>
    <br>
    <div class="car-cards-container">
        
        {{-- Kartu Mobil 1 --}}
        <article class="car-card">
            <img src="{{ asset('images/car.jpg') }}" alt="Toyota Avanza Veloz" class="car-image">
            <div class="car-card-body">
                <h3>Mobil Toyota Avanza Veloz</h3>
                <div class="car-price">
                    <span class="price-amount">Rp350.000</span>
                    <span class="price-period">/Hari</span>
                </div>
                    {{-- ... (kode kartu mobil sebelumnya) ... --}}
                <hr class="separator">
                <div class="car-specs">
                    {{-- BARIS PERTAMA --}}
                    <div class="spec-item">
                        <img src="{{ asset('images/icons/icon-seat.png') }}" alt="Seat Icon">
                        <span>4 Seat</span>
                    </div>
                    <div class="spec-item">
                        <img src="{{ asset('images/icons/icon-calendar.png') }}" alt="Calendar Icon">
                        <span>2023</span>
                    </div>
                    <div class="spec-item">
                        <img src="{{ asset('images/icons/icon-fuel.png') }}" alt="Fuel Icon">
                        <span>Bensin</span>
                    </div>
                    {{-- BARIS KEDUA --}}
                    <div class="spec-item">
                        <img src="{{ asset('images/icons/icon-door.png') }}" alt="Door Icon">
                        <span>4 Pintu</span>
                    </div>
                    <div class="spec-item">
                        <img src="{{ asset('images/icons/icon-users.png') }}" alt="Users Icon">
                        <span>7 Orang</span>
                    </div>
                </div>
            </div>
        </article>

        {{-- Kartu Mobil 2 --}}
        <article class="car-card">
            <img src="{{ asset('images/car.jpg') }}" alt="Mitsubishi Pajero" class="car-image">
            <div class="car-card-body">
                <h3>Mobil Mitsubishi Pajero</h3>
                <div class="car-price">
                    <span class="price-amount">Rp800.000</span>
                    <span class="price-period">/Hari</span>
                </div>
                <hr class="separator">
                <div class="car-specs">
                    {{-- BARIS PERTAMA --}}
                    <div class="spec-item">
                        <img src="{{ asset('images/icons/icon-seat.png') }}" alt="Seat Icon">
                        <span>4 Seat</span>
                    </div>
                    <div class="spec-item">
                        <img src="{{ asset('images/icons/icon-calendar.png') }}" alt="Calendar Icon">
                        <span>2023</span>
                    </div>
                    <div class="spec-item">
                        <img src="{{ asset('images/icons/icon-fuel.png') }}" alt="Fuel Icon">
                        <span>Bensin</span>
                    </div>
                    {{-- BARIS KEDUA --}}
                    <div class="spec-item">
                        <img src="{{ asset('images/icons/icon-door.png') }}" alt="Door Icon">
                        <span>4 Pintu</span>
                    </div>
                    <div class="spec-item">
                        <img src="{{ asset('images/icons/icon-users.png') }}" alt="Users Icon">
                        <span>7 Orang</span>
                    </div>
                </div>
            </div>
        </article>

        {{-- Kartu Mobil 3 --}}
        <article class="car-card">
            <img src="{{ asset('images/car.jpg') }}" alt="Honda Brio" class="car-image">
            <div class="car-card-body">
                <h3>Mobil Honda Brio</h3>
                <div class="car-price">
                    <span class="price-amount">Rp250.000</span>
                    <span class="price-period">/Hari</span>
                </div>
                <hr class="separator">
                <div class="car-specs">
                    {{-- BARIS PERTAMA --}}
                    <div class="spec-item">
                        <img src="{{ asset('images/icons/icon-seat.png') }}" alt="Seat Icon">
                        <span>4 Seat</span>
                    </div>
                    <div class="spec-item">
                        <img src="{{ asset('images/icons/icon-calendar.png') }}" alt="Calendar Icon">
                        <span>2023</span>
                    </div>
                    <div class="spec-item">
                        <img src="{{ asset('images/icons/icon-fuel.png') }}" alt="Fuel Icon">
                        <span>Bensin</span>
                    </div>
                    {{-- BARIS KEDUA --}}
                    <div class="spec-item">
                        <img src="{{ asset('images/icons/icon-door.png') }}" alt="Door Icon">
                        <span>4 Pintu</span>
                    </div>
                    <div class="spec-item">
                        <img src="{{ asset('images/icons/icon-users.png') }}" alt="Users Icon">
                        <span>7 Orang</span>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>

</main>

{{-- ... (akhir dari tag </main>) ... --}}
        
        {{-- ============================================= --}}
        {{--           TAMBAHKAN FOOTER DI SINI          --}}
        {{-- ============================================= --}}
        <footer class="footer">
            <div class="footer-content">

                {{-- Kolom 1: Tentang Perusahaan --}}
                <div class="footer-column about">
                    <h3>Tri Manunggala </h3>
                    <p>
                        Penyedia layanan rental mobil terpercaya <br> dengan koleksi kendaraan berkualitas <br> untuk kebutuhan perjalanan Anda.
                    </p>
                </div>

                {{-- Kolom 2: Menu Utama --}}
                <div class="footer-column">
                    <h3>Menu Utama</h3>
                    <ul>
                        <li><a href="#">Beranda</a></li>
                        <li><a href="#">Cari Mobil</a></li>
                        <li><a href="#">Tentang Kami</a></li>
                        <li><a href="#">Kontak</a></li>
                    </ul>
                </div>

                {{-- Kolom 3: Kontak Informasi --}}
                <div class="footer-column">
                    <h3>Kontak Informasi</h3>
                    <ul>
                        <li class="contact-item">
                            <strong>Telepon</strong>
                            <span>081355811336</span>
                        </li>
                        <li class="contact-item">
                            <strong>Alamat Email</strong>
                            <span>trimanunggala@gmail.com</span>
                        </li>
                        <li class="contact-item">
                            <strong>Alamat</strong>
                            <span>Tamalanrea, Makassar City, South Sulawesi, 90245</span>
                        </li>
                    </ul>
                </div>

                {{-- Kolom 4: Sosial Media --}}
                <div class="footer-column">
    <h3>Social Media</h3>
    <div class="social-icons">
        {{-- Ganti # dengan link sosial media Anda --}}
        <a href="#" aria-label="Instagram">
            <i class="fa-brands fa-instagram"></i>
        </a>
        <a href="#" aria-label="WhatsApp">
            <i class="fa-brands fa-whatsapp"></i>
        </a>
        <a href="#" aria-label="Facebook">
            <i class="fa-brands fa-facebook"></i>
        </a>
    </div>
</div>

            </div>
        </footer>

    </div> {{-- Ini adalah tag penutup dari .page-container --}}

   {{-- ============================================= --}}
{{--        KODE POP-UP LOGIN (VERSI BARU)         --}}
{{-- ============================================= --}}
<div id="login-modal" class="modal-overlay">
    <div class="modal-content">
        <span class="close-button">&times;</span>
        <div class="modal-header">
            <h1>Selamat Datang di Tri Manunggala Rent</h1>
            <p>Silahkan Masukkan Alamat Email <br> dan Password Anda</p>
        </div>
        
        <form action="#" method="POST">
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

        <p class="form-prompt">
            Belum Punya Akun ? <a href="{{ route('register') }}">Daftar Disini</a>
        </p>
    </div>
</div>


 {{-- ============================================= --}}
 {{--        KODE JAVASCRIPT DITAMBAHKAN DI SINI      --}}
 {{-- ============================================= --}}
 <script>
     // Ambil elemen yang dibutuhkan
     const loginBtn = document.getElementById('login-btn');
     const loginModal = document.getElementById('login-modal');
     const closeBtn = loginModal.querySelector('.close-button');

     // Fungsi untuk menampilkan modal
     function showModal() {
         loginModal.style.display = 'flex';
     }

     // Fungsi untuk menyembunyikan modal
     function hideModal() {
         loginModal.style.display = 'none';
     }

     // Event listener saat tombol "Masuk" di-klik
     loginBtn.addEventListener('click', function(event) {
         event.preventDefault(); // Mencegah link berpindah halaman
         showModal();
     });

     // Event listener saat tombol "X" di-klik
     closeBtn.addEventListener('click', hideModal);

     // Event listener untuk menutup modal saat area gelap di-klik
     loginModal.addEventListener('click', function(event) {
         if (event.target === loginModal) {
             hideModal();
         }
     });
 </script>


 </div> {{-- Ini adalah tag penutup dari .page-container --}}

</body>
</html>

