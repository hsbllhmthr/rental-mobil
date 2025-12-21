@extends('layouts.app')

@section('title', 'Status Pembayaran')

@section('content')

@if(session('success'))
    <div class="alert alert-success" style="margin: 20px 125px;">
        {{ session('success') }}
    </div>
@endif

<div class="payment-page-container">

    {{-- TAMPILAN JIKA MASIH MENUNGGU PEMBAYARAN --}}
    @if ($rental->status == 'menunggu_pembayaran')
        <div class="payment-card">
            <div class="payment-header">
                <h2>Menunggu pembayaran dalam</h2>
                <div id="countdown-timer" class="countdown-timer">--:--:--</div>
                <p class="payment-deadline">
                    Batas Akhir Pembayaran<br>
                    <strong>{{ $rental->payment_deadline->format('l, d F Y H:i') }} WITA</strong>
                </p>
            </div>

            <div class="payment-details-box">
                <div class="detail-row">
                    <div>
                        <label>Nomor Rekening BNI</label>
                        <strong id="rekening-number">0296833658</strong>
                        <span>a/n Aris Y Mangopo</span>
                    </div>
                    <button class="btn-copy" data-clipboard-target="#rekening-number">Salin</button>
                </div>
                <div class="detail-row">
                    <div>
                        <label>Total Tagihan</label>
                        <strong id="total-tagihan">Rp{{ number_format($rental->total_biaya, 0, ',', '.') }}</strong>
                    </div>
                    <button class="btn-copy" data-clipboard-target="#total-tagihan">Salin</button>
                </div>

                <hr class="payment-divider">

                <div class="payment-info">
                    <h4>Penting!</h4>
                    <ul>
                        
                        <li>Pesanan diverifikasi setiap hari hingga pukul 22.00 WITA, kecuali hari.</li>
                        <li>Bayar sebelum batas pembayaran habis, kalau lewat pesanan akan dibatalkan</li>
                    </ul>
                </div>
            </div>
            
            <div class="payment-actions">
                <a href="#" class="btn btn-primary" 
                   data-modal-target="#upload-proof-modal"
                   data-action="{{ route('rental.upload_proof', $rental->id) }}">
                   Unggah Pembayaran
                </a>
            </div>
        </div>

    {{-- TAMPILAN JIKA SUDAH UPLOAD BUKTI (MENUNGGU KONFIRMASI) --}}
    @elseif ($rental->status == 'menunggu_konfirmasi')
        <div class="payment-thankyou-card">
            <div class="modal-icon success">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <h2>Terima Kasih!</h2>
            <p>Bukti pembayaran Anda telah kami terima. Admin akan segera melakukan verifikasi pesanan Anda.</p>
            <div class="thankyou-info">
                <strong>Kode Sewa Anda:</strong>
                <span>TRX{{ str_pad($rental->id, 5, '0', STR_PAD_LEFT) }}</span>
            </div>
            <a href="{{ route('home') }}" class="btn btn-secondary" style="margin-top: 20px;">Kembali ke Beranda</a>
        </div>
    @endif

</div>
@endsection

@push('scripts')
{{-- Hanya jalankan script jika statusnya masih menunggu pembayaran --}}
@if ($rental->status == 'menunggu_pembayaran')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.11/clipboard.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // --- Fungsionalitas Countdown Timer ---
            const timerElement = document.getElementById('countdown-timer');
            if (timerElement) {
                const paymentDeadline = new Date('{{ $rental->payment_deadline }}').getTime();
                const timerInterval = setInterval(() => {
                    const now = new Date().getTime();
                    const timeLeft = paymentDeadline - now;
                    if (timeLeft <= 0) {
                        clearInterval(timerInterval);
                        timerElement.textContent = "Waktu Habis";
                        return;
                    }
                    const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
                    timerElement.textContent = 
                        String(hours).padStart(2, '0') + ':' + 
                        String(minutes).padStart(2, '0') + ':' + 
                        String(seconds).padStart(2, '0');
                }, 1000);
            }
            // --- Fungsionalitas Tombol Salin ---
            const clipboard = new ClipboardJS('.btn-copy');
            clipboard.on('success', function(e) {
                const originalText = e.trigger.innerText;
                e.trigger.innerText = 'Tersalin!';
                e.clearSelection();
                setTimeout(() => { e.trigger.innerText = originalText; }, 2000);
            });
        });
    </script>
@endif
@endpush