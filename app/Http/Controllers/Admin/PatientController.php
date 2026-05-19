<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\BloodType;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.patients.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.patients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        return view('admin.patients.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        // 1. Necesitas obtener los datos de la base de datos
        $blood_types = BloodType::all();

        // 2. Debes incluir 'blood_types' en el compact
        return view('admin.patients.edit', compact('patient', 'blood_types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        $data = $request->validate([
            'blood_type_id' => 'nullable|exists:blood_types,id',
            'allergies' => 'nullable|string|max:255',
            'chronic_conditions' => 'nullable|string|max:255',
            'surgical_history' => 'nullable|string|max:255',
            'family_history' => 'nullable|string|max:255',
            'observations' => 'nullable|string|max:255',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'emergency_contact_relationship' => 'nullable|string|max:255',
        ], [
        // Mensajes personalizados en español por si el usuario excede el límite
        'max' => 'El campo :attribute no puede tener más de :max caracteres.',
        ]);
        $patient->update($data);
        session()->flash('swal', ['icon' => 'success', 'title' => '¡Éxito!', 'text' => 'Información del paciente actualizada correctamente.']);
        return redirect()->route('admin.patients.edit', $patient)->with('success', 'Información del paciente actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        //
    }

    protected $fillable = [
        'user',
        'blood_type_id',
        'name',
        'allergies',
        'chronic_conditions',
        'surgical_history',
        'family_history',
        'observations',
        'emergency_contact_name',
        'emergency_contact_phone',
        'emergency_contact_relationship'
    ];
    //Relación uno a uno inversa
    public function patient(){
        return $this->belongsTo(Patient::class);
    }
}
