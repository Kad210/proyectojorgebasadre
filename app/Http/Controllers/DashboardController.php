<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // <-- Importa el modelo User
use App\Models\Clase; // <-- Importa el modelo Clase

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->rol === 'director') {
            // --- AÑADE ESTA LÓGICA ---
            $totalProfesores = User::where('rol', 'profesor')->count();
            $totalClases = Clase::count();

            return view('dashboard', [
                'totalProfesores' => $totalProfesores,
                'totalClases' => $totalClases
            ]);
            // --- FIN DE LA LÓGICA AÑADIDA ---
        }

        if ($user->rol === 'profesor') {
            $clasesAsignadas = $user->clases()->get();
            return view('profesor.dashboard', ['clases' => $clasesAsignadas]);
        }

        // Si el usuario no es director ni profesor, o si es un profesor sin clases,
        // se le puede mostrar un dashboard por defecto.
        // El código actual puede causar un error para un profesor sin clases si no se maneja
        // en la vista 'dashboard', por eso es mejor tener una lógica clara.
        // Sin embargo, para solucionar el error actual, el código de arriba es suficiente.
        // Para el caso de un usuario que no sea ni director ni profesor,
        // la vista 'dashboard' no recibirá las variables, lo que podría causar otro error.
        // Una versión más robusta sería:
        if ($user->rol !== 'profesor') {
             return view('dashboard', [
                'totalProfesores' => User::where('rol', 'profesor')->count(),
                'totalClases' => Clase::count()
            ]);
        }
        // Si no se cumple ninguna condición anterior, por seguridad, redirigir a una vista genérica.
        return view('dashboard');
    }
}
