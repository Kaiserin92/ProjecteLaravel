<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            Gestión de Desarrolladores
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 border border-gray-700 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="flex justify-between mb-4">
                    <h3 class="text-lg font-bold text-white">Estudios registrados</h3>
                    <a href="{{ route('developers.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500 transition">
                        + Nuevo Estudio
                    </a>
                </div>

                @if(session('success'))
                    <div class="bg-green-900 border border-green-500 text-green-200 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-700 bg-gray-700/50 text-gray-200">
                            <th class="py-3 px-4 font-semibold">Nombre</th>
                            <th class="py-3 px-4 font-semibold">País</th>
                            <th class="py-3 px-4 font-semibold">Fundación</th>
                            <th class="py-3 px-4 text-right font-semibold">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-300">
                        @foreach($developers as $developer)
                        <tr class="border-b border-gray-700 hover:bg-gray-700/30 transition">
                            <td class="py-3 px-4">{{ $developer->name }}</td>
                            <td class="py-3 px-4">{{ $developer->country ?? 'N/A' }}</td>
                            <td class="py-3 px-4">{{ $developer->founded_year ?? 'N/A' }}</td>
                            <td class="py-3 px-4 text-right">
                                <a href="{{ route('developers.edit', $developer) }}" class="text-indigo-400 hover:text-indigo-300 mr-3">Editar</a>
                                <form action="{{ route('developers.destroy', $developer) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300" onclick="return confirm('¿Seguro que quieres borrar este estudio?')">Borrar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>