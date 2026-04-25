<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            Editar Videojuego: {{ $game->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 border border-gray-700 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('games.update', $game) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-300 font-bold mb-2">Título del Juego *</label>
                        <input type="text" name="title" class="w-full bg-gray-900 border-gray-600 text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" value="{{ old('title', $game->title) }}" required>
                        @error('title') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-300 font-bold mb-2">Género</label>
                            <input type="text" name="genre" class="w-full bg-gray-900 border-gray-600 text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" value="{{ old('genre', $game->genre) }}">
                        </div>
                        <div>
                            <label class="block text-gray-300 font-bold mb-2">Año de lanzamiento</label>
                            <input type="number" name="release_year" class="w-full bg-gray-900 border-gray-600 text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" value="{{ old('release_year', $game->release_year) }}">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-300 font-bold mb-2">Descripción</label>
                        <textarea name="description" rows="4" class="w-full bg-gray-900 border-gray-600 text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">{{ old('description', $game->description) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-300 font-bold mb-2">Estudio Desarrollador *</label>
                        <select name="developer_id" class="w-full bg-gray-900 border-gray-600 text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required>
                            @foreach($developers as $developer)
                                <option value="{{ $developer->id }}" {{ (old('developer_id', $game->developer_id) == $developer->id) ? 'selected' : '' }}>
                                    {{ $developer->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6 p-4 border border-gray-600 border-dashed rounded-md bg-gray-900/50">
                        <label class="block text-gray-300 font-bold mb-2">Cambiar Portada (Opcional)</label>
                        
                        @if($game->image)
                            <div class="mb-4">
                                <p class="text-xs text-gray-500 mb-2">Portada actual:</p>
                                <img src="{{ asset('storage/' . $game->image) }}" class="h-24 rounded shadow-md border border-gray-700">
                            </div>
                        @endif

                        <input type="file" name="image" accept="image/*" class="w-full text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-700 file:text-gray-200 hover:file:bg-gray-600 cursor-pointer">
                    </div>

                    <div class="flex justify-end items-center">
                        <a href="{{ route('games.index') }}" class="text-gray-400 hover:text-gray-200 mr-4 transition">Cancelar</a>
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded shadow hover:bg-indigo-500 transition font-bold">Actualizar Videojuego</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>