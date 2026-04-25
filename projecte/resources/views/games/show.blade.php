<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-200 leading-tight">
                {{ $game->title }}
            </h2>
            <a href="{{ route('games.index') }}" class="text-gray-400 hover:text-white transition text-sm">
                &larr; Volver al catálogo
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="max-w-5xl mx-auto mb-4 px-4 sm:px-6 lg:px-8">
                    <div class="bg-green-900 border border-green-500 text-green-200 px-4 py-3 rounded-xl shadow-lg">
                        {{ session('success') }}
                    </div>
                </div>
             @endif
            <div class="bg-gray-800 border border-gray-700 overflow-hidden shadow-xl sm:rounded-2xl">
                <div class="flex flex-col md:flex-row">
                    
                    <div class="md:w-1/3 bg-gray-900">
                        @if($game->image)
                            <img src="{{ asset('storage/' . $game->image) }}" alt="{{ $game->title }}" class="w-full h-full object-cover shadow-2xl">
                        @else
                            <div class="flex items-center justify-center h-64 md:h-full bg-gray-900 text-gray-600 italic">
                                Sin portada disponible
                            </div>
                        @endif
                    </div>

                    <div class="md:w-2/3 p-8 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center space-x-2 mb-4">
                                <span class="bg-indigo-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                                    {{ $game->genre ?? 'General' }}
                                </span>
                                <span class="text-gray-500 text-sm italic">
                                    Lanzado en {{ $game->release_year ?? 'N/A' }}
                                </span>
                            </div>

                            <h1 class="text-4xl font-extrabold text-white mb-2">{{ $game->title }}</h1>
                            <p class="text-xl text-indigo-400 font-medium mb-6">
                                Desarrollado por {{ $game->developer->name ?? 'Estudio desconocido' }}
                            </p>

                            <div class="border-t border-gray-700 pt-6 mt-6">
                                <h4 class="text-white font-bold mb-4">Sobre este título</h4>
                                <p class="text-gray-400 leading-relaxed italic">
                                    {{ $game->description ?? 'No hay descripción disponible para este título.' }}
                                </p>
                            </div>
                        </div>

                       <div class="mt-10 flex flex-col lg:flex-row gap-3 border-t border-gray-700 pt-8">
                            @auth
                                <form action="{{ route('collection.store', $game) }}" method="POST" class="flex flex-1 gap-2">
                                    @csrf
                                    <select name="status" class="w-2/5 bg-gray-700 border border-gray-600 text-white text-xs rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block px-2 py-2.5">
                                        <option value="pending">Pendiente</option>
                                        <option value="playing">Jugando</option>
                                        <option value="completed">Completado</option>
                                    </select>

                                    <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-2.5 px-2 rounded-xl transition shadow-lg shadow-indigo-500/20 text-center text-xs uppercase tracking-wider">
                                        + Colección
                                    </button>
                                </form>
                                
                                @if(Auth::user()->role === 'admin')
                                    <div class="flex gap-2 flex-1">
                                        <a href="{{ route('games.edit', $game) }}" class="flex-1 bg-gray-700 hover:bg-gray-600 text-white font-bold py-2.5 px-4 rounded-xl transition text-center text-sm flex items-center justify-center border border-transparent">
                                            Editar Ficha
                                        </a>

                                        <form action="{{ route('games.destroy', $game) }}" method="POST" class="flex-1" onsubmit="return confirm('¿Eliminar este juego?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full bg-red-900/40 hover:bg-red-800 text-red-200 font-bold py-2.5 px-4 rounded-xl border border-red-700 transition text-center text-sm">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>