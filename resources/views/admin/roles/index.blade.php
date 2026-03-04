<x-admin-layout title="Roles" :breadcrumbs='[
    [
        "name" => "Dashboard",
        "route" => route("admin.roles.index")
    ],
    [
        "name" => "Roles",
        "route" => route("admin.roles.create")
    ],
    [
        "name" => "Editar"
    ]
]'>

    <x-slot name="action">
        <x-wire-button blue href="{{ route('admin.roles.create') }}">
            <i class="fa-solid fa-plus"></i>
            Nuevo
        </x-wire-button>

    </x-slot>

@livewire('admin.datatables.role-table')

</x-admin-layout>
