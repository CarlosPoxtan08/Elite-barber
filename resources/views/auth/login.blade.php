<x-guest-layout>
    <div class="login-card rounded-3xl shadow-2xl p-10 transform hover:scale-105 transition-transform duration-300">
        <!-- Session Status -->
        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-4 rounded-xl border-l-4 border-green-500">
                <i class="fas fa-check-circle mr-2"></i>{{ $value }}
            </div>
        @endsession

        <div class="text-center mb-8">
            <div class="w-20 h-20 mx-auto mb-4 rounded-full flex items-center justify-center"
                style="background: linear-gradient(135deg, #D4AF37 0%, #B8860B 100%);">
                <i class="fas fa-user text-3xl text-white"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-800 mb-2" style="font-family: 'Playfair Display', serif;">
                Bienvenido de Vuelta
            </h2>
            <p class="text-gray-600 text-sm">Ingresa tus credenciales para continuar</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div class="relative">
                <label for="email" class="block text-sm font-bold text-gray-700 mb-2 flex items-center">
                    <i class="fas fa-envelope mr-2 gold-accent"></i>Correo Electrónico
                </label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    autocomplete="username"
                    class="w-full px-5 py-4 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all bg-gray-50 hover:bg-white"
                    placeholder="tu@email.com">
            </div>

            <!-- Password -->
            <div class="relative">
                <label for="password" class="block text-sm font-bold text-gray-700 mb-2 flex items-center">
                    <i class="fas fa-lock mr-2 gold-accent"></i>Contraseña
                </label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="w-full px-5 py-4 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all bg-gray-50 hover:bg-white"
                    placeholder="••••••••">
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <label class="flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox" name="remember"
                        class="rounded border-gray-300 text-yellow-600 focus:ring-yellow-500 w-5 h-5">
                    <span class="ml-3 text-sm text-gray-700 font-medium">Recordarme</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="text-sm font-semibold gold-accent hover:underline flex items-center">
                        <i class="fas fa-question-circle mr-1"></i>¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>

            <!-- Actions -->
            <div class="space-y-4 pt-2">
                <button type="submit"
                    class="w-full btn-barber text-white font-bold py-4 px-6 rounded-xl shadow-lg transform transition-all hover:scale-105">
                    <i class="fas fa-sign-in-alt mr-2"></i>Iniciar Sesión
                </button>

                @if (Route::has('register'))
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white text-gray-500">o</span>
                        </div>
                    </div>

                    <a href="{{ route('register') }}"
                        class="block w-full text-center bg-white border-2 border-gray-300 text-gray-700 font-bold py-4 px-6 rounded-xl hover:bg-gray-50 hover:border-yellow-500 transition-all">
                        <i class="fas fa-user-plus mr-2"></i>Crear Nueva Cuenta
                    </a>
                @endif
            </div>
        </form>

        <!-- Additional Info -->
        <div class="mt-8 pt-6 border-t border-gray-200 text-center">
            <p class="text-xs text-gray-500 mb-2">
                <i class="fas fa-shield-alt mr-1 gold-accent"></i>
                Conexión segura y encriptada
            </p>
        </div>
    </div>
</x-guest-layout>