<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        @if ($errors->any())
            <div class="mb-4 px-4 py-2 w-full bg-red-500 text-white rounded text-center">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div>
            <x-text-input id="email" placeholder="Email" class="block mt-1 w-full" type="email" name="email"
                :value="old('email')" required autofocus autocomplete="off" />
        </div>

        <div class="mt-4">
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                placeholder="Password" required autocomplete="current-password" />

        </div>

        <div class="flex items-center justify-between mt-2">
            <div class="flex items-center">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded dark:bg-neutral-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                        name="remember">
                    <span
                        class="ms-2 sm:text-sm text-xs text-gray-600 dark:text-neutral-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            @if (Route::has('password.request'))
                <a class="underline sm:text-sm text-xs text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <button type="submit"
            class="w-full text-center p-3 mt-4 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
            Log in
        </button>

        @if (Route::has('register'))
            <div class="text-white text-xs sm:text-sm mt-4 flex justify-center flex-row">
                <h5>
                    Don't have an account?
                </h5>
                <a href="{{ route('register') }}" class="text-indigo-600 font-bold ms-1">
                    Register
                </a>
            </div>
        @endif
    </form>
</x-guest-layout>
