<div class="space-y-6 max-w-6xl mx-auto p-4">
    {{-- Encabezado Superior Profesional --}}
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <span class="px-2 py-0.5 text-xs font-bold uppercase bg-blue-100 text-blue-800 rounded-md">Consulta en Progreso</span>
            <h1 class="text-2xl font-bold text-gray-900 mt-1">Paciente: {{ $appointment->patient->user->name }}</h1>
            <p class="text-sm text-gray-500">Atendido por: Dr(a). {{ $appointment->doctor->user->name }}</p>
        </div>
        <div class="flex gap-2 w-full sm:w-auto">
            {{-- Enlace directo al expediente histórico del módulo previo --}}
            <a href="{{ route('admin.patients.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-700 bg-blue-50 border border-blue-200 rounded-md hover:bg-blue-100 transition">
                <i class="fa-solid fa-folder-open mr-2"></i> Ver Historia Expediente
            </a>
            <button wire:click="openHistoryModal" class="inline-flex items-center px-4 py-2 text-sm font-medium text-purple-700 bg-purple-50 border border-purple-200 rounded-md hover:bg-purple-100 transition">
                <i class="fa-solid fa-clock-rotate-left mr-2"></i> Consultas Anteriores
            </button>
        </div>
    </div>

    {{-- Navegador de Pestañas con Control de Alertas --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="border-b border-gray-200 bg-gray-50 px-4">
            <nav class="flex space-x-6" aria-label="Tabs">
                <button wire:click="$set('currentTab', 'consulta')"
                    class="py-4 px-1 border-b-2 font-medium text-sm transition-all relative {{ $currentTab === 'consulta' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500 hover:text-blue-600' }}">
                    <i class="fa-solid fa-notes-medical mr-2"></i> Ficha de Consulta
                    @if($errors->has('diagnosis') || $errors->has('treatment'))
                        <span class="absolute top-2 right-[-8px] w-2 h-2 bg-red-500 rounded-full animate-ping"></span>
                    @endif
                </button>
                <button wire:click="$set('currentTab', 'receta')"
                    class="py-4 px-1 border-b-2 font-medium text-sm transition-all {{ $currentTab === 'receta' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500 hover:text-blue-600' }}">
                    <i class="fa-solid fa-prescription-bottle-medical mr-2"></i> Receta Médica
                    @if(count($medications) >= 2)
                        <span class="ml-2 px-1.5 py-0.5 text-xs font-bold bg-green-100 text-green-800 rounded-full">{{ count($medications) }}</span>
                    @endif
                </button>
            </nav>
        </div>

        <div class="p-6">
            {{-- PESTAÑA 1: CONSULTA --}}
            <div x-show="$wire.currentTab === 'consulta'">
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Diagnóstico Clínico <span class="text-red-500">*</span></label>
                        <textarea wire:model="diagnosis" rows="3" placeholder="Ej. Faringoamigdalitis bacteriana aguda..." class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                        @error('diagnosis') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Plan de Tratamiento General <span class="text-red-500">*</span></label>
                        <textarea wire:model="treatment" rows="3" placeholder="Ej. Reposo por 3 días, abundante toma de líquidos..." class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                        @error('treatment') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Notas de Evolución <span class="text-gray-400 font-normal">(Opcional / No requerido)</span></label>
                        <textarea wire:model="notes" rows="2" placeholder="Observaciones extras de la exploración física..." class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                    </div>
                </div>
            </div>

            {{-- PESTAÑA 2: RECETA --}}
            <div x-show="$wire.currentTab === 'receta'" x-cloak>
                <div class="space-y-6">
                    <div class="bg-gray-50 p-4 rounded-md border border-gray-200 grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Medicamento / Fármaco</label>
                            <input type="text" wire:model="newMedicationName" placeholder="Ej. Paracetamol 500mg" class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500">
                            @error('newMedicationName') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Posología / Frecuencia</label>
                            <input type="text" wire:model="newMedicationDosage" placeholder="Ej. 1 tableta cada 8 horas por 5 días" class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500">
                            @error('newMedicationDosage') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <button type="button" wire:click="addMedication" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md font-medium text-sm hover:bg-blue-700 transition">
                                <i class="fa-solid fa-plus mr-1"></i> Incluir a Receta
                            </button>
                        </div>
                    </div>

                    {{-- Listado de Medicamentos Agregados --}}
                    <div>
                        <h3 class="text-sm font-bold text-gray-800 mb-3">Medicamentos en la Receta</h3>
                        @if(count($medications) === 0)
                            <p class="text-sm text-gray-400 italic bg-gray-50 p-4 rounded text-center">No se han añadido fármacos a la receta actual. Añade al menos dos.</p>
                        @else
                            <div class="border border-gray-200 rounded-md divide-y divide-gray-200">
                                @foreach($medications as $index => $med)
                                    <div class="p-3 flex justify-between items-center text-sm hover:bg-gray-50">
                                        <div>
                                            <span class="font-bold text-gray-900">{{ $med['name'] }}</span>
                                            <span class="mx-2 text-gray-400">|</span>
                                            <span class="text-gray-600">{{ $med['dosage'] }}</span>
                                        </div>
                                        <button type="button" wire:click="removeMedication({{ $index }})" class="text-red-500 hover:text-red-700">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Barra de Control Inferior --}}
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-end gap-3">
            <a href="{{ route('admin.appointments.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Salir sin Guardar</a>
            <button type="button" wire:click="saveConsultation" class="px-5 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700 transition shadow-sm">
                <i class="fa-solid fa-floppy-disk mr-2"></i> Terminar y Archivar Consulta
            </button>
        </div>
    </div>

    {{-- MODAL NATIVO: CONSULTAS ANTERIORES --}}
    @if($showHistoryModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="$set('showHistoryModal', false)"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">
                    <div class="bg-white px-6 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="flex justify-between items-center border-b border-gray-200 pb-3 mb-4">
                            <h3 class="text-lg font-bold text-gray-900"><i class="fa-solid fa-history text-purple-600 mr-2"></i>Historial de Consultas Médicas Pasadas</h3>
                            <button wire:click="$set('showHistoryModal', false)" class="text-gray-400 hover:text-gray-600 text-xl">&times;</button>
                        </div>

                        <div class="space-y-4 max-h-[450px] overflow-y-auto pr-2">
                            @forelse($pastConsultations as $past)
                                <div class="p-4 bg-gray-50 border border-gray-200 rounded-md space-y-2">
                                    <div class="flex justify-between text-xs font-bold text-gray-500">
                                        <span>Atendió: Dr(a). {{ $past['doctor'] }}</span>
                                        <span>Fecha: {{ $past['date'] }}</span>
                                    </div>
                                    <p class="text-sm text-gray-900"><strong>Diagnóstico:</strong> {{ $past['diagnosis'] }}</p>
                                    <p class="text-sm text-gray-700 bg-white p-2 rounded border border-gray-100"><strong>Tratamiento:</strong> {{ $past['treatment'] }}</p>
                                </div>
                            @empty
                                <p class="text-sm text-gray-400 italic text-center py-6">El paciente no registra consultas previas archivadas en el sistema.</p>
                            @endforelse
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-3 flex justify-end">
                        <button type="button" wire:click="$set('showHistoryModal', false)" class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">Cerrar Historial</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
