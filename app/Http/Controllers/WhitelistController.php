<?php

namespace App\Http\Controllers;

use App\Models\ListaBlanca;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // <-- AÑADE ESTA LÍNEA

class WhitelistController extends Controller
{
    use AuthorizesRequests; // <-- Y AÑADE ESTA LÍNEA

    // Muestra la página de gestión de la lista blanca
    public function index()
    {
        $this->authorize('viewAny', ListaBlanca::class); // Ahora esto funcionará
        $sitiosPermitidos = ListaBlanca::all();
        return view('whitelist.index', ['sitiosPermitidos' => $sitiosPermitidos]);
    }

    // Guarda un nuevo sitio en la lista blanca
    public function store(Request $request)
    {
        $this->authorize('create', ListaBlanca::class); // Ahora esto funcionará
        $request->validate([
            'url' => 'required|url|unique:lista_blancas,url',
            'motivo' => 'required|string|max:255',
        ]);

        ListaBlanca::create($request->all());

        return redirect()->route('whitelist.index')->with('status', '¡Sitio añadido a la lista blanca!');
    }

    // Elimina un sitio de la lista blanca
    public function destroy(ListaBlanca $listaBlanca)
    {
        $this->authorize('delete', $listaBlanca); // Ahora esto funcionará
        $listaBlanca->delete();
        return redirect()->route('whitelist.index')->with('status', '¡Sitio eliminado de la lista blanca!');
    }
}
