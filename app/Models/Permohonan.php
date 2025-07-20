<?php

namespace App\Models;

use App\Models\Traits\FiltersByUnitRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    use HasFactory, FiltersByUnitRole;

    protected $fillable = [
        'id_pelanggan',
        'jenis_permohonan',
        'nama_pemohon',
        'alamat_pemohon',
        'no_hp_pemohon',
        'titik_koordinat',
        'tarif_lama',
        'daya_lama',
        'tarif_permohonan',
        'daya_permohonan',
        'status_permohonan',
        'status_survey',
        'foto_lokasi',       // Tambahkan ini
        'file_surat',        // Tambahkan ini
        'user_email',
        'employee_nip',
        'unit_role',         // Pastikan nama kolom sudah standar
        'company_unit_name',
    ];

    public function survey()
    {
        return $this->hasOne(Survey::class);
    }
}
