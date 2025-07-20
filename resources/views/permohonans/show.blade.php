<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Permohonan: ') }} {{ $permohonan->nama_pemohon }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg">
                <div class="p-6 sm:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        
                        <!-- Data Pemohon -->
                        <div class="md:col-span-2">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 border-b border-gray-200 dark:border-gray-700 pb-2">Data Pemohon</h3>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nama Pemohon</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $permohonan->nama_pemohon }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">ID Pelanggan</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $permohonan->id_pelanggan ?? '-' }}</dd>
                        </div>
                         <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">No. HP</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $permohonan->no_hp_pemohon }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Titik Koordinat</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $permohonan->titik_koordinat ?? '-' }}</dd>
                        </div>
                        <div class="md:col-span-2">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Alamat</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $permohonan->alamat_pemohon }}</dd>
                        </div>
                        
                        <!-- Detail Permohonan -->
                        <div class="md:col-span-2 pt-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 border-b border-gray-200 dark:border-gray-700 pb-2">Detail Permohonan</h3>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Jenis Permohonan</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $permohonan->jenis_permohonan }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Daya Permohonan</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $permohonan->tarif_permohonan }} / {{ $permohonan->daya_permohonan }}</dd>
                        </div>
                        @if($permohonan->jenis_permohonan == 'TAMBAH DAYA')
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Daya Lama</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $permohonan->tarif_lama }} / {{ $permohonan->daya_lama }}</dd>
                        </div>
                        @endif

                        <!-- Status & Tracking -->
                        <div class="md:col-span-2 pt-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 border-b border-gray-200 dark:border-gray-700 pb-2">Status & Tracking</h3>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status Permohonan</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $permohonan->status_permohonan }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status Survey</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $permohonan->status_survey }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Dibuat oleh</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $permohonan->user_email }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Unit Kerja</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $permohonan->company_unit_name }} ({{ $permohonan->unit_role }})</dd>
                        </div>

                        <!-- Lampiran Berkas -->
                        <div class="md:col-span-2 pt-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 border-b border-gray-200 dark:border-gray-700 pb-2">Lampiran Berkas</h3>
                        </div>
                        
                        @if ($permohonan->foto_lokasi)
                        <div class="md:col-span-2">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Foto Lokasi</dt>
                            <dd class="mt-2 space-y-2">
                                <img src="{{ Storage::url($permohonan->foto_lokasi) }}" alt="Foto Lokasi" class="rounded-lg border dark:border-gray-700 w-full object-contain">
                                <a href="{{ Storage::url($permohonan->foto_lokasi) }}" download class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                    Unduh Foto
                                </a>
                            </dd>
                        </div>
                        @endif

                        @if ($permohonan->file_surat)
                        <div class="md:col-span-2">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Surat Permohonan</dt>
                            <dd class="mt-2 space-y-2">
                                <iframe src="{{ Storage::url($permohonan->file_surat) }}" class="w-full h-96 rounded-lg border dark:border-gray-700"></iframe>
                                <a href="{{ Storage::url($permohonan->file_surat) }}" download class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                    Unduh Surat (PDF)
                                </a>
                            </dd>
                        </div>
                        @endif
                        
                    </div>

                    <div class="mt-8 flex justify-end">
                        <a href="{{ route('permohonans.index') }}">
                            <x-secondary-button>
                                {{ __('Kembali ke Daftar') }}
                            </x-secondary-button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
