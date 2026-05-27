<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Specialty;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function edit(Doctor $doctor)
    {
        // Cargamos el catálogo de especialidades para el componente Select de WireUI
        $specialties = Specialty::all();

        return view('admin.doctors.edit', compact('doctor', 'specialties'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $validated = $request->validate([
            'specialty_id'  => 'required|exists:specialties,id',
            'medical_license_number' => 'required|string|max:50|unique:doctors,medical_license_number,' . $doctor->id,
            'phone_clinic'   => 'nullable|string|max:20',
            'biography'      => 'nullable|string|max:1500',
            'is_active'      => 'sometimes|boolean',
            'profile_photo'   => 'nullable|image|max:2048', // Máximo 2MB
        ], [
            'license_number.unique' => 'Esta cédula profesional ya está registrada en el sistema.',
            'specialty_id.required' => 'Debe seleccionar una especialidad del catálogo.',
            'max' => 'El campo supera el límite de :max caracteres asignado.',
        ]);

        // 1. Si el admin sube una nueva foto para este doctor, se actualiza en su usuario global
        if ($request->hasFile('profile_photo')) {
            $doctor->user->updateProfilePhoto($request->file('profile_photo'));
        }

        // 2. Se actualizan los datos médicos en la tabla de doctores
        $doctor->update([
            'specialty_id'  => $validated['specialty_id'],
            'medical_license_number' => $validated['license_number'],
            'phone_clinic'   => $validated['phone_clinic'] ?? null,
            'biography'      => $validated['biography'] ?? null,
            'is_active'      => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.doctors.edit', $doctor)
            ->with('info', 'El perfil del doctor y su especialidad se actualizaron correctamente.');
    }

    public function index()
    {
        return view('admin.doctors.index');
    }
}
