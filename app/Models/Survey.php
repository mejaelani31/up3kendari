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
        // Kolom baru
        'trafo_existing',
        'tanggal_ukur_trafo_existing',
        'beban_trafo_existing',
        'hasil_ukur_r',
        'hasil_ukur_s',
        'hasil_ukur_t',
        'hasil_ukur_n', // <-- Tambahkan ini
        'hasil_ukur_v',
        
    ];

    public function permohonan(): BelongsTo
    {
        return $this->belongsTo(Permohonan::class);
    }

    public function petugasSurvey(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'petugas_survey_id');
    }
}
