<x-admin-layout title="Usuarios" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard')
    ],
    [
        'name' => 'Usuarios',
        'route' => route('admin.users.index')
    ],
    [
        'name' => 'Crear'
    ]
]">

    <x-wire-card>
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div class="grid lg:grid-cols-2 gap-4">
                    {{-- Nombre --}}
                    <x-wire-input label="Nombre" name="name" placeholder="Nombre completo" required
                        :value="old('name')">
                    </x-wire-input>

                    {{-- Contraseña --}}
                    <x-wire-input label="Contraseña" name="password" type="password" placeholder="Mínimo 8 caracteres" required
                        autocomplete="new-password">
                    </x-wire-input>

                    {{-- Confirmar Contraseña --}}
                    <x-wire-input label="Confirmar contraseña" name="password_confirmation" type="password" placeholder="Repita la contraseña" required
                        autocomplete="new-password">
                    </x-wire-input>

                    {{-- ID Number --}}
                    <x-wire-input label="Número de ID" name="id_number" placeholder="Ej. 123456789"
                        autocomplete="off" required inputmode="numeric" :value="old('id_number')">
                    </x-wire-input>

                    {{-- Teléfono --}}
                    <x-wire-input label="Teléfono" name="phone" placeholder="Ej. 9999999999"
                        autocomplete="tel" required inputmode="tel" :value="old('phone')">
                    </x-wire-input>

                    {{-- Email (Añadido por si falta en tu lógica de User) --}}
                    <x-wire-input label="Correo electrónico" name="email" type="email" placeholder="ejemplo@correo.com" required
                        :value="old('email')">
                    </x-wire-input>
                </div>

                {{-- Dirección --}}
                <x-wire-input name="address" label="Dirección" required :value="old('address')"
                    placeholder="Ej. Calle 90 293" autocomplete="street-address">
                </x-wire-input>

                {{-- Selección de Rol --}}
                <div class="space-y-1">
                    <x-wire-native-select name="role_id" label="Rol" required>
                        <option value="">Selecciona un rol</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" @selected(old('role_id') == $role->id)>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </x-wire-native-select>
                    <p class="text-sm text-gray-500">
                        Define los permisos y el acceso del usuario en el sistema.
                    </p>
                </div>

                {{-- Botones de Acción --}}
                <div class="flex justify-end pt-4">
                    <x-wire-button blue type="submit" spinner="save">
                        <i class="fa-solid fa-plus mr-2"></i>
                        Crear y guardar usuario
                    </x-wire-button>
                </div>
            </div>
        </form>
    </x-wire-card>

</x-admin-layout>
