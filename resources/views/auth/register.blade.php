<x-guest-layout>
    <div class="login-card rounded-2xl shadow-2xl p-8">
        <x-validation-errors class="mb-4" />

        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-2" style="font-family: 'Playfair Display', serif;">
                Crear Cuenta
            </h2>
            <p class="text-gray-600 text-sm">Únete a nuestra comunidad</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-user mr-2 gold-accent"></i>Nombre Completo
                </label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                    autocomplete="name"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-600 focus:border-transparent transition">
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-envelope mr-2 gold-accent"></i>Correo Electrónico
                </label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-600 focus:border-transparent transition">
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-lock mr-2 gold-accent"></i>Contraseña
                </label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-600 focus:border-transparent transition">
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-lock mr-2 gold-accent"></i>Confirmar Contraseña
                </label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    autocomplete="new-password"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-600 focus:border-transparent transition">
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mb-6">
                    <label class="flex items-start">
                        <input type="checkbox" name="terms" id="terms" required
                            class="rounded border-gray-300 text-yellow-600 focus:ring-yellow-600 mt-1">
                        <span class="ml-2 text-sm text-gray-600">
                            Acepto los
                            <a target="_blank" href="{{ route('terms.show') }}" class="gold-accent hover:underline">Términos
                                de Servicio</a>
                            y la
                            <a target="_blank" href="{{ route('policy.show') }}"
                                class="gold-accent hover:underline">Política de Privacidad</a>
                        </span>
                    </label>
                </div>
            @endif

            <!-- Actions -->
            <div class="space-y-4">
                <button type="submit" class="w-full btn-barber text-white font-bold py-3 px-6 rounded-lg shadow-lg">
                    <i class="fas fa-user-plus mr-2"></i>Registrarse
                </button>

                <div class="text-center pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-600">
                        ¿Ya tienes cuenta?
                        <a href="{{ route('login') }}" class="font-semibold gold-accent hover:underline">
                            Inicia sesión aquí
                        </a>
                    </p>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>