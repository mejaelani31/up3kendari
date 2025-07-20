<?php

namespace App\Livewire\CompanyUnit;

use App\Models\CompanyUnit;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedUnit1 = '';
    public $selectedUnit2 = '';
    public $selectedUnit3 = '';

    // Reset pagination when searching
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    // When selectedUnit1 is updated, reset subsequent filters and pagination
    public function updatedSelectedUnit1()
    {
        $this->selectedUnit2 = '';
        $this->selectedUnit3 = '';
        $this->resetPage();
    }

    // When selectedUnit2 is updated, reset the last filter and pagination
    public function updatedSelectedUnit2()
    {
        $this->selectedUnit3 = '';
        $this->resetPage();
    }
    
    // When selectedUnit3 is updated, just reset pagination
    public function updatedSelectedUnit3()
    {
        $this->resetPage();
    }

    public function delete(CompanyUnit $companyUnit)
    {
        $companyUnit->delete();
        session()->flash('success', 'Unit berhasil dihapus.');
    }

    public function render()
    {
        // === Get Filter Options ===
        // Get all unique unit 1 names for the first dropdown
        $unit1Options = CompanyUnit::query()->select('unit1_name')->distinct()->orderBy('unit1_name')->pluck('unit1_name');
        
        // Get unit 2 options, filtered by unit 1 if selected
        $unit2OptionsQuery = CompanyUnit::query()->whereNotNull('unit2_name')->select('unit2_name')->distinct();
        if ($this->selectedUnit1) {
            $unit2OptionsQuery->where('unit1_name', $this->selectedUnit1);
        }
        $unit2Options = $unit2OptionsQuery->orderBy('unit2_name')->pluck('unit2_name');

        // Get unit 3 options, filtered by unit 1 and 2 if selected
        $unit3OptionsQuery = CompanyUnit::query()->whereNotNull('unit3_name')->select('unit3_name')->distinct();
        if ($this->selectedUnit1) {
            $unit3OptionsQuery->where('unit1_name', $this->selectedUnit1);
        }
        if ($this->selectedUnit2) {
            $unit3OptionsQuery->where('unit2_name', $this->selectedUnit2);
        }
        $unit3Options = $unit3OptionsQuery->orderBy('unit3_name')->pluck('unit3_name');


        // === Build Table Query ===
        $query = CompanyUnit::query();

        // Apply dropdown filters
        $query->when($this->selectedUnit1, fn ($q) => $q->where('unit1_name', $this->selectedUnit1));
        $query->when($this->selectedUnit2, fn ($q) => $q->where('unit2_name', $this->selectedUnit2));
        $query->when($this->selectedUnit3, fn ($q) => $q->where('unit3_name', $this->selectedUnit3));

        // Apply text search across multiple fields
        if ($this->search) {
             $query->where(function($q) {
                $q->where('unit1_name', 'like', '%'.$this->search.'%')
                  ->orWhere('unit1_code', 'like', '%'.$this->search.'%')
                  ->orWhere('unit2_name', 'like', '%'.$this->search.'%')
                  ->orWhere('unit2_code', 'like', '%'.$this->search.'%')
                  ->orWhere('unit3_name', 'like', '%'.$this->search.'%')
                  ->orWhere('unit3_code', 'like', '%'.$this->search.'%');
            });
        }
        
        $companyUnits = $query->latest()->paginate(10);

        return view('livewire.company-unit.table', [
            'companyUnits' => $companyUnits,
            'unit1Options' => $unit1Options,
            'unit2Options' => $unit2Options,
            'unit3Options' => $unit3Options,
        ]);
    }
}
