<div class="form-group form-group-full">
    <label>Aksesoris Kendaraan</label>
    <div class="checkbox-grid">
        @php
            $allAksesoris = [
                'USB Charging Port', 'Power Door Locks', 'AntiLock Braking System',
                'Brake Assist', 'Power Steering', 'Driver Airbag', 'Passenger Airbag',
                'Power Windows', 'Bluetooth', 'Central Locking', 'Crash Sensor', 'GPS', 'Parking Camera'
            ];
            // Cek aksesoris yang sudah ada jika ini adalah halaman edit
            $currentAksesoris = old('aksesoris', isset($mobil) ? ($mobil->aksesoris ?? []) : []);
        @endphp

        @foreach ($allAksesoris as $aksesoris)
            {{-- Label sekarang membungkus semua elemen untuk fungsionalitas klik yang lebih baik --}}
            <label class="checkbox-item"> {{ $aksesoris }}
                <input type="checkbox" 
                       name="aksesoris[]" 
                       value="{{ $aksesoris }}"
                       {{ in_array($aksesoris, $currentAksesoris) ? 'checked' : '' }}>
                <span class="checkmark"></span> {{-- Ini adalah elemen yang hilang --}}
            </label>
        @endforeach
    </div>
</div>