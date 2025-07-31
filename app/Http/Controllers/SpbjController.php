<?php

namespace App\Http\Controllers;

use App\Models\Spbj;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SpbjController extends Controller
{
    use AuthorizesRequests;

    public function index(): View
    {
        return view('spbjs.index');
    }

    public function create(): View
    {
        return view('spbjs.create');
    }

    public function show(Spbj $spbj): View
    {
        $this->authorize('access-unit-item', $spbj);
        return view('spbjs.show', compact('spbj'));
    }

    public function edit(Spbj $spbj): View
    {
        $this->authorize('access-unit-item', $spbj);
        return view('spbjs.edit', compact('spbj'));
    }
}
