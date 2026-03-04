<x-admin-layout title="Roles" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard')
    ],
    [
        'name' => 'Roles',
        'route' => route('admin.roles.create')
    ],
    [
        'name' => 'Editar'
    ]
]">

    <x-wire-card>
        <form action="{{ route('admin.roles.store') }}">

        </form>
    </x-wire-card>

</x-admin-layout>
