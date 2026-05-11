<x-admin-layout title="Roles" :breadcrumbs='[
    [
        "name" => "Dashboard",
        "route" => route("admin.roles.index")
    ],
    [
        "name" => "Pacientes",

    ]
]'>

    @livewire('admin.datatables.patient-table');

</x-admin-layout>
