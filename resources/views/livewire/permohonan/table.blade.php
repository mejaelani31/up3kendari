<div class="bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg p-6">
    <div class="flex flex-col sm:flex-row justify-between gap-4 mb-6">
        <div class="flex-1">
            <x-input wire:model.live.debounce.300ms="search" type="text" class="block w-full sm:w-80" placeholder="Cari nama atau ID pelanggan..."/>
        </div>
        <div class="flex items-center gap-4">
            <select wire:model.live="filterStatus" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="">Semua Status</option>
                <option value="MOHON">MOHON</option>
                <option value="BAYAR">BAYAR</option>
                <option value="CETAK PK">CETAK PK</option>
                <option value="PEREMAJAAN">PEREMAJAAN</option>
            </select>
            <a href="{{ route('permohonans.create') }}">
                 <x-button>{{ __('Buat Baru') }}</x-button>
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
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-6 py-3">Nama Pemohon</th>
                    <th class="px-6 py-3">Alamat</th>
                    <th class="px-6 py-3">Tarif & Daya</th>
                    <th class="px-6 py-3">Status Permohonan</th>
                    <th class="px-6 py-3">Status Survey</th>
                    <th class="px-6 py-3">Unit</th>
                    <th class="relative px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($permohonans as $permohonan)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $permohonan->nama_pemohon }}</td>
                        <td class="px-6 py-4">{{ Str::limit($permohonan->alamat_pemohon, 30) }}</td>
                        <td class="px-6 py-4">{{ $permohonan->tarif_permohonan }} / {{ $permohonan->daya_permohonan }}</td>
                        <td class="px-6 py-4">
                            @php
                                $statusClass = '';
                                switch ($permohonan->status_permohonan) {
                                    case 'MOHON':
                                        $statusClass = 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300';
                                        break;
                                    case 'BAYAR':
                                        $statusClass = 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300';
                                        break;
                                    case 'CETAK PK':
                                        $statusClass = 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300';
                                        break;
                                    case 'PEREMAJAAN':
                                        $statusClass = 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300';
                                        break;
                                    default:
                                        $statusClass = 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200';
                                }
                            @endphp
                            <span class="px-2 py-1 text-xs font-medium rounded-full {{ $statusClass }}">
                                {{ $permohonan->status_permohonan }}
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ $permohonan->status_survey }}</td>
                        <td class="px-6 py-4">{{ $permohonan->company_unit_name }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end space-x-4">
                                <a href="{{ route('permohonans.show', $permohonan) }}" class="text-gray-400 hover:text-blue-600" title="Lihat Detail">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                </a>
                                <a href="{{ route('permohonans.edit', $permohonan) }}" class="text-gray-400 hover:text-indigo-600" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 7.125L18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                                </a>
                                <button wire:click="delete({{ $permohonan->id }})" class="text-gray-400 hover:text-red-600" title="Hapus">
                                     <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                                </button>
                                <!-- Tambahkan ini di dalam <div class="flex items-center ..."> -->

                                @if(!$permohonan->survey)
                                    <a href="{{ route('surveys.create', $permohonan) }}" class="text-gray-400 hover:text-green-600" title="Buat Survei">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="px-6 py-4 text-center">Tidak ada data untuk ditampilkan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $permohonans->links() }}</div>
</div>
