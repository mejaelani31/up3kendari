<?php

namespace App\Livewire\Survey;

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

    public $no_survey;
    public $tanggal_survey;
    public $foto_survey;

    public function mount(Permohonan $permohonan, Survey $survey = null)
    {
        $this->permohonan = $permohonan;
        $this->survey = $survey ?: new Survey();

        if ($this->survey->exists) {
            $this->no_survey = $this->survey->no_survey;
            $this->tanggal_survey = $this->survey->tanggal_survey;
        } else {
            // Generate data untuk survei baru
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
            'foto_survey' => 'nullable|image|max:2048',
        ];
    }

    public function save()
    {
        $dataToSave = $this->validate();

        $dataToSave = collect($dataToSave)->except(['foto_survey'])->toArray();

        if ($this->foto_survey) {
            if ($this->survey->foto_survey) Storage::disk('public')->delete($this->survey->foto_survey);

            $idPermohonan = $this->permohonan->id;
            $namaFoto = "SURVEY_{$idPermohonan}_{$this->no_survey}." . $this->foto_survey->extension();
            $dataToSave['foto_survey'] = $this->foto_survey->storeAs('surveys', $namaFoto, 'public');
        }

        if ($this->survey->exists) {
            $this->survey->update($dataToSave);
        } else {
            // Isi data relasi dan hak akses untuk survei baru
            $dataToSave['permohonan_id'] = $this->permohonan->id;
            $dataToSave['unit_role'] = $this->permohonan->unit_role;
            Survey::create($dataToSave);

            // Update status di tabel permohonan induknya
            $this->permohonan->update(['status_survey' => '10 : Survey Selesai']);
        }
        
        session()->flash('success', 'Data survei berhasil disimpan.');
        return redirect()->route('permohonans.show', $this->permohonan);
    }


    public function render()
    {
        return view('livewire.survey.form');
    }
}
