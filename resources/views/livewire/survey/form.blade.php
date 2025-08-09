<x-form-section submit="save">
    <x-slot name="title">{{ __('Data Survei') }}</x-slot>
    <x-slot name="description">{{ __('Input hasil survei untuk permohonan ') }}<span class="font-bold">{{ $permohonan->nama_pemohon }}</span></x-slot>

    <x-slot name="form">
        <!-- Info Dasar -->
        <div class="col-span-6 sm:col-span-2">
            <x-label for="no_survey" value="{{ __('Nomor Survei (Otomatis)') }}" />
            <x-input id="no_survey" type="text" class="mt-1 block w-full bg-gray-100 dark:bg-gray-800" wire:model="no_survey" readonly />
        </div>
        <div class="col-span-6 sm:col-span-2">
            <x-label for="tanggal_survey" value="{{ __('Tanggal Survei') }}" />
            <x-input id="tanggal_survey" type="date" class="mt-1 block w-full" wire:model="tanggal_survey" />
            <x-input-error for="tanggal_survey" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-2">
            <x-label for="petugas_survey_id" value="{{ __('Petugas Survei') }}" />
            <select id="petugas_survey_id" wire:model="petugas_survey_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                <option value="">Pilih Petugas</option>
                @foreach($petugasOptions as $petugas)
                <option value="{{ $petugas->id }}">{{ $petugas->nama }}</option>
                @endforeach
            </select>
            <x-input-error for="petugas_survey_id" class="mt-2" />
        </div>

        <!-- Hasil Survey -->
        <div class="col-span-6 sm:col-span-3">
            <x-label for="koordinat_survey" value="{{ __('Koordinat Hasil Survei') }}" />
            <x-input id="koordinat_survey" type="text" class="mt-1 block w-full" wire:model="koordinat_survey" />
            <x-input-error for="koordinat_survey" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-3">
            <x-label for="hasil_survey" value="{{ __('Hasil Survei') }}" />
            <select id="hasil_survey" wire:model.live="hasil_survey" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                <option value="">Pilih Hasil</option>
                @foreach($opsiHasilSurvey as $opsi)
                <option value="{{ $opsi }}">{{ $opsi }}</option>
                @endforeach
            </select>
            <x-input-error for="hasil_survey" class="mt-2" />
        </div>

        <!-- Kebutuhan Material (Kondisional) -->
        @if(in_array($hasil_survey, ['PERLUASAN JUTR', 'PERLUASAN JUTR DAN UPRATING TRAFO', 'SISIP TRAFO', 'PERLUASAN JUTM']))
        <div class="col-span-6">
            <x-label for="kebutuhan_jutr" value="{{ __('Kebutuhan JUTR (meter)') }}" />
            <x-input id="kebutuhan_jutr" type="number" class="mt-1 block w-full" wire:model="kebutuhan_jutr" />
            <x-input-error for="kebutuhan_jutr" class="mt-2" />
        </div>
        @endif
        @if(in_array($hasil_survey, ['UPRATING TRAFO', 'PERLUASAN JUTR DAN UPRATING TRAFO', 'SISIP TRAFO', 'PERLUASAN JUTM']))
        <div class="col-span-6">
            <x-label for="kebutuhan_trafo" value="{{ __('Kebutuhan Trafo (kVA)') }}" />
            <x-input id="kebutuhan_trafo" type="number" class="mt-1 block w-full" wire:model="kebutuhan_trafo" />
            <x-input-error for="kebutuhan_trafo" class="mt-2" />
        </div>
        @endif
        @if(in_array($hasil_survey, ['PERLUASAN JUTM']))
        <div class="col-span-6">
            <x-label for="kebutuhan_jutm" value="{{ __('Kebutuhan JUTM (meter)') }}" />
            <x-input id="kebutuhan_jutm" type="number" class="mt-1 block w-full" wire:model="kebutuhan_jutm" />
            <x-input-error for="kebutuhan_jutm" class="mt-2" />
        </div>
        @endif

        <!-- Detail & Keterangan -->
        <div class="col-span-6">
            <x-label for="detail_kebutuhan" value="{{ __('Detail Kebutuhan Material') }}" />
            <textarea id="detail_kebutuhan" wire:model="detail_kebutuhan" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" placeholder="Contoh: Tiang Beton 9: 2 Buah; Tiang Beton 13: 3 Buah Dll ...."></textarea>
             <x-input-error for="detail_kebutuhan" class="mt-2" />
        </div>
        <div class="col-span-6">
            <x-label for="keterangan" value="{{ __('Keterangan Tambahan') }}" />
            <textarea id="keterangan" wire:model="keterangan" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" placeholder="Contoh: Tidak Bisa Tiang Beton, Dll ..."></textarea>
        </div>

        <!-- Baris Pertama Pengukuran -->
        <div class="col-span-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <x-label for="trafo_existing" value="{{ __('Trafo Existing / Terdekat') }}" />
                <x-input id="trafo_existing" type="text" class="mt-1 block w-full" wire:model="trafo_existing" />
                <x-input-error for="trafo_existing" class="mt-2" />
            </div>
            <div>
                <x-label for="tanggal_ukur_trafo_existing" value="{{ __('Tanggal Ukur') }}" />
                <x-input id="tanggal_ukur_trafo_existing" type="date" class="mt-1 block w-full" wire:model="tanggal_ukur_trafo_existing" />
                <x-input-error for="tanggal_ukur_trafo_existing" class="mt-2" />
            </div>
            <div>
                <x-label for="beban_trafo_existing" value="{{ __('Beban Trafo (%)') }}" />
                <x-input id="beban_trafo_existing" type="number" step="0.01" class="mt-1 block w-full" wire:model="beban_trafo_existing" />
                <x-input-error for="beban_trafo_existing" class="mt-2" />
            </div>
        </div>

        <!-- Baris Kedua Pengukuran -->
        <div class="col-span-6 grid grid-cols-1 sm:grid-cols-5 gap-4">
            <div>
                <x-label for="hasil_ukur_r" value="{{ __('Beban R (A)') }}" />
                <x-input id="hasil_ukur_r" type="number" step="0.01" class="mt-1 block w-full" wire:model="hasil_ukur_r" />
                <x-input-error for="hasil_ukur_r" class="mt-2" />
            </div>
            <div>
                <x-label for="hasil_ukur_s" value="{{ __('Beban S (A)') }}" />
                <x-input id="hasil_ukur_s" type="number" step="0.01" class="mt-1 block w-full" wire:model="hasil_ukur_s" />
                <x-input-error for="hasil_ukur_s" class="mt-2" />
            </div>
            <div>
                <x-label for="hasil_ukur_t" value="{{ __('Beban T (A)') }}" />
                <x-input id="hasil_ukur_t" type="number" step="0.01" class="mt-1 block w-full" wire:model="hasil_ukur_t" />
                <x-input-error for="hasil_ukur_t" class="mt-2" />
            </div>
            <div>
                <x-label for="hasil_ukur_n" value="{{ __('Beban N (A)') }}" />
                <x-input id="hasil_ukur_n" type="number" step="0.01" class="mt-1 block w-full" wire:model="hasil_ukur_n" />
                <x-input-error for="hasil_ukur_n" class="mt-2" />
            </div>
            <div>
                <x-label for="hasil_ukur_v" value="{{ __('Tegangan (V)') }}" />
                <x-input id="hasil_ukur_v" type="number" step="0.01" class="mt-1 block w-full" wire:model="hasil_ukur_v" />
                <x-input-error for="hasil_ukur_v" class="mt-2" />
            </div>
        </div>

        <!-- Upload Berkas -->
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
        
        <div class="col-span-6" x-data="{ pdfPreviewUrl: '' }">
            <x-label for="gambar_survey" value="{{ __('Gambar Survei (PDF)') }}" />
            <input 
                wire:model="gambar_survey" 
                @change="pdfPreviewUrl = $event.target.files.length ? URL.createObjectURL($event.target.files[0]) : ''"
                accept=".pdf" 
                class="block w-full text-sm p-2.5 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 mt-1" 
                id="gambar_survey" 
                type="file">
            <div wire:loading wire:target="gambar_survey" class="text-sm text-gray-500 mt-1">Mengunggah...</div>
            <div class="mt-2">
                <template x-if="pdfPreviewUrl">
                    <iframe :src="pdfPreviewUrl" class="w-full h-96 rounded-md border border-gray-300 dark:border-gray-600"></iframe>
                </template>
                <template x-if="!pdfPreviewUrl && '{{ $survey->gambar_survey }}'">
                    <iframe src="{{ Storage::url($survey->gambar_survey) }}" class="w-full h-96 rounded-md border border-gray-300 dark:border-gray-600"></iframe>
                </template>
            </div>
            <x-input-error for="gambar_survey" class="mt-2" />
        </div>

    </x-slot>

    <x-slot name="actions">
        <a href="{{ route('permohonans.show', $permohonan) }}">
            <x-secondary-button>{{ __('Batal') }}</x-secondary-button>
        </a>
        <x-button class="ms-3">{{ __('Simpan Survei') }}</x-button>
    </x-slot>

</x-form-section>
