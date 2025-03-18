<nav x-data="{ scrolled: false, open: false }" x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 0; })"
    :class="scrolled ? 'bg-neutral-900 shadow-sm' : 'bg-transparent border-none'"
    class="fixed w-full z-30 transition-all duration-300 dark:shadow-current">

    <!-- Primary Navigation Menu -->
    <div class="flex flex-row justify-between items-center max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('landing-page') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden lg:flex items-center space-x-8 sm:-my-px sm:ms-10">
                    <x-nav-link :href="route('films.search')" :active="request()->routeIs('films.search.*')">
                        {{ __('Movies') }}
                    </x-nav-link>
                    <x-dropdown>
                        <x-slot name="trigger">
                            <div class="inline-flex items-center w-max transition-all ease-in-out duration-300">
                                <x-nav-link href="#">
                                    {{ __('Age Rating') }}

                                    <div class="ms-2 text-sm" x-bind:class="open ? 'rotate-180' : ''">
                                        <i class="fas fa-chevron-down text-gray-400"></i>
                                    </div>
                                </x-nav-link>
                            </div>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('films.age-rating-filter', ['age_rating' => 'all'])" :active="request()->query('age_rating') == 'all'">
                                {{ __('All') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('films.age-rating-filter', ['age_rating' => 'G'])" :active="request()->query('age_rating') === 'G'">
                                {{ __('G') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('films.age-rating-filter', ['age_rating' => 'PG'])" :active="request()->query('age_rating') === 'PG'">
                                {{ __('PG') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('films.age-rating-filter', ['age_rating' => 'PG-13'])" :active="request()->query('age_rating') === 'PG-13'">
                                {{ __('PG-13') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('films.age-rating-filter', ['age_rating' => 'R'])" :active="request()->query('age_rating') === 'R'">
                                {{ __('R') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>
                @auth
                    @if (auth()->user()->role == 'admin' || auth()->user()->role == 'author')
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    @endif
                    @if (auth()->user()->role == 'admin')
                        <x-dropdown>
                            <x-slot name="trigger">
                                <div class="inline-flex items-center transition-all ease-in-out duration-300">
                                    <x-nav-link href="#">
                                        {{ __('Admin Menu') }}

                                        <div class="ms-2 text-sm" x-bind:class="open ? 'rotate-180' : ''">
                                            <i class="fas fa-chevron-down text-gray-400"></i>
                                        </div>
                                    </x-nav-link>
                                </div>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('admin.films.index')" :active="request()->routeIs('admin.films.*')">
                                    {{ __('Films') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('admin.genres.index')" :active="request()->routeIs('admin.genres.*')">
                                    {{ __('Genres') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('admin.genre_relations.index')" :active="request()->routeIs('admin.genre_relations.*')">
                                    {{ __('Genre Relations') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('admin.castings.index')" :active="request()->routeIs('admin.castings.*')">
                                    {{ __('Casting') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('admin.casting_relations.index')" :active="request()->routeIs('admin.casting_relations.*')">
                                    {{ __('Casting Relations') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                                    {{ __('Users') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    @elseif (auth()->user()->role == 'author')
                        <x-dropdown>
                            <x-slot name="trigger">
                                <div class="inline-flex items-center transition-all ease-in-out duration-300">
                                    <x-nav-link href="#">
                                        {{ __('Author Menu') }}

                                        <div class="ms-2 text-sm" x-bind:class="open ? 'rotate-180' : ''">
                                            <i class="fas fa-chevron-down text-gray-400"></i>
                                        </div>
                                    </x-nav-link>
                                </div>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('author.films.index')" :active="request()->routeIs('author.films.*')">
                                    {{ __('Films') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('author.add-genres.index')" :active="request()->routeIs('author.add-genres.*')">
                                    {{ __('Add Genres') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('author.add-castings.index')" :active="request()->routeIs('author.add-castings.*')">
                                    {{ __('Add Castings') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    @else
                        {{-- Not available for Subscriber hahaha --}}
                    @endif
                @endauth
            </div>
        </div>

        @auth
            <!-- Settings Dropdown -->
            <div class="hidden lg:flex items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-neutral-800 hover:text-neutral-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" id="logout-form" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link href="#" onclick="confirmLogout(event)">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center lg:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @else
            <div class="flex w-full justify-end">
                <div class="flex items-center gap-2 sm:gap-4">
                    <a href="{{ route('login') }}"
                        class="rounded-md bg-sky-700 text-xs sm:text-base hover:bg-sky-800 px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="rounded-md border text-xs sm:text-base border-sky-700 hover:border-sky-800 px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                            Register
                        </a>
                    @endif
                </div>
            </div>
        @endauth
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden lg:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                @if (auth()->user()->role == 'admin' || auth()->user()->role == 'author')
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                @endif
                @if (auth()->user()->role == 'admin')
                    <x-responsive-nav-link :href="route('admin.films.index')" :active="request()->routeIs('admin.films.*')">
                        {{ __('Films') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.genres.index')" :active="request()->routeIs('admin.genres.*')">
                        {{ __('Genres') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.genre_relations.index')" :active="request()->routeIs('admin.genre_relations.*')">
                        {{ __('Genre Relations') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.castings.index')" :active="request()->routeIs('admin.castings.*')">
                        {{ __('Casting') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.casting_relations.index')" :active="request()->routeIs('admin.casting_relations.*')">
                        {{ __('Casting Relations') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                        {{ __('Users') }}
                    </x-responsive-nav-link>
                @elseif (auth()->user()->role == 'author')
                    <x-responsive-nav-link :href="route('author.films.index')" :active="request()->routeIs('author.films.*')">
                        {{ __('Films') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('author.add-genres.index')" :active="request()->routeIs('author.add-genres.*')">
                        {{ __('Add Genres') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('author.add-castings.index')" :active="request()->routeIs('author.add-castings.*')">
                        {{ __('Add Castings') }}
                    </x-responsive-nav-link>
                @else
                    {{-- Not available for Subscriber hahaha --}}
                @endif
            @endauth
        </div>

        @auth
            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" id="logout-form" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link href="#" onclick="confirmLogout(event)">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="flex w-full justify-end">
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <a href="{{ route('login') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                    Log in
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        Register
                    </a>
                @endif
            </div>
        </div>
    @endauth
</nav>
