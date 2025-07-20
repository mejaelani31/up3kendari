<?php

namespace App\Livewire\Survey;

use App\Models\Survey;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete(Survey $survey)
    {
        // Otorisasi sebelum menghapus
        if (Gate::denies('access-unit-item', $survey)) {
            session()->flash('error', 'Anda tidak memiliki izin untuk menghapus data ini.');
            return;
        }

        // Hapus berkas dari storage
        if ($survey->foto_survey) {
            Storage::disk('public')->delete($survey->foto_survey);
        }

        $survey->delete();
        session()->flash('success', 'Data survei berhasil dihapus.');
    }

    public function render()
    {
        // Mulai query dengan filter hak akses unit
        $query = Survey::with('permohonan')->filterByUnitRole();

        // Terapkan filter pencarian
        $query->when($this->search, function($q) {
            $q->where('no_survey', 'like', '%' . $this->search . '%')
              ->orWhereHas('permohonan', function ($subQuery) {
                  $subQuery->where('nama_pemohon', 'like', '%' . $this->search . '%');
              });
        });

        $surveys = $query->latest()->paginate(10);

        return view('livewire.survey.table', [
            'surveys' => $surveys,
        ]);
    }
}
