<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            Mi colección Personal
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($games->isEmpty())
                <div class="bg-gray-800 border border-gray-700 p-10 rounded-2xl text-center">
                    <p class="text-gray-400 text-lg">Tu colección está vacía. ¡Explora el catálogo y añade tu primer juego!</p>
                    <a href="{{ route('games.index') }}" class="inline-block mt-4 text-indigo-400 hover:text-indigo-300 font-bold">Ver Catálogo &rarr;</a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($games as $game)
                        <div class="bg-gray-800 border border-gray-700 rounded-2xl overflow-hidden shadow-lg group hover:border-indigo-500 transition duration-300">
                            <div class="relative h-48">
                                <img src="{{ asset('storage/' . $game->image) }}" class="w-full h-full object-cover">
                                <div class="absolute top-2 right-2">
                                    <span class="px-2 py-1 text-xs font-bold rounded-lg uppercase tracking-tighter 
                                        {{ $game->pivot->status === 'completed' ? 'bg-green-600 text-white' : '' }}
                                        {{ $game->pivot->status === 'playing' ? 'bg-blue-600 text-white' : '' }}
                                        {{ $game->pivot->status === 'pending' ? 'bg-gray-600 text-white' : '' }}">
                                        {{ $game->pivot->status }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="p-4">
                                <h3 class="text-white font-bold truncate">{{ $game->title }}</h3>
                                <p class="text-gray-400 text-xs">{{ $game->developer->name }}</p>
                                
                                <div class="mt-4 flex justify-between items-center">
                                    <a href="{{ route('games.show', $game) }}" class="text-indigo-400 text-xs font-bold hover:underline">Ver ficha</a>
                                    
                                    {{-- Botón para eliminar de la colección (lo haremos luego) --}}
                                    <form action="{{ route('collection.destroy', $game) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-500 hover:text-red-500 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>