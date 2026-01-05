@extends('layouts.app')

@section('title', 'Formulir Pemesanan')

@section('content')
<div class="booking-page-container">
    <nav class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <span>Formulir Pemesanan</span>
    </nav>

    <form id="booking-form" action="{{ route('rental.store', $mobil->id) }}" method="POST">
        @csrf
        <div class="booking-layout">
            
            {{-- KOLOM KIRI: FORMULIR PEMESANAN --}}
            <div class="booking-form-section">
                <div class="form-header">
                    <h2>Masukkan Informasi Pemesanan Rental Mobil</h2>
                </div>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="start_date">Tanggal Mulai</label>
                        <input type="date" id="start_date" name="start_date" required>
                    </div>
                    <div class="form-group">
                        <label for="end_date">Tanggal Selesai</label>
                        <input type="date" id="end_date" name="end_date" required>
                    </div>
                    <div class="form-group">
                        <label for="pickup_method">Metode Pickup</label>
                        <select id="pickup_method" name="pickup_method" required>
                            <option value="Ambil di Kantor">Ambil di Lokasi Rental</option>
                            <option value="Diantar ke Alamat">Antar ke Lokasi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pickup_address">Alamat Rumah</label>
                        <input type="text" id="pickup_address" name="pickup_address" value="{{ Auth::user()->alamat }}" placeholder="Isi jika memilih diantar">
                    </div>
                    <div class="form-group">
                        <label for="use_driver">Gunakan Driver?</label>
                        <select id="use_driver" name="use_driver" required>
                            <option value="Tidak">Tidak</option>
                            <option value="Ya">Ya (Biaya tambahan berlaku)</option>
                        </select>
                    </div>
                </div>

                <button type="button" class="btn btn-outline" id="check-availability-btn"
                        data-url="{{ route('rental.cek_ketersediaan', $mobil->id) }}">
                    Cek Ketersediaan & Biaya
                </button>

                <div id="availability-message" class="availability-message"></div>

                {{-- Bagian Ringkasan Sewa (muncul setelah cek ketersediaan) --}}
                <div class="rental-summary-section">
                    <h3>Ringkasan Sewa</h3>
                    <div class="form-grid">
                        <div class="form-group"><label>Tanggal Mulai</label><input type="text" id="summary_start_date" disabled></div>
                        <div class="form-group"><label>Tanggal Selesai</label><input type="text" id="summary_end_date" disabled></div>
                        <div class="form-group"><label>Durasi Rental</label><input type="text" id="summary_duration" disabled></div>
                        <div class="form-group"><label>Metode Pickup</label><input type="text" id="summary_pickup_method" disabled></div>
                        <div class="form-group"><label>Alamat Rumah</label><input type="text" id="summary_address" disabled></div>
                        <div class="form-group"><label>Gunakan Driver?</label><input type="text" id="summary_driver" disabled></div>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: RINGKASAN BIAYA --}}
            <div class="cost-summary-section">
                <div class="cost-summary-card">
                    <div class="cost-item">
                        <span>Biaya Mobil</span>
                        <strong id="summary-biaya-mobil">Rp0</strong>
                    </div>
                    <div class="cost-item">
                        <span>Biaya Driver</span>
                        <strong id="summary-biaya-driver">Rp0</strong>
                    </div>
                    <hr class="payment-divider">
                    <div class="cost-item total">
                        <span>Total</span>
                        <strong id="summary-total">Rp0</strong>
                    </div>
                    <button type="submit" class="btn-submit-rental">Sewa Sekarang</button>
                    <a href="https://wa.me/6281355811336?text={{ urlencode('Halo, saya ingin bertanya lebih lanjut mengenai penyewaan mobil ' . $mobil->merek->nama_merek . ' ' . $mobil->nama_mobil . ' (ID Mobil: ' . $mobil->id . '). Harga sewa per hari: Rp' . number_format($mobil->harga_sewa, 0, ',', '.') . ', Biaya driver per hari: Rp150.000.') }}" 
                       target="_blank" 
                       class="btn btn-outline" 
                       style="margin-top: 10px; width: 100%;">Tanyakan Lebih Lanjut</a>
                    <p class="terms">Dengan menekan “Sewa Sekarang”, Anda menyetujui syarat & ketentuan sewa yang berlaku.</p>
                </div>
            </div>

        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- DATA DARI SERVER ---
        const hargaSewaHarian = JSON.parse('{{ $mobil->harga_sewa }}');
        const biayaDriverHarian = 150000;

        // --- ELEMEN-ELEMEN ---
        const checkBtn = document.getElementById('check-availability-btn');
        const summarySection = document.querySelector('.rental-summary-section');
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');
        const pickupMethodInput = document.getElementById('pickup_method');
        const addressInput = document.getElementById('pickup_address');
        const driverInput = document.getElementById('use_driver');
        const messageDiv = document.getElementById('availability-message');
        const submitBtn = document.querySelector('.btn-submit-rental');
        const form = document.getElementById('booking-form');

        // --- ELEMEN RINGKASAN SEWA ---
        const summaryStartDate = document.getElementById('summary_start_date');
        const summaryEndDate = document.getElementById('summary_end_date');
        const summaryDuration = document.getElementById('summary_duration');
        const summaryPickupMethod = document.getElementById('summary_pickup_method');
        const summaryAddress = document.getElementById('summary_address');
        const summaryDriver = document.getElementById('summary_driver');
        
        // --- ELEMEN RINGKASAN BIAYA ---
        const summaryBiayaMobil = document.getElementById('summary-biaya-mobil');
        const summaryBiayaDriver = document.getElementById('summary-biaya-driver');
        const summaryTotal = document.getElementById('summary-total');

        // Nonaktifkan tombol sewa di awal
        if(submitBtn) submitBtn.disabled = true;

        // Fungsi format Rupiah
        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka);
        }
        
        // Event listener utama pada tombol "Cek Ketersediaan"
        checkBtn.addEventListener('click', function() {
            const startDate = startDateInput.value;
            const endDate = endDateInput.value;
            const url = this.dataset.url;
            const csrfToken = form.querySelector('input[name="_token"]').value;

            if (!startDate || !endDate) {
                alert('Silakan pilih tanggal mulai dan tanggal selesai terlebih dahulu.');
                return;
            }

            messageDiv.innerText = 'Mengecek...';
            messageDiv.className = 'availability-message checking';

            // Kirim permintaan AJAX untuk cek ketersediaan
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ start_date: startDate, end_date: endDate })
            })
            .then(response => response.json())
            .then(data => {
                messageDiv.innerText = data.pesan;
                if (data.tersedia) {
                    messageDiv.className = 'availability-message available';
                    if(submitBtn) submitBtn.disabled = false; // Aktifkan tombol sewa
                } else {
                    messageDiv.className = 'availability-message unavailable';
                    if(submitBtn) submitBtn.disabled = true; // Tetap nonaktif
                }
            })
            .catch(error => {
                messageDiv.innerText = 'Terjadi kesalahan. Silakan coba lagi.';
                messageDiv.className = 'availability-message unavailable';
            });

            // --- Update Ringkasan (tetap dijalankan) ---
            summaryStartDate.value = startDate || '-';
            summaryEndDate.value = endDate || '-';
            summaryPickupMethod.value = pickupMethodInput.value || '-';
            summaryAddress.value = addressInput.value || '-';
            summaryDriver.value = driverInput.value || '-';

            // Kalkulasi Biaya
            let durasiHari = 0;
            if (startDate && endDate) {
                const start = new Date(startDate);
                const end = new Date(endDate);
                if (end > start) {
                    durasiHari = Math.ceil(Math.abs(end - start) / (1000 * 60 * 60 * 24)) +1;
                }
            }
            summaryDuration.value = durasiHari > 0 ? durasiHari + ' Hari' : '-';

            const biayaMobilTotal = hargaSewaHarian * durasiHari;
            const pakaiDriver = driverInput.value === 'Ya';
            const biayaDriverTotal = pakaiDriver ? (biayaDriverHarian * durasiHari) : 0;
            const totalBiaya = biayaMobilTotal + biayaDriverTotal;

            // Update Tampilan Ringkasan Biaya
            summaryBiayaMobil.innerText = formatRupiah(biayaMobilTotal);
            summaryBiayaDriver.innerText = formatRupiah(biayaDriverTotal);
            summaryTotal.innerText = formatRupiah(totalBiaya);

            // Tampilkan bagian ringkasan sewa
            summarySection.classList.add('show');
        });
    });
</script>
@endpush