<x-admin-layout title="Usuarios" :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
    ['name' => 'Usuarios', 'href' => route('admin.users.index')],
    ['name' => 'Editar'],
]">
    <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
        <x-validation-errors class="mb-4" />

        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">Nombre</label>
                    <input name="name" value="{{ old('name', $user->name) }}" placeholder="Nombre completo"
                        class="block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                        required>
                    <x-input-error for="name" class="mt-2" />
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">Correo electrónico</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        placeholder="ejemplo@dominio.com" autocomplete="email"
                        class="block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                        required>
                    <x-input-error for="email" class="mt-2" />
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">Número de ID</label>
                    <input name="id_number" value="{{ old('id_number', $user->id_number) }}" placeholder="Ej. ID-12345"
                        autocomplete="off"
                        class="block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    <x-input-error for="id_number" class="mt-2" />
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">Teléfono</label>
                    <input name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Ej. 999999999"
                        autocomplete="tel"
                        class="block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    <x-input-error for="phone" class="mt-2" />
                </div>

                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-gray-700">Dirección</label>
                    <input name="address" value="{{ old('address', $user->address) }}"
                        placeholder="Ej. Calle 123, Col. Centro" autocomplete="street-address"
                        class="block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    <x-input-error for="address" class="mt-2" />
                </div>

                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-gray-700">Rol</label>
                    <select name="role"
                        class="block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        <option value="">Sin rol</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" @selected(old('role', $user->roles->pluck('name')->first()) === $role->name)>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error for="role" class="mt-2" />
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-8 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
