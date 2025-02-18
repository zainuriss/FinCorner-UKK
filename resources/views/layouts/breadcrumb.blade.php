@php
    $url = request()->getPathInfo();
    $items = explode('/', $url);
    unset($items[0]);
@endphp

<nav class="flex" aria-label="Breadcrumb">
    <ol class="flex items-center space-x-4">
        @foreach ($items as $key => $item)
            <li>
                <a href="/" class="text-blue-500 hover:text-blue-400">Home</a>
            </li>
            <li class="text-gray-500 dark:text-gray-400">/</li>
            @if ($key == count($items))
                <li class="text-gray-50 dark:text-gray-400">
                    {{ Str::ucfirst($item) }}
                </li>
            @else
                <li class="text-gray-500 dark:text-gray-50">
                    <a href="/{{ $item }}" class="hover:text-gray-400 dark:hover:text-white">
                        {{ Str::ucfirst($item) }}
                    </a>
                </li>
            @endif
        @endforeach
    </ol>
</nav>
