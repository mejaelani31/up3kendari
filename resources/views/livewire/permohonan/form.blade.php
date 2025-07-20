<x-form-section submit="save">
    <x-slot name="title">{{ __('Detail Permohonan') }}</x-slot>
    <x-slot name="description">{{ __('Lengkapi semua informasi yang diperlukan untuk permohonan baru atau edit.') }}</x-slot>

    <x-slot name="form">
        <!-- Jenis Permohonan -->
        <div class="col-span-6">
            <x-label for="jenis" value="{{ __('Jenis Permohonan') }}" />
            <select id="jenis" wire:model.live="jenis_permohonan" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                @foreach($opsiJenis as $opsi)
                    <option value="{{ $opsi }}">{{ $opsi }}</option>
                @endforeach
            </select>
            <x-input-error for="jenis_permohonan" class="mt-2" />
        </div>

        <!-- Data Pemohon -->
        <div class="col-span-6 sm:col-span-3">
            <x-label for="nama" value="{{ __('Nama Pemohon') }}" />
            <x-input id="nama" type="text" class="mt-1 block w-full" wire:model="nama_pemohon" />
            <x-input-error for="nama_pemohon" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-3">
            <x-label for="id_pelanggan" value="{{ __('ID Pelanggan (Jika ada)') }}" />
            <x-input id="id_pelanggan" type="text" class="mt-1 block w-full" wire:model="id_pelanggan" />
            <x-input-error for="id_pelanggan" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-3">
            <x-label for="no_hp" value="{{ __('No. HP Pemohon') }}" />
            <x-input id="no_hp" type="text" class="mt-1 block w-full" wire:model="no_hp_pemohon" />
            <x-input-error for="no_hp_pemohon" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-3">
            <x-label for="koordinat" value="{{ __('Titik Koordinat') }}" />
            <x-input id="koordinat" type="text" class="mt-1 block w-full" wire:model="titik_koordinat" />
            <x-input-error for="titik_koordinat" class="mt-2" />
        </div>
        <div class="col-span-6">
            <x-label for="alamat" value="{{ __('Alamat Lengkap Pemohon') }}" />
            <textarea id="alamat" wire:model="alamat_pemohon" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"></textarea>
            <x-input-error for="alamat_pemohon" class="mt-2" />
        </div>
        
        <!-- Detail Permohonan Baru -->
        <div class="col-span-6"><hr class="my-2 dark:border-gray-700"></div>
        <div class="col-span-6 sm:col-span-3">
            <x-label for="tarif_baru" value="{{ __('Tarif Permohonan') }}" />
            <select id="tarif_baru" wire:model="tarif_permohonan" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                @foreach($opsiTarif as $opsi)
                    <option value="{{ $opsi }}">{{ $opsi }}</option>
                @endforeach
            </select>
            <x-input-error for="tarif_permohonan" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-3">
            <x-label for="daya_baru" value="{{ __('Daya Permohonan') }}" />
            <select id="daya_baru" wire:model="daya_permohonan" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                 @foreach($opsiDaya as $opsi)
                    <option value="{{ $opsi }}">{{ $opsi }}</option>
                @endforeach
            </select>
            <x-input-error for="daya_permohonan" class="mt-2" />
        </div>

        <!-- Detail Data Lama (jika Tambah Daya) -->
        @if($jenis_permohonan === 'TAMBAH DAYA')
            <div class="col-span-6"><hr class="my-2 dark:border-gray-700"></div>
            <div class="col-span-6 sm:col-span-3">
                <x-label for="tarif_lama" value="{{ __('Tarif Lama') }}" />
                <select id="tarif_lama" wire:model="tarif_lama" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                    @foreach($opsiTarif as $opsi)
                        <option value="{{ $opsi }}">{{ $opsi }}</option>
                    @endforeach
                </select>
                <x-input-error for="tarif_lama" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-3">
                <x-label for="daya_lama" value="{{ __('Daya Lama') }}" />
                <select id="daya_lama" wire:model="daya_lama" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                    @foreach($opsiDaya as $opsi)
                        <option value="{{ $opsi }}">{{ $opsi }}</option>
                    @endforeach
                </select>
                <x-input-error for="daya_lama" class="mt-2" />
            </div>
        @endif

        <!-- Upload Berkas -->
        <div class="col-span-6"><hr class="my-2 dark:border-gray-700"></div>

        <div class="col-span-6">
            <x-label for="foto_lokasi" value="{{ __('Foto Lokasi (JPG/PNG)') }}" />
            <input 
                wire:model="foto_lokasi" 
                class="block w-full text-sm p-2.5 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 mt-1" 
                id="foto_lokasi" 
                type="file"
                accept="image/png, image/jpeg"
            >
            <div wire:loading wire:target="foto_lokasi" class="text-sm text-gray-500 mt-1">Mengunggah...</div>
            
            <div class="mt-2">
                @if (is_object($foto_lokasi) && method_exists($foto_lokasi, 'temporaryUrl'))
                    <img src="{{ $foto_lokasi->temporaryUrl() }}" class="rounded-md w-full h-auto object-contain">
                @elseif($permohonan->foto_lokasi)
                    <img src="{{ Storage::url($permohonan->foto_lokasi) }}" class="rounded-md w-full h-auto object-contain">
                @endif
            </div>
            <x-input-error for="foto_lokasi" class="mt-2" />
        </div>

        <div class="col-span-6" x-data="{ pdfPreviewUrl: '' }">
            <x-label for="file_surat" value="{{ __('Surat Permohonan (PDF)') }}" />
            <input 
                wire:model="file_surat" 
                @change="pdfPreviewUrl = $event.target.files.length ? URL.createObjectURL($event.target.files[0]) : ''"
                class="block w-full text-sm p-2.5 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 mt-1" 
                id="file_surat" 
                type="file"
                accept=".pdf"
            >
            <div wire:loading wire:target="file_surat" class="text-sm text-gray-500 mt-1">Mengunggah...</div>

            <div class="mt-2">
                <template x-if="pdfPreviewUrl">
                    <iframe :src="pdfPreviewUrl" class="w-full h-96 rounded-md border border-gray-300 dark:border-gray-600"></iframe>
                </template>

                <template x-if="!pdfPreviewUrl && '{{ $permohonan->file_surat }}'">
                    <iframe src="{{ Storage::url($permohonan->file_surat) }}" class="w-full h-96 rounded-md border border-gray-300 dark:border-gray-600"></iframe>
                </template>
            </div>
            <x-input-error for="file_surat" class="mt-2" />
        </div>
        <!-- Batas Upload Berkas -->
        
        <!-- Status Permohonan (hanya saat edit) -->
        @if($permohonan->exists)
            <div class="col-span-6"><hr class="my-2 dark:border-gray-700"></div>
            <div class="col-span-6 sm:col-span-3">
                <x-label for="status_permohonan" value="{{ __('Status Permohonan') }}" />
                 <select id="status_permohonan" wire:model="status_permohonan" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                    @foreach($opsiStatus as $opsi)
                        <option value="{{ $opsi }}">{{ $opsi }}</option>
                    @endforeach
                </select>
                <x-input-error for="status_permohonan" class="mt-2" />
            </div>
             <div class="col-span-6 sm:col-span-3">
                <x-label value="{{ __('Status Survey (Otomatis)') }}" />
                <x-input type="text" class="mt-1 block w-full bg-gray-100 dark:bg-gray-800" value="{{ $permohonan->status_survey }}" readonly />
            </div>
        @endif

    </x-slot>

    <x-slot name="actions">
        <a href="{{ route('permohonans.index') }}">
            <x-secondary-button>{{ __('Batal') }}</x-secondary-button>
        </a>
        <x-button class="ms-3">{{ __('Simpan') }}</x-button>
    </x-slot>
</x-form-section>
