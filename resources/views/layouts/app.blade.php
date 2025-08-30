<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard-theme.css') }}" rel="stylesheet">
    <!-- Global override: remove underlines from links/buttons; keep focus outlines for accessibility -->
    <style>
    a,
    a:link,
    a:visited,
    a:hover,
    a:active,
    button,
    input[type="submit"],
    .btn {
        text-decoration: none !important;
    }

    /* Keep keyboard focus visible */
    a:focus,
    button:focus,
    input[type="submit"]:focus {
        outline: 3px solid rgba(99, 102, 241, 0.18);
        outline-offset: 2px;
    }
    </style>
</head>

<body>
    <div id="app" class="min-h-screen flex bg-gray-100">
        @if (Request::is('login') || Request::is('/'))
        <!-- No sidebar on login page -->
        <div class="flex-1 flex flex-col min-h-screen">
            <nav class="bg-gray-900 shadow px-4 py-2 flex items-center justify-between">
                <a class="text-xl font-bold text-white" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </nav>
            <main class="flex-1 py-8 px-6 bg-gray-800">
                @yield('content')
            </main>
        </div>
        @else
        @if(Auth::user() && Auth::user()->is_admin)
        <!-- Sidebar only for admin users -->
        <aside class="w-64 bg-gray-900 text-white flex-shrink-0 min-h-screen hidden md:block">
            <div class="h-full flex flex-col p-4">
                <a href="{{ route('dashboard') }}"
                    class="text-2xl font-bold mb-8 flex items-center gap-2 select-none hover:text-blue-400 transition-colors">
                    <!-- Dashboard Icon -->
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="7" />
                        <rect x="14" y="3" width="7" height="7" />
                        <rect x="14" y="14" width="7" height="7" />
                        <rect x="3" y="14" width="7" height="7" />
                    </svg>
                    Dashboard
                </a>
                @include('layouts.menu')
            </div>
        </aside>
        @endif
        <div class="flex-1 flex flex-col min-h-screen">
            <nav class="bg-white shadow px-4 py-2 flex items-center justify-between">
                <a class="text-xl font-bold text-gray-800" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <div>
                    <ul class="flex items-center space-x-4">
                        @guest
                        @if (Route::has('login'))
                        <li>
                            <a class="text-gray-700 hover:text-blue-600"
                                href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif
                        @if (Route::has('register'))
                        <li>
                            <a class="text-gray-700 hover:text-blue-600"
                                href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="relative" x-data="{ open: false }" @click.away="open = false">
                            <button @click="open = !open"
                                class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 focus:outline-none">
                                <span class="font-semibold">{{ Auth::user()->name }}</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5">

                                <a href="{{ route('profile.edit') }}"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <svg class="mr-3 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Profile
                                </a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="flex w-full items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <svg class="mr-3 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </nav>
            <main class="flex-1 py-8 px-6 bg-gray-50">
                @yield('content')
            </main>
        </div>
        @endif
    </div>
</body>

</html>