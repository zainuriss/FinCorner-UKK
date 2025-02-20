<x-app-layout>
    <div class="bg-neutral-900 w-full h-auto flex flex-col items-center relative justify-center">
        <div class="mt-10 flex flex-col items-center justify-center">
            <h1 data-aos="fade-up"  class="sm:text-5xl text-2xl font-bold text-white my-2">Movie List</h1>
            <div class="flex flex-row w-80 justify-center items-center gap-2">
                <div class="">
                    <form class="block md:w-full w-full" action="{{ route('films.search') }}">
                        @csrf
                        <div class="relative">
                            <x-text-input 
                            id="title" 
                            class="pl-10 w-full" 
                            type="text" 
                            name="title" 
                            :value="old('title')" 
                            placeholder="Type title you want here.."
                            />
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="">
                    <form action="{{ route('films.genres-filter') }}" method="get">
                        <select name="genre" id="genre" class="block w-full px-3 py-2 text-base border-gray-300 dark:border-gray-700 dark:bg-neutral-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" onchange="this.form.submit()">
                            <option value="">Genre</option>
                            @foreach ($genres as $g)
                                <option value="{{ $g->id }}">{{ $g->title }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
            @if ($errors->any())
            <div class="mt-4 px-4 py-2 bg-red-500 text-white rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div id="card-group" class="w-full h-full flex flex-wrap justify-center gap-4 md:gap-y-10 p-4 relative">
                @foreach ($showAllFilm as $saf)
                <a href="{{ route('films.show', $saf->id) }}" data-aos="zoom-in-right" id="card" class="group flex flex-col items-center justify-center transform transition-transform duration-300 hover:scale-110 hover:shadow-xl hover:rotate-1 relative h-40 md:h-96 w-32 md:w-64">
                    <div class="absolute bottom-0 w-full h-full bg-gradient-to-t from-black to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-b-lg"></div>
                    <img src="{{ $saf->poster }}" alt="{{ $saf->title }}" class="h-full rounded-lg w-full">
                    <h2 class="text-white absolute bottom-8 font-bold opacity-0 group-hover:opacity-100 transition-opacity duration-300 translate-y-2 group-hover:translate-y-0 ">{{ $saf->title }}</h2>
                </a>
                @endforeach
            </div>                         
        </div>
    </div>
</x-app-layout>