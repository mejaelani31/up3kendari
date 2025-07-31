<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail SPBJ: ') }} {{ $spbj->no_spbj }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nomor SPBJ</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $spbj->no_spbj }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Tanggal</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ \Carbon\Carbon::parse($spbj->tanggal)->isoFormat('DD MMMM YYYY') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Dibuat Oleh</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $spbj->user_email }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Unit Kerja</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $spbj->company_unit_name }} ({{ $spbj->unit_role }})</dd>
                    </div>
                </div>
                <div class="mt-8 flex justify-end">
                    <a href="{{ route('spbjs.index') }}">
                        <x-secondary-button>{{ __('Kembali') }}</x-secondary-button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>