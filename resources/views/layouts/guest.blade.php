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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Outfit:wght@100..900&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased h-screen">
    <div
        class="h-full flex flex-col relative sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-neutral-900">
        <div class="absolute inset-0">
            <img class="w-full h-full object-fill opacity-10"
                src="https://media.istockphoto.com/id/458971457/photo/film-releases.jpg?s=612x612&w=0&k=20&c=pRYhzYx7Hbt_OxSYRvuR00-ulfzs85KJo4QDnrGMS8g="
                alt="">
        </div>
        <div class="relative z-10 flex flex-col items-center justify-center w-full px-4 sm:px-6 lg:px-8">
            <div>
                <a href="/">
                    <x-application-logo class="lg:w-[30rem] w-40 fill-current text-gray-500" />
                </a>
            </div>
            <div class="max-w-md w-full m-6 p-6 bg-white dark:bg-neutral-800 shadow-md overflow-hidden rounded-lg">
                @if (session('status'))
                    <div class="mb-4 px-4 py-2 w-full bg-green-500 text-white rounded text-center">
                        {{ session('status') }}
                    </div>
                @endif
                {{ $slot }}
            </div>
        </div>
    </div>
</body>

</html>
