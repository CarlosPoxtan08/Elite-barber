<div class="space-y-6">
    <!-- Welcome Header -->
    <div class="dashboard-card p-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 rounded-full flex items-center justify-center"
                    style="background: linear-gradient(135deg, #D4AF37 0%, #B8860B 100%);">
                    <i class="fas fa-cut text-3xl text-white"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-gray-800" style="font-family: 'Playfair Display', serif;">
                        Panel de Staff
                    </h2>
                    <p class="text-gray-600">Bienvenido, {{ auth()->user()->name }}</p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-500">Última conexión</p>
                <p class="text-lg font-semibold text-gray-800">{{ now()->locale('es')->isoFormat('D MMM Y, H:mm') }}</p>
            </div>
        </div>
    </div>

    <!-- Flash Message -->
    @if (session()->has('message'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg shadow-md">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                <p class="text-green-700 font-medium">{{ session('message') }}</p>
            </div>
        </div>
    @endif

    <!-- Estadísticas Rápidas -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="stat-card transform hover:scale-105 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-white/80 text-sm font-medium mb-1">Total Citas</p>
                    <p class="text-4xl font-bold">{{ $totalAppointments }}</p>
                </div>
                <i class="fas fa-calendar-alt text-5xl text-white/20"></i>
            </div>
        </div>
        <div
            class="bg-gradient-to-br from-yellow-400 to-yellow-600 text-white rounded-xl p-6 shadow-lg transform hover:scale-105 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-white/80 text-sm font-medium mb-1">Pendientes</p>
                    <p class="text-4xl font-bold">{{ $pendingAppointments }}</p>
                </div>
                <i class="fas fa-clock text-5xl text-white/20"></i>
            </div>
        </div>
        <div
            class="bg-gradient-to-br from-green-400 to-green-600 text-white rounded-xl p-6 shadow-lg transform hover:scale-105 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-white/80 text-sm font-medium mb-1">Confirmadas</p>
                    <p class="text-4xl font-bold">{{ $confirmedAppointments }}</p>
                </div>
                <i class="fas fa-check-circle text-5xl text-white/20"></i>
            </div>
        </div>
        <div
            class="bg-gradient-to-br from-purple-400 to-purple-600 text-white rounded-xl p-6 shadow-lg transform hover:scale-105 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-white/80 text-sm font-medium mb-1">Completadas Hoy</p>
                    <p class="text-4xl font-bold">{{ $completedToday }}</p>
                </div>
                <i class="fas fa-check-double text-5xl text-white/20"></i>
            </div>
        </div>
    </div>

    <!-- Citas de Hoy -->
    <div class="dashboard-card p-6">
        <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center"
            style="font-family: 'Playfair Display', serif;">
            <i class="fas fa-calendar-day mr-3 gold-accent"></i>Citas de Hoy
        </h3>
        @if($todayAppointments->count() > 0)
            <div class="space-y-4">
                @foreach($todayAppointments as $appointment)
                    <div class="bg-gradient-to-r from-gray-50 to-white p-5 rounded-xl border-l-4 shadow-sm hover:shadow-md transition
                                                {{ $appointment->status === 'pending' ? 'border-yellow-500' : '' }}
                                                {{ $appointment->status === 'confirmed' ? 'border-green-500' : '' }}
                                                {{ $appointment->status === 'completed' ? 'border-blue-500' : '' }}">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-6">
                                <div class="text-center bg-white rounded-lg p-3 shadow-sm">
                                    <p class="text-sm text-gray-600 font-medium">{{ $appointment->scheduled_at->format('H:i') }}
                                    </p>
                                    <i class="fas fa-clock text-2xl gold-accent mt-1"></i>
                                </div>
                                <div>
                                    <p class="text-lg font-bold text-gray-800">{{ $appointment->client->name }}</p>
                                    <p class="text-sm text-gray-600 flex items-center mt-1">
                                        <i class="fas fa-scissors mr-2 gold-accent"></i>
                                        {{ $appointment->service->name }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span
                                    class="px-4 py-2 rounded-full text-sm font-bold
                                                            {{ $appointment->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                            {{ $appointment->status === 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                                                            {{ $appointment->status === 'completed' ? 'bg-blue-100 text-blue-800' : '' }}
                                                            {{ $appointment->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ ucfirst($appointment->status) }}
                                </span>

                                @if($appointment->status === 'pending')
                                    <button wire:click="confirmAppointment({{ $appointment->id }})"
                                        class="btn-barber text-white px-4 py-2 rounded-lg font-semibold shadow-md hover:shadow-lg transition">
                                        <i class="fas fa-check mr-2"></i>Confirmar
                                    </button>
                                    <button wire:click="cancelAppointment({{ $appointment->id }})"
                                        class="bg-gradient-to-r from-red-500 to-red-600 text-white px-4 py-2 rounded-lg font-semibold shadow-md hover:shadow-lg transition">
                                        <i class="fas fa-times mr-2"></i>Cancelar
                                    </button>
                                @elseif($appointment->status === 'confirmed')
                                    <button wire:click="completeAppointment({{ $appointment->id }})"
                                        class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-4 py-2 rounded-lg font-semibold shadow-md hover:shadow-lg transition">
                                        <i class="fas fa-check-double mr-2"></i>Completar
                                    </button>
                                    <button wire:click="cancelAppointment({{ $appointment->id }})"
                                        class="bg-gradient-to-r from-red-500 to-red-600 text-white px-4 py-2 rounded-lg font-semibold shadow-md hover:shadow-lg transition">
                                        <i class="fas fa-times mr-2"></i>Cancelar
                                    </button>
                                @elseif($appointment->status === 'completed')
                                    <span class="text-sm text-gray-500 italic">
                                        <i class="fas fa-check-circle mr-1"></i>Completada
                                    </span>
                                @elseif($appointment->status === 'cancelled')
                                    <span class="text-sm text-gray-500 italic">
                                        <i class="fas fa-ban mr-1"></i>Cancelada
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 bg-gray-50 rounded-xl">
                <i class="fas fa-calendar-times text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 text-lg">No tienes citas programadas para hoy</p>
            </div>
        @endif
    </div>

    <!-- Próximas Citas -->
    <div class="dashboard-card p-6">
        <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center"
            style="font-family: 'Playfair Display', serif;">
            <i class="fas fa-calendar-week mr-3 gold-accent"></i>Próximas Citas
        </h3>
        @if($upcomingAppointments->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($upcomingAppointments as $appointment)
                    <div class="bg-white border-2 p-5 rounded-xl shadow-sm hover:shadow-md transition
                                        {{ $appointment->status === 'pending' ? 'border-yellow-300' : '' }}
                                        {{ $appointment->status === 'confirmed' ? 'border-green-300' : '' }}
                                        {{ $appointment->status === 'completed' ? 'border-blue-300' : '' }}
                                        {{ $appointment->status === 'cancelled' ? 'border-red-300' : '' }}">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <p class="font-bold text-gray-800 text-lg">{{ $appointment->client->name }}</p>
                                <p class="text-sm text-gray-600 flex items-center mt-1">
                                    <i class="fas fa-scissors mr-2 gold-accent"></i>
                                    {{ $appointment->service->name }}
                                </p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs font-bold
                                                {{ $appointment->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ $appointment->status === 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $appointment->status === 'completed' ? 'bg-blue-100 text-blue-800' : '' }}
                                                {{ $appointment->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600 mb-3">
                            <i class="far fa-calendar mr-2 gold-accent"></i>
                            <span class="font-semibold">{{ $appointment->scheduled_at->format('d/m/Y H:i') }}</span>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-2 mt-3">
                            @if($appointment->status === 'pending')
                                <button wire:click="confirmAppointment({{ $appointment->id }})"
                                    class="flex-1 btn-barber text-white px-3 py-2 rounded-lg text-sm font-semibold shadow-md hover:shadow-lg transition">
                                    <i class="fas fa-check mr-1"></i>Confirmar
                                </button>
                                <button wire:click="cancelAppointment({{ $appointment->id }})"
                                    class="flex-1 bg-gradient-to-r from-red-500 to-red-600 text-white px-3 py-2 rounded-lg text-sm font-semibold shadow-md hover:shadow-lg transition">
                                    <i class="fas fa-times mr-1"></i>Cancelar
                                </button>
                            @elseif($appointment->status === 'confirmed')
                                <button wire:click="completeAppointment({{ $appointment->id }})"
                                    class="flex-1 bg-gradient-to-r from-blue-500 to-blue-600 text-white px-3 py-2 rounded-lg text-sm font-semibold shadow-md hover:shadow-lg transition">
                                    <i class="fas fa-check-double mr-1"></i>Completar
                                </button>
                                <button wire:click="cancelAppointment({{ $appointment->id }})"
                                    class="flex-1 bg-gradient-to-r from-red-500 to-red-600 text-white px-3 py-2 rounded-lg text-sm font-semibold shadow-md hover:shadow-lg transition">
                                    <i class="fas fa-times mr-1"></i>Cancelar
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8 bg-gray-50 rounded-xl">
                <i class="fas fa-info-circle text-4xl text-gray-300 mb-3"></i>
                <p class="text-gray-500">No tienes citas próximas</p>
            </div>
        @endif
    </div>

    <!-- Enlaces Rápidos -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="{{ route('staff.appointments.index') }}"
            class="dashboard-card p-6 text-center hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-600 hover:text-white transition group">
            <i class="fas fa-calendar-alt text-5xl mb-3 gold-accent group-hover:text-white transition"></i>
            <h4 class="text-xl font-bold">Ver Todas Mis Citas</h4>
        </a>
        <a href="{{ route('staff.appointments.index') }}"
            class="dashboard-card p-6 text-center hover:bg-gradient-to-r hover:from-green-500 hover:to-green-600 hover:text-white transition group">
            <i class="fas fa-clock text-5xl mb-3 gold-accent group-hover:text-white transition"></i>
            <h4 class="text-xl font-bold">Gestionar Horarios</h4>
        </a>
    </div>
</div>