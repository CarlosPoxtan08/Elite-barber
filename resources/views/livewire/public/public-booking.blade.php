<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white shadow-2xl rounded-lg overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-8">
                <h2 class="text-3xl font-bold text-white text-center">Agenda tu Cita</h2>
                <p class="text-blue-100 text-center mt-2">Reserva tu servicio de barbería</p>
            </div>

            <form wire:submit="book" class="p-8 space-y-6">
                <!-- Nombre -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nombre Completo</label>
                    <input wire:model="client_name" type="text"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                        placeholder="Tu nombre completo">
                    @error('client_name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Correo Electrónico</label>
                    <input wire:model="client_email" type="email"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                        placeholder="tu@email.com">
                    @error('client_email') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Servicio -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Servicio</label>
                    <select wire:model="service_id"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        <option value="">Selecciona un servicio</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }} - ${{ $service->price }}</option>
                        @endforeach
                    </select>
                    @error('service_id') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Barbero -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Barbero (Opcional)</label>
                    <select wire:model="staff_id"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        <option value="">Cualquier barbero disponible</option>
                        @foreach($staff as $member)
                            <option value="{{ $member->id }}">{{ $member->name }}</option>
                        @endforeach
                    </select>
                    @error('staff_id') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Fecha y Hora -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Fecha y Hora</label>
                    <input wire:model="scheduled_at" type="datetime-local"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    @error('scheduled_at') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Botón -->
                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-bold py-4 px-6 rounded-lg shadow-lg transform transition hover:scale-105">
                        Agendar Cita
                    </button>
                </div>

                <div class="text-center pt-4">
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                        ¿Ya tienes cuenta? Inicia sesión
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>