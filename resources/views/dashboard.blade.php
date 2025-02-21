<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10">
            <div class="bg-white dark:bg-neutral-800 overflow-hidden shadow-sm sm:rounded-lg">
                @if (in_array(auth()->user()->role, ['admin', 'author']))
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("You're :role", ['role' => ucfirst(auth()->user()->role)]) }}
                    </div>
                @else
                    <script>window.location.href = "{{ route('landing-page') }}";</script>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

