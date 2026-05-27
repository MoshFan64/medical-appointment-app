<?php

namespace App\Livewire\Admin\Datatables;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class DoctorTable extends DataTableComponent
{
    protected $model = Doctor::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
        $this->setPageName('doctores');
    }

    public function builder(): Builder
    {
        // Precargamos las relaciones de usuario y especialidad para máxima velocidad
        return Doctor::query()->with(['user', 'specialty']);
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->sortable(),

            Column::make("Fotografía")
                ->label(fn($row) => view('admin.doctors.partials.avatar', ['doctor' => $row])),

            Column::make("Nombre Médico")
            ->label(fn($row) => $row->user->name ?? 'Sin usuario asignado') // <-- Agregamos el operador ??
            ->searchable(fn(Builder $query, $searchTerm) =>
                $query->whereHas('user', fn($q) => $q->where('name', 'like', '%' . $searchTerm . '%'))
            ),

            Column::make("Especialidad")
                ->label(fn($row) => $row->specialty->name ?? 'No asignada'),

            Column::make("Cédula Profesional", "medical_license_number")
                ->sortable()
                ->searchable(),

            Column::make("Teléfono Clínica", "phone_clinic"),

            Column::make("Estado")
                ->label(fn($row) => $row->is_active
                    ? '<span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded-full">Activo</span>'
                    : '<span class="px-2 py-1 text-xs font-semibold bg-red-100 text-red-800 rounded-full">Inactivo</span>'
                )->html(),

            Column::make("Acciones")
                ->label(fn($row) => view('admin.doctors.partials.actions', ['doctor' => $row])),
        ];
    }
}
