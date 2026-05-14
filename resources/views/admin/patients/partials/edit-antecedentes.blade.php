<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    {{-- Alergias --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 font-bold">Alergias</label>
        <textarea name="allergies" rows="3"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
            placeholder="Listado de alergias (medicamentos, alimentos, etc.)">{{ old('allergies', $patient->allergies) }}</textarea>
    </div>

    {{-- Condiciones Crónicas --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 font-bold">Condiciones Crónicas</label>
        <textarea name="chronic_conditions" rows="3"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
            placeholder="Ej: Diabetes, Hipertensión...">{{ old('chronic_conditions', $patient->chronic_conditions) }}</textarea>
    </div>

    {{-- Historial Quirúrgico --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 font-bold">Historial Quirúrgico</label>
        <textarea name="surgical_history" rows="3"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
            placeholder="Cirugías previas y fechas aproximadas...">{{ old('surgical_history', $patient->surgical_history) }}</textarea>
    </div>

    {{-- Historia Familiar --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 font-bold">Historia Familiar</label>
        <textarea name="family_history" rows="3"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
            placeholder="Antecedentes médicos relevantes en la familia...">{{ old('family_history', $patient->family_history) }}</textarea>
    </div>
</div>
