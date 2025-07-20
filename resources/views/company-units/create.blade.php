<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Company Unit') }}
        </h2>
    </x-slot>

    <div>
        @livewire('company-unit.form')
    </div>
</x-app-layout>
