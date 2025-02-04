<x-app-layout>
    <div class="bg-neutral-900 text-white min-h-screen flex justify-center items-center p-4">
        <form action="{{ route('films.update', $editFilm->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col md:flex-row gap-4 p-4 w-full">
            @csrf
            @method('PUT')
            @if ($errors->any())
                <div class="bg-red-500 text-white p-4 rounded-lg">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-white">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="h-full md:h-96 w-full md:w-64">
                <img src="{{ $editFilm->poster }}" alt="{{ $editFilm->title }}" class="bg-clip-content rounded-lg w-full">
                {{-- <input type="hidden" name="poster" value=""> --}}
                <input type="file" name="poster" class="mt-2 w-full bg-neutral-800 text-white p-2 rounded">
                <input type="text" name="poster_url" value="{{ $editFilm->poster }}" class="mt-2 w-full bg-neutral-800 text-white p-2 rounded">
            </div>

            <div class="w-full md:w-2/3">
                <input type="text" name="title" value="{{ $editFilm->title }}" class="text-2xl md:text-4xl font-bold bg-neutral-800 text-white p-2 rounded w-full">
                <div class="flex items-start md:items-center md:flex-row flex-col gap-2 text-gray-400 mt-2">
                    <input type="text" name="release_year" value="{{ $editFilm->release_year }}" class="bg-neutral-800 text-white p-2 rounded">
                    <input type="text" name="duration" value="{{ $editFilm->duration }}" class="bg-neutral-800 text-white p-2 rounded">
                    {{-- <input type="text" name="genre" value="" placeholder="Genre.." class="bg-neutral-800 text-white p-2 rounded"> --}}
                </div>
                <textarea name="description" class="mt-4 bg-neutral-800 text-white p-2 rounded w-full block" rows="9">{{ $editFilm->description }}</textarea>
                <div class="mt-4 flex flex-row items-center gap-4">
                    <div>
                        <p class="font-semibold">Produsen:</p>
                        <input type="text" name="creator" value="{{ $editFilm->creator }}" class="bg-neutral-800 text-white p-2 rounded w-full">
                    </div>
                    {{-- <div>
                        <p class="font-semibold">Pemain:</p>
                        <input type="text" name="cast" value="" class="bg-neutral-800 text-white p-2 rounded w-full">
                    </div> --}}
                    <div class="mt-6 flex flex-wrap gap-4">
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md font-bold flex items-center">
                            <span class="text-lg">Save</span>
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>
    
    <div class="bg-neutral-900 text-white min-h-screen flex justify-center items-center p-4">
        <div class="flex flex-col md:flex-row gap-4 p-4 w-full">
            <div class="h-full w-full">
                <video src="{{ $editFilm->trailer }}" class="rounded-lg w-full" controls></video>
                {{-- <input type="hidden" name="" value=""> --}}
                <input type="file" name="trailer" class="mt-2 w-full bg-neutral-800 text-white p-2 rounded">
                <input type="text" name="trailer_url" value="{{ $editFilm->trailer }}" class="mt-2 w-full bg-neutral-800 text-white p-2 rounded">
            </div>
        </div>
    </div>
</x-app-layout>
