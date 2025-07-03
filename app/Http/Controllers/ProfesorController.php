<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule; // <-- Importante: Añade esta línea
use Illuminate\Validation\Rules;

class ProfesorController extends Controller
{
    public function index()
    {
        // Busca todos los usuarios cuyo rol sea 'profesor'
        $profesores = User::where('rol', 'profesor')->get();

        // Manda los datos a una vista que crearemos ahora
        return view('profesores.index', ['profesores' => $profesores]);
    }
     public function create()
    {
        return view('profesores.create');
    }
    // Función para guardar el nuevo profesor en la base de datos
    public function store(Request $request)
    {
        // 1. Validar los datos del formulario
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 2. Crear el nuevo usuario (profesor)
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encripta la contraseña
            'rol' => 'profesor', // Asigna el rol por defecto
        ]);

        // 3. Redirigir de vuelta a la lista de profesores con un mensaje de éxito
        return redirect()->route('profesores.index')->with('status', '¡Profesor creado exitosamente!');
    }
    public function edit(User $profesor)
    {
        return view('profesores.edit', ['profesor' => $profesor]);
    }

    // Actualiza los datos del profesor en la base de datos
    public function update(Request $request, User $profesor)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($profesor->id)],
        ]);

        $profesor->name = $request->name;
        $profesor->email = $request->email;
        $profesor->save();

        return redirect()->route('profesores.index')->with('status', '¡Profesor actualizado exitosamente!');
    }

    // Elimina un profesor de la base de datos
    public function destroy(User $profesor)
    {
        $profesor->delete();
        return redirect()->route('profesores.index')->with('status', '¡Profesor eliminado exitosamente!');
    }
}
