<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10">
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
            
            <div class="bg-white dark:bg-neutral-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 overflow-x-scroll">
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.genre_relations.index') }}" class="bg-cyan-500 hover:bg-cyan-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fa-solid fa-arrow-left"></i>
                        </a>
                    </div>
                    <table id="search-table" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Genre
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Movie Title
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="">
                            @foreach ($grTrash as $trash)
                                <tr class="">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ $trash->genres->title }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                        {{ $trash->films->title }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="gap-2 flex">
                                            <a href="{{ route('admin.genre_relations.restore', $trash->film_id) }}" class="bg-lime-600 hover:bg-lime-900 p-2.5 rounded">
                                                <x-fas-trash-restore class="w-4 h-auto"/>
                                            </a>
                                            <form action="{{ route('admin.genre_relations.destroy', $trash->film_id) }}" method="POST" class="inline" id="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-pink-600 hover:bg-pink-900 p-2.5 rounded">
                                                    <x-fluentui-delete-dismiss-24 class="w-5 h-auto" />
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>