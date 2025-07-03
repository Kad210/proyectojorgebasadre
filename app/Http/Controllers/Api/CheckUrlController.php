<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Clase;
use App\Models\ListaBlanca; // <-- IMPORTA EL MODELO
use Illuminate\Http\Request;

class CheckUrlController extends Controller
{
    public function check(Request $request)
    {
        $request->validate([
            'api_key' => 'required|string',
            'url' => 'required|url',
        ]);

        $apiKey = $request->api_key;
        $urlToCheck = $request->url;
        $hostToCheck = parse_url($urlToCheck, PHP_URL_HOST);

        // ===== INICIO DE LA NUEVA LÓGICA =====
        // 1. Revisar si la URL está en la lista blanca global
        $isWhitelisted = ListaBlanca::where('url', 'like', '%' . $hostToCheck . '%')->exists();

        if ($isWhitelisted) {
            // Si está en la lista blanca, se permite inmediatamente.
            return response()->json(['blocked' => false, 'reason' => 'Site is on the global whitelist.']);
        }
        // ===== FIN DE LA NUEVA LÓGICA =====


        // 2. Si no está en la lista blanca, continuamos con la lógica anterior
        $clase = Clase::where('api_key', $apiKey)->first();

        if (!$clase) {
            return response()->json(['blocked' => false, 'reason' => 'Invalid API Key']);
        }

        $isBlocked = $clase->sitiosBloqueados()
                           ->where('url', 'like', '%' . $hostToCheck . '%')
                           ->exists();

        $isBlocked = $clase->sitiosBloqueados()
                       ->whereRaw("? LIKE CONCAT('%', url)", [$hostToCheck])
                       ->exists();

        if ($isBlocked) {
            return response()->json(['blocked' => true, 'reason' => 'Site is on the class blocklist.']);
        }

        return response()->json(['blocked' => false]);
    }
}
