<x-app-layout>
    <div class="bg-neutral-900 w-full h-auto flex flex-col items-center relative justify-center">
        <div class="mt-16 flex flex-col items-center justify-center w-full">
            <h1 data-aos="fade-up" class="sm:text-5xl text-2xl font-bold text-white my-2">Movie List</h1>
            <div class="flex flex-row w-2/3 justify-center items-center gap-2">
                <div class="block md:w-full w-2/3">
                    <form class="w-full" action="{{ route('films.search') }}">
                        @csrf
                        <div class="relative">
                            <x-text-input id="title" class="pl-10 w-full md:text-base text-xs" type="text" name="title"
                                :value="old('title')" placeholder="Type title you want here.." />
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="block w-1/2">
                    <form action="{{ route('films.genres-filter') }}" method="get">
                        <select name="genre_id" id="genre_id"
                            class="block w-full px-3 py-2 md:text-base text-xs border-gray-300 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            onchange="this.form.submit()">
                            <option hidden value="">Genre</option>
                            @foreach ($genres as $g)
                                <option value="{{ $g->id }}">{{ $g->title }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
            <div class="w-full">
                @if ($errors->any())
                    <div class="mt-4 px-4 py-2 w-2/3 bg-red-500 text-white rounded text-center">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div id="card-group" class="w-full h-full flex flex-wrap justify-center gap-4 md:gap-y-10 p-4 relative">
                @foreach ($showAllFilm as $saf)
                    <a href="{{ route('films.show', $saf->slug) }}" data-aos="zoom-in-right" id="card"
                        class="group flex flex-col items-center justify-center relative w-48 lg:min-w-64 h-full">
                        <div class="transform transition-transform duration-300 hover:scale-110 hover:text-blue-400">
                            <img src="{{ $saf->poster }}" alt="{{ $saf->title }}"
                                class="h-80 w-full md:h-96 rounded-lg object-cover">
                            <div class="flex flex-col w-full p-2">
                                <h2 class="text-white text-left font-semibold w-full">{{ $saf->title }}</h2>
                                <div class="flex items-center w-full justify-between">
                                    <h4 class="text-white font-thin">{{ $saf->release_year }}</h4>
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-blue-400">
                                            <i class="fa-solid fa-star"></i>
                                        </span>
                                        <h4 class="text-white font-thin">{{ $averageRatings[$saf->id] ?? 0 }}/5</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
