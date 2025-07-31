<?php

namespace App\Livewire\Spbj;

use App\Models\Spbj;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Form extends Component
{
    public Spbj $spbj;

    public $no_spbj;
    public $tanggal;

    public function mount(Spbj $spbj = null)
    {
        $this->spbj = $spbj ?: new Spbj();

        if ($this->spbj->exists) {
            $this->no_spbj = $this->spbj->no_spbj;
            $this->tanggal = $this->spbj->tanggal;
        } else {
            $this->tanggal = now()->format('Y-m-d');
            $this->no_spbj = $this->generateSpbjNumber();
        }
    }

    private function generateSpbjNumber(): string
    {
        $today = Carbon::now();
        $prefix = $today->format('Ymd');
        $lastSpbj = Spbj::where('no_spbj', 'like', $prefix . '%')->latest('no_spbj')->first();

        $newNumber = $lastSpbj ? ((int) substr($lastSpbj->no_spbj, -3)) + 1 : 1;

        return $prefix . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    public function rules()
    {
        return [
            'no_spbj' => 'required|string|unique:spbjs,no_spbj,' . $this->spbj->id,
            'tanggal' => 'required|date',
        ];
    }

    public function save()
    {
        $dataToSave = $this->validate();

        if ($this->spbj->exists) {
            $this->spbj->update($dataToSave);
        } else {
            $user = Auth::user();
            $employee = $user->employee;

            $dataToSave['user_email'] = $user->email;
            $dataToSave['employee_nip'] = $employee->nip;
            $dataToSave['unit_role'] = $employee->unit_role;
            $dataToSave['company_unit_name'] = $employee->unit3; // Asumsi dari unit 3

            Spbj::create($dataToSave);
        }

        session()->flash('success', 'Data SPBJ berhasil disimpan.');
        return redirect()->route('spbjs.index');
    }

    public function render()
    {
        return view('livewire.spbj.form');
    }
}
