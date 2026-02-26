<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Spatie\Permission\Models\Role;
use Vtiful\Kernel\Format;

class RoleTable extends DataTableComponent
{
    protected $model = Role::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array{
    return [
        Column::make("Id", "id")
            ->sortable(),

        Column::make("Nombre", "name")
            ->sortable(),

        Column::make("Fecha", "created_at")
            ->sortable() // Eliminado el ";" que estaba aquí
            ->format(fn($value) => $value ? $value->format('d-m-Y') : ''), // Corregido el cierre y simplificado

        Column::make("Updated at", "updated_at")
            ->sortable(), // Añadida coma necesaria

        Column::make("Acciones")
            ->label(fn($row) => view('admin.roles.actions', ['role' => $row])), // Añadida coma necesaria
        ];
    }
}
