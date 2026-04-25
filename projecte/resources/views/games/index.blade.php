<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            Catálogo de Videojuegos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-900 border border-green-500 text-green-200 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-end items-center mb-8">
                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('games.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-500 transition shadow-lg shadow-indigo-500/20">
                            + Añadir Juego
                        </a>
                    @endif
                @endauth
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach($games as $game)
                    <div class="bg-gray-800 border border-gray-700 rounded-xl overflow-hidden shadow-lg hover:border-indigo-500 transition group">
                        
                        <div class="aspect-[3/4] w-full bg-gray-900 relative overflow-hidden">
                            @if($game->image)
                                <img src="{{ asset('storage/' . $game->image) }}" alt="{{ $game->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            @else
                                <div class="flex items-center justify-center h-full text-gray-600 italic text-sm">
                                    Sin portada
                                </div>
                            @endif
                            
                            <div class="absolute top-2 right-2">
                                <span class="bg-black/60 backdrop-blur-md text-indigo-400 text-[10px] font-bold px-2 py-1 rounded uppercase">
                                    {{ $game->genre ?? 'General' }}
                                </span>
                            </div>
                        </div>

                        <div class="p-4">
                            <h4 class="font-bold text-lg text-white truncate">{{ $game->title }}</h4>
                            <p class="text-sm text-gray-400 mt-1 italic">{{ $game->developer->name ?? 'Estudio desconocido' }}</p>
                            
                            <div class="mt-4 flex justify-between items-center">
                                <span class="text-xs text-gray-500">{{ $game->release_year }}</span>
                                <a href="{{ route('games.show', $game) }}" class="text-indigo-400 text-sm font-bold hover:text-indigo-300 transition">
                                    Ver detalles
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($games->isEmpty())
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg">No hay juegos en el catálogo todavía.</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>