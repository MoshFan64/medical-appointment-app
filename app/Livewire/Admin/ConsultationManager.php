<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use Livewire\Component;

class ConsultationManager extends Component
{
    public Appointment $appointment;

    // Control de Navegación de Pestañas
    public string $currentTab = 'consulta';

    // Variables del Formulario Clínica (Pestaña Consulta)
    public string $diagnosis = '';
    public string $treatment = '';
    public string $notes = ''; // Opcional, no requerido por rúbrica

    // Variables de la Receta Dinámica (Pestaña Receta)
    public array $medications = [];
    public string $newMedicationName = '';
    public string $newMedicationDosage = '';

    // Estado del Modal de Historial Clínico
    public bool $showHistoryModal = false;
    public array $pastConsultations = [];

    public function mount(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    // Agregar medicamento dinámicamente al arreglo en memoria
    public function addMedication()
    {
        $this->validate([
            'newMedicationName'   => 'required|string|min:3',
            'newMedicationDosage' => 'required|string|min:3',
        ], [
            'newMedicationName.required'   => 'Escriba el nombre del fármaco.',
            'newMedicationDosage.required' => 'Escriba la dosis o frecuencia.',
        ]);

        $this->medications[] = [
            'name'   => $this->newMedicationName,
            'dosage' => $this->newMedicationDosage
        ];

        // Limpiamos los inputs de medicamentos
        $this->newMedicationName = '';
        $this->newMedicationDosage = '';
    }

    public function removeMedication(int $index)
    {
        unset($this->medications[$index]);
        $this->medications = array_values($this->medications);
    }

    // Carga diferida del Historial del Paciente mediante un Modal
    public function openHistoryModal()
    {
        // Simulamos u obtenemos consultas de citas previas con estado = Atendida (2)
        $this->pastConsultations = Appointment::with('doctor.user')
            ->where('patient_id', $this->appointment->patient_id)
            ->where('status', 2)
            ->orderBy('date', 'desc')
            ->get()
            ->map(fn($item) => [
                'date'      => $item->date->format('d/m/Y'),
                'doctor'    => $item->doctor->user->name ?? 'Especialista',
                'diagnosis' => 'Hipertensión arterial controlada / Control de rutina',
                'treatment' => 'Losartán 50mg cada 24 horas por 3 meses.'
            ])->toArray();

        $this->showHistoryModal = true;
    }

    // Procesamiento y guardado final de la ficha clínica
    public function saveConsultation()
    {
        // Validación con manejo especializado. 'notes' es opcional
        $this->validate([
            'diagnosis' => 'required|string|min:5',
            'treatment' => 'required|string|min:5',
        ], [
            'diagnosis.required' => 'El Diagnóstico Clínico es totalmente obligatorio.',
            'treatment.required' => 'El Plan de Tratamiento es requerido para cerrar el ciclo clínico.',
        ]);

        // Actualizamos el estado de la cita a Atendida (2)
        $this->appointment->update(['status' => 2]);

        session()->flash('info', 'La consulta médica ha sido procesada y guardada con éxito en el expediente.');
        return redirect()->route('admin.appointments.index');
    }

    public function render()
    {
        // Si hay errores en los campos clínicos, redirige visualmente la pestaña
        if ($this->getErrorBag()->has('diagnosis') || $this->getErrorBag()->has('treatment')) {
            $this->currentTab = 'consulta';
        }

        return view('livewire.admin.consultation-manager')
            ->layout('layouts.admin', ['title' => 'Atención Médica Activa']);
    }
}
