<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Terima kasih telah mendaftar! Akun Anda sedang menunggu persetujuan dan aktivasi dari administrator. Anda akan dapat mengakses Dashboard setelah akun Anda ditautkan ke data karyawan. Silakan hubungi administrator jika Anda memiliki pertanyaan.') }}
        </div>

        <div class="mt-4 flex items-center justify-end">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>
