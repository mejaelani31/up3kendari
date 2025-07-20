<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Data Survei') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg">
                {{-- Memanggil komponen form Livewire untuk mengedit survei --}}
                {{-- Variabel $survey dikirim dari SurveyController@edit --}}
                {{-- Kita juga mengirim permohonan induknya agar informasi tetap ada --}}
                @livewire('survey.form', ['permohonan' => $survey->permohonan, 'survey' => $survey])
            </div>
        </div>
    </div>
</x-app-layout>
