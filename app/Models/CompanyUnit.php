<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyUnit extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'unit1_name',
        'unit1_code',
        'unit2_name',
        'unit2_code',
        'unit3_name',
        'unit3_code',
    ];
}