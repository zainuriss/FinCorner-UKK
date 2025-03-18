<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10">
            <div class="bg-white dark:bg-neutral-800 overflow-hidden shadow-sm sm:rounded-lg">
                @if (auth()->user()->role == 'admin')
                <div class="p-6 text-gray-100 flex flex-row gap-4 justify-center">
                    <div class="flex justify-center flex-col hover:text-blue-500 text-white p-6 rounded-lg w-64 h-28 border border-white/40 backdrop-blur-md shadow-lg transition duration-300 hover:shadow-blue-400">
                        <h1 class="text-xl font-semibold opacity-80">Number of films now</h1>
                        <h1 class="text-4xl font-bold mt-2">{{ \App\Models\Film::all()->count() }}</h1>
                    </div>                                                     
                    <div class="flex justify-center flex-col hover:text-green-500 text-white p-6 rounded-lg w-64 h-28 border border-white/40 backdrop-blur-md shadow-lg transition duration-300 hover:shadow-green-400">
                        <h1 class="text-xl font-semibold opacity-80">Genres added</h1>
                        <h1 class="text-4xl font-bold mt-2">{{ \App\Models\Genre::all()->count() }}</h1>
                    </div>                                                     
                    <div class="flex justify-center flex-col hover:text-amber-500 text-white p-6 rounded-lg w-64 h-28 border border-white/40 backdrop-blur-md shadow-lg transition duration-300 hover:shadow-amber-400">
                        <h1 class="text-xl font-semibold opacity-80">Casting added</h1>
                        <h1 class="text-4xl font-bold mt-2">{{ \App\Models\Casting::all()->count() }}</h1>
                    </div>                                                     
                    <div class="flex justify-center flex-col hover:text-fuchsia-500 text-white p-6 rounded-lg w-64 h-28 border border-white/40 backdrop-blur-md shadow-lg transition duration-300 hover:shadow-fuchsia-400">
                        <h1 class="text-xl font-semibold opacity-80">Users registered</h1>
                        <h1 class="text-4xl font-bold mt-2">{{ \App\Models\User::all()->count() }}</h1>
                    </div>                                                     
                </div>
                @elseif(auth()->user()->role == 'author')
                    <div class="p-6 text-gray-100 flex flex-row gap-4">
                        <div class="flex justify-center flex-col hover:text-blue-500 text-white p-6 rounded-lg w-64 h-28 border border-white/40 backdrop-blur-md shadow-lg transition duration-300 hover:shadow-blue-400">
                            <h1 class="text-xl font-semibold opacity-80">Films Added</h1>
                            <h1 class="text-4xl font-bold mt-2">{{ auth()->user()->films->count() }}</h1>
                        </div>                                                     
                    </div>
                @else
                    <script>
                        window.location.href = "{{ route('landing-page') }}";
                    </script>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
