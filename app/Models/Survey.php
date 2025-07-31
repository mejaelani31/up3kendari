<?php

namespace App\Models;

use App\Models\Traits\FiltersByUnitRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Survey extends Model
{
    use HasFactory, FiltersByUnitRole;

    protected $fillable = [
        'permohonan_id',
        'no_survey',
        'tanggal_survey',
        'foto_survey',
        'petugas_survey_id',
        'koordinat_survey',
        'hasil_survey',
        'gambar_survey',
        'kebutuhan_jutr',
        'kebutuhan_trafo',
        'kebutuhan_jutm',
        'detail_kebutuhan',
        'keterangan',
        'user_email',
        'employee_nip',
        'unit_role',
        'company_unit_name',
    ];

    /**
     * Mendapatkan permohonan yang memiliki survei ini.
     */
    public function permohonan(): BelongsTo
    {
        return $this->belongsTo(Permohonan::class);
    }

    /**
     * Mendapatkan data petugas (employee) yang melakukan survei.
     */
    public function petugasSurvey(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'petugas_survey_id');
    }
}
