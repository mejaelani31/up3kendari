<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Survei: ') }} {{ $survey->no_survey }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg">
                <div class="p-6 sm:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">

                        <div class="md:col-span-2">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 border-b border-gray-200 dark:border-gray-700 pb-2">Informasi Survei</h3>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nomor Survei</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $survey->no_survey }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Tanggal Survei</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ \Carbon\Carbon::parse($survey->tanggal_survey)->isoFormat('DD MMMM YYYY') }}</dd>
                        </div>

                         <div class="md:col-span-2">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Terkait Permohonan</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                <a href="{{ route('permohonans.show', $survey->permohonan) }}" class="text-indigo-600 hover:underline">
                                    {{ $survey->permohonan->nama_pemohon }} (ID Pel: {{ $survey->permohonan->id_pelanggan ?? 'Baru' }})
                                </a>
                            </dd>
                        </div>

                        @if ($survey->foto_survey)
                        <div class="md:col-span-2">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Foto Hasil Survei</dt>
                            <dd class="mt-2 space-y-2">
                                <img src="{{ Storage::url($survey->foto_survey) }}" alt="Foto Hasil Survei" class="rounded-lg border dark:border-gray-700 w-full object-contain">
                                <a href="{{ Storage::url($survey->foto_survey) }}" download class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                    Unduh Foto
                                </a>
                            </dd>
                        </div>
                        @endif

                    </div>

                    <div class="mt-8 flex justify-end">
                        <a href="{{ route('surveys.index') }}">
                            <x-secondary-button>
                                {{ __('Kembali ke Daftar Survei') }}
                            </x-secondary-button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
