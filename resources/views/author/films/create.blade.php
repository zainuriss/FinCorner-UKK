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
                    <form method="POST" action="{{ route('author.films.store') }}" enctype="multipart/form-data">
                        @csrf
                
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" class="block mt-1 w-full " type="text" name="title" :value="old('title')" required autofocus autocomplete="title" />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                    
                            <div class="">
                                <x-input-label for="creator_id" :value="__('Creator')" />
                                <select id="creator_id" class="block mt-1 w-full" name="creator_id">
                                    <option hidden value="{{ $creators->id }}" {{ old('creator_id') == $creators->id ? 'selected' : '' }}>
                                        {{ $creators->name }}
                                    </option>
                                </select>
                                <x-input-error :messages="$errors->get('creator_id')" class="mt-2" />
                            </div>

                            <div class="">
                                <x-input-label for="release_year" :value="__('Release Year')" />
                                <x-text-input id="release_year" class="block mt-1 w-full" type="number" name="release_year" :value="old('release_year')" required autocomplete="release_year" />
                                <x-input-error :messages="$errors->get('release_year')" class="mt-2" />
                                </div>
    
                            <div class="">
                                <x-input-label for="duration" :value="__('Duration (in minutes)')" />
                                <x-text-input id="duration" class="block mt-1 w-full" type="number" name="duration" :value="old('duration')" required autocomplete="duration" />
                                <x-input-error :messages="$errors->get('duration')" class="mt-2" />
                            </div>
                        </div>

                                
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" name="description" required autocomplete="description">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="mt-4 flex flex-row gap-4">
                            <div class="w-1/2">
                                <x-input-label for="poster" :value="__('Poster')" />
                                <x-text-input id="poster" class="block mt-1 w-full py-1.5" type="file" name="poster" :value="old('poster')" />
                                <x-input-error :messages="$errors->get('poster')" class="mt-2" />
                            </div>
                            <div class="flex items-center justify-center mt-4">
                                <span class="text-gray-500 text-2xl">OR</span>
                            </div>
                            <div class="w-1/2">
                                <x-input-label for="poster_url" :value="__('Poster URL')" />
                                <x-text-input id="poster_url" class="block mt-1 w-full" type="text" name="poster_url" :value="old('poster_url')" autocomplete="poster_url" />
                                <x-input-error :messages="$errors->get('poster_url')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mt-4 flex flex-row gap-4">
                            <div class="w-1/2">
                                <x-input-label for="trailer" :value="__('Trailer')" />
                                <x-text-input id="trailer" class="block mt-1 w-full py-1.5" type="file" name="trailer" :value="old('trailer')" />
                                <x-input-error :messages="$errors->get('trailer')" class="mt-2" />
                            </div>
                            <div class="flex items-center justify-center mt-4">
                                <span class="text-gray-500 text-2xl">OR</span>
                            </div>
                            <div class="w-1/2">
                                <x-input-label for="trailer_url" :value="__('Trailer URL')" />
                                <x-text-input id="trailer_url" class="block mt-1 w-full" type="text" name="trailer_url" :value="old('trailer_url')" autocomplete="trailer_url" />
                                <x-input-error :messages="$errors->get('trailer_url')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="age_rating" :value="__('Age Rating')" />
                            <div id="age-rating" class="flex space-x-2 mt-2">
                                <select id="age_rating"
                                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    name="age_rating" required>
                                    <option value="G">G</option>
                                    <option value="PG">PG</option>
                                    <option value="PG-13">PG-13</option>
                                    <option value="R">R</option>
                                    <option value="NC-17">NC-17</option>
                                </select>
                            </div>
                            <x-input-error :messages="$errors->get('age_rating')" class="mt-2" />
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
