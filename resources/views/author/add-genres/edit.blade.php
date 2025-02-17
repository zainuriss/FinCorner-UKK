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
                    <form method="POST" action="{{ route('author.add-genres.update', $data->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')                        
                        <div class="mt-4">
                            <x-input-label for="film_id" :value="__('Film')" />
                            <select id="film_id" name="film_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option hidden value="">{{ __('Pilih Film') }}</option>
                                @foreach ($films as $f)
                                    <option value="{{ $f->id }}" {{ old('film_id', $selectedFilm ?? '') == $f->id ? 'selected' : '' }}>
                                        {{ $f->id }} - {{ $f->title }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('film_id')" class="mt-2" />
                        </div>

                        <div class="mt-4 grid grid-cols-5 gap-4">                        
                            @foreach ($genres as $genre)
                                <div class="flex items-center mt-2">
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox" name="genres[]" value="{{ $genre->id }}"
                                            class="rounded border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600"
                                            {{ in_array($genre->id, $selectedGenres ?? []) ? 'checked' : '' }}>
                                        <span class="text-sm text-gray-700 dark:text-gray-300">{{ $genre->title }}</span>
                                    </label>
                                </div>
                            @endforeach
                        
                            <x-input-error :messages="$errors->get('genres')" class="mt-2" />
                        </div>
                        

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('author.add-genres.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Back') }}
                            </a>
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
