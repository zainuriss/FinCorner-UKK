<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @if (auth()->user()->role == 'admin' )
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("You're Admin") }}
                    </div>
                @elseif (auth()->user()->role == 'author')
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("You're Author") }}
                    </div>
                @elseif (auth()->user()->role == 'subscriber')
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("You're Subscriber") }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
