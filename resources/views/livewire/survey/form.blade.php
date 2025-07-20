<x-form-section submit="save">
    <x-slot name="title">{{ __('Data Survei') }}</x-slot>
    <x-slot name="description">
        {{ __('Input hasil survei untuk permohonan ') }} 
        <span class="font-bold">{{ $permohonan->nama_pemohon }}</span>.
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-3">
            <x-label for="no_survey" value="{{ __('Nomor Survei (Otomatis)') }}" />
            <x-input id="no_survey" type="text" class="mt-1 block w-full bg-gray-100 dark:bg-gray-800" wire:model="no_survey" readonly />
            <x-input-error for="no_survey" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-3">
            <x-label for="tanggal_survey" value="{{ __('Tanggal Survei') }}" />
            <x-input id="tanggal_survey" type="date" class="mt-1 block w-full" wire:model="tanggal_survey" />
            <x-input-error for="tanggal_survey" class="mt-2" />
        </div>
        <div class="col-span-6">
            <x-label for="foto_survey" value="{{ __('Foto Hasil Survei (JPG/PNG)') }}" />
            <input wire:model="foto_survey" accept="image/png, image/jpeg" class="block w-full text-sm p-2.5 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 mt-1" id="foto_survey" type="file">
            <div wire:loading wire:target="foto_survey" class="text-sm text-gray-500 mt-1">Mengunggah...</div>

            <div class="mt-2">
                @if (is_object($foto_survey) && method_exists($foto_survey, 'temporaryUrl'))
                    <img src="{{ $foto_survey->temporaryUrl() }}" class="rounded-md w-full h-auto object-contain">
                @elseif($survey->foto_survey)
                    <img src="{{ Storage::url($survey->foto_survey) }}" class="rounded-md w-full h-auto object-contain">
                @endif
            </div>
            <x-input-error for="foto_survey" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <a href="{{ route('permohonans.show', $permohonan) }}">
            <x-secondary-button>{{ __('Batal') }}</x-secondary-button>
        </a>
        <x-button class="ms-3">{{ __('Simpan Survei') }}</x-button>
    </x-slot>
</x-form-section>
