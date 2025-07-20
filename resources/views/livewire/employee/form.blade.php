<x-form-section submit="save">
    <x-slot name="title">
        {{ __('Informasi Karyawan') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Lengkapi detail data karyawan di bawah ini.') }}
    </x-slot>

    <x-slot name="form">
        <!-- NIP & Nama -->
        <div class="col-span-6 sm:col-span-3">
            <x-label for="nip" value="{{ __('NIP') }}" />
            <x-input id="nip" type="text" class="mt-1 block w-full" wire:model="nip" />
            <x-input-error for="nip" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-3">
            <x-label for="nama" value="{{ __('Nama Lengkap') }}" />
            <x-input id="nama" type="text" class="mt-1 block w-full" wire:model="nama" />
            <x-input-error for="nama" class="mt-2" />
        </div>

        <!-- Jabatan & Bidang -->
        <div class="col-span-6 sm:col-span-3">
            <x-label for="jabatan" value="{{ __('Jabatan') }}" />
            <x-input id="jabatan" type="text" class="mt-1 block w-full" wire:model="jabatan" />
            <x-input-error for="jabatan" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-3">
            <x-label for="bidang" value="{{ __('Bidang') }}" />
            <x-input id="bidang" type="text" class="mt-1 block w-full" wire:model="bidang" />
            <x-input-error for="bidang" class="mt-2" />
        </div>
        
        <!-- Unit 1 Dropdown -->
        <div class="col-span-6 sm:col-span-2">
            <x-label for="unit1" value="{{ __('Unit Level 1') }}" />
            <select id="unit1" wire:model.live="unit1" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="">Pilih Unit 1</option>
                @foreach($unit1Options as $option)
                    <option value="{{ $option }}">{{ $option }}</option>
                @endforeach
            </select>
            <x-input-error for="unit1" class="mt-2" />
        </div>

        <!-- Unit 2 Dropdown -->
        <div class="col-span-6 sm:col-span-2">
            <x-label for="unit2" value="{{ __('Unit Level 2') }}" />
            <select id="unit2" wire:model.live="unit2" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="">Pilih Unit 2</option>
                @foreach($unit2Options as $option)
                    <option value="{{ $option }}">{{ $option }}</option>
                @endforeach
            </select>
            <x-input-error for="unit2" class="mt-2" />
        </div>

        <!-- Unit 3 Dropdown -->
        <div class="col-span-6 sm:col-span-2">
            <x-label for="unit3" value="{{ __('Unit Level 3') }}" />
            <select id="unit3" wire:model.live="unit3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="">Pilih Unit 3</option>
                @foreach($unit3Options as $option)
                    <option value="{{ $option }}">{{ $option }}</option>
                @endforeach
            </select>
            <x-input-error for="unit3" class="mt-2" />
        </div>

        <!-- Role & Unit Role -->
        <div class="col-span-6 sm:col-span-3">
            <x-label for="role" value="{{ __('Role Sistem') }}" />
            <select id="role" wire:model="role" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="">Pilih Role</option>
                @foreach($roleOptions as $option)
                    <option value="{{ $option }}">{{ Str::title(str_replace('-', ' ', $option)) }}</option>
                @endforeach
            </select>
            <x-input-error for="role" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-3">
            <x-label for="unit_role" value="{{ __('Role pada Unit (Otomatis)') }}" />
            <x-input id="unit_role" type="text" class="mt-1 block w-full bg-gray-100 dark:bg-gray-800" wire:model="unit_role" readonly />
            <x-input-error for="unit_role" class="mt-2" />
        </div>

        <!-- User Account Link -->
        <div class="col-span-6">
            <x-label for="user_id" value="{{ __('Akun User Terkait (Opsional)') }}" />
            <select id="user_id" wire:model="user_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="">Tidak ada (Silahkan Daftar User Baru)</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
            <x-input-error for="user_id" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <a href="{{ route('employees.index') }}">
            <x-secondary-button>
                {{ __('Batal') }}
            </x-secondary-button>
        </a>
        <x-button class="ms-3">
            {{ __('Simpan') }}
        </x-button>
    </x-slot>
</x-form-section>
