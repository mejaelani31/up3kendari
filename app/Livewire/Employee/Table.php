<?php

namespace App\Livewire\Employee;

use App\Models\CompanyUnit;
use App\Models\Employee;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;

class Table extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedUnit1 = '';
    public $selectedUnit2 = '';
    public $selectedUnit3 = '';

    public function updatingSearch() { $this->resetPage(); }
    public function updatedSelectedUnit1() { $this->selectedUnit2 = ''; $this->selectedUnit3 = ''; $this->resetPage(); }
    public function updatedSelectedUnit2() { $this->selectedUnit3 = ''; $this->resetPage(); }
    public function updatedSelectedUnit3() { $this->resetPage(); }

    public function delete(Employee $employee)
    {
        // Melindungi aksi hapus
        if (Gate::denies('has-role', 'admin')) {
            session()->flash('error', 'Anda tidak memiliki izin untuk menghapus data ini.');
            return;
        }

        $employee->delete();
        session()->flash('success', 'Data karyawan berhasil dihapus.');
    }

    public function render()
    {
        // Ambil opsi filter dari CompanyUnit
        $unit1Options = CompanyUnit::select('unit1_name')->distinct()->orderBy('unit1_name')->pluck('unit1_name');
        $unit2Options = CompanyUnit::query()->when($this->selectedUnit1, fn($q) => $q->where('unit1_name', $this->selectedUnit1))
            ->whereNotNull('unit2_name')->select('unit2_name')->distinct()->orderBy('unit2_name')->pluck('unit2_name');
        $unit3Options = CompanyUnit::query()->when($this->selectedUnit1, fn($q) => $q->where('unit1_name', $this->selectedUnit1))
            ->when($this->selectedUnit2, fn($q) => $q->where('unit2_name', $this->selectedUnit2))
            ->whereNotNull('unit3_name')->select('unit3_name')->distinct()->orderBy('unit3_name')->pluck('unit3_name');

        // Menerapkan scope untuk menyaring data yang ditampilkan
        $query = Employee::query()->filterByUnitRole();

        // Query data karyawan
        // $query = Employee::query();
        $query->when($this->selectedUnit1, fn ($q) => $q->where('unit1', $this->selectedUnit1));
        $query->when($this->selectedUnit2, fn ($q) => $q->where('unit2', $this->selectedUnit2));
        $query->when($this->selectedUnit3, fn ($q) => $q->where('unit3', $this->selectedUnit3));
        $query->when($this->search, function($q) {
            $q->where('nama', 'like', '%'.$this->search.'%')
              ->orWhere('nip', 'like', '%'.$this->search.'%')
              ->orWhere('jabatan', 'like', '%'.$this->search.'%')
              ->orWhere('bidang', 'like', '%'.$this->search.'%');
        });
        
        $employees = $query->latest()->paginate(10);

        return view('livewire.employee.table', compact('employees', 'unit1Options', 'unit2Options', 'unit3Options'));
    }
}
