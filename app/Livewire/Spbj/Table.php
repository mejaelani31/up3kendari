<?php

namespace App\Livewire\Spbj;

use App\Models\Spbj;
use Illuminate\Support\Facades\Gate;
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

    public function delete(Spbj $spbj)
    {
        if (Gate::denies('access-unit-item', $spbj)) {
            session()->flash('error', 'Anda tidak memiliki izin untuk menghapus data ini.');
            return;
        }
        $spbj->delete();
        session()->flash('success', 'Data SPBJ berhasil dihapus.');
    }

    public function render()
    {
        $query = Spbj::query()->filterByUnitRole();

        $query->when($this->search, function ($q) {
            $q->where('no_spbj', 'like', '%' . $this->search . '%')
              ->orWhere('company_unit_name', 'like', '%' . $this->search . '%');
        });

        $spbjs = $query->latest()->paginate(10);

        return view('livewire.spbj.table', [
            'spbjs' => $spbjs,
        ]);
    }
}
