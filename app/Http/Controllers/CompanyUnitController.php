<?php

namespace App\Http\Controllers;

use App\Models\CompanyUnit;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CompanyUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        // Get all company units, paginated
        $companyUnits = CompanyUnit::latest()->paginate(10);
        
        // Return the view with the company units data
        return view('company-units.index', compact('companyUnits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        // Return the view to create a new company unit
        return view('company-units.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'unit1_name' => 'required|string|max:255',
            'unit1_code' => 'required|string|max:255|unique:company_units,unit1_code',
            'unit2_name' => 'nullable|string|max:255',
            'unit2_code' => 'nullable|string|max:255|unique:company_units,unit2_code',
            'unit3_name' => 'nullable|string|max:255',
            'unit3_code' => 'nullable|string|max:255|unique:company_units,unit3_code',
        ]);

        // Create a new CompanyUnit instance with the validated data
        CompanyUnit::create($validatedData);

        // Redirect to the index page with a success message
        return redirect()->route('company-units.index')
                         ->with('success', 'Company Unit created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompanyUnit  $companyUnit
     * @return \Illuminate\View\View
     */
    public function show(CompanyUnit $companyUnit): View
    {
        // Return the view with the specified company unit data
        return view('company-units.show', compact('companyUnit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompanyUnit  $companyUnit
     * @return \Illuminate\View\View
     */
    public function edit(CompanyUnit $companyUnit): View
    {
        // Return the view to edit the specified company unit
        return view('company-units.edit', compact('companyUnit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompanyUnit  $companyUnit
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, CompanyUnit $companyUnit): RedirectResponse
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'unit1_name' => 'required|string|max:255',
            'unit1_code' => 'required|string|max:255|unique:company_units,unit1_code,' . $companyUnit->id,
            'unit2_name' => 'nullable|string|max:255',
            'unit2_code' => 'nullable|string|max:255|unique:company_units,unit2_code,' . $companyUnit->id,
            'unit3_name' => 'nullable|string|max:255',
            'unit3_code' => 'nullable|string|max:255|unique:company_units,unit3_code,' . $companyUnit->id,
        ]);

        // Update the company unit with the validated data
        $companyUnit->update($validatedData);

        // Redirect to the index page with a success message
        return redirect()->route('company-units.index')
                         ->with('success', 'Company Unit updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompanyUnit  $companyUnit
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(CompanyUnit $companyUnit): RedirectResponse
    {
        // Delete the company unit
        $companyUnit->delete();

        // Redirect to the index page with a success message
        return redirect()->route('company-units.index')
                         ->with('success', 'Company Unit deleted successfully.');
    }
}
