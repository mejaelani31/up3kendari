<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // 1. Import Trait
use Illuminate\View\View;

class EmployeeController extends Controller
{
    use AuthorizesRequests; // 2. Gunakan Trait di sini

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('employees.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('employees.create');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee): View
    {
        // Melindungi halaman dari akses ilegal via URL
        // Sekarang metode authorize() akan tersedia.
        $this->authorize('has-role', 'admin');

        return view('employees.edit', compact('employee'));
    }
}
