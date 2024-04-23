<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>App | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.2/dist/full.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans min-h-screen bg-gray-100 dark:text-gray-100 dark:bg-gray-900 antialiased">
    @if (Route::has('login'))
        <nav class="navbar bg-slate-300 dark:bg-slate-700 ">
            @auth
                <div class="navbar-start">
                    <div class="dropdown">
                        <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h8m-8 6h16" />
                            </svg>
                        </div>
                        <div tabindex="0"
                            class="menu menu-sm dropdown-content mt-3 z-[100] p-2 shadow bg-base-100 rounded-box w-52 text-gray-800 ">
                            <!-- Responsive Settings Options -->
                            <div class="pt-2 pb-2 border-t border-gray-200 dark:border-gray-600">
                                <div class="p-4">
                                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">
                                        {{ Auth::user()->name }}
                                    </div>
                                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                                </div>

                                <ul class="pt-4 pb-2 border-t border-gray-200 dark:border-gray-600">
                                    @include('layouts.components.menuitems')
                                </ul>

                                <div class="mt-3 space-y-1 pt-4 pb-2 border-t border-gray-200 dark:border-gray-600">
                                    <x-responsive-nav-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-responsive-nav-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-responsive-nav-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-responsive-nav-link>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-ghost text-xl" href="/">Főoldal</a>
                    <div class="hidden lg:flex">
                        <ul class="menu menu-horizontal px-1">
                            @include('layouts.components.menuitems')
                        </ul>
                    </div>
                </div>
                <!-- Settings Dropdown -->
                <div class="navbar-end">
                    <div class="hidden lg:flex lg:items-center lg:ms-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>


                </div>
            @else
                <div class="navbar-start">
                </div>
                <div class="navbar-center hidden lg:flex">
                </div>
                <div class="navbar-end">
                    <ul class="menu menu-horizontal px-1">
                        <li><a href="{{ route('login') }}">Bejelentkezés</a></li>
                        <li><a href="{{ route('register') }}">Regisztráció</a></li>
                    </ul>
                </div>
            @endauth
        </nav>
    @endif
    <!-- Page Heading -->
    <header class="max-w-full bg-white dark:bg-gray-700 shadow">
        <div class="max-w-full mx-auto py-6 px-4 sm:px-6 lg:px-8">
            @yield('header')
        </div>
    </header>
    <div class="container mx-auto px-5 my-3 py-12">
        @yield('content')
    </div>
    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>
