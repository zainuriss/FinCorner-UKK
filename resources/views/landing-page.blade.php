<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Outfit:wght@100..900&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> --}}

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @include('layouts.navigation')

    {{-- Greetings Section --}}
    <div class="w-full h-screen bg-neutral-900 flex justify-center items-center">
        <div
            class="flex flex-col absolute justify-center items-center text-white text-center gap-2 sm:gap-4 mx-auto z-20">
            @auth
                <h1 class="sm:text-5xl text-xl font-bold">Welcome, <span
                        class="bg-clip-text text-transparent bg-gradient-to-r from-sky-700 via-purple-700 to-pink-600">{{ Auth::user()->name }}</span>
                </h1>
            @else
                <h1 class="sm:text-5xl text-xl font-bold">Welcome, <span
                        class="bg-clip-text text-transparent bg-gradient-to-r from-sky-700 via-purple-700 to-pink-600">Anonymous</span>
                </h1>
            @endauth
        </div>
        <img class="w-full h-screen object-cover opacity-40"
            src="https://media.istockphoto.com/id/458971457/photo/film-releases.jpg?s=612x612&w=0&k=20&c=pRYhzYx7Hbt_OxSYRvuR00-ulfzs85KJo4QDnrGMS8g="
            alt="">
        <div class="h-screen bg-gradient-to-t from-neutral-900 to-transparent absolute inset-0 z-10"></div>
    </div>

    {{-- Latest Movie Section --}}
    <div class="dark:bg-neutral-900 w-full h-auto flex flex-col relative items-center justify-center">
        <h1 data-aos="zoom-out" class="md:text-5xl text-2xl font-bold text-white relative top-0 mt-6 md:my-4">
            Latest Movie
        </h1>

        <div data-aos="zoom-in-up" id="card-group" class="swiper w-full h-max flex justify-center items-center py-10">
            <div class="swiper-wrapper">
                @foreach ($latestFilm as $ltFilm)
                    <div
                        class="swiper-slide flex justify-center items-center w-48 md:min-w-64 h-full transform transition-transform duration-300 hover:scale-110 hover:text-blue-400">
                        <a href="{{ route('films.show', $ltFilm->slug) }}" id="card"
                            class="flex flex-col items-center snap-center justify-center relative group ">
                            <img class="h-80 w-full md:h-96 rounded-lg object-cover" src="{{ $ltFilm->poster }}"
                                alt="{{ $ltFilm->title }}">
                            <div class="flex flex-col w-full p-2">
                                <h2 class="text-white text-left font-semibold w-full">{{ $ltFilm->title }}</h2>
                                <div class="flex items-center w-full justify-between">
                                    <h4 class="text-white font-thin">{{ $ltFilm->release_year }}</h4>
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-blue-400">
                                            <i class="fa-solid fa-star"></i>
                                        </span>
                                        <h4 class="text-white font-thin">{{ $averageRatings[$ltFilm->id] ?? 0 }}/5</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    {{-- Movie List Section --}}
    <div class="bg-neutral-900 w-full h-auto flex flex-col items-center relative justify-center">
        <h1 data-aos="fade-up" class="sm:text-5xl text-2xl font-bold text-white my-2">Movie List</h1>
        <div class="flex flex-row md:w-1/2 w-3/4 justify-center items-center gap-2 md:gap-4">
            <form class="block md:w-full w-2/3" action="{{ route('films.search-in-landing-page') }}">
                @csrf
                <div class="relative">
                    <x-text-input id="title" class="pl-10 w-full text-xs md:text-base" type="text" name="title"
                        :value="old('title')" required placeholder="Type title you want here.." />
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>
            </form>
            <div class="block md:w-1/2 w-max">
                <a href="{{ route('films.search') }}"
                    class="p-2 bg-green-600 rounded-md flex justify-center items-center flex-row gap-2 text-white">
                    <h3 class="md:text-base text-xs hidden md:block">See more</h3>
                    <i class="fas fa-arrow-right md:text-base text-xs"></i>
                </a>
            </div>
        </div>
        @if ($errors->any())
            <div class="mt-4 px-4 py-2 w-full bg-red-500 text-white rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div id="card-group"
            class="w-full h-full flex flex-wrap flex-row justify-center p-4 mt-10 relative gap-x-4 gap-y-6">
            @foreach ($listFilm as $lf)
                <a href="{{ route('films.show', $lf->slug) }}" data-aos="zoom-in-right" id="card"
                    class="group flex flex-col items-center justify-center relative w-48 lg:min-w-64 h-full">
                    <div class="transform transition-transform duration-300 hover:scale-110 hover:text-blue-400">
                        <img src="{{ $lf->poster }}" alt="{{ $lf->title }}"
                            class="h-80 w-full md:h-96 rounded-lg object-cover">
                        <div class="flex flex-col w-full p-2">
                            <h2 class="text-white text-left font-semibold w-full">{{ $lf->title }}</h2>
                            <div class="flex items-center w-full justify-between">
                                <h4 class="text-white font-thin">{{ $lf->release_year }}</h4>
                                <div class="flex items-center gap-2">
                                    <span class="text-sm text-blue-400">
                                        <i class="fa-solid fa-star"></i>
                                    </span>
                                    <h4 class="text-white font-thin">{{ $averageRatings[$lf->id] ?? 0 }}/5</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    {{-- Footer Section --}}
    <footer class="bg-neutral-900 w-full h-1/3 flex flex-col items-center relative justify-center p-4">
        <div
            class="border border-neutral-700 w-full flex h-full items-center justify-center mb-10 border-r-0 border-l-0 p-10 ">
            <div class=" flex justify-between w-full items-center">
                <div class="flex flex-col-reverse md:flex-row items-start md:items-center justify-between w-3/5">
                    <h1 class="text-neutral-700 text-xs md:text-sm">&copy; {{ date('Y') }} <span
                            class="font-semibold">{{ config('app.name', 'Laravel') }}</span> All rights reserved.</h1>
                    <x-application-logo class="w-20 md:w-64 h-auto" />
                </div>
                <div class="flex gap-2">
                    <i class="fa-brands fa-instagram text-neutral-700 bg-white p-2 rounded-full"></i>
                    <i class="fa-brands fa-youtube text-neutral-700 bg-white p-2 rounded-full"></i>
                    <i class="fa-brands fa-facebook text-neutral-700 bg-white p-2 rounded-full"></i>
                </div>
            </div>
        </div>
    </footer>
    
</body>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let stars = document.querySelectorAll(".star");
            let ratingInput = document.getElementById("rating");
    
            if (stars.length > 0) { // Pastikan elemen ada sebelum diproses
                stars.forEach(star => {
                    star.addEventListener("click", function() {
                        let rating = this.getAttribute("data-value");
                        ratingInput.value = rating;
    
                        stars.forEach(s => {
                            s.classList.toggle("text-yellow-400", s.getAttribute(
                                "data-value") <= rating);
                            s.classList.toggle("text-gray-400", s.getAttribute(
                                "data-value") > rating);
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
    
        const swiper = new Swiper('.swiper', {
            slidesPerView: "auto",
            spaceBetween: 20,
            loop: true,
            centeredSlides: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    
        function confirmLogout(event) {
        event.preventDefault(); // Supaya link nggak langsung jalan
    
        Swal.fire({
            title: 'Yakin mau logout?',
            text: "Kamu akan keluar dari sesi ini.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, logout!',
            cancelButtonText: 'Batal',
            background: '#262626',
            color: '#fff'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit(); // Submit form logout
            }
        });
    }
    </script>
</html>
