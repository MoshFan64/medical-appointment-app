@props([
    'breadcrumbs' => [], //Array vacío por defecto
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <wireui:scripts />
    </head>
    <body class="font-sans antialiased">

        {{-- 1. Incluimos la navegación superior --}}
        @include('layouts.includes.admin.navigation')

        {{-- 2. Incluimos el sidebar lateral --}}
        @include('layouts.includes.admin.sidebar')

        {{-- 3. EL BLOQUE PRINCIPAL: Con soporte para Slot de Acción y Breadcrumbs --}}
        <div class="p-4 sm:ml-64">
            <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">

                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-4">
                    {{-- Breadcrumbs a la izquierda --}}
                    <div class="flex-1">
                        @include('layouts.includes.admin.breadcrumb')
                    </div>

                    {{-- Botón de Acción (Nuevo) a la derecha --}}
                    @isset($action)
                        <div class="flex-shrink-0">
                            {{ $action }}
                        </div>
                    @endisset
                </div>

                {{-- Contenedor del contenido (aquí caerá la tabla de Livewire) --}}
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4">
                    {{ $slot }}
                </div>

            </div>
        </div>

        @stack('modals')
        @if(session('swal'))
            <script>
                Swal.fire(@json(session('swal')));
            </script>
        @endif

        @livewireScripts
    </body>
</html>
