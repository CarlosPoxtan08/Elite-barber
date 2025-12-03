<div class="space-y-6">
    <!-- Welcome Header -->
    <div class="dashboard-card p-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 rounded-full flex items-center justify-center"
                    style="background: linear-gradient(135deg, #D4AF37 0%, #B8860B 100%);">
                    <i class="fas fa-user text-3xl text-white"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-gray-800" style="font-family: 'Playfair Display', serif;">
                        Mi Panel
                    </h2>
                    <p class="text-gray-600">Bienvenido, {{ auth()->user()->name }}</p>
                </div>
            </div>
            <a href="{{ route('client.appointments.create') }}"
                class="btn-barber text-white px-6 py-3 rounded-xl font-bold shadow-lg">
                <i class="fas fa-plus mr-2"></i>Nueva Cita
            </a>
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
                    <p class="text-white/80 text-sm font-medium mb-1">Completadas</p>
                    <p class="text-4xl font-bold">{{ $completedAppointments }}</p>
                </div>
                <i class="fas fa-check-double text-5xl text-white/20"></i>
            </div>
        </div>
    </div>

    <!-- Próximas Citas -->
    <div class="dashboard-card p-6">
        <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center"
            style="font-family: 'Playfair Display', serif;">
            <i class="fas fa-calendar-check mr-3 gold-accent"></i>Próximas Citas
        </h3>
        @if($upcomingAppointments->count() > 0)
            <div class="space-y-4">
                @foreach($upcomingAppointments as $appointment)
                    <div class="bg-gradient-to-r from-gray-50 to-white p-6 rounded-xl border-l-4 shadow-sm hover:shadow-lg transition
                                {{ $appointment->status === 'pending' ? 'border-yellow-500' : 'border-green-500' }}">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-6">
                                <div class="text-center bg-white rounded-lg p-4 shadow-sm">
                                    <p class="text-xs text-gray-500 mb-1">{{ $appointment->scheduled_at->locale('es')->isoFormat('D') }}</p>
                                    <p class="text-lg font-bold text-gray-800">{{ $appointment->scheduled_at->locale('es')->isoFormat('MMM') }}</p>
                                    <p class="text-sm gold-accent font-semibold mt-1">
                                        {{ $appointment->scheduled_at->format('H:i') }}</p>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xl font-bold text-gray-800 mb-2">{{ $appointment->service->name }}</p>
                                    <div class="flex items-center space-x-4 text-sm text-gray-600">
                                        <span class="flex items-center">
                                            <i class="fas fa-cut mr-2 gold-accent"></i>
                                            {{ $appointment->staff ? $appointment->staff->name : 'Por asignar' }}
                                        </span>
                                        <span class="flex items-center">
                                            <i class="fas fa-dollar-sign mr-2 gold-accent"></i>
                                            ${{ $appointment->service->price }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span
                                    class="px-4 py-2 rounded-full text-sm font-bold
                                            {{ $appointment->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $appointment->status === 'pending' ? 'Pendiente' : 'Confirmada' }}
                                </span>
                                @if(in_array($appointment->status, ['pending', 'confirmed']))
                                    <button wire:click="cancelAppointment({{ $appointment->id }})"
                                        wire:confirm="¿Estás seguro de cancelar esta cita?"
                                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-semibold shadow-md transition">
                                        <i class="fas fa-times mr-2"></i>Cancelar
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl">
                <i class="fas fa-calendar-times text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 text-lg mb-4">No tienes citas próximas</p>
                <a href="{{ route('client.appointments.create') }}"
                    class="btn-barber text-white px-8 py-3 rounded-xl font-bold shadow-lg inline-block">
                    <i class="fas fa-plus mr-2"></i>Agendar Primera Cita
                </a>
            </div>
        @endif
    </div>

    <!-- Historial de Citas -->
    <div class="dashboard-card p-6">
        <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center"
            style="font-family: 'Playfair Display', serif;">
            <i class="fas fa-history mr-3 gold-accent"></i>Historial Reciente
        </h3>
        @if($recentAppointments->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($recentAppointments as $appointment)
                    <div class="bg-white border-2 border-gray-100 p-4 rounded-xl hover:border-yellow-500 transition">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <p class="font-bold text-gray-800 text-lg">{{ $appointment->service->name }}</p>
                                <p class="text-sm text-gray-600 flex items-center mt-1">
                                    <i class="fas fa-cut mr-2 gold-accent"></i>
                                    {{ $appointment->staff ? $appointment->staff->name : 'No asignado' }}
                                </p>
                            </div>
                            <span
                                class="px-3 py-1 rounded-full text-xs font-bold
                                        {{ $appointment->status === 'completed' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800' }}">
                                {{ $appointment->status === 'completed' ? 'Completada' : 'Cancelada' }}
                            </span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="far fa-calendar mr-2 gold-accent"></i>
                            <span>{{ $appointment->scheduled_at->locale('es')->isoFormat('D/MM/Y H:mm') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8 bg-gray-50 rounded-xl">
                <i class="fas fa-info-circle text-4xl text-gray-300 mb-3"></i>
                <p class="text-gray-500">No tienes historial de citas</p>
            </div>
        @endif
    </div>

    <!-- Enlaces Rápidos -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="{{ route('client.appointments.create') }}"
            class="dashboard-card p-6 text-center hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-600 hover:text-white transition group">
            <i class="fas fa-calendar-plus text-5xl mb-3 gold-accent group-hover:text-white transition"></i>
            <h4 class="text-xl font-bold">Agendar Nueva Cita</h4>
        </a>
        <a href="{{ route('client.appointments.index') }}"
            class="dashboard-card p-6 text-center hover:bg-gradient-to-r hover:from-green-500 hover:to-green-600 hover:text-white transition group">
            <i class="fas fa-list text-5xl mb-3 gold-accent group-hover:text-white transition"></i>
            <h4 class="text-xl font-bold">Ver Todas Mis Citas</h4>
        </a>
    </div>
</div>