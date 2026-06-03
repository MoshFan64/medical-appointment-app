@php
// Definimos qué campos pertenecen a cada pestaña para detectar errores de validación
$errorGroups = [
    'antecedentes' => ['allergies', 'chronic_conditions', 'medications', 'surgical_history', 'family_history'],
    'informacion-general' => ['blood_type', 'height', 'weight', 'bmi', 'lifestyle_habits'],
    'contacto-emergencia' => ['emergency_contact_name', 'emergency_contact_relationship', 'emergency_contact_phone']
];

$initialTab = 'datos-personales';

foreach($errorGroups as $tab => $fields) {
    foreach($fields as $field) {
        if($errors->has($field)) {
            $initialTab = $tab; // Cambia la pestaña inicial al grupo que falló
            break 2; // Rompe ambos bucles de inmediato
        }
    }
}
@endphp

<x-admin-layout title="Pacientes" :breadcrumbs="[
    ['name' => 'Dashboard', 'route' => route('admin.dashboard')],
    ['name' => 'Pacientes', 'route' => route('admin.patients.index')],
    ['name' => 'Editar']
]">

    <form action="{{ route('admin.patients.update', $patient) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Encabezado con foto y acciones unificadas con WireUI --}}
        <x-wire-card class="mb-8">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <img src="{{ $patient->user->profile_photo_url }}" alt="{{ $patient->user->name }}" class="w-12 h-12 rounded-full object-cover ring-2 ring-gray-100">
                    <div class="ml-4">
                        <p class="text-2xl font-bold text-gray-900">{{ $patient->user->name }}</p>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <x-wire-button outline gray href="{{ route('admin.patients.index') }}" label="Volver" />
                    {{-- Botón corregido con propiedades nativas para evitar el bug invisible --}}
                    <x-wire-button type="submit" icon="check" label="Guardar cambios" class="bg-blue-600 hover:bg-blue-700 text-white font-bold !bg-blue-600 !text-white" />
                </div>
            </div>
        </x-wire-card>

        {{-- Panel de Pestañas Navegables --}}
        <x-wire-card>
            <div x-data="{ tab: '{{ $initialTab }}' }">

                {{-- Menú de pestañas superior --}}
                <div class="border-b border-gray-200 mb-4">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500">

                        {{-- Tab 1: Datos personales --}}
                        <li class="me-2">
                            <a href="#" x-on:click.prevent="tab = 'datos-personales'"
                               class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group transition-colors duration-200"
                               :class="tab === 'datos-personales' ? 'text-blue-600 border-blue-600' : 'border-transparent hover:text-blue-600 hover:border-gray-300'">
                                <i class="fa-solid fa-user me-2"></i> Datos personales
                            </a>
                        </li>

                        {{-- Tab 2: Antecedentes --}}
                        @php $tabAntecedentesError = $errors->hasAny($errorGroups['antecedentes']); @endphp
                        <li class="me-2">
                            <a href="#" x-on:click.prevent="tab = 'antecedentes'"
                               class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group transition-colors duration-200"
                               :class="tab === 'antecedentes'
                                    ? 'text-blue-600 border-blue-600'
                                    : ('{{ $tabAntecedentesError }}' ? 'text-red-600 border-red-600 animate-pulse' : 'border-transparent hover:text-blue-600 hover:border-gray-300')">
                                <i class="fa-solid fa-file-lines me-2"></i> Antecedentes
                                @if ($tabAntecedentesError)
                                    <i class="fa-solid fa-triangle-exclamation text-red-600 ms-2" title="Hay errores en esta sección"></i>
                                @endif
                            </a>
                        </li>

                        {{-- Tab 3: Información general --}}
                        @php $tabGeneralError = $errors->hasAny($errorGroups['informacion-general']); @endphp
                        <li class="me-2">
                            <a href="#" x-on:click.prevent="tab = 'informacion-general'"
                               class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group transition-colors duration-200"
                               :class="tab === 'informacion-general'
                                    ? 'text-blue-600 border-blue-600'
                                    : ('{{ $tabGeneralError }}' ? 'text-red-600 border-red-600' : 'border-transparent hover:text-blue-600 hover:border-gray-300')">
                                <i class="fa-solid fa-info me-2"></i> Información general
                                @if ($tabGeneralError)
                                    <i class="fa-solid fa-triangle-exclamation text-red-600 ms-2" title="Hay errores en esta sección"></i>
                                @endif
                            </a>
                        </li>

                        {{-- Tab 4: Contacto de emergencia --}}
                        @php $tabEmergenciaError = $errors->hasAny($errorGroups['contacto-emergencia']); @endphp
                        <li class="me-2">
                            <a href="#" x-on:click.prevent="tab = 'contacto-emergencia'"
                               class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group transition-colors duration-200"
                               :class="tab === 'contacto-emergencia'
                                    ? 'text-blue-600 border-blue-600'
                                    : ('{{ $tabEmergenciaError }}' ? 'text-red-600 border-red-600' : 'border-transparent hover:text-blue-600 hover:border-gray-300')">
                                <i class="fa-solid fa-heart me-2"></i> Contacto de emergencia
                                @if ($tabEmergenciaError)
                                    <i class="fa-solid fa-triangle-exclamation text-red-600 ms-2" title="Hay errores en esta sección"></i>
                                @endif
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- Contenedor dinámico de las vistas parciales --}}
                <div class="px-4 mt-4">

                    {{-- Contenido Tab 1 --}}
                    <div x-show="tab === 'datos-personales'">
                        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6 rounded-r-lg shadow-sm">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                <div class="flex items-start">
                                    <i class="fa-solid fa-user-gear text-blue-500 text-xl mt-1 mr-3"></i>
                                    <div>
                                        <h3 class="text-sm font-bold text-blue-800">Edición de cuenta de usuario</h3>
                                        <p class="text-sm text-blue-600">La <strong>información de acceso</strong> (Nombre, email) debe gestionarse desde la cuenta de usuarios asociada.</p>
                                    </div>
                                </div>
                                <div class="mt-4 sm:mt-0">
                                    <x-wire-button primary sm href="{{ route('admin.users.edit', $patient->user) }}" target="_blank">
                                        Editar usuario <i class="fa-solid fa-arrow-up-right-from-square ms-2"></i>
                                    </x-wire-button>
                                </div>
                            </div>
                        </div>

                        {{-- Grid informativo corregido con su correspondiente cierre --}}
                        <div class="grid lg:grid-cols-2 gap-4 mb-6">
                            <div>
                                <span class="text-gray-500 font-semibold">Teléfono:</span>
                                <span class="text-gray-900 text-sm ml-1">{{ $patient->user->phone ?? 'No registrado' }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500 font-semibold">Email:</span>
                                <span class="text-gray-900 text-sm ml-1">{{ $patient->user->email ?? 'No registrado' }}</span>
                            </div>
                            <div class="lg:col-span-2">
                                <span class="text-gray-500 font-semibold">Dirección:</span>
                                <span class="text-gray-900 text-sm ml-1">{{ $patient->user->address ?? 'No registrado' }}</span>
                            </div>
                        </div>

                        @includeIf('admin.patients.partials.edit-datos-personales')
                    </div>

                    {{-- Contenido Tab 2 --}}
                    <div x-show="tab === 'antecedentes'">
                        @includeIf('admin.patients.partials.edit-antecedentes')
                    </div>

                    {{-- Contenido Tab 3 --}}
                    <div x-show="tab === 'informacion-general'">
                        @includeIf('admin.patients.partials.edit-informacion-general')
                    </div>

                    {{-- Contenido Tab 4 --}}
                    <div x-show="tab === 'contacto-emergencia'">
                        @if(View::exists('admin.patients.partials.edit-contacto-emergencia'))
                            @includeIf('admin.patients.partials.edit-contacto-emergencia')
                        @else
                            <p class="text-gray-500 italic">El formulario de contacto de emergencia aún no ha sido creado.</p>
                        @endif
                    </div>
                </div>
            </div>
        </x-wire-card>
    </form>
</x-admin-layout>
