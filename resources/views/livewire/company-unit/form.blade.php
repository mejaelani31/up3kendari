<x-form-section submit="save">
    <x-slot name="title">
        {{ __('Company Unit Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Provide the details for the company unit. Unit 1 is required, while Units 2 and 3 are optional.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Unit 1 -->
        <div class="col-span-6 sm:col-span-3">
            <x-label for="unit1_name" value="{{ __('Unit Level 1') }}" />
            <x-input id="unit1_name" type="text" class="mt-1 block w-full" wire:model="unit1_name" />
            <x-input-error for="unit1_name" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-3">
            <x-label for="unit1_code" value="{{ __('Kode Unit Level 1') }}" />
            <x-input id="unit1_code" type="text" class="mt-1 block w-full" wire:model="unit1_code" />
            <x-input-error for="unit1_code" class="mt-2" />
        </div>

        <!-- Unit 2 -->
        <div class="col-span-6 sm:col-span-3">
            <x-label for="unit2_name" value="{{ __('Unit Level 2') }}" />
            <x-input id="unit2_name" type="text" class="mt-1 block w-full" wire:model="unit2_name" />
            <x-input-error for="unit2_name" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-3">
            <x-label for="unit2_code" value="{{ __('Kode Unit Level 2') }}" />
            <x-input id="unit2_code" type="text" class="mt-1 block w-full" wire:model="unit2_code" />
            <x-input-error for="unit2_code" class="mt-2" />
        </div>

        <!-- Unit 3 -->
        <div class="col-span-6 sm:col-span-3">
            <x-label for="unit3_name" value="{{ __('Unit Level 3') }}" />
            <x-input id="unit3_name" type="text" class="mt-1 block w-full" wire:model="unit3_name" />
            <x-input-error for="unit3_name" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-3">
            <x-label for="unit3_code" value="{{ __('Kode Unit Level 3') }}" />
            <x-input id="unit3_code" type="text" class="mt-1 block w-full" wire:model="unit3_code" />
            <x-input-error for="unit3_code" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <a href="{{ route('company-units.index') }}">
            <x-secondary-button>
                {{ __('Cancel') }}
            </x-secondary-button>
        </a>

        <x-button class="ms-3">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
