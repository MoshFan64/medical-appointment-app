<x-admin-layout title="Convenios de Seguros">
    <div class="space-y-6">
        {{-- Encabezado --}}
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h1 class="text-2xl font-bold text-gray-900">Gestión de Convenios de Seguro</h1>
            <p class="text-sm text-gray-500">Módulo de administración para el catálogo de aseguradoras integradas con Healthify.</p>
        </div>

        @if(session('info'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg text-sm text-green-700 shadow-sm">
                <i class="fa-solid fa-circle-check mr-2"></i> {{ session('info') }}
            </div>
        @endif

        {{-- Contenedor de Dos Columnas --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            {{-- Columna 1: Formulario de Registro --}}
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 h-fit">
                <h2 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2">
                    <i class="fa-solid fa-file-medical text-blue-600 mr-2"></i>Nuevo Convenio
                </h2>
                
                <form action="{{ route('admin.insurances.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Aseguradora / Compañía</label>
                        <input type="text" name="company_name" value="{{ old('company_name') }}" placeholder="Ej. AXA Seguros" 
                               class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('company_name') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Código de Convenio</label>
                        <input type="text" name="agreement_code" value="{{ old('agreement_code') }}" placeholder="Ej. CONV-AXA-2026" 
                               class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('agreement_code') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Porcentaje de Cobertura</label>
                        <div class="relative rounded-md shadow-sm">
                            <input type="number" name="coverage_percentage" value="{{ old('coverage_percentage') }}" placeholder="Ej. 80" min="0" max="100"
                                   class="w-full text-sm rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 pr-8">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-sm">%</span>
                            </div>
                        </div>
                        @error('coverage_percentage') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Notas / Deducibles <span class="text-gray-400 text-xs font-normal">(Opcional)</span></label>
                        <textarea name="notes" rows="3" placeholder="Especificaciones de coaseguro o restricciones..." 
                                  class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('notes') }}</textarea>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" id="is_active" value="1" checked class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="is_active" class="ml-2 block text-sm text-gray-900 font-medium">Convenio Activo de Inmediato</label>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md font-semibold text-sm hover:bg-blue-700 transition shadow-sm flex justify-center items-center">
                            <i class="fa-solid fa-shield-halved mr-2"></i> Registrar Convenio
                        </button>
                    </div>
                </form>
            </div>

            {{-- Columna 2 y 3: Tabla de Visualización --}}
            <div class="lg:col-span-2 bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden h-fit">
                <div class="bg-gray-50 p-4 border-b border-gray-200">
                    <h2 class="text-lg font-bold text-gray-900"><i class="fa-solid fa-list-check text-gray-600 mr-2"></i>Convenios Registrados</h2>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                        <thead class="bg-gray-100 text-gray-700 font-semibold">
                            <tr>
                                <th class="p-4">Aseguradora</th>
                                <th class="p-4">Código</th>
                                <th class="p-4">Cobertura</th>
                                <th class="p-4">Estatus</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-gray-600">
                            @forelse($insurances as $insurance)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="p-4 font-bold text-gray-900">
                                        <i class="fa-solid fa-building-shield text-blue-500 mr-2"></i>{{ $insurance->company_name }}
                                    </td>
                                    <td class="p-4 font-mono text-xs text-gray-700 bg-gray-50 px-2 py-1 rounded w-fit border border-gray-100">{{ $insurance->agreement_code }}</td>
                                    <td class="p-4">
                                        <div class="flex items-center gap-2">
                                            <span class="font-semibold text-gray-900">{{ $insurance->coverage_percentage }}%</span>
                                            <div class="w-24 bg-gray-200 rounded-full h-1.5 hidden sm:block">
                                                <div class="bg-green-500 h-1.5 rounded-full" style="width: {{ $insurance->coverage_percentage }}%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        @if($insurance->is_active)
                                            <span class="px-2.5 py-1 text-xs font-bold bg-green-100 text-green-800 rounded-full"><i class="fa-solid fa-circle-check mr-1"></i>Vigente</span>
                                        @else
                                            <span class="px-2.5 py-1 text-xs font-bold bg-red-100 text-red-800 rounded-full"><i class="fa-solid fa-circle-xmark mr-1"></i>Suspendido</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-8 text-center text-gray-400 italic bg-gray-50">
                                        <i class="fa-solid fa-triangle-exclamation text-xl mb-2 block text-gray-300"></i> No hay convenios de seguro registrados actualmente.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>