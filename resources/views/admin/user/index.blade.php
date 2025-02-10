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
                        <a href="{{ route('admin.users.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                        <a href="{{ route('admin.users.trash') }}" class="bg-amber-500 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </div>
                    <table id="search-table" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Id
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Role
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="">
                            @foreach ($dataUser as $du)
                                <tr class="">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                        {{ $du->id }}
                                    </td>
                                    <td class="px-6 py-4  whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ $du->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                        {{ $du->email }}
                                    </td>
                                    <td class="px-6 py-4 capitalize text-center whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                        @if ($du->role == 'author')
                                            <span class="bg-teal-500 text-teal-50 py-2 px-5 rounded">{{ $du->role }}</span>
                                        @elseif ($du->role == 'admin')
                                            <span class="bg-orange-500 text-orange-50 py-2 px-6 rounded">{{ $du->role }}</span>
                                        @else
                                            <span class="bg-green-500 text-green-50 p-2 rounded">{{ $du->role }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="gap-2 flex">
                                            <a href="{{ route('admin.users.edit', $du->id) }}" class="bg-indigo-600 dark:bg-indigo-400 hover:bg-indigo-900 dark:hover:bg-indigo-600 p-2.5 rounded">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                            <form action="{{ route('admin.users.delete', $du->id) }}" method="POST" class="inline" id="delete-form">
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