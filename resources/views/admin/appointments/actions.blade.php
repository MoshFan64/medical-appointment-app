<div class="flex items-center space-x-2">
    <x-wire-button
        href="{{ route('admin.appointments.consultation', $appointment) }}"
        blue
        xs
        icon="stethoscope"
        tooltip="Atender e iniciar consulta médica"
        label="Atender"
    />
</div>
