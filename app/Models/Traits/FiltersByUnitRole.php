<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait FiltersByUnitRole
{
    /**
     * Scope a query to only include models within the user's unit role hierarchy.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilterByUnitRole(Builder $query): Builder
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // If no user is logged in or the user doesn't have an employee record, return nothing.
        if (!$user || !$user->employee) {
            return $query->whereRaw('1 = 0'); // A trick to return an empty result set
        }

        // If the user's system role is 'admin', bypass all filters and show all data.
        if ($user->employee->role === 'admin') {
            return $query;
        }
        
        // Get the unit_role from the logged-in user's employee data
        $userUnitRole = $user->employee->unit_role;

        // If the user has a unit_role, apply the hierarchical LIKE filter.
        if ($userUnitRole) {
            // This is the core logic:
            // It filters the query to only include records where the 'unit_role' column
            // starts with the user's own unit_role.
            return $query->where('unit_role', 'like', $userUnitRole . '%');
        }

        // If the user is not an admin and has no unit_role, return nothing.
        return $query->whereRaw('1 = 0');
    }
}