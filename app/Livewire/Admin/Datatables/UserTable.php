<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;

class UserTable extends DataTableComponent
{
    //protected $model = User::class;

    // Este método define el modelo
    public function builder()
    {
        // Devuelve la relación con los roles
        return User::query()
            ->with('roles'); // Carga la relación de roles para evitar consultas adicionales
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
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Email", "email")
                ->sortable(),
            Column::make("Número de identificación", "id_number")
                ->sortable(),
            Column::make("Teléfono", "phone")
                ->sortable(),
            Column::make("Rol", "roles")
                ->label(function ($row) {
                    // Devuelve el nombre del primer rol asignado al usuario
                    return $row->roles->first()->name ?? 'Sin rol';
                }),
            Column::make("Acciones")
                ->label(function ($row) {
                    return view('admin.users.actions', ['user' => $row]);
                }),
        ];
    }
}
