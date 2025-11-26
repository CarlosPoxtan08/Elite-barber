<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-2xl sm:rounded-2xl p-8 border-t-4" style="border-color: #D4AF37;">
            <div class="flex items-center mb-8">
                <i class="fas fa-chart-line text-4xl mr-4" style="color: #D4AF37;"></i>
                <div>
                    <h2 class="text-3xl font-bold text-gray-800" style="font-family: 'Playfair Display', serif;">Panel
                        de Administración</h2>
                    <p class="text-gray-600">Vista general del sistema</p>
                </div>
            </div>

            <!-- Estadísticas de Usuarios -->
            <div class="mb-8">
                <h3 class="text-xl font-semibold text-gray-700 mb-4 flex items-center">
                    <i class="fas fa-users mr-2" style="color: #D4AF37;"></i>Usuarios
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div
                        class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl border-l-4 border-blue-500 shadow-md hover:shadow-lg transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-blue-700 font-semibold mb-1">Total Usuarios</p>
                                <p class="text-4xl font-bold text-blue-800">{{ $totalUsers }}</p>
                            </div>
                            <i class="fas fa-users text-3xl text-blue-300"></i>
                        </div>
                    </div>
                    <div
                        class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-xl border-l-4 border-purple-500 shadow-md hover:shadow-lg transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-purple-700 font-semibold mb-1">Administradores</p>
                                <p class="text-4xl font-bold text-purple-800">{{ $totalAdmins }}</p>
                            </div>
                            <i class="fas fa-user-shield text-3xl text-purple-300"></i>
                        </div>
                    </div>
                    <div
                        class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-xl border-l-4 border-green-500 shadow-md hover:shadow-lg transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-green-700 font-semibold mb-1">Staff</p>
                                <p class="text-4xl font-bold text-green-800">{{ $totalStaff }}</p>
                            </div>
                            <i class="fas fa-cut text-3xl text-green-300"></i>
                        </div>
                    </div>
                    <div
                        class="bg-gradient-to-br from-yellow-50 to-yellow-100 p-6 rounded-xl border-l-4 border-yellow-500 shadow-md hover:shadow-lg transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-yellow-700 font-semibold mb-1">Clientes</p>
                                <p class="text-4xl font-bold text-yellow-800">{{ $totalClients }}</p>
                            </div>
                            <i class="fas fa-user text-3xl text-yellow-300"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Estadísticas de Citas -->
            <div class="mb-8">
                <h3 class="text-xl font-semibold text-gray-700 mb-4 flex items-center">
                    <i class="fas fa-calendar-check mr-2" style="color: #D4AF37;"></i>Citas
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div
                        class="bg-gradient-to-br from-indigo-50 to-indigo-100 p-6 rounded-xl border-l-4 border-indigo-500 shadow-md hover:shadow-lg transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-indigo-700 font-semibold mb-1">Total Citas</p>
                                <p class="text-4xl font-bold text-indigo-800">{{ $totalAppointments }}</p>
                            </div>
                            <i class="fas fa-calendar-alt text-3xl text-indigo-300"></i>
                        </div>
                    </div>
                    <div
                        class="bg-gradient-to-br from-teal-50 to-teal-100 p-6 rounded-xl border-l-4 border-teal-500 shadow-md hover:shadow-lg transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-teal-700 font-semibold mb-1">Citas Hoy</p>
                                <p class="text-4xl font-bold text-teal-800">{{ $todayAppointments }}</p>
                            </div>
                            <i class="fas fa-calendar-day text-3xl text-teal-300"></i>
                        </div>
                    </div>
                    <div
                        class="bg-gradient-to-br from-cyan-50 to-cyan-100 p-6 rounded-xl border-l-4 border-cyan-500 shadow-md hover:shadow-lg transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-cyan-700 font-semibold mb-1">Esta Semana</p>
                                <p class="text-4xl font-bold text-cyan-800">{{ $weekAppointments }}</p>
                            </div>
                            <i class="fas fa-calendar-week text-3xl text-cyan-300"></i>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div
                        class="bg-gradient-to-br from-yellow-50 to-yellow-100 p-6 rounded-xl border-l-4 border-yellow-500 shadow-md hover:shadow-lg transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-yellow-700 font-semibold mb-1">Pendientes</p>
                                <p class="text-4xl font-bold text-yellow-800">{{ $pendingAppointments }}</p>
                            </div>
                            <i class="fas fa-clock text-3xl text-yellow-300"></i>
                        </div>
                    </div>
                    <div
                        class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-xl border-l-4 border-green-500 shadow-md hover:shadow-lg transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-green-700 font-semibold mb-1">Confirmadas</p>
                                <p class="text-4xl font-bold text-green-800">{{ $confirmedAppointments }}</p>
                            </div>
                            <i class="fas fa-check-circle text-3xl text-green-300"></i>
                        </div>
                    </div>
                    <div
                        class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl border-l-4 border-blue-500 shadow-md hover:shadow-lg transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-blue-700 font-semibold mb-1">Completadas</p>
                                <p class="text-4xl font-bold text-blue-800">{{ $completedAppointments }}</p>
                            </div>
                            <i class="fas fa-check-double text-3xl text-blue-300"></i>
                        </div>
                    </div>
                    <div
                        class="bg-gradient-to-br from-red-50 to-red-100 p-6 rounded-xl border-l-4 border-red-500 shadow-md hover:shadow-lg transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-red-700 font-semibold mb-1">Canceladas</p>
                                <p class="text-4xl font-bold text-red-800">{{ $cancelledAppointments }}</p>
                            </div>
                            <i class="fas fa-times-circle text-3xl text-red-300"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Servicios Más Solicitados -->
            <div class="mb-8">
                <h3 class="text-xl font-semibold text-gray-700 mb-4 flex items-center">
                    <i class="fas fa-star mr-2" style="color: #D4AF37;"></i>Servicios Más Solicitados
                </h3>
                <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-6 rounded-xl border-l-4 shadow-md"
                    style="border-color: #D4AF37;">
                    @if($popularServices->count() > 0)
                        <ul class="space-y-3">
                            @foreach($popularServices as $item)
                                <li
                                    class="flex justify-between items-center p-3 bg-white rounded-lg shadow-sm hover:shadow-md transition">
                                    <span class="text-gray-800 font-semibold flex items-center">
                                        <i class="fas fa-scissors mr-3" style="color: #D4AF37;"></i>
                                        {{ $item->service->name }}
                                    </span>
                                    <span class="px-4 py-2 rounded-full text-sm font-bold text-white shadow-md"
                                        style="background: linear-gradient(135deg, #D4AF37 0%, #B8860B 100%);">
                                        <i class="fas fa-chart-bar mr-1"></i>{{ $item->total }} citas
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500 text-center py-4">
                            <i class="fas fa-info-circle mr-2"></i>No hay datos disponibles
                        </p>
                    @endif
                </div>
            </div>

            <!-- Enlaces Rápidos -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="{{ route('admin.users.index') }}"
                    class="block text-white text-center py-4 px-6 rounded-xl font-bold shadow-lg hover:shadow-xl transition transform hover:-translate-y-1"
                    style="background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);">
                    <i class="fas fa-users-cog mr-2"></i>Gestionar Usuarios
                </a>
                <a href="{{ route('admin.appointments.index') }}"
                    class="block text-white text-center py-4 px-6 rounded-xl font-bold shadow-lg hover:shadow-xl transition transform hover:-translate-y-1"
                    style="background: linear-gradient(135deg, #10B981 0%, #059669 100%);">
                    <i class="fas fa-calendar-alt mr-2"></i>Gestionar Citas
                </a>
            </div>
        </div>
    </div>
</div>