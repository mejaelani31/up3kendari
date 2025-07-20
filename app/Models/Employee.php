<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Traits\FiltersByUnitRole; // Import Trait

class Employee extends Model
{
    use HasFactory, FiltersByUnitRole; // Gunakan Trait di sini

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'nip',
        'nama',
        'bidang',
        'jabatan',
        'unit1',
        'unit2',
        'unit3',
        'role',
        'unit_role',
    ];

    /**
     * Get the user that owns the employee.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
