<?php

namespace App\Http\Controllers;

use App\Models\Game; // Importante
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectionController extends Controller
{
    public function store(Request $request, Game $game)
    {
        $user = $request->user();

        // Ahora usamos $request->status para guardar lo que el usuario ha elegido
        $user->games()->syncWithoutDetaching([
            $game->id => ['status' => $request->status ?? 'pending']
        ]);

        return back()->with('success', '¡Juego añadido a tu colección!');
    }

    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Obtenemos los juegos y los agrupamos por el campo 'status' de la tabla pivote
        $collection = $user->games()->withPivot('status')->get()->groupBy('pivot.status');

        return view('dashboard', compact('collection'));
    }

    public function update(Request $request, Game $game)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Actualizamos el estado en la tabla intermedia
        $user->games()->updateExistingPivot($game->id, [
            'status' => $request->status
        ]);

        return back()->with('success', 'Estado actualizado correctamente.');
    }

}