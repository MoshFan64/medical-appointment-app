<x-admin-layout title="Roles" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.roles.index')
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
        <form action="{{ route('admin.roles.update', $role) }}" method="POST">
            @csrf
            @method('PUT')
            <x-wire-input label="Nombre" name="name" placeholder="Nombre del rol"
                value="{{ old('name', $role->name) }}">
            </x-wire-input>
            <div class="flex justify-end mt-4">
                <x-wire-button blue type="submit">
                    <i class="fa-solid fa-plus"></i>
                    Actualizar y guardar
                </x-wire-button>
            </div>
        </form>
    </x-wire-card>

</x-admin-layout>
