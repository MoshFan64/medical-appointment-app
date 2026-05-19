<div class="space-y-4">
    <h3 class="text-lg font-medium text-gray-900">Contacto de Emergencia</h3>
    <p class="text-sm text-gray-500 mt-1">Información de la persona a contactar en caso de emergencia.</p>

    <div class="mt-4">
        <x-wire-input label="Nombre de contacto" name="emergency_contact_name" placeholder="Nombre completo del contacto de emergencia"
            value="{{ old('emergency_contact_name', $patient->emergency_contact_name) }}">
        </x-wire-input>

        <x-wire-input label="Relación" name="emergency_contact_relationship" placeholder="Relación con el paciente (ej: padre, hermano, amigo...)"
            value="{{ old('emergency_contact_relationship', $patient->emergency_contact_relationship) }}">
        </x-wire-input>

        <x-wire-phone label="Teléfono" name="emergency_contact_phone" mask="(###) ###-####" placeholder="(999) 999-9999"
            value="{{ old('emergency_contact_phone', $patient->emergency_contact_phone) }}">
        </x-wire-phone>
    </div>
</div>
