<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mi Colección de Juegos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold">Mis títulos guardados</h3>
                    <a href="{{ route('games.index') }}" class="text-sm bg-gray-200 px-3 py-1 rounded">Buscar más juegos</a>
                </div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Juego</th>
                            <th class="py-2">Estado</th>
                            <th class="py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <td class="py-3">Elden Ring</td>
                            <td class="py-3"><span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded">Jugando</span></td>
                            <td class="py-3 text-red-500 text-sm"><a href="#">Eliminar</a></td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>