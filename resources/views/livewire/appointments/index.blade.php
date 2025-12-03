<div class="p-6 bg-white border-b border-gray-200">
    <div class="flex justify-between mb-4">
        <h2 class="text-xl font-bold">Citas</h2>
        @if(auth()->user()->hasRole('client') || auth()->user()->hasRole('admin'))
            <a href="{{ route(auth()->user()->hasRole('admin') ? 'admin.appointments.create' : 'client.appointments.create') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded">Nueva Cita</a>
        @endif
    </div>

    <table class="min-w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">Fecha</th>
                <th class="px-4 py-2">Cliente</th>
                <th class="px-4 py-2">Barbero</th>
                <th class="px-4 py-2">Servicio</th>
                <th class="px-4 py-2">Estado</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
                <tr>
                    <td class="border px-4 py-2">{{ $appointment->scheduled_at->format('d/m/Y H:i') }}</td>
                    <td class="border px-4 py-2">{{ $appointment->client->name }}</td>
                    <td class="border px-4 py-2">{{ $appointment->barber->name ?? 'Sin asignar' }}</td>
                    <td class="border px-4 py-2">{{ $appointment->service->name }}</td>
                    <td class="border px-4 py-2">
                        <span class="px-2 py-1 rounded text-sm
                                            {{ $appointment->status === 'confirmed' ? 'bg-green-200 text-green-800' : '' }}
                                            {{ $appointment->status === 'pending' ? 'bg-yellow-200 text-yellow-800' : '' }}
                                            {{ $appointment->status === 'cancelled' ? 'bg-red-200 text-red-800' : '' }}
                                            {{ $appointment->status === 'completed' ? 'bg-blue-200 text-blue-800' : '' }}
                                        ">
                            {{ ucfirst($appointment->status) }}
                        </span>
                    </td>
                    <td class="border px-4 py-2">
                        @if($appointment->status === 'pending')
                            <button wire:click="cancel({{ $appointment->id }})"
                                class="bg-red-500 text-white px-2 py-1 rounded text-sm">Cancelar</button>
                            @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('staff'))
                                <button wire:click="confirm({{ $appointment->id }})"
                                    class="bg-green-500 text-white px-2 py-1 rounded text-sm">Confirmar</button>
                            @endif
                        @elseif($appointment->status === 'confirmed')
                            <button wire:click="cancel({{ $appointment->id }})"
                                class="bg-red-500 text-white px-2 py-1 rounded text-sm">Cancelar</button>
                            @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('staff'))
                                <button wire:click="complete({{ $appointment->id }})"
                                    class="bg-blue-500 text-white px-2 py-1 rounded text-sm">Completar</button>
                            @endif
                        @endif

                        @php
                            $canEdit = false;
                            if (auth()->user()->hasRole('admin')) {
                                $canEdit = true;
                            } elseif (auth()->user()->hasRole('staff') && $appointment->staff_id === auth()->id()) {
                                $canEdit = true;
                            } elseif (auth()->user()->hasRole('client') && $appointment->client_id === auth()->id() && in_array($appointment->status, ['pending', 'confirmed'])) {
                                $canEdit = true;
                            }
                        @endphp

                        @if($canEdit)
                            <a href="{{ route(auth()->user()->hasRole('admin') ? 'admin.appointments.edit' : (auth()->user()->hasRole('staff') ? 'staff.appointments.edit' : 'client.appointments.edit'), $appointment) }}"
                                class="bg-yellow-500 text-white px-2 py-1 rounded text-sm ml-1">Editar</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $appointments->links() }}
    </div>
</div>