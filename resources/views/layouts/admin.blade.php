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

        <wireui:scripts />
        <script src="//unpkg.com/alpinejs" defer></script>
    </head>
    <body class="font-sans antialiased">

        {{-- 1. Incluimos la navegación superior --}}
        @include('layouts.includes.admin.navigation')

        {{-- 2. Incluimos el sidebar lateral --}}
        @include('layouts.includes.sidebar')

        {{-- 3. EL BLOQUE PRINCIPAL: Aquí es donde va el contenido dinámico --}}
        <div class="p-4 sm:ml-64">
            <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
                @include('layouts.includes.admin.breadcrumb')
            </div>
            {{ $slot }}

        </div>

        @stack('modals')
        @livewireScripts
    </body>
</html>
