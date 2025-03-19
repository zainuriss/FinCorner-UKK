<x-app-layout>
    <div class="bg-neutral-900 w-full h-auto flex flex-col items-center relative justify-center">
        <div class="mt-16 flex flex-col items-center justify-center w-full">
            <h1 data-aos="fade-up" class="sm:text-5xl text-2xl font-bold text-white my-2">Movie List</h1>
            <div class="w-2/3">
                <form class="w-full" action="{{ route('films.filter') }}" method="get">
                    @csrf
                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-3 mb-4">
                        <!-- Release year filter -->
                        <div>
                            <select name="release_year" id="release_year"
                                class="block w-full px-3 py-2 text-xs md:text-base border-gray-300 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="">Years</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}"
                                        {{ request('release_year') == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Genre filter -->
                        <div>
                            <select name="genre_id" id="genre_id"
                                class="block w-full px-3 py-2 text-xs md:text-base border-gray-300 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="">Genres</option>
                                @foreach ($genres as $g)
                                    <option value="{{ $g->id }}"
                                        {{ request('genre_id') == $g->id ? 'selected' : '' }}>
                                        {{ $g->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Age rating filter -->
                        <div>
                            <select name="age_rating" id="age_rating"
                                class="block w-full px-3 py-2 text-xs md:text-base border-gray-300 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="">Age Ratings</option>
                                <option value="G" {{ request('age_rating') == 'G' ? 'selected' : '' }}>G</option>
                                <option value="PG" {{ request('age_rating') == 'PG' ? 'selected' : '' }}>PG</option>
                                <option value="PG-13" {{ request('age_rating') == 'PG-13' ? 'selected' : '' }}>PG-13
                                </option>
                                <option value="R" {{ request('age_rating') == 'R' ? 'selected' : '' }}>R</option>
                                <option value="NC-17" {{ request('age_rating') == 'NC-17' ? 'selected' : '' }}>NC-17
                                </option>
                            </select>
                        </div>

                        <!-- Average rating filter -->
                        <div>
                            <select name="avg_rating" id="avg_rating"
                                class="block w-full px-3 py-2 text-xs md:text-base border-gray-300 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="" {{ request('avg_rating') == 'all' ? 'selected' : '' }}>Ratings
                                </option>
                                <option value="4" {{ request('avg_rating') == '4' ? 'selected' : '' }}>4+ Stars
                                </option>
                                <option value="3" {{ request('avg_rating') == '3' ? 'selected' : '' }}>3+ Stars
                                </option>
                                <option value="2" {{ request('avg_rating') == '2' ? 'selected' : '' }}>2+ Stars
                                </option>
                                <option value="1" {{ request('avg_rating') == '1' ? 'selected' : '' }}>1+ Stars
                                </option>
                            </select>
                        </div>

                        <!-- Title search -->
                        <div class="relative md:col-span-3">
                            <x-text-input id="title" class="pl-10 w-full text-xs md:text-base" type="text"
                                name="title" :value="old('title', request('title'))" placeholder="Type title you want here.." />
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Filter and reset buttons -->
                        <div class="flex gap-2 justify-center md:justify-normal flex-shrink">
                            <button type="submit"
                                class="px-4 py-0 bg-blue-500 hover:bg-blue-600 text-white rounded-md transition duration-200 text-sm">
                                Apply Filters
                            </button>
                            <a href="{{ route('films.filter') }}"
                                class="px-4 py-2 items-center bg-gray-500 hover:bg-gray-600 text-white rounded-md transition duration-200 text-sm">
                                <h2 class="text-center">
                                    Reset
                                </h2>
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Error messages display -->
            <div class="w-full flex justify-center">
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

            <!-- Movie cards display -->
            <div id="card-group" class="w-full h-full flex flex-wrap justify-center gap-4 md:gap-y-10 p-4 relative">
                @if ($showAllFilm->isNotEmpty())
                    @foreach ($showAllFilm as $saf)
                        <a href="{{ route('films.show', $saf->slug) }}" data-aos="zoom-in-right" id="card"
                            class="group flex flex-col items-center justify-center relative w-48 lg:min-w-64 h-full">
                            <div
                                class="transform transition-transform duration-300 hover:scale-110 hover:text-blue-400">
                                <img src="{{ $saf->poster }}" alt="{{ $saf->title }}"
                                    class="h-80 w-full md:h-96 rounded-lg object-cover">
                                <div class="flex flex-col w-full p-2">
                                    <h2 class="text-white text-left font-semibold w-full">{{ $saf->title }}</h2>
                                    <div class="flex items-center w-full justify-between">
                                        <div class="flex items-center">
                                            <h4 class="text-white font-thin">{{ $saf->release_year }}</h4>
                                            @if (isset($saf->age_rating))
                                                <span
                                                    class="ml-2 px-1.5 py-0.5 text-xs bg-gray-700 text-white rounded">{{ $saf->age_rating }}</span>
                                            @endif
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-sm text-blue-400">
                                                <i class="fa-solid fa-star"></i>
                                            </span>
                                            <h4 class="text-white font-thin">{{ $averageRating[$saf->id] ?? 0 }}/5
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <div class="mt-4 px-4 py-2 w-2/3 bg-red-500 text-white rounded text-center">
                        <p>No films found.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
