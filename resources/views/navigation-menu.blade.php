<!-- Sidebar Navigation -->
<div class="flex flex-col h-full">
    <!-- Navigation Links -->
    <nav class="flex-1 mt-6 space-y-2">
        @if(auth()->user()->hasRole('admin'))
            <a href="{{ route('admin.dashboard') }}"
                class="sidebar-link flex items-center px-4 py-3 text-gray-300 hover:text-white {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-line w-6 mr-3"></i>
                <span class="font-medium">Dashboard</span>
            </a>
            <a href="{{ route('admin.users.index') }}"
                class="sidebar-link flex items-center px-4 py-3 text-gray-300 hover:text-white {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="fas fa-users w-6 mr-3"></i>
                <span class="font-medium">Usuarios</span>
            </a>
            <a href="{{ route('admin.appointments.index') }}"
                class="sidebar-link flex items-center px-4 py-3 text-gray-300 hover:text-white {{ request()->routeIs('admin.appointments.*') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt w-6 mr-3"></i>
                <span class="font-medium">Citas</span>
            </a>
        @elseif(auth()->user()->hasRole('staff'))
            <a href="{{ route('staff.dashboard') }}"
                class="sidebar-link flex items-center px-4 py-3 text-gray-300 hover:text-white {{ request()->routeIs('staff.dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-line w-6 mr-3"></i>
                <span class="font-medium">Dashboard</span>
            </a>
            <a href="{{ route('staff.appointments.index') }}"
                class="sidebar-link flex items-center px-4 py-3 text-gray-300 hover:text-white {{ request()->routeIs('staff.appointments.*') ? 'active' : '' }}">
                <i class="fas fa-calendar-check w-6 mr-3"></i>
                <span class="font-medium">Mis Citas</span>
            </a>
        @elseif(auth()->user()->hasRole('client'))
            <a href="{{ route('client.dashboard') }}"
                class="sidebar-link flex items-center px-4 py-3 text-gray-300 hover:text-white {{ request()->routeIs('client.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home w-6 mr-3"></i>
                <span class="font-medium">Inicio</span>
            </a>
            <a href="{{ route('client.appointments.index') }}"
                class="sidebar-link flex items-center px-4 py-3 text-gray-300 hover:text-white {{ request()->routeIs('client.appointments.index') ? 'active' : '' }}">
                <i class="fas fa-list w-6 mr-3"></i>
                <span class="font-medium">Mis Citas</span>
            </a>
            <a href="{{ route('client.appointments.create') }}"
                class="sidebar-link flex items-center px-4 py-3 text-gray-300 hover:text-white {{ request()->routeIs('client.appointments.create') ? 'active' : '' }}">
                <i class="fas fa-plus-circle w-6 mr-3"></i>
                <span class="font-medium">Agendar Cita</span>
            </a>
        @endif
    </nav>

    <!-- User Profile & Logout -->
    <div class="mt-auto border-t border-gray-700 pt-4 pb-4">
        <div class="px-4 mb-4">
            <div class="flex items-center space-x-3 mb-3">
                <div class="w-10 h-10 rounded-full flex items-center justify-center"
                    style="background: linear-gradient(135deg, #D4AF37 0%, #B8860B 100%);">
                    <i class="fas fa-user text-white"></i>
                </div>
                <div class="flex-1">
                    <p class="text-white font-semibold text-sm">{{ auth()->user()->name }}</p>
                    <p class="text-gray-400 text-xs">{{ auth()->user()->email }}</p>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-red-600 transition">
                <i class="fas fa-sign-out-alt w-6 mr-3"></i>
                <span class="font-medium">Cerrar Sesión</span>
            </button>
        </form>
    </div>
</div>