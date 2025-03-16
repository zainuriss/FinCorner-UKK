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
    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Outfit:wght@100..900&display=swap"
        rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

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
        document.querySelectorAll('[id^=rating-stars]').forEach(starContainer => {
            const stars = starContainer.querySelectorAll('.star');
            const ratingInput = starContainer.nextElementSibling; // Hidden input yang nyimpen nilai rating
    
            stars.forEach(star => {
                star.addEventListener('click', () => {
                    const ratingValue = star.getAttribute('data-value');
                    ratingInput.value = ratingValue;
    
                    // Update warna bintang yang aktif
                    stars.forEach(s => {
                        s.classList.remove('text-blue-500');
                        s.classList.add('text-gray-500');
                    });
    
                    for (let i = 0; i < ratingValue; i++) {
                        stars[i].classList.remove('text-gray-500');
                        stars[i].classList.add('text-blue-500');
                    }
                });
            });
        });
    
    
        function toggleMenu(id) {
            let menu = document.getElementById("menu-" + id);
            menu.style.display = (menu.style.display === "block") ? "none" : "block";
        }
    
        function editComment(id) {
            document.getElementById("comment-text-" + id).style.display = "none";
            document.getElementById("rating-" + id).style.display = "none";
            document.getElementById("edit-form-" + id).style.display = "block";
            document.getElementById("edit-input-" + id).focus();
            document.getElementById("menu-" + id).style.display = "none";
        }
    
        function cancelEdit(id) {
            document.getElementById("comment-text-" + id).style.display = "block";
            document.getElementById("rating-" + id).style.display = "block";
            document.getElementById("edit-form-" + id).style.display = "none";
        }
    
        document.addEventListener("click", function(event) {
            document.querySelectorAll("[id^='menu-']").forEach(menu => {
                if (!menu.contains(event.target) && !event.target.closest("button")) {
                    menu.style.display = "none";
                }
            });
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
