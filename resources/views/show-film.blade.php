<x-app-layout>
    <div class="bg-neutral-900 text-white min-h-screen flex justify-center items-center p-4">
        <div class="flex flex-col md:flex-row gap-4 p-4 w-full justify-center">
            <div class="h-full md:h-96 w-full md:w-64">
                <img src="{{  $showFilm->poster }}" alt="{{ $showFilm->title }}" class="bg-clip-content rounded-lg w-full"> 
            </div>

            <div class="w-full md:w-2/3">
                @auth
                    <a href="{{ route('films.edit', $showFilm->id ) }}"><i class="fa-solid fa-pencil flex place-items-end justify-end"></i></a>
                @endauth
                <h1 class="text-2xl md:text-4xl font-bold ">{{ $showFilm->title }}</h1>
                <div class="flex items-center text-gray-400 mt-1 divide-x divide-neutral-500">
                    <span class="text-center px-2">{{ $showFilm->release_year }}</span>
                    <span class="text-center px-2">{{ $showFilm->duration }}</span>
                    <div class="px-2">
                        @foreach ($showGenreFilm as $shGenreFilm)
                            @if ($shGenreFilm->genre)
                                <span>{{ $shGenreFilm->genre->title }}{{ $loop->last ? '' : ',' }}</span>
                            @endif
                        @endforeach
                    </div>
                </div>
                <p class="text-gray-300 mt-4">
                    {{ $showFilm->description }}
                </p>
                <div class="mt-4 flex flex-row items-center gap-4">
                    <div class="">
                        <p class="font-semibold">Produsen:</p>
                        <p class="text-gray-300">{{ $showFilm->creator }}</p>
                    </div>
                    <div>
                        <p class="font-semibold">Pemain:</p>
                        <p class="text-gray-300">Arif Brata, Arie Kriting, Alisa Safitri, Bryant Onardo</p>
                    </div>
                </div>

                {{-- @auth
                    <div class="mt-4 flex flex-row items-center gap-4">
                        <label for="rating" class="text-xl font-bold">Rate this movie</label>
                        <div id="rating-stars" class="flex space-x-2 mt-2">
                            <span class="star text-2xl cursor-pointer text-gray-400" data-value="1"><i class="fa-solid fa-star"></i></span>
                            <span class="star text-2xl cursor-pointer text-gray-400" data-value="2"><i class="fa-solid fa-star"></i></span>
                            <span class="star text-2xl cursor-pointer text-gray-400" data-value="3"><i class="fa-solid fa-star"></i></span>
                            <span class="star text-2xl cursor-pointer text-gray-400" data-value="4"><i class="fa-solid fa-star"></i></span>
                            <span class="star text-2xl cursor-pointer text-gray-400" data-value="5"><i class="fa-solid fa-star"></i></span>
                        </div>
                        <input type="hidden" name="rating" id="rating" value="{{ old('rating') }}" required>
                        <x-input-error :messages="$errors->get('rating')" class="mt-2" />
                    </div>
                @else
                    <div class="mt-6 flex flex-wrap gap-4">
                        <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md font-bold flex items-center">
                            <span class="text-lg">▶</span> Putar
                        </button>
                        <button class="bg-gray-800 hover:bg-gray-700 px-4 py-2 rounded-md">My List</button>
                        <button class="bg-gray-800 hover:bg-gray-700 px-4 py-2 rounded-md">Rate</button>
                        <button class="bg-gray-800 hover:bg-gray-700 px-4 py-2 rounded-md">Share</button>
                    </div>
                @endauth --}}


            </div>
        </div>
    </div>
    <div class="bg-neutral-900 text-white min-h-screen flex justify-center items-center p-4">
        <div class="flex flex-col md:flex-row gap-4 p-4 w-full bg-neutral-800 rounded-lg">
            <div class="h-full w-full ">
                <h1 class="text-4xl font-bold mb-4">Trailer</h1>
                {{-- <video src="{{ $showFilm->trailer }}" class="rounded-lg w-full" controls></video> --}}
                <iframe class="w-full h-full" src="{{ str_replace('watch?v=', 'embed/', $showFilm->trailer) }}" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</x-app-layout>
