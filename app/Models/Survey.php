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
        'unit_role',
    ];

    /**
     * Mendapatkan permohonan yang memiliki survei ini.
     */
    public function permohonan(): BelongsTo
    {
        return $this->belongsTo(Permohonan::class);
    }
}
