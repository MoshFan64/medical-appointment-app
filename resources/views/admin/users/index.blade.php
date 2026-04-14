<x-admin-layout title="Usuarios" :breadcrumbs='[
    [
        "name" => "Dashboard",
        "route" => route("admin.roles.index")
    ],
    [
        "name" => "Usuarios",
        "route" => route("admin.roles.create")
    ],
    [
        "name" => "Editar"
    ]
]'>

    <x-slot name="action">
        <x-wire-button blue href="{{ route('admin.users.create') }}">
            <i class="fa-solid fa-plus"></i>
            Nuevo
        </x-wire-button>

    </x-slot>

@livewire('admin.datatables.user-table')

</x-admin-layout>
