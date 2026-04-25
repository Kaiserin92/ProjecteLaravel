<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GameVault - Tu colección de videojuegos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-gray-300 font-sans antialiased">
    <div class="min-h-screen flex flex-col items-center justify-center relative selection:bg-indigo-500 selection:text-white">

        <div class="absolute top-0 right-0 p-6">
            @auth
                <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white font-semibold transition">Mi Panel</a>
            @else
                <a href="{{ route('login') }}" class="text-gray-300 hover:text-white font-semibold mr-4 transition">Iniciar Sesión</a>
                <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-500 font-semibold shadow-lg transition">Registrarse</a>
            @endauth
        </div>

        <div class="text-center max-w-2xl px-6">
            <h1 class="text-5xl font-extrabold tracking-tight text-white mb-6">
                Bienvenido a <span class="text-indigo-400">GameVault</span>
            </h1>
            <p class="text-lg text-gray-400 mb-8">
                La plataforma definitiva para explorar el catálogo de videojuegos, descubrir nuevos estudios de desarrollo y gestionar tu colección personal.
            </p>
            
            <div class="flex justify-center space-x-4">
                <a href="{{ route('games.index') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-bold text-lg hover:bg-indigo-500 shadow-lg shadow-indigo-500/30 transition transform hover:-translate-y-0.5">
                    Explorar Catálogo
                </a>
                
                @guest
                    <a href="{{ route('register') }}" class="bg-gray-800 text-indigo-400 border border-indigo-500/50 px-6 py-3 rounded-lg font-bold text-lg hover:bg-gray-700 shadow-lg transition">
                        Crear una cuenta
                    </a>
                @endguest
            </div>
        </div>

        <div class="absolute inset-0 -z-10 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-gray-800 via-gray-900 to-gray-900"></div>
    </div>
</body>
</html>