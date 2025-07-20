<?php

namespace App\Livewire\Employee;

use App\Models\CompanyUnit;
use App\Models\Employee;
use App\Models\User;
use Livewire\Component;

class Form extends Component
{
    public Employee $employee;

    // Form fields
    public $user_id = '';
    public $nip = '';
    public $nama = '';
    public $bidang = '';
    public $jabatan = '';
    public $unit1 = '';
    public $unit2 = '';
    public $unit3 = '';
    public $role = '';
    public $unit_role = '';

    // Options for dropdowns
    public $unit2Options = [];
    public $unit3Options = [];
    public $roleOptions = ['team-leader', 'manager', 'admin', 'pegawai'];

    public function mount(Employee $employee)
    {
        $this->employee = $employee;
        
        if ($this->employee->exists) {
            $this->user_id = $this->employee->user_id;
            $this->nip = $this->employee->nip;
            $this->nama = $this->employee->nama;
            $this->bidang = $this->employee->bidang;
            $this->jabatan = $this->employee->jabatan;
            $this->unit1 = $this->employee->unit1;
            $this->unit2 = $this->employee->unit2;
            $this->unit3 = $this->employee->unit3;
            $this->role = $this->employee->role;
            $this->unit_role = $this->employee->unit_role;
            
            if ($this->unit1) {
                $this->unit2Options = CompanyUnit::where('unit1_name', $this->unit1)->whereNotNull('unit2_name')->select('unit2_name')->distinct()->pluck('unit2_name');
            }
            if ($this->unit2) {
                $this->unit3Options = CompanyUnit::where('unit1_name', $this->unit1)->where('unit2_name', $this->unit2)->whereNotNull('unit3_name')->select('unit3_name')->distinct()->pluck('unit3_name');
            }
        }
    }

    public function rules()
    {
        return [
            'user_id' => 'nullable|exists:users,id|unique:employees,user_id,' . $this->employee->id,
            'nip' => 'required|string|max:255|unique:employees,nip,' . $this->employee->id,
            'nama' => 'required|string|max:255',
            'bidang' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'unit1' => 'nullable|string|max:255',
            'unit2' => 'nullable|string|max:255',
            'unit3' => 'nullable|string|max:255',
            'role' => 'nullable|string|max:255',
            'unit_role' => 'nullable|string|max:255',
        ];
    }

    public function updatedUnit1($value)
    {
        $this->unit2Options = CompanyUnit::where('unit1_name', $value)->whereNotNull('unit2_name')->select('unit2_name')->distinct()->pluck('unit2_name');
        $this->unit2 = '';
        $this->unit3Options = [];
        $this->unit3 = '';
        $this->unit_role = '';
    }

    public function updatedUnit2($value)
    {
        $this->unit3Options = CompanyUnit::where('unit1_name', $this->unit1)->where('unit2_name', $value)->whereNotNull('unit3_name')->select('unit3_name')->distinct()->pluck('unit3_name');
        $this->unit3 = '';
        $this->unit_role = '';
    }
    
    public function updatedUnit3($value)
    {
        if (empty($value)) {
            $this->unit_role = '';
            return;
        }
        $unit = CompanyUnit::where('unit1_name', $this->unit1)->where('unit2_name', $this->unit2)->where('unit3_name', $value)->first();
        $this->unit_role = $unit ? $unit->unit3_code : '';
    }
    
    public function save()
    {
        $validatedData = $this->validate();
        
        // **FIX**: Convert empty string for user_id to null before saving.
        // This prevents the foreign key constraint violation.
        if (empty($validatedData['user_id'])) {
            $validatedData['user_id'] = null;
        }
        
        if ($this->employee->exists) {
            $this->employee->update($validatedData);
            session()->flash('success', 'Data karyawan berhasil diperbarui.');
        } else {
            Employee::create($validatedData);
            session()->flash('success', 'Data karyawan berhasil dibuat.');
        }
        return redirect()->route('employees.index');
    }

    public function render()
    {
        $users = User::whereDoesntHave('employee')
                     ->orWhere('id', $this->employee->user_id)
                     ->orderBy('name')
                     ->get();

        $unit1Options = CompanyUnit::select('unit1_name')->distinct()->orderBy('unit1_name')->pluck('unit1_name');
        
        return view('livewire.employee.form', compact('users', 'unit1Options'));
    }
}
