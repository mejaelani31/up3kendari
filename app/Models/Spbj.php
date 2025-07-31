<?php

namespace App\Models;

use App\Models\Traits\FiltersByUnitRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spbj extends Model
{
    use HasFactory, FiltersByUnitRole;

    protected $fillable = [
        'no_spbj',
        'tanggal',
        'user_email',
        'employee_nip',
        'unit_role',
        'company_unit_name',
    ];
}
