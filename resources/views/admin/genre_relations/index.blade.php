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
                        <a href="{{ route('admin.genre_relations.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                        <a href="{{ route('admin.genre_relations.trash') }}" class="bg-amber-500 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fa-solid fa-trash"></i>
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
                            @foreach ($genre_relations as $relation)
                                <tr class="">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ $relation->genre->title }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                        {{ $relation->film->title }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="gap-2 flex">
                                            <a href="{{ route('admin.genre_relations.edit', $relation->id) }}" class="bg-indigo-600 dark:bg-indigo-400 hover:bg-indigo-900 dark:hover:bg-indigo-600 p-2.5 rounded">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                            <form action="{{ route('admin.genre_relations.delete', $relation->id) }}" method="POST" class="inline" id="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-600 dark:bg-red-400 hover:bg-red-900 dark:hover:bg-red-600 p-2.5 rounded">
                                                    <i class="fa-solid fa-ban"></i>
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