<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="h-screen flex flex-col relative sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-neutral-900">
            <img class="w-full h-full object-cover opacity-10" src="https://media.istockphoto.com/id/458971457/photo/film-releases.jpg?s=612x612&w=0&k=20&c=pRYhzYx7Hbt_OxSYRvuR00-ulfzs85KJo4QDnrGMS8g=" alt="">
            <div class="absolute flex flex-col items-center justify-center">
                <div>
                    <a href="/">
                        <x-application-logo class="lg:w-[30rem] w-xl fill-current text-gray-500" />
                    </a>
                </div>
                <div class="max-w-md md:w-full m-10 md:px-6 md:py-4 px-4 py-2 bg-white dark:bg-neutral-800 shadow-md overflow-hidden rounded-lg">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
