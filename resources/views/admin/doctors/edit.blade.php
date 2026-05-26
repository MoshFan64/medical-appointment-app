<x-admin-layout title="Médicos" :breadcrumbs="[
    ['name' => 'Dashboard', 'route' => route('admin.dashboard')],
    ['name' => 'Doctores', 'route' => route('admin.doctors.index')],
    ['name' => 'Editar Perfil Médico']
]">

    <form action="{{ route('admin.doctors.update', $doctor) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Tarjeta de Encabezado de Perfil Profesional --}}
        <x-wire-card shadow="sm" rounded="lg">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="flex items-center space-x-4">
                    <img src="{{ $doctor->user->profile_photo_url }}"
                         alt="{{ $doctor->user->name }}"
                         class="w-16 h-16 rounded-full object-cover ring-2 ring-blue-500">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">{{ $doctor->user->name }}</h2>
                        <p class="text-sm text-gray-500">Personal Médico Especializado</p>
                    </div>
                </div>
                <div class="flex space-x-3 w-full sm:w-auto justify-end">
                    <x-wire-button href="{{ route('admin.doctors.index') }}" label="Cancelar" secondary flat />
                    <x-wire-button type="submit" label="Guardar Configuración" primary icon="check" />
                </div>
            </div>
        </x-wire-card>

        {{-- Bloque de Formulario Integrado --}}
        <x-wire-card title="Información Profesional e Historial Médico" shadow="sm" rounded="lg">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Selector de Especialidades desde el Catálogo --}}
                <div>
                    <x-wire-select
                        label="Especialidad Médica"
                        placeholder="Seleccione la especialidad"
                        :options="$specialties"
                        option-label="name"
                        option-value="id"
                        name="specialty_id"
                        value="{{ old('specialty_id', $doctor->specialty_id) }}"
                    />
                </div>

                {{-- Cédula Profesional --}}
                <div>
                    <x-wire-input
                        label="Número de Cédula Profesional (Licencia)"
                        placeholder="Ej. REG-748392-MX"
                        name="license_number"
                        icon="identification"
                        value="{{ old('license_number', $doctor->medical_license_number) }}"
                    />
                </div>

                {{-- Teléfono de la Clínica --}}
                <div>
                    <x-wire-input
                        label="Teléfono del Consultorio / Clínica"
                        placeholder="Ej. +52 999 923 4567"
                        name="phone_clinic"
                        icon="phone"
                        value="{{ old('phone_clinic', $doctor->phone_clinic) }}"
                    />
                </div>

                {{-- Estado Operativo --}}
                <div class="flex items-center mt-6">
                    <x-wire-checkbox
                        id="is_active"
                        label="Doctor activo para asignación de citas públicas"
                        name="is_active"
                        value="1"
                        :checked="old('is_active', $doctor->is_active)"
                    />
                </div>

                {{-- Perfil Curricular / Biografía --}}
                <div class="md:col-span-2">
                    <x-wire-textarea
                        label="Resumen de Trayectoria y Biografía Profesional"
                        placeholder="Escriba una breve reseña sobre la experiencia del médico, sub-especialidades o logros destacados..."
                        name="biography"
                        rows="5"
                    >{{ old('biography', $doctor->biography) }}</x-wire-textarea>
                </div>

            </div>
        </x-wire-card>
    </form>
</x-admin-layout>
