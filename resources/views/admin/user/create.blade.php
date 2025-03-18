<x-app-layout>
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
            <span class="block sm:inline">
                <h1 class="mt-3 text-red-600">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </h1>
            </span>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10">
            <div class="bg-white dark:bg-neutral-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 overflow-x-scroll">
                    <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" class="block mt-1 w-full " type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                
                            <div class="">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-full " type="email" name="email" :value="old('email')" required autofocus autocomplete="email" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div class="">
                                <x-input-label for="telepon" :value="__('Telepon')" />
                    
                                <x-text-input id="telepon" class="block mt-1 w-full"
                                                type="number"
                                                name="telepon"
                                                required autocomplete="telepon" />
                    
                                <x-input-error :messages="$errors->get('telepon')" class="mt-2" />
                            </div>
                            
                            <div class="">
                                <x-input-label for="password" :value="__('Password')" />
                    
                                <x-text-input id="password" class="block mt-1 w-full"
                                                type="password"
                                                name="password"
                                                required autocomplete="new-password" />
                    
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                    
                            <!-- Confirm Password -->
                            <div class="">
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    
                                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                                type="password"
                                                name="password_confirmation" required autocomplete="new-password" />
                    
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="role" :value="__('Role')" />
                            <select id="role" name="role" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option hidden value="">{{ __('Pilih Role') }}</option>
                                    <option value="admin">Admin</option>
                                    <option value="author">Author</option>
                                    <option value="subscriber">Susbscriber</option>
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </div>
                
                        <div class="flex items-center justify-end mt-4">                
                            <x-primary-button class="ms-4">
                                {{ __('Submit') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
