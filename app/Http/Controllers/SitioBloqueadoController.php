<?php

namespace App\Http\Controllers;

use App\Models\Clase;
use App\Models\SitioBloqueado;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class SitioBloqueadoController extends Controller
{
    public function index(Clase $clase)
    {
    // Carga los sitios bloqueados usando la relación
    $sitios = $clase->sitiosBloqueados()->get();

    // Devuelve la vista y le pasa las variables 'clase' y 'sitios'
    return view('sitios_bloqueados.index', [
        'clase' => $clase,
        'sitios' => $sitios,
    ]);
    }

    // Guarda un nuevo sitio bloqueado para una clase
   public function store(Request $request, Clase $clase)
{
    $request->validate([
        'url' => 'required|url',
        'razon_bloqueo' => 'required|string|max:255',
    ]);

    // ===== INICIO DE LA NUEVA LÓGICA =====
    // Extraemos el host de la URL (ej: es.wikipedia.org)
    $host = parse_url($request->url, PHP_URL_HOST);

    // Extraemos el dominio principal (ej: wikipedia.org)
    // Esto funciona para dominios .com, .org, .net, .pe, etc.
    $domain = Str::after(Str::of($host)->rtrim('/'), '.');
    if (Str::contains($domain, '.')) {
         $domain = Str::after($domain, '.');
    }
    $mainDomain = Str::before($domain, '.');
    $tld = Str::after($domain, '.');
    $rootDomain = $mainDomain . '.' . $tld;
    if (Str::contains($host, $rootDomain)) {
        $host = $rootDomain;
    }
    // ===== FIN DE LA NUEVA LÓGICA =====

    // Usamos firstOrCreate para no añadir dominios duplicados a la misma clase
    $clase->sitiosBloqueados()->firstOrCreate(
        ['url' => $host], // Busca por este dominio
        ['razon_bloqueo' => $request->razon_bloqueo] // Si no existe, lo crea con estos datos
    );

    return redirect()->route('sitios.index', $clase)->with('status', '¡Dominio bloqueado exitosamente!');
}

    // Elimina un sitio bloqueado
    public function destroy(SitioBloqueado $sitio)
    {
        $clase = $sitio->clase; // Obtenemos la clase antes de borrar el sitio
        $sitio->delete();
        return redirect()->route('sitios.index', $clase)->with('status', '¡Sitio desbloqueado exitosamente!');
    }
}
