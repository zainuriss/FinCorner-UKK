<x-guest-layout>
    <form id="registerForm" method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" placeholder="Name"
                :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-text-input id="telepon" class="block mt-1 w-full" type="number" name="telepon"
                placeholder="Phone number" :value="old('telepon')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('telepon')" class="mt-2" />
        </div>

        <div class="">
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" placeholder="Email"
                :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="">
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                placeholder="Password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="">
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div x-data="{ showPopup: false }">
            <button type="submit" @click.prevent="showPopup = true; setTimeout(() => document.getElementById('registerForm').submit(), 3000)"
                class="w-full text-center p-3 mt-4 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                Register
            </button>
        
            <!-- Pop-up Registrasi Sukses -->
            <div x-show="showPopup" x-transition.opacity x-cloak class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full text-center">
                    <h2 class="text-lg font-bold text-gray-800">Registrasi Berhasil!</h2>
                    <p class="text-gray-600 mt-2">Akun kamu sudah terdaftar. Silakan login untuk melanjutkan.</p>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-center mt-4 text-white text-xs sm:text-sm">
            <p class="">Already registered?
                <a class="font-bold text-indigo-600" href="{{ route('login') }}">
                    {{ __('Login') }}
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
