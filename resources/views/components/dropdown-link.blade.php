@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'block w-full px-4 py-2 text-start text-sm leading-5 border-l-2 border-indigo-400 dark:border-indigo-600 dark:bg-indigo-800/40 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-indigo-800 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-neutral-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-neutral-800 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
