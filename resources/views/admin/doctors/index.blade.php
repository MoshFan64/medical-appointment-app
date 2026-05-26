<x-admin-layout title="Gestión de Personal Médico" :breadcrumbs="[
    ['name' => 'Dashboard', 'route' => route('admin.dashboard')],
    ['name' => 'Doctores']
]">

    <div class="space-y-6">
        {{-- Encabezado del Módulo --}}
        <div class="flex justify-between items-center bg-white p-6 rounded-lg shadow-sm border border-gray-100">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Catálogo de Doctores</h1>
                <p class="text-sm text-gray-500">Administra las especialidades, cédulas profesionales y estados activos del equipo médico clínico.</p>
            </div>
        </div>

        {{-- Contenedor del Datatable Reactivo --}}
        <x-wire-card shadow="sm" rounded="lg">
            @livewire('admin.datatables.doctor-table')
        </x-wire-card>
    </div>

</x-admin-layout>
