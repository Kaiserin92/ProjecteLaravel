<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    // Mostrar todos los desarrolladores
    public function index()
    {
        $developers = Developer::all();
        return view('developers.index', compact('developers'));
    }

    // Mostrar el formulario para crear uno nuevo
    public function create()
    {
        return view('developers.create');
    }

    // Guardar el nuevo desarrollador en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'nullable|string|max:255',
            'founded_year' => 'nullable|integer|min:1880|max:' . date('Y'),
        ]);

        Developer::create($request->all());

        return redirect()->route('developers.index')->with('success', 'Estudio creado correctamente.');
    }

    // Mostrar el formulario para editar
    public function edit(Developer $developer)
    {
        return view('developers.edit', compact('developer'));
    }

    // Actualizar los datos en la base de datos
    public function update(Request $request, Developer $developer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'nullable|string|max:255',
            'founded_year' => 'nullable|integer|min:1880|max:' . date('Y'),
        ]);

        $developer->update($request->all());

        return redirect()->route('developers.index')->with('success', 'Estudio actualizado correctamente.');
    }

    // Eliminar de la base de datos
    public function destroy(Developer $developer)
    {
        $developer->delete();
        return redirect()->route('developers.index')->with('success', 'Estudio eliminado correctamente.');
    }
}