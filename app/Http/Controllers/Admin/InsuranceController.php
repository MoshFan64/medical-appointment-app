<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Insurance;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    public function index()
    {
        $insurances = Insurance::orderBy('company_name', 'asc')->get();
        return view('admin.insurances.index', compact('insurances'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name'        => 'required|string|max:100',
            'agreement_code'      => 'required|string|max:50|unique:insurances,agreement_code',
            'coverage_percentage' => 'required|integer|min:0|max:100',
            'notes'               => 'nullable|string|max:1000',
        ], [
            'company_name.required'        => 'El nombre de la aseguradora es obligatorio.',
            'agreement_code.required'      => 'El código de convenio es requerido.',
            'agreement_code.unique'        => 'Este código de convenio ya se encuentra registrado.',
            'coverage_percentage.required' => 'Debe especificar un porcentaje de cobertura.',
            'coverage_percentage.max'      => 'El porcentaje de cobertura máximo no puede exceder el 100%.',
        ]);

        Insurance::create([
            'company_name'        => $validated['company_name'],
            'agreement_code'      => strtoupper($validated['agreement_code']), // Normalización a mayúsculas
            'coverage_percentage' => $validated['coverage_percentage'],
            'notes'               => $validated['notes'],
            'is_active'           => $request->has('is_active'),
        ]);

        return redirect()->route('admin.insurances.index')
            ->with('info', 'El convenio de seguro ha sido registrado exitosamente en el sistema.');
    }
}