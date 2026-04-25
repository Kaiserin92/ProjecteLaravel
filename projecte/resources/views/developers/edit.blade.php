<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            Editar Desarrollador: <span class="text-indigo-400">{{ $developer->name }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 border border-gray-700 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('developers.update', $developer) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-300 font-bold mb-2">Nombre del Estudio *</label>
                        <input type="text" name="name" class="w-full bg-gray-900 border-gray-600 text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" value="{{ old('name', $developer->name) }}" required>
                        @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-300 font-bold mb-2">País</label>
                        <input type="text" name="country" class="w-full bg-gray-900 border-gray-600 text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" value="{{ old('country', $developer->country) }}">
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-300 font-bold mb-2">Año de fundación</label>
                        <input type="number" name="founded_year" class="w-full bg-gray-900 border-gray-600 text-white rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" value="{{ old('founded_year', $developer->founded_year) }}">
                        @error('founded_year') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end items-center">
                        <a href="{{ route('developers.index') }}" class="text-gray-400 hover:text-gray-200 mr-4 transition">Cancelar</a>
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-500 transition">Actualizar Cambios</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>