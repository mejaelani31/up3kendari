<?php

namespace App\Livewire\Permohonan;

use App\Models\Permohonan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str; // 1. Import Str helper

class Form extends Component
{
    use WithFileUploads;

    public Permohonan $permohonan;

    // Properti untuk unggahan berkas baru
    public $foto_lokasi;
    public $file_surat;
    
    // Properti lainnya
    public $id_pelanggan, $jenis_permohonan, $nama_pemohon, $alamat_pemohon, $no_hp_pemohon,
           $titik_koordinat, $tarif_lama, $daya_lama, $tarif_permohonan, $daya_permohonan, $status_permohonan;

    // Opsi untuk dropdown
    public $opsiJenis = ['PASANG BARU', 'TAMBAH DAYA'];
    public $opsiTarif = ['R - Rumah Tangga', 'B - Bisnis', 'I - Industri', 'S - Sosial', 'P - Publik'];
    public $opsiDaya = ['900', '1300', '2200', '3500', '4400', '5500', '7700', '6600', '10600', '11000', '13200', '16500', '23000', '33000', '41500', '53000', '66000', '82500', '105000', '131000', '147000', '164000', '197000'];
    public $opsiStatus = ['MOHON', 'BAYAR', 'CETAK PK', 'PEREMAJAAN'];

    public function mount(Permohonan $permohonan)
    {
        $this->permohonan = $permohonan;

        if ($this->permohonan->exists) {
            $this->fill(
                $this->permohonan->only([
                    'id_pelanggan', 'jenis_permohonan', 'nama_pemohon', 'alamat_pemohon', 'no_hp_pemohon',
                    'titik_koordinat', 'tarif_lama', 'daya_lama', 'tarif_permohonan', 'daya_permohonan', 'status_permohonan'
                ])
            );
        } else {
            // Set nilai default untuk permohonan baru
            $this->jenis_permohonan = 'PASANG BARU';
            $this->status_permohonan = 'MOHON';
            $this->tarif_permohonan = $this->opsiTarif[0];
            $this->daya_permohonan = $this->opsiDaya[0];
        }
    }

    public function updatedJenisPermohonan($value)
    {
        if ($value === 'TAMBAH DAYA') {
            if (empty($this->tarif_lama)) $this->tarif_lama = $this->opsiTarif[0];
            if (empty($this->daya_lama)) $this->daya_lama = $this->opsiDaya[0];
        } else {
            $this->tarif_lama = null;
            $this->daya_lama = null;
        }
    }

    public function rules()
    {
        return [
            'id_pelanggan' => 'nullable|string|max:50',
            'jenis_permohonan' => 'required|string',
            'nama_pemohon' => 'required|string|max:100',
            'alamat_pemohon' => 'required|string',
            'no_hp_pemohon' => 'required|string|max:20',
            'titik_koordinat' => 'nullable|string|max:100',
            'tarif_lama' => 'required_if:jenis_permohonan,TAMBAH DAYA|nullable|string',
            'daya_lama' => 'required_if:jenis_permohonan,TAMBAH DAYA|nullable|string',
            'tarif_permohonan' => 'required|string',
            'daya_permohonan' => 'required|string',
            'status_permohonan' => 'required|string',
            'foto_lokasi' => 'nullable|image|max:2048', 
            'file_surat' => 'nullable|mimes:pdf|max:5120',
        ];
    }
    
    public function save()
    {
        $validatedData = $this->validate();
        
        $dataToSave = collect($validatedData)->except(['foto_lokasi', 'file_surat'])->toArray();

        // 2. Logika Penamaan Berkas Kustom
        $idPelanggan = Str::slug($this->id_pelanggan ?: 'NO-ID');
        $namaPemohon = Str::slug($this->nama_pemohon);

        if ($this->foto_lokasi) {
            if ($this->permohonan->foto_lokasi) Storage::disk('public')->delete($this->permohonan->foto_lokasi);
            
            $namaFoto = "{$idPelanggan}_{$namaPemohon}_Foto_Lokasi." . $this->foto_lokasi->extension();
            $dataToSave['foto_lokasi'] = $this->foto_lokasi->storeAs('permohonan/fotos', $namaFoto, 'public');
        }

        if ($this->file_surat) {
            if ($this->permohonan->file_surat) Storage::disk('public')->delete($this->permohonan->file_surat);
            
            $namaSurat = "{$idPelanggan}_{$namaPemohon}_Surat_Permohonan." . $this->file_surat->extension();
            $dataToSave['file_surat'] = $this->file_surat->storeAs('permohonan/surat', $namaSurat, 'public');
        }
        
        if (!$this->permohonan->exists) {
            $user = Auth::user();
            $employee = $user->employee;
            
            $dataToSave['user_email'] = $user->email;
            $dataToSave['employee_nip'] = $employee->nip;
            $dataToSave['unit_role'] = $employee->unit_role;
            $dataToSave['company_unit_name'] = $employee->unit3;
        }

        if ($this->permohonan->exists) {
            $this->permohonan->update($dataToSave);
        } else {
            Permohonan::create($dataToSave);
        }
        
        session()->flash('success', 'Data permohonan berhasil disimpan.');
        return redirect()->route('permohonans.index');
    }

    public function render()
    {
        return view('livewire.permohonan.form');
    }
}
