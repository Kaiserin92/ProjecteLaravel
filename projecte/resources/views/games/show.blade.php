<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalles del Videojuego
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <h3 class="text-2xl font-bold mb-2">Título del Juego</h3>
                <p class="mb-4 text-gray-700"><strong>Género:</strong> RPG</p>
                <p class="mb-4 text-gray-700"><strong>Año de salida:</strong> 2022</p>

                <div class="mt-6 border-t pt-4">
                    @auth
                        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            + Añadir a mi Colección
                        </button>
                    @else
                        <p class="text-red-500">Inicia sesión para añadir este juego a tu lista.</p>
                    @endauth
                </div>

            </div>
        </div>
    </div>
</x-app-layout>