<x-app-layout>
    {{-- @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
            <span class="block sm:inline">
                <h1 class="mt-3 text-red-600">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </h1>
            </span>
        </div>
    @endif --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10">
            <div class="bg-white dark:bg-neutral-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 overflow-x-scroll">
                    <form method="POST" action="{{ route('author.add-genres.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-4">
                            <x-input-label for="film_id" :value="__('Film')" />
                            <select id="film_id" name="film_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option hidden value="">{{ __('Pilih Film') }}</option>
                                @foreach ($film as $f)
                                    <option value="{{ $f->id }}">{{ $f->id }} - {{ $f->title }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('film_id')" class="mt-2" />
                        </div>

                        <div class="mt-4 grid grid-cols-5 gap-4">
                            @foreach ($genre as $gen)
                                <div class="flex items-center mt-2">
                                    <input id="genre_{{ $gen->id }}" type="checkbox" name="genre_id[]" value="{{ $gen->id }}" class="form-checkbox h-5 w-5 text-indigo-600 transition duration-150 ease-in-out rounded border-gray-300 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                                    <label for="genre_{{ $gen->id }}" class="ml-2 block text-sm leading-5 text-gray-900 dark:text-gray-300">
                                        {{ $gen->title }}
                                    </label>
                                </div>
                            @endforeach
                            <x-input-error :messages="$errors->get('genre_id')" class="mt-2 col-span-5" />
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

