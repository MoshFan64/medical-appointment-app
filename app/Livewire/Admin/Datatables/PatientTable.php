<?php

namespace App\Livewire\Admin\Datatables;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Patient;

class PatientTable extends DataTableComponent
{
    //protected $model = Patient::class;
    // Este método define el modelo
    public function builder(): Builder
    {
        // Devuelve la relación con los roles
        return Patient::query()
            ->with('user'); // Carga la relación de roles para evitar consultas adicionales
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Nombre", "name")
                ->sortable(),
            Column::make("Número de identificación", "user.id_number")
                ->sortable(),
            Column::make("Teléfono", "phone")
                ->sortable(),
            Column::make("Acciones")
                ->label(function ($row) {
                    return view('admin.patients.actions', ['patient' => $row]);
                }),
        ];
    }
}
