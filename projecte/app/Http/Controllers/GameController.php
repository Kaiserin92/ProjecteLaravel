<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Developer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
        {
            // 1. Buscamos todos los juegos en la base de datos
            // Usamos 'with' para traer también el nombre del desarrollador de golpe
            $games = Game::with('developer')->get();

            // 2. Le pasamos la variable $games a la vista
            return view('games.index', compact('games'));
        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $developers = Developer::all();
        return view('games.create', compact('developers')); // <-- Mira que aquí NO diga 'games.show'
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validamos los datos
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'genre' => 'nullable|string|max:255',
            'release_year' => 'nullable|integer|min:1950|max:' . (date('Y') + 5),
            'developer_id' => 'required|exists:developers,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación de imagen (máx 2MB)
        ]);

        // 2. Gestionamos la subida de la imagen
        if ($request->hasFile('image')) {
            // Guarda la imagen en la carpeta 'storage/app/public/games'
            $path = $request->file('image')->store('games', 'public');
            // Guardamos la ruta en el array de datos
            $validatedData['image'] = $path;
        }

        // 3. Creamos el juego con los datos validados
        Game::create($validatedData);

        return redirect()->route('games.index')->with('success', 'Videojuego añadido correctamente.');
    }

    /**
     * Display the specified resource.
     */
public function show(Game $game)
{
    // Cargamos la relación para que no falle al buscar el nombre del estudio
    $game->load('developer');
    return view('games.show', compact('game'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        $developers = Developer::all();
        return view('games.edit', compact('game', 'developers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'genre' => 'nullable|string|max:255',
            'release_year' => 'nullable|integer|min:1950|max:' . (date('Y') + 5),
            'description' => 'nullable|string', // Añadimos la descripción
            'developer_id' => 'required|exists:developers,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Si subes una imagen nueva, la guardamos
            $path = $request->file('image')->store('games', 'public');
            $validatedData['image'] = $path;
        }

        $game->update($validatedData);

        return redirect()->route('games.index')->with('success', 'Videojuego actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        if ($game->image) {
            // Ahora ya sabe qué es Storage porque lo importamos arriba
            Storage::disk('public')->delete($game->image);
        }

        $game->delete();

        return redirect()->route('games.index')->with('success', 'El videojuego ha sido eliminado de la bóveda.');
    }
}
