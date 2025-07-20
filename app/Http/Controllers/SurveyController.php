<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use App\Models\Survey;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SurveyController extends Controller
{
    use AuthorizesRequests;

    public function index(): View
    {
        return view('surveys.index');
    }

    /**
     * Tampilkan form untuk membuat survei BARU untuk permohonan tertentu.
     */
    public function create(Permohonan $permohonan): View
    {
        // Pastikan permohonan ini belum punya survei
        if ($permohonan->survey) {
            abort(403, 'Permohonan ini sudah memiliki data survei.');
        }

        // Periksa hak akses ke permohonan induknya
        $this->authorize('access-unit-item', $permohonan);

        return view('surveys.create', compact('permohonan'));
    }

    public function show(Survey $survey): View
    {
        $this->authorize('access-unit-item', $survey);
        return view('surveys.show', compact('survey'));
    }

    public function edit(Survey $survey): View
    {
        $this->authorize('access-unit-item', $survey);
        return view('surveys.edit', compact('survey'));
    }
}
