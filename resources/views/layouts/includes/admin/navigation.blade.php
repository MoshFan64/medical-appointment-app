<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 h-16">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                {{-- El target debe ser logo-sidebar para que coincida con el <aside id="logo-sidebar"> --}}
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="sm:hidden text-heading bg-transparent box-border border border-transparent hover:bg-neutral-secondary-medium focus:ring-4 focus:ring-neutral-tertiary font-medium leading-5 rounded-base text-sm p-2 focus:outline-none">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h10"/>
                    </svg>
                </button>

                {{-- Logo y Nombre de la Clínica --}}
                <a href="{{ route('admin.dashboard') }}" class="flex ms-2 md:me-24">
                    <img src="{{ asset('img/medical-snake-caduceus-symbol-free.png') }}" class="h-8 me-3" alt="Logo" />
                    <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Clínicas Balam</span>
                </a>
            </div>

            <div class="flex items-center">
                <div class="flex items-center ms-3">
                    <div>
                        <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            {{-- Imagen de perfil real de Jetstream o una por defecto --}}
                            <img class="w-8 h-8 rounded-full" src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.Auth::user()->name }}" alt="user photo">
                        </button>
                    </div>

                    {{-- Menú desplegable del usuario --}}
                    <div class="z-50 hidden bg-white border border-gray-200 rounded-lg shadow-lg w-44 dark:bg-gray-700 dark:border-gray-600" id="dropdown-user">
                        <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-600" role="none">
                            <p class="text-sm font-medium text-gray-900 dark:text-white" role="none">
                                {{ Auth::user()->name }}
                            </p>
                            <p class="text-sm text-gray-500 truncate dark:text-gray-400" role="none">
                                {{ Auth::user()->email }}
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Perfil</a>
                            </li>
                            <li>
                                {{-- Formulario de Logout --}}
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">
                                        Cerrar Sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
