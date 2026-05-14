<?php

namespace App\Livewire\Admin\Datatables;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Patient;

class PatientTable extends DataTableComponent
{
    public function builder(): Builder
    {
        // Cargamos la relación 'user' para acceder a sus datos
        return Patient::query()
            ->with('user');
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

            // CAMBIO: Apuntamos a la relación user.name
            Column::make("Nombre", "user.name")
                ->sortable()
                ->searchable(),

            Column::make("Número de identificación", "user.id_number")
                ->sortable()
                ->searchable(),

            // CAMBIO: Apuntamos a user.phone (ya que en patients no existe)
            Column::make("Teléfono", "user.phone")
                ->sortable(),

            Column::make("Acciones")
                ->label(function ($row) {
                    return view('admin.patients.actions', ['patient' => $row]);
                }),
        ];
    }
}
