<x-admin-layout title="Nueva Cita Manual">
    <div class="max-w-4xl mx-auto space-y-6">
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
            <h2 class="text-xl font-bold text-gray-900">Programar Cita Médica Manual</h2>
            <p class="text-xs text-gray-400">Asignación directa sin validación perimetral de horarios automatizados.</p>
        </div>

        <form action="{{ route('admin.appointments.store') }}" method="POST" class="space-y-6 bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Selector de Paciente --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Paciente</label>
                    <select name="patient_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Seleccione al paciente...</option>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}" {{ old('patient_id') == $patient->id ? 'selected' : '' }}>
                                {{ $patient->user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('patient_id') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
                </div>

                {{-- Selector de Doctor --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Médico Especialista</label>
                    <select name="doctor_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Seleccione al médico...</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                Dr(a). {{ $doctor->user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('doctor_id') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
                </div>

                {{-- Fecha --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Fecha de la Cita</label>
                    <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('date') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
                </div>

                {{-- Horarios --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Hora Entrada</label>
                        <input type="time" name="start_time" value="{{ old('start_time') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('start_time') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Hora Salida</label>
                        <input type="time" name="end_time" value="{{ old('end_time') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('end_time') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Motivo obligatorio --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Sintomatología / Motivo de Consulta</label>
                    <textarea name="reason" rows="4" placeholder="Escriba aquí los síntomas principales por los que asiste el paciente..." class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('reason') }}</textarea>
                    @error('reason') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex justify-end space-x-3 border-t border-gray-100 pt-4">
                <x-wire-button href="{{ route('admin.appointments.index') }}" label="Cancelar" secondary flat />
                <x-wire-button type="submit" label="Confirmar y Guardar Cita" primary />
            </div>
        </form>
    </div>
</x-admin-layout>
