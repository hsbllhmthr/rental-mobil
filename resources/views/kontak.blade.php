@extends('layouts.app')

@section('title', 'Hubungi Kami')

@section('content')
<div class="page-container static-page-container">
    <nav class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <span>Kontak</span>
    </nav>

    <div class="page-header">
        <h1 class="page-title">Hubungi Kami</h1>
    </div>

    {{-- Layout untuk Info Kontak dan Peta --}}
    <div class="contact-bottom-layout">
        {{-- Kolom Kiri: Info Kontak --}}
        <div class="contact-info-section">
            <div class="contact-item">
                <i class="fa-solid fa-phone"></i>
                <div>
                    <strong>Telepon</strong>
                    <span>0813-5581-1336</span>
                </div>
            </div>
            <div class="contact-item">
                <i class="fa-solid fa-envelope"></i>
                <div>
                    <strong>Alamat Email</strong>
                    <span>trimanunggala@gmail.com</span>
                </div>
            </div>
            <div class="contact-item">
                <i class="fa-solid fa-map-marker-alt"></i>
                <div>
                    <strong>Alamat</strong>
                    <span>Tamalanrea, Kota Makassar, Sulawesi Selatan, 90245</span>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Peta --}}
        <div class="map-section">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.826213228607!2d119.50075000000001!3d-5.131674299999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbefcae4eb45b27%3A0xbd4f5ee11913d683!2sRental%20Mobil%20Makassar%20(Tri%20Manunggal%20Rent%20Car)!5e0!3m2!1sid!2sid!4v1757249707532!5m2!1sid!2sid" 
                width="500%" 
                height="300" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        </div>
    </div>
</div>
@endsection