<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Barbería Elite</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:400,700|inter:400,500,600&display=swap"
        rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    <style>
        :root {
            --barber-gold: #D4AF37;
            --barber-dark: #1a1a1a;
            --barber-brown: #8B4513;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        h1,
        h2,
        h3 {
            font-family: 'Playfair Display', serif;
        }

        .barber-bg {
            background:
                linear-gradient(135deg, rgba(26, 26, 26, 0.92) 0%, rgba(45, 45, 45, 0.92) 100%),
                url('https://images.unsplash.com/photo-1585747860715-2ba37e788b70?q=80&w=2074&auto=format&fit=crop') center/cover;
            background-attachment: fixed;
        }

        .login-card {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.98);
            border: 2px solid rgba(212, 175, 55, 0.3);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .gold-accent {
            color: var(--barber-gold);
        }

        .btn-barber {
            background: linear-gradient(135deg, var(--barber-gold) 0%, #B8860B 100%);
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.4);
        }

        .btn-barber:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.6);
        }

        .scissors-icon {
            animation: rotate 20s linear infinite;
            filter: drop-shadow(0 0 10px rgba(212, 175, 55, 0.5));
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .barber-pattern {
            background-image:
                repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(212, 175, 55, 0.03) 35px, rgba(212, 175, 55, 0.03) 70px);
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div
        class="min-h-screen barber-bg barber-pattern flex flex-col justify-center items-center py-12 px-4 sm:px-6 lg:px-8">
        <!-- Logo/Brand -->
        <div class="text-center mb-8 animate-fade-in">
            <div class="relative inline-block">
                <i class="fas fa-cut text-7xl gold-accent scissors-icon mb-4"></i>
                <div class="absolute -top-2 -right-2 w-4 h-4 bg-yellow-400 rounded-full animate-ping"></div>
            </div>
            <h1 class="text-5xl font-bold text-white mb-3 tracking-tight"
                style="font-family: 'Playfair Display', serif; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                Barbería Elite
            </h1>
            <div class="flex items-center justify-center space-x-2 mb-2">
                <div class="h-px w-12 bg-gradient-to-r from-transparent to-yellow-500"></div>
                <p class="text-yellow-400 text-sm font-semibold tracking-widest uppercase">Estilo y Distinción</p>
                <div class="h-px w-12 bg-gradient-to-l from-transparent to-yellow-500"></div>
            </div>
            <p class="text-gray-300 text-xs">Desde 1995</p>
        </div>

        <!-- Content -->
        <div class="w-full max-w-md">
            {{ $slot }}
        </div>

        <!-- Footer -->
        <div class="mt-10 text-center">
            <div class="flex items-center justify-center space-x-6 mb-4">
                <a href="#" class="text-gray-400 hover:text-yellow-400 transition">
                    <i class="fab fa-facebook-f text-xl"></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-yellow-400 transition">
                    <i class="fab fa-instagram text-xl"></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-yellow-400 transition">
                    <i class="fab fa-whatsapp text-xl"></i>
                </a>
            </div>
            <p class="text-gray-400 text-sm">&copy; {{ date('Y') }} Barbería Elite. Todos los derechos reservados.</p>
            <p class="text-gray-500 text-xs mt-1">Diseñado con <i class="fas fa-heart text-red-500"></i> para caballeros
                distinguidos</p>
        </div>
    </div>

    @livewireScripts
</body>

</html>