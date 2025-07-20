<?php

namespace App\Livewire\CompanyUnit;

use App\Models\CompanyUnit;
use Livewire\Component;

class Form extends Component
{
    public CompanyUnit $companyUnit;

    public $unit1_name = '';
    public $unit1_code = '';
    public $unit2_name = '';
    public $unit2_code = '';
    public $unit3_name = '';
    public $unit3_code = '';

    public function mount(CompanyUnit $companyUnit)
    {
        $this->companyUnit = $companyUnit;
        
        // Populate form fields if the model already exists (i.e., we are editing)
        if ($this->companyUnit->exists) {
            $this->unit1_name = $companyUnit->unit1_name;
            $this->unit1_code = $companyUnit->unit1_code;
            $this->unit2_name = $companyUnit->unit2_name;
            $this->unit2_code = $companyUnit->unit2_code;
            $this->unit3_name = $companyUnit->unit3_name;
            $this->unit3_code = $companyUnit->unit3_code;
        }
    }

    public function rules()
    {
        $unitId = $this->companyUnit->id; // Can be null if creating
        return [
            'unit1_name' => 'required|string|max:255',
            'unit1_code' => 'required|string|max:255',
            'unit2_name' => 'nullable|string|max:255',
            'unit2_code' => 'nullable|string|max:255',
            'unit3_name' => 'nullable|string|max:255',
            'unit3_code' => 'nullable|string|max:255',
        ];
    }

    public function save()
    {
        $validatedData = $this->validate();

        // Use the exists property to check if we are updating or creating
        if ($this->companyUnit->exists) {
            // Update existing model
            $this->companyUnit->update($validatedData);
            session()->flash('success', 'Company Unit updated successfully.');
        } else {
            // Create new model
            CompanyUnit::create($validatedData);
            session()->flash('success', 'Company Unit created successfully.');
        }

        return $this->redirect(route('company-units.index'));
    }

    public function render()
    {
        return view('livewire.company-unit.form');
    }
}
