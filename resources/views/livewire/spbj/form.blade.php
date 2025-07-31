<x-form-section submit="save">
    <x-slot name="title">{{ __('Informasi SPBJ') }}</x-slot>
    <x-slot name="description">{{ __('Lengkapi detail untuk Surat Perjanjian Borongan Jasa.') }}</x-slot>
    <x-slot name="form">
        <div class="col-span-6 sm:col-span-3">
            <x-label for="no_spbj" value="{{ __('Nomor SPBJ (Otomatis)') }}" />
            <x-input id="no_spbj" type="text" class="mt-1 block w-full bg-gray-100 dark:bg-gray-800" wire:model="no_spbj" readonly />
        </div>
        <div class="col-span-6 sm:col-span-3">
            <x-label for="tanggal" value="{{ __('Tanggal') }}" />
            <x-input id="tanggal" type="date" class="mt-1 block w-full" wire:model="tanggal" />
            <x-input-error for="tanggal" class="mt-2" />
        </div>
    </x-slot>
    <x-slot name="actions">
        <a href="{{ route('spbjs.index') }}">
            <x-secondary-button>{{ __('Batal') }}</x-secondary-button>
        </a>
        <x-button class="ms-3">{{ __('Simpan') }}</x-button>
    </x-slot>
</x-form-section>
