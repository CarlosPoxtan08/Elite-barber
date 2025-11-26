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
            --barber-cream: #F5F5DC;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to bottom right, #f8f9fa 0%, #e9ecef 100%);
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Playfair Display', serif;
        }

        .sidebar {
            background: linear-gradient(180deg, #1a1a1a 0%, #2d2d2d 100%);
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
        }

        .sidebar-link {
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            background: rgba(212, 175, 55, 0.15);
            border-left-color: var(--barber-gold);
        }

        .gold-accent {
            color: var(--barber-gold);
        }

        .btn-barber {
            background: linear-gradient(135deg, var(--barber-gold) 0%, #B8860B 100%);
            transition: all 0.3s ease;
        }

        .btn-barber:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(212, 175, 55, 0.3);
        }

        .dashboard-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border-top: 4px solid var(--barber-gold);
            transition: all 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .stat-card {
            background: linear-gradient(135deg, var(--barber-gold) 0%, #B8860B 100%);
            color: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 10px 15px -3px rgba(212, 175, 55, 0.3);
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="sidebar w-64 min-h-screen flex-shrink-0">
            <div class="p-6">
                <!-- Logo -->
                <div class="mb-8 text-center">
                    <i class="fas fa-cut text-5xl gold-accent mb-3"></i>
                    <h2 class="text-2xl font-bold text-white" style="font-family: 'Playfair Display', serif;">Barbería
                        Elite</h2>
                    <p class="text-gray-400 text-xs mt-1">Panel de Control</p>
                </div>

                <!-- Navigation -->
                @livewire('navigation-menu')
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-h-screen">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm border-b-2 border-gray-100 flex-shrink-0">
                <div class="px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-home mr-2 gold-accent"></i>
                        <h1 class="text-xl font-bold text-gray-800">
                            @if(auth()->user()->hasRole('admin'))
                                Panel de Administración
                            @elseif(auth()->user()->hasRole('staff'))
                                Panel de Staff
                            @else
                                Mi Panel
                            @endif
                        </h1>
                    </div>

                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-600">
                            <i class="far fa-clock mr-1"></i>
                            {{ now()->format('d M Y, H:i') }}
                        </span>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6 overflow-y-auto">
                {{ $slot }}
            </main>
        </div>
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>