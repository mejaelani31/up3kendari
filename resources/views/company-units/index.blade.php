<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Company Units') }}
        </h2>
    </x-slot>

    <div>
        @livewire('company-unit.table')
    </div>
</x-app-layout>
