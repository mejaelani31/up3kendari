<?php

namespace App\Livewire\Permohonan;

use App\Models\Permohonan;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $search = '';
    public $filterStatus = '';

    public function updatingSearch() { $this->resetPage(); }
    public function updatedFilterStatus() { $this->resetPage(); }

    public function delete(Permohonan $permohonan)
    {
        if (Gate::denies('access-unit-item', $permohonan)) {
            session()->flash('error', 'Anda tidak memiliki izin untuk menghapus data ini.');
            return;
        }
        
        // Hapus berkas dari storage sebelum menghapus record dari database
        if ($permohonan->foto_lokasi) {
            Storage::disk('public')->delete($permohonan->foto_lokasi);
        }
        if ($permohonan->file_surat) {
            Storage::disk('public')->delete($permohonan->file_surat);
        }

        $permohonan->delete();
        session()->flash('success', 'Data permohonan berhasil dihapus.');
    }

    public function render()
    {
        // Panggil scope hierarki kita
        $query = Permohonan::query()->filterByUnitRole();

        // Terapkan filter tambahan
        $query->when($this->filterStatus, fn($q) => $q->where('status_permohonan', $this->filterStatus));
        $query->when($this->search, function($q) {
            $q->where('nama_pemohon', 'like', '%'.$this->search.'%')
              ->orWhere('id_pelanggan', 'like', '%'.$this->search.'%');
        });

        $permohonans = $query->latest()->paginate(10);
        
        return view('livewire.permohonan.table', [
            'permohonans' => $permohonans,
        ]);
    }
}
