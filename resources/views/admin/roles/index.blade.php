<x-admin-layout title="Roles" :breadcrumbs='[
    [
        "name" => "Dashboard", // <-- Falta coma aquí
        "route" => route("admin.roles.index")
    ],
    [
        "name" => "Roles",     // <-- Falta coma aquí
        "route" => route("admin.roles.create")
    ],
    [
        "name" => "Editar"
    ]
]'>

@livewire('admin.datatables.role-table')

</x-admin-layout>
