<x-admin-layout>
    {{-- Todo lo que se escriba aquí aparecerá donde se puso {{ $slot }} en admin.blade.php --}}

    <div class="py-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-black">
            Bienvenido a Clínicas Balam
        </h1>
        <p class="mt-4 text-gray-600 dark:text-gray-400">
            Aquí puedes gestionar tus pacientes, citas médicas y doctores de manera eficiente.
        </p>
    </div>

    {{-- Ejemplo de una tarjeta informativa --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Pacientes</h5>
            <p class="font-normal text-gray-700 dark:text-gray-400">Registrados: 124</p>
        </div>
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Citas Hoy</h5>
            <p class="font-normal text-gray-700 dark:text-gray-400">Total: 12</p>
        </div>
    </div>
</x-admin-layout>
