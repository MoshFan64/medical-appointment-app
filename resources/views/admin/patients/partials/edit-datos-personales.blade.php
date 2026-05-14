<div class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Tipo de Sangre --}}
        <div>
            <x-wire-select
                label="Tipo de Sangre"
                placeholder="Seleccione una opción"
                :options="$blood_types"
                option-label="name"
                option-value="id"
                wire:model.defer="blood_type_id"
                name="blood_type_id"
            />
            {{-- Si no usas wireui, usa un select normal: --}}
            {{--
            <label class="block text-sm font-medium text-gray-700">Tipo de Sangre</label>
            <select name="blood_type_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">Seleccione...</option>
                @foreach($blood_types as $type)
                    <option value="{{ $type->id }}" @selected(old('blood_type_id', $patient->blood_type_id) == $type->id)>{{ $type->name }}</option>
                @endforeach
            </select>
            --}}
        </div>

        {{-- Observaciones --}}
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700">Observaciones Generales</label>
            <textarea name="observations" rows="3"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                placeholder="Notas relevantes sobre el paciente...">{{ old('observations', $patient->observations) }}</textarea>
        </div>
    </div>
</div>
