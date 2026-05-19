<div class="bg-gray-50 p-6 rounded-lg border border-dashed border-gray-300">
    <div class="flex items-center space-x-4 mb-4">
        <div class="p-3 bg-white rounded-full shadow-sm">
            <i class="fa-solid fa-clock-rotate-left text-gray-400 text-xl"></i>
        </div>
        <div>
            <h4 class="text-lg font-medium text-gray-900">Registro de Actividad</h4>
            <p class="text-sm text-gray-500">Información sobre la creación y última actualización del expediente.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
        <div class="bg-white p-3 rounded border border-gray-200">
            <span class="block text-gray-500 uppercase text-xs font-bold">Fecha de registro:</span>
            <span class="text-gray-900">{{ $patient->created_at->format('d/m/Y H:i') }}</span>
        </div>
        <div class="bg-white p-3 rounded border border-gray-200">
            <span class="block text-gray-500 uppercase text-xs font-bold">Última actualización:</span>
            <span class="text-gray-900">{{ $patient->updated_at->format('d/m/Y H:i') }}</span>
        </div>
    </div>

    <div class="grid lg:grid cols-2 gap-4">
        <x-wire-native-select label="Tipo de sangre" class="mb-4" name="blood_type_id">
            <option value="">Selecciona un tipo de sangre</option>
            @foreach($blood_types as $bloodType)
                <option value="{{ $bloodType->id }}" @selected(old('blood_type_id', $patient->blood_type_id) == $bloodType->id)>{{ $bloodType->name }}</option>
            @endforeach
        </x-wire-native-select>
        <x-wire-textarea label="Observaciones" name="observations" placeholder="Notas relevantes sobre el paciente...">{{ old('observations', $patient->observations) }}

        </x-wire-textarea>
    </div>
</div>
