<x-admin-layout title="Pacientes" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.patients.index')
    ],
    [
        'name' => 'Editar',
        'route' => route('admin.patients.index')
    ],
    [
        'name' => 'Editar'
    ]
]">

    <form action="{{ route('admin.patients.update', $patient) }}" method="POST">
        @csrf
        @method('PUT')
        {{-- Encabezado con foto y acciones --}}
    <x-wire-card>
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <img src="{{ $patient->user->profile_photo_url }}" alt="{{ $patient->user->name }}" class="w-12 h-12 rounded-full object-cover object-center">
                <div>
                    <p class="text-2x1 font-bold text-gray-900">{{ $patient->user->name }}</p>
                </div>
            </div>
            <div class="flex space-x-3 mt-6 lg:mt-0">
                <x-wire-button outline gray href={{ route('admin.patients.index', $patient) }} type="submit" color="primary">Volver</x-wire-button>
                <x-wire-button type="submit" color="primary">
                    <i class="fa-solid fa-check">
                        Guardar cambios
                    </i>
                </x-wire-button>
        </div>
    </x-wire-card>
        {{-- Tabs de navegación --}}
        <x-wire-card>
        <div x-data="{tab: 'datos-personales'}">
        {{-- Menú de pestañas --}}
        <div class="border-b border-gray-200">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500">
                {{-- Tab 1: Datos personales --}}
                <li class="me-2">
                    <a href="#" x-on:click="tab = 'datos-personales'">
                    :class="{
                        text-blue-600 border-blue-600 active: 'datos-personales' === tab,
                        'border-transparent hover:text-blue-600 hover:border-gray-300': tab !== 'datos-personales'
                    }"
                    <a href="#" class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group transition-colors duration-200"
                    :aria-current="tab === 'datos-personales' ? 'page' : undefined">
                    <i class="fa-solid fa-user me-2"></i>
                        Datos personales
                    </a>
                </li>
                {{-- Tab 2: Antecedentes --}}
                <li class="me-2">
                    <a href="#" x-on:click="tab = 'antecedentes'">
                    :class="{
                        text-blue-600 border-blue-600 active: 'antecedentes' === tab,
                        'border-transparent hover:text-blue-600 hover:border-gray-300': tab !== 'antecedentes'
                    }"
                    <a href="#" class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group transition-colors duration-200"
                    :aria-current="tab === 'antecedentes' ? 'page' : undefined">
                    <i class="fa-solid fa-file-lines me-2"></i>
                        Antecedentes
                    </a>
                </li>
                {{-- Tab 3: Información general --}}
                <li class="me-2">
                    <a href="#" x-on:click="tab = 'informacion-general'">
                    :class="{
                        text-blue-600 border-blue-600 active: 'informacion-general' === tab,
                        'border-transparent hover:text-blue-600 hover:border-gray-300': tab !== 'informacion-general'
                    }"
                    <a href="#" class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group transition-colors duration-200"
                    :aria-current="tab === 'informacion-general' ? 'page' : undefined">
                    <i class="fa-solid fa-info me-2"></i>
                        Información general
                    </a>
                </li>
                 {{-- Tab 4: Contacto de emergencia --}}
                <li class="me-2">
                    <a href="#" x-on:click="tab = 'contacto-emergencia'">
                    :class="{
                        text-blue-600 border-blue-600 active: 'contacto-emergencia' === tab,
                        'border-transparent hover:text-blue-600 hover:border-gray-300': tab !== 'contacto-emergencia'
                    }"
                    <a href="#" class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group transition-colors duration-200"
                    :aria-current="tab === 'contacto-emergencia' ? 'page' : undefined">
                    <i class="fa-solid fa-heart me-2"></i>
                        Contacto de emergencia
                    </a>
                </li>
            </ul>
        </div>
        {{-- Contenido de las tabs --}}
            <div class="px-4 mt-4">
                {{-- Contenido de la pestaña de datos personales --}}
                <div x-show="tab === 'datos-personales'">
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6 rounded-r-lg shadow-small">
                        <div class = "flex flex-col sm:flex-row sm:items-center sm:justify-between">
                            {{-- Lado izquierdo: Información --}}
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i class="fa-solid fa-user-gear text-blue-500 text-xl mt-1"></i>
                                <div class="ml-3">
                                    <h3 class="text-sm font-bold text-blue-800">
                                        Edición de cuenta de usuario
                                    </h3>
                                    <div class="mt-1 text-sm text-blue-600">

                                    </div>
                                </div>
                        <p>La <strong>información de acceso</strong> (Nombre, email y contraseña)
                        debe gestionarse desde la cuenta de usuarios asociada:</p>
                            </div>
                        </div>
                        {{-- Lado derecho: Acción --}}
                        <div class="flex-shrink-0">
                            <x-wire-button primary sm href="{{ route('admin.users.edit', $patient->user) }}" target="_blank">

                                Editar usuario
                                <i class="fa-solid fa-arrow-up-right-from-square ms-2"></i>
                            </x-wire-button>
                        </div>
                        </div>
                    </div>

                    @include('admin.patients.partials.edit-datos-personales')
                </div>
                {{-- Contenido de la pestaña de antecedentes --}}
                <div x-show="tab === 'antecedentes'">
                    @include('admin.patients.partials.edit-antecedentes')
                </div>
                {{-- Contenido de la pestaña de información general --}}
                <div x-show="tab === 'informacion-general'">
                    @include('admin.patients.partials.edit-informacion-general')
                </div>
                {{-- Contenido de la pestaña de contacto de emergencia --}}
                <div x-show="tab === 'contacto-emergencia'">
                    @include('admin.patients.partials.edit-contacto-emergencia')
                </div>
        </div>
       </x-wire-card>
    </form>

</x-admin-layout>
