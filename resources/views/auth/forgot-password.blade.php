<x-guest-layout>


    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="Masukkan email Anda"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-primary-button class="w-full justify-center">
                {{ __('Reset') }}
            </x-primary-button>
        </div>
    </form>

    <div class="text-center mt-4">
        <a class="text-sm text-blue-600 hover:underline" href="{{ route('home') }}">
            Kembali untuk masuk
        </a>
    </div>
</x-guest-layout>
