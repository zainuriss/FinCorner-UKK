<x-app-layout>
    <div class="bg-neutral-900 text-white min-h-screen flex justify-center items-center p-4">
        @if ($errors->any())
            <div class="mt-4 px-4 py-2 bg-red-500 text-white rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="flex flex-col md:flex-row gap-4 p-4 w-full justify-center">

            <div class="flex place-self-center h-96 w-64">
                <img src="{{ $showFilm->poster }}" alt="{{ $showFilm->title }}" class="rounded-lg w-full h-full">
            </div>

            <div class="w-full md:w-2/3">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl md:text-4xl font-bold ">{{ $showFilm->title }}</h1>
                    @auth
                        @if (in_array(Auth::user()->role, ['admin', 'author']))
                            <a href="{{ route('films.edit', $showFilm->id) }}"><i class="fa-solid fa-pencil"></i></a>
                        @endif
                    @endauth
                </div>
                <div class="flex items-center text-gray-400 mt-1 divide-x divide-neutral-500">
                    <span class="text-center px-2">{{ $showFilm->release_year }}</span>
                    <span class="text-center px-2">{{ $durationFormat }}</span>
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
                        <h1 class="text-gray-400 font-bold text-2xl">{{ $showFilm->age_rating }}</h1>
                    </div>
                    <div class="">
                        <p class="font-semibold">Director:</p>
                        <p class="text-gray-300">{{ $showFilm->creator->name }}</p>
                    </div>
                    <div>
                        <p class="font-semibold">Castings:</p>
                        <div class="flex flex-row">
                            @if ($showFilm->casting->isNotEmpty())
                                @foreach ($showFilm->casting as $casting)
                                    <p class="text-gray-300 me-2">
                                        {{ $casting->real_name }}{{ $loop->last ? '' : ',' }}</p>
                                @endforeach
                            @else
                                <p class="text-gray-300">will edited soon...</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="justify-self-start mt-4 flex flex-row items-center gap-2 divide-x-2 divide-neutral-500">
                    <div id="average-rating-stars" class="flex space-x-1">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($averageRating >= $i)
                                <span class="text-2xl text-blue-400">
                                    <i class="fa-solid fa-star"></i>
                                </span>
                            @elseif ($i - 0.5 <= $averageRating)
                                <span class="text-2xl text-blue-400">
                                    <i class="fa-solid fa-star-half-stroke"></i>
                                </span>
                            @else
                                <span class="text-2xl text-gray-400">
                                    <i class="fa-solid fa-star"></i>
                                </span>
                            @endif
                        @endfor
                    </div>
                    
                    <p class="text-gray-300 text-center ps-2">
                        @if ($totalRating > 0)
                            Based on {{ $totalRating }} ratings
                        @else
                            No ratings yet
                        @endif
                    </p>                    
                </div>
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
                <iframe class="w-full h-screen" src="{{ str_replace('watch?v=', 'embed/', $showFilm->trailer) }}"
                    frameborder="0"></iframe>
            </div>
        </div>
    </div>

    <div id="commentSection"
        class="bg-neutral-900 text-white min-h-screen flex flex-col justify-center items-center p-4">
        @if ($errors->has('comment'))
            <div class="mt-4 px-4 py-2 bg-red-500 text-white rounded">
                <ul>
                    @foreach ($errors->get('comment') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="w-full bg-neutral-800 p-4 rounded-lg shadow-lg">
            <h1 for="comment" class="text-4xl font-bold mb-4">Comments ({{ $commentView->count() }})</h1>
            @if (!$existingComment)
                <form action="{{ route('comments.store') }}" method="POST" class="flex flex-col space-y-4">
                    @csrf
                    <input type="hidden" name="film_id" value="{{ $showFilm->id }}">
                    <div class="flex flex-row gap-4">
                        <x-text-input autocomplete="off" name="comment" id="comment"
                            class="bg-neutral-800 text-white p-2 rounded resize-none w-full mx-auto focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required></x-text-input>
                        <x-input-error :messages="$errors->get('comment')" class="mt-2" />
                    </div>
                    <div class="mb-4 flex flex-row justify-between items-center w-full">
                        <div id="rating-stars" class="flex space-x-2 mt-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <span
                                    class="star text-5xl cursor-pointer text-gray-500 transform transition duration-500 ease-in-out hover:scale-110"
                                    data-value="{{ $i }}"><i class="fa-solid fa-star"></i></span>
                            @endfor
                        </div>
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md font-bold focus:outline-none focus:ring-2 focus:ring-blue-500">Submit</button>
                        <input type="hidden" name="rating" id="rating" value="{{ old('rating') }}" required>
                        <x-input-error :messages="$errors->get('rating')" class="mt-2" />
                    </div>
                </form>
            @else
                <p class="text-center font-semibold text-lg text-blue-500">You have already submitted a comment.</p>
            @endif
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 bg-neutral-800 p-4 mt-4 w-full rounded-lg">
            @if ($commentView->count() > 0)
                @foreach ($commentView as $cv)
                    <div class="bg-neutral-700 p-4 rounded-lg h-auto w-full">
                        <div class="flex flex-row items-center justify-between">
                            <div class="flex flex-row items-center gap-2">
                                <h2 class="text-xl text-white font-bold mb-2">{{ $cv->user->name }}</h2>
                                <i
                                    class="fas fa-circle text-[0.5rem] 
                                    {{ $cv->user->role == 'admin' ? 'text-red-500' : ($cv->user->role == 'author' ? 'text-green-500' : 'text-blue-500') }}">
                                </i>
                            </div>

                            @auth
                                @if ($cv->user_id == auth()->id())
                                    <div class="relative">
                                        <button onclick="toggleMenu('{{ $cv->id }}')"
                                            class="text-white focus:outline-none hover:bg-gray-700 p-1 rounded-full">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div id="menu-{{ $cv->id }}"
                                            class="absolute z-10 right-0 mt-1 bg-neutral-500 p-2 rounded-md shadow-lg hidden">
                                            <a href="#commentSection" onclick="editComment('{{ $cv->id }}')"
                                                class="block text-white hover:bg-gray-700 p-1 rounded-md">Edit</a>
                                            <form action="{{ route('comments.delete', $cv->id) }}" method="POST"
                                                class="block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-white hover:bg-gray-700 p-1 rounded-md">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            @endauth
                        </div>

                        <!-- Rating -->
                        <div id="rating-{{ $cv->id }}" class="flex space-x-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="text-sm {{ $cv->rating >= $i ? 'text-blue-500' : 'text-gray-500' }}">
                                    <i class="fa-solid fa-star"></i>
                                </span>
                            @endfor
                        </div>

                        <!-- Toggle Komentar -->
                        <div class="relative">
                            <input type="checkbox" id="toggle-{{ $cv->id }}-comment" class="hidden peer">
                            <div
                                class="max-h-24 overflow-hidden transition-all duration-300 peer-checked:max-h-screen">
                                <p class="text-gray-300 mt-1 text-lg" id="comment-text-{{ $cv->id }}">
                                    {{ $cv->comment }}</p>
                            </div>

                            <div class="mt-2">
                                <form action="{{ route('comments.update', $cv->id) }}" method="POST"
                                    id="edit-form-{{ $cv->id }}" style="display: none;">
                                    @csrf
                                    @method('PUT')
                                    <div id="rating-stars" class="flex space-x-2 mb-2">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span
                                                class="star text-3xl cursor-pointer transform transition duration-500 ease-in-out hover:scale-110
                                                {{ $cv->rating >= $i ? 'text-blue-500' : 'text-gray-500' }} peer-checked:text-blue-500"
                                                data-value="{{ $i }}">
                                                <i class="fa-solid fa-star"></i>
                                            </span>
                                        @endfor
                                        <input type="hidden" name="rating" id="rating"
                                            value="{{ old('rating') }}" required>
                                    </div>
                                    <input type="text" name="comment" value="{{ $cv->comment }}"
                                        class="bg-gray-700 text-white p-1 rounded-md w-full"
                                        id="edit-input-{{ $cv->id }}" />
                                    <div class="mt-2 flex flex-row gap-2">
                                        <button type="submit"
                                            class="text-white bg-blue-500 hover:bg-blue-600 p-1 rounded-md mt-1">Save</button>
                                        <button type="button" onclick="cancelEdit('{{ $cv->id }}')"
                                            class="text-white bg-red-500 hover:bg-red-600 p-1 rounded-md mt-1">Cancel</button>
                                    </div>
                                </form>
                            </div>

                            <div class="flex flex-row justify-between items-center">
                                @if (strlen($cv->comment) > 200)
                                    <label for="toggle-{{ $cv->id }}-comment"
                                        class="text-blue-400 hover:text-blue-500 text-sm cursor-pointer mt-2 block">
                                        Read more
                                    </label>
                                @endif
                                <p class="text-gray-500 text-xs mt-4">{{ $cv->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-white text-md col-span-3 flex items-center justify-center">No comments available.</p>
            @endif
        </div>

    </div>

</x-app-layout>
