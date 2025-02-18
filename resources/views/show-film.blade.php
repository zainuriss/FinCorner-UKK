<x-app-layout>
    <div class="bg-neutral-900 text-white min-h-screen flex justify-center items-center p-4">
        <div class="flex flex-col md:flex-row gap-4 p-4 w-full justify-center">

            <div class="h-full md:h-96 w-full md:w-64">
                <img src="{{  $showFilm->poster }}" alt="{{ $showFilm->title }}" class="rounded-lg w-full h-full"> 
            </div>

            <div class="w-full md:w-2/3">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl md:text-4xl font-bold ">{{ $showFilm->title }}</h1>
                    @auth
                        @if (Auth::user()->role == 'admin')
                            <a href="{{ route('films.edit', $showFilm->id ) }}"><i class="fa-solid fa-pencil"></i></a>
                        @elseif (Auth::user()->role == 'author')
                            <a href="{{ route('films.edit', $showFilm->id ) }}"><i class="fa-solid fa-pencil"></i></a>
                        @else
                            <!-- No content to display -->
                        @endif
                    @endauth
                </div>
                <div class="flex items-center text-gray-400 mt-1 divide-x divide-neutral-500">
                    <span class="text-center px-2">{{ $showFilm->release_year }}</span>
                    <span class="text-center px-2">{{ $showFilm->duration }}</span>
                    <div class="px-2">
                        @foreach ($showGenreFilm as $shGenreFilm)
                            @if ($shGenreFilm->genres)
                                <span>{{ $shGenreFilm->genres->title }}{{ $loop->last ? '' : ',' }}</span>
                            @endif
                        @endforeach
                    </div>
                </div>
                <p class="text-gray-300 mt-4">
                    {{ $showFilm->description }}
                </p>
                <div class="mt-4 flex flex-row items-center gap-4">
                    <div class="">
                        <p class="font-semibold">Director:</p>
                        <p class="text-gray-300">{{ $showFilm->creator->name }}</p>
                    </div>
                    <div>
                        <p class="font-semibold">Castings:</p>
                        @if ($showFilm->casting->isNotEmpty())
                            @foreach ($showFilm->casting as $casting)
                                <p class="text-gray-300">{{ $casting->real_name }}{{ $loop->last ? '' : ',' }}</p>
                            @endforeach
                        @else
                            <p class="text-gray-300">will edited soon...</p>
                        @endif
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
    <div class="flex justify-center items-end text-base md:text-xl ">
        @include('layouts.breadcrumb')
    </div>
    <div class="bg-neutral-900 text-white min-h-screen flex justify-center items-center p-4">
        <div class="flex flex-col md:flex-row gap-4 p-4 w-full bg-neutral-800 rounded-lg">
            <div class="h-full w-full ">
                <h1 class="text-4xl font-bold mb-4">Trailer</h1>
                <iframe class="w-full h-screen" src="{{ str_replace('watch?v=', 'embed/', $showFilm->trailer) }}" frameborder="0"></iframe>
            </div>
        </div>
    </div>

    <div class="bg-neutral-900 text-white min-h-screen flex flex-col justify-center items-center p-4">
        <div class="w-full bg-neutral-800 p-4 rounded-lg">
            <h1 for="comment" class="text-4xl font-bold mb-4">Comments ({{ $commentView->count() }})</h1>
            <form action="{{ route('comments.store') }}" method="POST" class="">
                @csrf
                <input type="hidden" name="film_id" value="{{ $showFilm->id }}">
                <div class="flex flex-row gap-4 p-4">
                    <x-text-input name="comment" id="comment" class="bg-neutral-800 text-white p-2 rounded resize-none w-full mx-auto" required></x-text-input>
                    <x-input-error :messages="$errors->get('comment')" class="mt-2" />
                </div>
                <div class="mb-4 flex flex-row justify-between items-center w-full">
                    <div id="rating-stars" class="flex space-x-2 mt-2">
                        <span class="star text-5xl cursor-pointer text-gray-500" data-value="1"><i class="fa-solid fa-star"></i></span>
                        <span class="star text-5xl cursor-pointer text-gray-500" data-value="2"><i class="fa-solid fa-star"></i></span>
                        <span class="star text-5xl cursor-pointer text-gray-500" data-value="3"><i class="fa-solid fa-star"></i></span>
                        <span class="star text-5xl cursor-pointer text-gray-500" data-value="4"><i class="fa-solid fa-star"></i></span>
                        <span class="star text-5xl cursor-pointer text-gray-500" data-value="5"><i class="fa-solid fa-star"></i></span>
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md font-bold">Submit</button>
                    <input type="hidden" name="rating" id="rating" value="{{ old('rating') }}" required>
                    <x-input-error :messages="$errors->get('rating')" class="mt-2" />
                </div>
            </form>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 bg-neutral-800 p-4 mt-4  w-full rounded-lg">
            @if ( $commentView->count() > 0 )
                @foreach ( $commentView as $cv )
                    <div class="bg-neutral-700 p-4 rounded-lg h-full">
                        <div class="flex flex-row items-center justify-between">
                            <div class="flex flex-row items-center gap-2">
                                <h2 class="text-xl text-white font-bold mb-2">{{ $cv->user->name }}</h2>
                                @if (auth()->user()->role == 'admin')
                                    <i class="fas fa-circle text-[0.5rem] text-red-500"></i>
                                @elseif (auth()->user()->role == 'author')
                                    <i class="fas fa-circle text-[0.5rem] text-green-500"></i>
                                @else
                                    <i class="fas fa-circle text-[0.5rem] text-blue-500"></i>
                                @endif
                            </div>
                            <p class="text-gray-200 text-xs">{{ $cv->created_at->diffForHumans() }}</p>                    
                        </div>
                        <div class="flex space-x-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="text-sm {{ $cv->rating >= $i ? 'text-blue-500' : 'text-gray-500' }}"><i class="fa-solid fa-star"></i></span>
                            @endfor
                        </div>
                        <div class="relative">
                            <input type="checkbox" id="toggle-{{ $cv->id }}-comment" class="hidden peer">
                            <div class="max-h-24 overflow-hidden transition-all duration-300 peer-checked:max-h-screen">
                                <p class="text-gray-300 mt-1 text-lg">
                                    {{ $cv->comment }}
                                </p>
                            </div>
                        
                            @if(strlen($cv->comment) > 200) 
                                <label for="toggle-{{ $cv->id }}-comment" class="text-blue-400 hover:text-blue-500 text-sm cursor-pointer mt-2 block">
                                    Read more
                                </label>
                            @endif
                        </div>                
                    </div>
                @endforeach
            @else
                <p class="text-white text-md col-span-3 flex items-center justify-center">No comments available.</p>
            @endif
        </div>
    </div>

</x-app-layout>
