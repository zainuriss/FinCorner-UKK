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
                    <form method="POST" action="{{ route('admin.casting_relations.store') }}" enctype="multipart/form-data">
                        @csrf
                
                        <div>
                            <x-input-label for="casting_id" :value="__('Casting Name')" />
                            <select id="casting_id" name="casting_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option hidden value="">{{ __('Pilih Casting') }}</option>
                                @foreach ($dataCast as $dc)
                                    <option value="{{ $dc->id }}">{{ $dc->real_name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('casting_id')" class="mt-2" />
                        </div>
                            
                        <div class="mt-4">
                            <x-input-label for="film_id" :value="__('Film')" />
                            <select id="film_id" name="film_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option hidden value="">{{ __('Pilih Film') }}</option>
                                @foreach ($dataFilm as $df)
                                    <option value="{{ $df->id }}">{{ $df->id }} - {{ $df->title }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('film_id')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="character_name" :value="__('Character Name')" />
                            <x-text-input id="character_name" class="block mt-1 w-full " type="text" name="character_name" value="" required autofocus autocomplete="character_name" />
                            <x-input-error :messages="$errors->get('character_name')" class="mt-2" />
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
