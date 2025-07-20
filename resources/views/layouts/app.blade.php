<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        {{-- Kontainer utama dengan tinggi layar penuh dan overflow tersembunyi --}}
        {{-- Tambahkan x-data untuk Alpine.js dan properti isSidebarOpen --}}
        <div class="flex h-screen bg-gray-100 dark:bg-gray-900 overflow-hidden" x-data="{ isSidebarOpen: true }">
            {{-- Tambahkan x-show, :class, dan kelas transisi --}}
            <div x-show="isSidebarOpen"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="-translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition ease-in duration-300 transform"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="-translate-x-full"
                 class="flex-shrink-0"> {{-- Tambahkan flex-shrink-0 agar sidebar tidak mengecil --}}
                @livewire('sidebar-menu')
            </div>

            <div class="flex-1 flex flex-col overflow-hidden"> {{-- flex-1 agar mengambil sisa lebar, flex-col untuk tata letak vertikal --}}
                @if (isset($header))
                    <header class="flex items-center"> {{-- Tambahkan flex dan items-center --}}
                        {{-- Tombol Toggle Sidebar --}}
                        <button @click="isSidebarOpen = !isSidebarOpen" class="p-2 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-md ml-2">
                            <svg x-show="isSidebarOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                            </svg>
                            <svg x-show="!isSidebarOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                        <div class="max-w-7xl mx-2 py-6 px-2 sm:px-4 lg:px-6">
                            {{ $header }}
                        </div>
                    </header>
                @endif
                {{-- @livewire('navigation-menu') Ini adalah navigasi atas yang sudah ada --}}

                {{-- flex-1 agar mengambil sisa tinggi, overflow-y-auto untuk scroll konten halaman jika melebihi --}}
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 dark:bg-gray-900 p-4 sm:p-6">
                    {{ $slot }}
                </main>
            </div>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>