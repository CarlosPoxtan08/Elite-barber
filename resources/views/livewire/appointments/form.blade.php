<div class="p-6 bg-white border-b border-gray-200">
    <form wire:submit="save">
        @if(auth()->user()->hasRole('admin'))
            <div class="mb-4">
                <label class="block text-gray-700">Cliente</label>
                <select wire:model="client_id" class="w-full border rounded px-4 py-2">
                    <option value="">Seleccionar Cliente</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                    @endforeach
                </select>
                @error('client_id') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
        @endif

        <div class="mb-4">
            <label class="block text-gray-700">Servicio</label>
            <select wire:model="service_id" class="w-full border rounded px-4 py-2">
                <option value="">Seleccionar Servicio</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }} - ${{ $service->price }}</option>
                @endforeach
            </select>
            @error('service_id') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Barbero (Opcional)</label>
            <select wire:model="barber_id" class="w-full border rounded px-4 py-2">
                <option value="">Cualquiera</option>
                @foreach($barbers as $barber)
                    <option value="{{ $barber->id }}">{{ $barber->name }}</option>
                @endforeach
            </select>
            @error('barber_id') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Fecha y Hora</label>
            <input wire:model="scheduled_at" type="datetime-local" class="w-full border rounded px-4 py-2">
            @error('scheduled_at') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        @if(auth()->user()->hasRole('admin'))
            <div class="mb-4">
                <label class="block text-gray-700">Estado</label>
                <select wire:model="status" class="w-full border rounded px-4 py-2">
                    <option value="pending">Pendiente</option>
                    <option value="confirmed">Confirmada</option>
                    <option value="cancelled">Cancelada</option>
                    <option value="completed">Completada</option>
                </select>
                @error('status') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
        @endif

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Guardar</button>
        <a href="{{ url()->previous() }}" class="ml-2 text-gray-600">Cancelar</a>
    </form>
</div>