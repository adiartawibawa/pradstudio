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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @filamentStyles

    @vite('resources/css/app.css')
</head>

<body class="font-sans text-gray-900 antialiased">
    <div
        class="min-h-screen flex flex-col text-neutral-900 dark:bg-neutral-900 dark:text-neutral-100 transition-colors duration-300">

        <div class="w-full mx-auto px-4 sm:px-6 lg:px-8 flex-1 flex flex-col">

            <!-- Header -->
            <header class="py-8 space-y-4 bg-white">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold">{{ config('app.name') }}</h1>
                        <p class="text-neutral-600 dark:text-neutral-400 font-serif italic">Digitizing Your Desires,
                            Whatever They Are</p>
                    </div>

                    <!-- Auth Navigation -->
                    @if (Route::has('login'))
                        <nav class="flex items-center gap-3">
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="inline-block px-5 py-1.5 border text-sm rounded-sm leading-normal text-neutral-800 dark:text-neutral-100 border-neutral-300 dark:border-neutral-600 hover:border-neutral-400 dark:hover:border-neutral-500 transition">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="inline-block px-5 py-1.5 text-sm rounded-sm leading-normal text-neutral-800 dark:text-neutral-100 hover:underline transition">
                                    Log in
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="inline-block px-5 py-1.5 border text-sm rounded-sm leading-normal text-neutral-800 dark:text-neutral-100 border-neutral-300 dark:border-neutral-600 hover:border-neutral-400 dark:hover:border-neutral-500 transition">
                                        Register
                                    </a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </div>

                <!-- Dynamic Navigation -->
                <nav>
                    <ul class="flex flex-wrap gap-4 text-sm border-b border-neutral-200 dark:border-neutral-700 pb-4">
                        <x-guest-nav :href="route('welcome')" :active="request()->routeIs('welcome')">
                            Home
                        </x-guest-nav>
                        <x-guest-nav :href="route('blog.all')" :active="request()->routeIs('blog*')">
                            Blog
                        </x-guest-nav>
                        <x-guest-nav :href="route('project.all')" :active="request()->routeIs('project*')">
                            Explore
                        </x-guest-nav>
                    </ul>
                </nav>
            </header>

            <!-- Featured & Other Sections -->
            <main class="flex-1">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer
                class="py-8 border-t border-neutral-200 dark:border-neutral-700 text-sm text-neutral-500 dark:text-neutral-400 text-center">
                <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </footer>
        </div>

    </div>

    @filamentScripts

    @vite('resources/js/app.js')

</body>

</html>
