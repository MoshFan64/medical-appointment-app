@php
    $links = [
        [
            'name' => 'Dashboard',
            'icon' => 'fa-solid fa-gauge-high',
            'href' => route('admin.dashboard'),
            'active' => request()->routeIs('admin.dashboard'),
        ],
        [
            'header' => 'Administrar clínica',
        ],
        [
            'name' => 'Pacientes',
            'icon' => 'fa-solid fa-user-injured',
            'active' => false,
            'submenu' => [
                ['name' => 'Lista de pacientes', 'href' => '#'],
                ['name' => 'Historial médico', 'href' => '#'],
            ],
        ],
        [
            'name' => 'Citas Médicas',
            'icon' => 'fa-solid fa-calendar-check',
            'active' => false,
            'submenu' => [
                ['name' => 'Ver agenda', 'href' => '#'],
                ['name' => 'Nueva cita', 'href' => '#'],
            ],
        ],
        [
            'header' => 'Configuración',
        ],
        [
            'name' => 'Doctores',
            'icon' => 'fa-solid fa-user-md',
            'href' => '#',
            'active' => false,
        ],
    ];
@endphp

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        {{-- ELIMINÉ EL BLOQUE DEL LOGO DE AQUÍ PARA QUE NO APAREZCA DEBAJO DEL DASHBOARD --}}

        <ul class="space-y-2 font-medium">
            @foreach ($links as $index => $link)
                <li>
                    @isset($link['header'])
                        <div class="px-2 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            {{ $link['header'] }}
                        </div>
                    @elseif(isset($link['submenu']))
                        <button type="button"
                            class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                            data-collapse-toggle="dropdown-{{ $index }}">
                            <span class="w-6 h-6 inline-flex justify-center items-center text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                                <i class="{{ $link['icon'] }}"></i>
                            </span>
                            <span class="flex-1 ms-3 text-left whitespace-nowrap">{{ $link['name'] }}</span>
                            {{-- Icono de flecha para el submenú --}}
                            <i class="fa-solid fa-chevron-down text-xs ms-auto"></i>
                        </button>
                        <ul id="dropdown-{{ $index }}" class="hidden py-2 space-y-2">
                            @foreach ($link['submenu'] as $sub)
                                <li>
                                    <a href="{{ $sub['href'] }}"
                                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                        {{ $sub['name'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <a href="{{ $link['href'] }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ $link['active'] ? 'bg-gray-100 dark:bg-gray-700 font-bold' : '' }}">
                            <span class="w-6 h-6 inline-flex justify-center items-center text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
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
