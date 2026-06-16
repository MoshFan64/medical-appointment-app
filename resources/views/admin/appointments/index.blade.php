<x-admin-layout title="Control de Citas Médicas">
    <div class="space-y-6">
        <div class="flex justify-between items-center bg-white p-6 rounded-lg shadow-sm border border-gray-100">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Historial y Agenda de Citas</h1>
                <p class="text-sm text-gray-500">Módulo centralizado administrado de asignación directa de pacientes y personal médico.</p>
            </div>
            <x-wire-button href="{{ route('admin.appointments.create') }}" primary label="Agendar Nueva Cita" icon="calendar" />
        </div>

        @if(session('info'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg text-sm text-green-700">
                {{ session('info') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                <thead class="bg-gray-50 text-gray-700 font-semibold">
                    <tr>
                        <th class="p-4">Paciente</th>
                        <th class="p-4">Médico Asignado</th>
                        <th class="p-4">Fecha</th>
                        <th class="p-4">Horario (Inicio - Fin)</th>
                        <th class="p-4">Estatus</th>
                        <th class="p-4 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-gray-600">
                    @foreach($appointments as $appointment)
                        <tr class="hover:bg-gray-50">
                            <td class="p-4 font-medium text-gray-900">{{ $appointment->patient->user->name ?? 'N/A' }}</td>
                            <td class="p-4">Dr(a). {{ $appointment->doctor->user->name ?? 'N/A' }}</td>
                            <td class="p-4">{{ $appointment->date->format('d/m/Y') }}</td>
                            <td class="p-4 font-mono text-xs">{{ $appointment->start_time }} - {{ $appointment->end_time }}</td>
                            <td class="p-4">
                                @if($appointment->status == 1)
                                    <span class="px-2 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded-full">Programada</span>
                                @elseif($appointment->status == 2)
                                    <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded-full">Atendida</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold bg-red-100 text-red-800 rounded-full">Cancelada</span>
                                @endif
                            </td>
                            <td class="p-4 flex justify-center space-x-2">
                                @include('admin.appointments.actions', ['appointment' => $appointment])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
