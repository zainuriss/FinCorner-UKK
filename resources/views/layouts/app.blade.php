<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Outfit:wght@100..900&display=swap" rel="stylesheet">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-neutral-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            @isset($slot)
                <main>
                    {{ $slot }}
                </main>
            @endisset
        </div>
    </body>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let stars = document.querySelectorAll(".star");
            let ratingInput = document.getElementById("rating");

            if (stars.length > 0) { // Pastikan elemen ada sebelum diproses
                stars.forEach(star => {
                    star.addEventListener("click", function () {
                        let rating = this.getAttribute("data-value");
                        ratingInput.value = rating;

                        stars.forEach(s => {
                            s.classList.toggle("text-yellow-400", s.getAttribute("data-value") <= rating);
                            s.classList.toggle("text-gray-400", s.getAttribute("data-value") > rating);
                        });
                    });
                });

                let savedRating = ratingInput.value;
                if (savedRating > 0) {
                    stars.forEach(s => {
                        s.classList.toggle("text-yellow-400", s.getAttribute("data-value") <= savedRating);
                        s.classList.toggle("text-gray-400", s.getAttribute("data-value") > savedRating);
                    });
                }
            }
        });

        function togglePasswordVisibility(id) {
            var input = document.getElementById(id);
            if (input.type === "password") {
                input.type = "text";
            } else {
                input.type = "password";
            }
        }
    </script>
</html>
