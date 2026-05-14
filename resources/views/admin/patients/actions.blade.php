<div class="flex items-center space-x-2">
    {{-- Botón Editar --}}
    <x-wire-button
        href="{{ route('admin.patients.edit', $patient) }}"
        blue
        xs
        icon="pencil">
        <i class="fa-solid fa-pen-to-square"></i>
    </x-wire-button>

    {{-- Botón Ver Expediente (Opcional) --}}
    <x-wire-button
        href="{{ route('admin.patients.show', $patient) }}"
        slate
        xs>
        <i class="fa-solid fa-eye"></i>
    </x-wire-button>

    {{-- Botón Eliminar (Si tienes la lógica) --}}
    <form action="{{ route('admin.patients.destroy', $patient) }}" method="POST" onsubmit="return confirm('¿Estás seguro?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-600 hover:text-red-900">
            <i class="fa-solid fa-trash"></i>
        </button>
    </form>
</div>
