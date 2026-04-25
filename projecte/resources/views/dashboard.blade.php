<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">Mi Colección</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">
            
            @php
                $statuses = [
                    'playing' => ['label' => 'Jugando', 'color' => 'text-blue-400', 'border' => 'border-blue-500/50'],
                    'pending' => ['label' => 'Pendientes', 'color' => 'text-gray-400', 'border' => 'border-gray-700'],
                    'completed' => ['label' => 'Completados', 'color' => 'text-green-400', 'border' => 'border-green-500/50'],
                ];
            @endphp

            @foreach($statuses as $key => $info)
                @if(isset($collection[$key]) && $collection[$key]->isNotEmpty())
                    <section>
                        <div class="flex items-center gap-4 mb-6">
                            <h3 class="{{ $info['color'] }} font-bold text-lg uppercase tracking-widest">{{ $info['label'] }}</h3>
                            <div class="flex-1 h-px bg-gray-800"></div>
                            <span class="text-gray-600 text-xs font-mono">{{ $collection[$key]->count() }} títulos</span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                            @foreach($collection[$key] as $game)
                                <div class="bg-gray-800 border border-gray-700 rounded-xl overflow-hidden shadow-lg hover:border-indigo-500 transition group">
                                    
                                    <div class="aspect-[3/4] w-full bg-gray-900 relative overflow-hidden">
                                        @if($game->image)
                                            <img src="{{ asset('storage/' . $game->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                        @endif
                                        
                                        <div class="absolute bottom-0 left-0 right-0 p-2 bg-black/60 backdrop-blur-sm translate-y-full group-hover:translate-y-0 transition duration-300">
                                            <form action="{{ route('collection.update', $game) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <select name="status" onchange="this.form.submit()" class="w-full bg-gray-800 border-none text-white text-[10px] font-bold uppercase rounded-lg p-1.5 focus:ring-0 cursor-pointer">
                                                    @foreach($statuses as $k => $i)
                                                        <option value="{{ $k }}" {{ $game->pivot->status === $k ? 'selected' : '' }}>Mover a: {{ $i['label'] }}</option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="p-4">
                                        <h4 class="font-bold text-white truncate">{{ $game->title }}</h4>
                                        <div class="mt-4 flex justify-between items-center">
                                            <a href="{{ route('games.show', $game) }}" class="text-indigo-400 text-xs font-bold hover:underline">Ver detalles</a>
                                            
                                            <form action="{{ route('collection.destroy', $game) }}" method="POST" onsubmit="return confirm('¿Quitar de la colección?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-gray-500 hover:text-red-500 transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif
            @endforeach

            @if($collection->isEmpty())
                <div class="bg-gray-800 border border-gray-700 p-10 rounded-2xl text-center">
                    <p class="text-gray-400">Tu colección está vacía.</p>
                    <a href="{{ route('games.index') }}" class="text-indigo-400 font-bold mt-2 inline-block italic underline">Ir al catálogo</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>