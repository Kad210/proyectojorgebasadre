<?php

namespace App\Http\Controllers;
use App\Models\Clase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClaseController extends Controller
{
    // Muestra una lista de todas las clases
    public function index()
    {
        $clases = Clase::with('profesor')->get(); // 'profesor' es el nombre de la relación que definiremos
        return view('clases.index', ['clases' => $clases]);
    }

    // Muestra el formulario para crear una nueva clase
    public function create()
    {
        // Obtenemos todos los usuarios que son profesores para pasarlos a la vista
        $profesores = User::where('rol', 'profesor')->get();
        return view('clases.create', ['profesores' => $profesores]);
    }

    // Guarda la nueva clase en la base de datos
   public function store(Request $request)
    {
        $request->validate([
            'grado' => 'required|string|max:255',
            'seccion' => 'required|string|max:50',
            'user_id' => 'required|exists:users,id',
        ]);

        Clase::create([
            'grado' => $request->grado,
            'seccion' => $request->seccion,
            'user_id' => $request->user_id,
            'api_key' => Str::random(32), // <-- AÑADE ESTA LÍNEA PARA GENERAR LA LLAVE
        ]);

        return redirect()->route('clases.index')->with('status', '¡Clase creada exitosamente!');
    }
    public function edit(Clase $clase)
{
    // Necesitamos la lista de profesores para poder cambiar la asignación
    $profesores = User::where('rol', 'profesor')->get();
    return view('clases.edit', [
        'clase' => $clase,
        'profesores' => $profesores
    ]);
    }

    /**
     * Actualiza la clase en la base de datos.
     */
    public function update(Request $request, Clase $clase)
    {
        $request->validate([
            'grado' => 'required|string|max:255',
            'seccion' => 'required|string|max:50',
            'user_id' => 'required|exists:users,id',
        ]);

        $clase->update($request->all());

        return redirect()->route('clases.index')->with('status', '¡Clase actualizada exitosamente!');
    }

    /**
     * Elimina la clase de la base de datos.
     */
    public function destroy(Clase $clase)
    {
        $clase->delete();
        return redirect()->route('clases.index')->with('status', '¡Clase eliminada exitosamente!');
    }
}
