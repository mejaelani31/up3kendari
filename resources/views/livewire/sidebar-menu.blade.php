{{-- resources/views/livewire/sidebar-menu.blade.php --}}
<div class="flex flex-col w-64 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 h-screen border-e border-gray-200 dark:border-gray-700">
    <!-- Logo / Nama Web -->
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
        <a href="{{ route('dashboard') }}" class="flex items-center text-gray-900 dark:text-white">
            <svg class="h-8 w-auto mr-3 text-indigo-600 dark:text-indigo-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
            </svg>
            <span class="font-semibold text-xl tracking-tight">{{ config('app.name', 'Nama Web') }}</span>
        </a>
    </div>

    <!-- Link Navigasi -->
    
    <nav class="flex-1 px-4 py-4 space-y-2 overflow-y-auto">
        {{-- Link Dashboard --}}
        <a href="{{ route('dashboard') }}"
           class="flex items-center px-3 py-2.5 text-sm font-medium
                  {{ request()->routeIs('dashboard') ? 'bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }}">
            <svg class="h-6 w-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h7.5"/>
            </svg>
            <div>
                <span class="block">Dashboard</span>
                <span class="block text-xs text-gray-500 dark:text-gray-400">Halaman Utama</span>
            </div>
        </a>
        @if (Auth::user()->hasVerifiedEmail())
            
            @can('has-role', 'admin')
                <!-- Company Unit Link -->
                <a href="{{ route('company-units.index') }}"
                class="flex items-center px-3 py-2.5 text-sm font-medium rounded-md
                        {{ request()->routeIs('company-units.*') ? 'bg-gray-200 dark:bg-gray-900 text-gray-900 dark:text-white' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }}">
                    <!-- Company Icon SVG -->
                    <svg class="h-6 w-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                    </svg>
                    <div>
                        <span class="block">Company Units</span>
                        <span class="block text-xs text-gray-500 dark:text-gray-400">Pengaturan Unit</span>
                    </div>
                </a>

                <!-- Employee Management Link -->
                <a href="{{ route('employees.index') }}"
                class="flex items-center px-3 py-2.5 text-sm font-medium rounded-md
                        {{ request()->routeIs('employees.*') ? 'bg-gray-200 dark:bg-gray-900 text-gray-900 dark:text-white' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }}">
                    <!-- Users/Employees Icon SVG (Cleaner Version) -->
                    <svg class="h-6 w-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-4.663M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0z" />
                    </svg>
                    <div>
                        <span class="block">Karyawan</span>
                        <span class="block text-xs text-gray-500 dark:text-gray-400">Manajemen Data</span>
                    </div>
                </a>
            @endcan

            <!-- Permohonan Management Link -->
            <a href="{{ route('permohonans.index') }}"
            class="flex items-center px-3 py-2.5 text-sm font-medium rounded-md
                    {{ request()->routeIs('permohonans.*') ? 'bg-gray-200 dark:bg-gray-900 text-gray-900 dark:text-white' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }}">
                <!-- Document Icon SVG -->
                <svg class="h-6 w-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
                <div>
                    <span class="block">Permohonan</span>
                    <span class="block text-xs text-gray-500 dark:text-gray-400">Monitoring Permohonan</span>
                </div>
            </a>

            <!-- Survey Management Link -->
            <a href="{{ route('surveys.index') }}"
            class="flex items-center px-3 py-2.5 text-sm font-medium rounded-md
                    {{ request()->routeIs('surveys.*') ? 'bg-gray-200 dark:bg-gray-900 text-gray-900 dark:text-white' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }}">
                <!-- Clipboard/Survey Icon SVG -->
                <svg class="h-6 w-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
                <div>
                    <span class="block">Survei</span>
                    <span class="block text-xs text-gray-500 dark:text-gray-400">Manajemen Survei</span>
                </div>
            </a>
            
        @endif
    </nav>
    

    {{-- Bagian User/Logout dengan Dropdown di bagian bawah sidebar --}}
    @auth
    <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-700 mt-auto">
        <div class="relative">
            <x-dropdown align="top" width="48"
                        content-classes="absolute z-50 bg-white dark:bg-gray-700 shadow-lg ring-1 ring-black ring-opacity-5 py-1 origin-bottom bottom-full mb-2 w-full sm:w-48">
                <x-slot name="trigger">
                    <button class="flex items-center w-full text-left text-sm transition duration-150 ease-in-out p-2 hover:bg-gray-100 dark:hover:bg-gray-700/50">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <img class="size-9 rounded-full object-cover flex-shrink-0" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        @else
                            <span class="flex items-center justify-center size-9 bg-gray-300 dark:bg-gray-600 rounded-full text-gray-600 dark:text-gray-300 flex-shrink-0">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                        @endif
                        <div class="ms-2 min-w-0 flex-1">
                            <div class="font-medium text-sm text-gray-800 dark:text-gray-200 truncate">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-xs text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}</div>
                        </div>
                        <svg class="ms-1 size-4 text-gray-500 dark:text-gray-400 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                        </svg>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <div class="block px-4 py-2 text-xs text-gray-500 dark:text-gray-400">
                        {{ __('Manage Account') }}
                    </div>

                    <x-dropdown-link href="{{ route('profile.show') }}" class="text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-dropdown-link href="{{ route('api-tokens.index') }}" class="text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">
                            {{ __('API Tokens') }}
                        </x-dropdown-link>
                    @endif

                    <div class="border-t border-gray-200 dark:border-gray-600"></div>

                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <x-dropdown-link href="{{ route('logout') }}"
                                         @click.prevent="$root.submit();"
                                         class="text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
    @endauth
</div>
