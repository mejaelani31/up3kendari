<?php

namespace App\Livewire\Survey;

use App\Models\Employee;
use App\Models\Permohonan;
use App\Models\Survey;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Form extends Component
{
    use WithFileUploads;

    public Permohonan $permohonan;
    public Survey $survey;

    // Properti Form
    public $no_survey, $tanggal_survey, $foto_survey, $petugas_survey_id, $koordinat_survey,
           $hasil_survey, $gambar_survey, $kebutuhan_jutr, $kebutuhan_trafo,
           $kebutuhan_jutm, $detail_kebutuhan, $keterangan;

    // Opsi untuk dropdown
    public $opsiHasilSurvey = [
        'LAYAK SAMBUNG',
        'PERLUASAN JUTR',
        'UPRATING TRAFO',
        'PERLUASAN JUTR DAN UPRATING TRAFO',
        'SISIP TRAFO',
        'PERLUASAN JUTM',
    ];

    public function mount(Permohonan $permohonan, Survey $survey = null)
    {
        $this->permohonan = $permohonan;
        $this->survey = $survey ?: new Survey();

        if ($this->survey->exists) {
            // PERBAIKAN #1: Hanya isi properti selain unggahan berkas.
            $this->fill($this->survey->only([
                'no_survey', 'tanggal_survey', 'petugas_survey_id', 'koordinat_survey',
                'hasil_survey', 'kebutuhan_jutr', 'kebutuhan_trafo', 'kebutuhan_jutm',
                'detail_kebutuhan', 'keterangan'
            ]));
        } else {
            $this->tanggal_survey = now()->format('Y-m-d');
            $this->no_survey = $this->generateSurveyNumber();
        }
    }
    
    private function generateSurveyNumber(): string
    {
        $today = Carbon::now();
        $prefix = $today->format('Ymd');
        $lastSurvey = Survey::where('no_survey', 'like', $prefix . '%')->latest('no_survey')->first();

        if ($lastSurvey) {
            $lastNumber = (int) substr($lastSurvey->no_survey, -3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return $prefix . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    public function rules()
    {
        return [
            'no_survey' => 'required|string|unique:surveys,no_survey,' . $this->survey->id,
            'tanggal_survey' => 'required|date',
            'petugas_survey_id' => 'required|exists:employees,id',
            'koordinat_survey' => 'nullable|string|max:100',
            'hasil_survey' => 'required|string',
            'foto_survey' => 'nullable|image|max:2048',
            'gambar_survey' => 'nullable|mimes:pdf|max:5120',
            'detail_kebutuhan' => 'required_unless:hasil_survey,LAYAK SAMBUNG|nullable|string',
            'kebutuhan_jutr' => 'required_if:hasil_survey,PERLUASAN JUTR|required_if:hasil_survey,PERLUASAN JUTR DAN UPRATING TRAFO|required_if:hasil_survey,SISIP TRAFO|required_if:hasil_survey,PERLUASAN JUTM|nullable|integer',
            'kebutuhan_trafo' => 'required_if:hasil_survey,UPRATING TRAFO|required_if:hasil_survey,PERLUASAN JUTR DAN UPRATING TRAFO|required_if:hasil_survey,SISIP TRAFO|required_if:hasil_survey,PERLUASAN JUTM|nullable|integer',
            'kebutuhan_jutm' => 'required_if:hasil_survey,PERLUASAN JUTM|nullable|integer',
            'keterangan' => 'nullable|string',
        ];
    }

    public function save()
    {
        $validatedData = $this->validate();
        
        // PERBAIKAN #2: Siapkan data untuk disimpan, KECUALI field berkas.
        $dataToSave = collect($validatedData)->except(['foto_survey', 'gambar_survey'])->toArray();

        if ($this->foto_survey) {
            if ($this->survey->foto_survey) Storage::disk('public')->delete($this->survey->foto_survey);
            $namaFoto = "SURVEY_FOTO_{$this->no_survey}." . $this->foto_survey->extension();
            $dataToSave['foto_survey'] = $this->foto_survey->storeAs('surveys/foto', $namaFoto, 'public');
        }
        
        if ($this->gambar_survey) {
            if ($this->survey->gambar_survey) Storage::disk('public')->delete($this->survey->gambar_survey);
            $namaGambar = "SURVEY_GAMBAR_{$this->no_survey}." . $this->gambar_survey->extension();
            $dataToSave['gambar_survey'] = $this->gambar_survey->storeAs('surveys/gambar', $namaGambar, 'public');
        }

        if ($this->survey->exists) {
            $this->survey->update($dataToSave);
        } else {
            $dataToSave['permohonan_id'] = $this->permohonan->id;
            $dataToSave['unit_role'] = $this->permohonan->unit_role;
            Survey::create($dataToSave);
            $this->permohonan->update(['status_survey' => '10: Survey Selesai']);
        }
        
        session()->flash('success', 'Data survei berhasil disimpan.');
        return redirect()->route('permohonans.show', $this->permohonan);
    }

    public function render()
    {
        // Ambil daftar karyawan yang berada di bawah unit_role permohonan
        $petugasOptions = Employee::where('unit_role', 'like', $this->permohonan->unit_role . '%')
                                  ->orderBy('nama')
                                  ->get();

        return view('livewire.survey.form', [
            'petugasOptions' => $petugasOptions
        ]);
    }
}
