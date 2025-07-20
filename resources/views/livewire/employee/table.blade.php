<div class="max-w-7xl mx-auto">
    <div class="bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg p-6">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <x-label for="u1" value="{{__('Unit 1')}}" />
                    <select id="u1" wire:model.live="selectedUnit1" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        <option value="">Semua</option>
                        @foreach($unit1Options as $o) <option value="{{ $o }}">{{ $o }}</option> @endforeach
                    </select>
                </div>
                <div>
                    <x-label for="u2" value="{{__('Unit 2')}}" />
                    <select id="u2" wire:model.live="selectedUnit2" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        <option value="">Semua</option>
                        @foreach($unit2Options as $o) <option value="{{ $o }}">{{ $o }}</option> @endforeach
                    </select>
                </div>
                <div>
                    <x-label for="u3" value="{{__('Unit 3')}}" />
                    <select id="u3" wire:model.live="selectedUnit3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        <option value="">Semua</option>
                        @foreach($unit3Options as $o) <option value="{{ $o }}">{{ $o }}</option> @endforeach
                    </select>
                </div>
            </div>

            <div class="flex items-end justify-between md:justify-end space-x-4">
                 <div class="w-full md:w-2/3">
                    <x-label for="search" value="{{ __('Pencarian') }}" />
                    <x-input id="search" wire:model.live.debounce.300ms="search" type="text" class="mt-1 block w-full" placeholder="Cari nama, nip..."/>
                </div>
                <a href="{{ route('employees.create') }}">
                     <x-button class="h-10">
                        {{ __('Buat Baru') }}
                    </x-button>
                </a>
            </div>
        </div>

        @if (session()->has('success'))
            <div class="mb-4 p-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-green-900 dark:text-green-300" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-red-900 dark:text-red-300" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">NIP</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Jabatan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Unit Induk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Unit Pelaksana</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Unit Layanan</th>
                        <th class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($employees as $employee)
                        <tr class="text-gray-700 dark:text-gray-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $employee->nip }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $employee->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $employee->jabatan ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $employee->unit1 ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $employee->unit2 ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $employee->unit3 ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-4">
                                    <a href="{{ route('employees.edit', $employee) }}" class="text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                                    </a>
                                    <button wire:click="delete({{ $employee->id }})" wire:confirm="Anda yakin ingin menghapus data ini?" class="text-gray-400 hover:text-red-600 dark:hover:text-red-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 text-center">Tidak ada data karyawan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $employees->links() }}</div>
    </div>
</div>
