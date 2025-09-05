@extends('layouts.app')

@section('title', 'Formulir Pemesanan')

@section('content')
<div class="booking-page-container">
    <nav class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <span>Formulir Pemesanan</span>
    </nav>

    {{-- Form sekarang membungkus kedua kolom agar tombol submit berfungsi --}}
    <form action="{{ route('rental.store', $mobil->id) }}" method="POST">
        @csrf
        <div class="booking-layout">
            
            {{-- KOLOM KIRI: FORMULIR PEMESANAN --}}
            <div class="booking-form-section">
                <div class="form-header">
                    <h2>Masukkan Informasi Pemesanan Rental Mobil</h2>
                </div>
                
                <div id="booking-form"> {{-- Beri ID agar bisa diakses JS --}}
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="start_date">Tanggal Mulai</label>
                            <input type="date" id="start_date" name="start_date" required>
                            <small>Pilih tanggal mulai sewa (Minimal H-1).</small>
                        </div>
                        <div class="form-group">
                            <label for="end_date">Tanggal Selesai</label>
                            <input type="date" id="end_date" name="end_date" required>
                            <small>Pilih tanggal selesai sewa.</small>
                        </div>
                        <div class="form-group">
                            <label for="pickup_method">Metode Pickup</label>
                            <select id="pickup_method" name="pickup_method" required>
                                <option value="Ambil di Kantor">Ambil di Kantor</option>
                                <option value="Diantar ke Alamat">Diantar ke Alamat</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pickup_address">Alamat Antar/Jemput</label>
                            <input type="text" id="pickup_address" name="pickup_address" value="{{ Auth::user()->alamat }}" placeholder="Isi jika memilih diantar">
                            <small>Isi alamat lengkap untuk pengantaran/penjemputan.</small>
                        </div>
                        <div class="form-group">
                            <label for="use_driver">Gunakan Driver?</label>
                            <select id="use_driver" name="use_driver" required>
                                <option value="Tidak">Tidak</option>
                                <option value="Ya">Ya (Biaya tambahan berlaku)</option>
                            </select>
                        </div>
                    </div>

                    <button type="button" class="btn btn-outline" id="check-availability-btn">Cek Ketersediaan  </button>

                    {{-- Bagian Ringkasan Sewa --}}
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
            </div>

            {{-- KOLOM KANAN: RINGKASAN BIAYA --}}
            {{-- KOLOM KANAN: RINGKASAN BIAYA --}}
<div class="cost-summary-section">
    <div class="cost-summary-card">
        <div class="cost-item">
            <span>Biaya Mobil</span>
            <strong id="summary-biaya-mobil">Rp{{ number_format($mobil->harga_sewa, 0, ',', '.') }}</strong>
        </div>
        <div class="cost-item">
            <span>Biaya Driver</span>
            <strong id="summary-biaya-driver">-</strong>
        </div>
        <hr>
        <div class="cost-item total">
            <span>Total</span>
            <strong id="summary-total">-</strong>
        </div>
        <button type="submit" class="btn-submit-rental">Sewa Sekarang</button>
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

        // --- ELEMEN FORM UTAMA (VARIABEL YANG HILANG DITAMBAHKAN KEMBALI) ---
        const checkBtn = document.getElementById('check-availability-btn');
        const summarySection = document.querySelector('.rental-summary-section');
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');
        const pickupMethodInput = document.getElementById('pickup_method'); // Ditambahkan kembali
        const addressInput = document.getElementById('pickup_address'); // Ditambahkan kembali
        const driverInput = document.getElementById('use_driver');

        // --- ELEMEN RINGKASAN SEWA (VARIABEL YANG HILANG DITAMBAHKAN KEMBALI) ---
        const summaryStartDate = document.getElementById('summary_start_date');
        const summaryEndDate = document.getElementById('summary_end_date');
        const summaryDuration = document.getElementById('summary_duration');
        const summaryPickupMethod = document.getElementById('summary_pickup_method'); // Ditambahkan kembali
        const summaryAddress = document.getElementById('summary_address'); // Ditambahkan kembali
        const summaryDriver = document.getElementById('summary_driver'); // Ditambahkan kembali
        
        // --- ELEMEN RINGKASAN BIAYA ---
        const summaryBiayaMobil = document.getElementById('summary-biaya-mobil');
        const summaryBiayaDriver = document.getElementById('summary-biaya-driver');
        const summaryTotal = document.getElementById('summary-total');

        // Fungsi untuk format angka ke Rupiah
        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(angka);
        }

        // Event listener pada tombol "Cek Ketersediaan"
        checkBtn.addEventListener('click', function() {
            // --- Update Ringkasan Sewa (BARIS YANG HILANG DITAMBAHKAN KEMBALI) ---
            summaryStartDate.value = startDateInput.value || '-';
            summaryEndDate.value = endDateInput.value || '-';
            summaryPickupMethod.value = pickupMethodInput.value || '-'; // Ditambahkan kembali
            summaryAddress.value = addressInput.value || '-'; // Ditambahkan kembali
            summaryDriver.value = driverInput.value || '-'; // Ditambahkan kembali

            // --- Kalkulasi Biaya ---
            let durasiHari = 0;
            if (startDateInput.value && endDateInput.value) {
                const start = new Date(startDateInput.value);
                const end = new Date(endDateInput.value);
                if (end > start) {
                    const diffTime = Math.abs(end - start);
                    durasiHari = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                }
            }
            summaryDuration.value = durasiHari > 0 ? durasiHari + ' Hari' : '-';

            const biayaMobilTotal = hargaSewaHarian * durasiHari;
            const pakaiDriver = driverInput.value === 'Ya';
            const biayaDriverTotal = pakaiDriver ? (biayaDriverHarian * durasiHari) : 0;
            const totalBiaya = biayaMobilTotal + biayaDriverTotal;

            // --- Update Tampilan Ringkasan Biaya ---
            summaryBiayaMobil.innerText = formatRupiah(biayaMobilTotal);
            summaryBiayaDriver.innerText = formatRupiah(biayaDriverTotal);
            summaryTotal.innerText = formatRupiah(totalBiaya);

            // Tampilkan bagian ringkasan sewa
            summarySection.classList.add('show');
        });
    });
</script>
@endpush