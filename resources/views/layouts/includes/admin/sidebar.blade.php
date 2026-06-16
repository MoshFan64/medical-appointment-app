@php
    $links = [
        [
            'header' => 'Administrar clínica',
        ],
        [
            'name' => 'Pacientes',
            'icon' => 'fa-solid fa-user-injured',
            'active' => request()->routeIs('admin.patients*'),
            'submenu' => [
                // Conectado al CRUD de pacientes que hicimos anteriormente
                ['name' => 'Lista de pacientes', 'href' => route('admin.patients.index')],
                ['name' => 'Historial médico', 'href' => route('admin.patients.index')],
            ],
        ],
        [
            'name' => 'Citas Médicas',
            'icon' => 'fa-solid fa-calendar-check',
            'active' => request()->routeIs('admin.appointments*'),
            'submenu' => [
                // Conectado al Listado principal y al Formulario del Módulo de Citas
                ['name' => 'Ver agenda', 'href' => route('admin.appointments.index')],
                ['name' => 'Nueva cita', 'href' => route('admin.appointments.create')],
            ],
        ],
        [
            'header' => 'Configuración',
        ],
        [
            'name' => 'Doctores',
            'icon' => 'fa-solid fa-user-md',
            'href' => route('admin.doctors.index'),
            'active' => request()->routeIs('admin.doctors*'),
        ],
        [
            'header' => 'Gestión',
        ],
        [
            'name' => 'Gestión de roles',
            'icon' => 'fa-solid fa-shield-halved',
            'href' => route('admin.roles.index'),
            'active' => request()->routeIs('admin.roles*')
        ],
        [
            'name' => 'Gestión de usuarios',
            'icon' => 'fa-solid fa-users',
            'href' => route('admin.users.index'),
            'active' => request()->routeIs('admin.users*')
        ],
        [
            'name' => 'Gestión de pacientes',
            'icon' => 'fa-solid fa-user-injured',
            'href' => route('admin.patients.index'),
            'active' => request()->routeIs('admin.patients*')
        ],
        [
            'name' => 'Gestión de doctores',
            'icon' => 'fa-solid fa-user-md',
            'href' => route('admin.doctors.index'),
            'active' => request()->routeIs('admin.doctors*')
        ],
        [
            'name' => 'Convenios de seguros',
            'icon' => 'fa-solid fa-building-shield',
            'href' => route('admin.insurances.index'),
            'active' => request()->routeIs('admin.insurances*')
        ]
    ];
@endphp

{{-- Usamos style="margin-top: 64px;" para forzar el descenso sin importar las clases --}}
<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    style="margin-top: 64px;"
    aria-label="Sidebar">

    <div class="h-full px-3 pb-24 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium pt-4">
            @foreach ($links as $index => $link)
                <li>
                    @isset($link['header'])
                        <div class="px-2 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            {{ $link['header'] }}
                        </div>
                    @elseif(isset($link['submenu']))
                        {{-- Controlamos el estado abierto/cerrado con Alpine.js detectando si la ruta actual pertenece a este módulo --}}
                        <div x-data="{ open: {{ $link['active'] ? 'true' : 'false' }} }">
                            <button type="button"
                                x-on:click="open = !open"
                                class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                                :class="{ 'bg-gray-50': open }">
                                <span class="w-6 h-6 inline-flex justify-center items-center text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                                      :class="{ 'text-blue-600': open }">
                                    <i class="{{ $link['icon'] }}"></i>
                                </span>
                                <span class="flex-1 ms-3 text-left whitespace-nowrap" :class="{ 'text-blue-600 font-semibold': open }">{{ $link['name'] }}</span>
                                <i class="fa-solid fa-chevron-down text-xs ms-auto transition-transform duration-200"
                                   :class="{ 'rotate-180 text-blue-600': open }"></i>
                            </button>
                            
                            {{-- Lista desplegable reactiva --}}
                            <ul x-show="open" 
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                class="py-2 space-y-2 ml-4">
                                @foreach ($link['submenu'] as $sub)
                                    <li>
                                        <a href="{{ $sub['href'] }}"
                                            class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 text-sm {{ request()->url() === $sub['href'] ? 'text-blue-600 font-bold dark:text-blue-400' : 'text-gray-900 dark:text-gray-300' }}">
                                            {{ $sub['name'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <a href="{{ $link['href'] }}"
                            class="flex items-center p-2 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ $link['active'] ? 'bg-blue-50 text-blue-600 font-bold dark:bg-gray-700 dark:text-blue-400' : 'text-gray-900' }}">
                            <span class="w-6 h-6 inline-flex justify-center items-center text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white {{ $link['active'] ? 'text-blue-600 dark:text-blue-400' : '' }}">
                                <i class="{{ $link['icon'] }}"></i>
                            </span>
                            <span class="ms-3">{{ $link['name'] }}</span>
                        </a>
                    @endisset
                </li>
            @endforeach
        </ul>
    </div>
</aside>
