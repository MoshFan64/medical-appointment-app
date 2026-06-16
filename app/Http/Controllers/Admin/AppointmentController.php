<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        // Traemos las citas con sus relaciones cargadas para evitar consultas N+1
        $appointments = Appointment::with(['patient.user', 'doctor.user'])->orderBy('date', 'desc')->get();
        return view('admin.appointments.index', compact('appointments'));
    }

    public function create()
    {
        // Cargamos doctores y pacientes activos vinculados a sus tablas de usuarios
        $patients = Patient::with('user')->get()->filter(fn($p) => $p->user !== null);
        $doctors = Doctor::with('user')->get()->filter(fn($d) => $d->user !== null);

        return view('admin.appointments.create', compact('patients', 'doctors'));
    }

    public function store(Request $request)
    {
        // 5. Validaciones Lógicas del Negocio solicitadas
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id'  => 'required|exists:doctors,id',
            'date'       => 'required|date|after_or_equal:today', // No fechas del pasado
            'start_time' => 'required',
            'end_time'   => 'required|after:start_time', // Hora fin obligatoriamente mayor a inicio
            'reason'     => 'required|string|min:5|max:1000', // Requerido por entregable
        ], [
            'date.after_or_equal' => 'La fecha de la cita no puede ser un día del pasado.',
            'end_time.after'      => 'La hora de finalización debe ser posterior a la hora de inicio.',
            'reason.required'     => 'Debe ingresar obligatoriamente el motivo de la consulta médica.',
        ]);

        Appointment::create($validated);

        return redirect()->route('admin.appointments.index')
            ->with('info', 'La cita médica ha sido agendada exitosamente de forma manual.');
    }
}
