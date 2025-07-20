<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PermohonanController extends Controller
{
    use AuthorizesRequests;

    public function index(): View
    {
        return view('permohonans.index');
    }

    public function create(): View
    {
        return view('permohonans.create');
    }

    public function edit(Permohonan $permohonan): View
    {
        $this->authorize('access-unit-item', $permohonan);
        return view('permohonans.edit', compact('permohonan'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Permohonan $permohonan): View
    {
        // Melindungi halaman dari akses ilegal via URL
        $this->authorize('access-unit-item', $permohonan);
        return view('permohonans.show', compact('permohonan'));
    }
}
