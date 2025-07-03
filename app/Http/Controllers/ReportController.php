<?php

namespace App\Http\Controllers;
use App\Exports\SitiosBloqueadosExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
         * Genera y descarga el reporte de sitios bloqueados.
         */
        public function exportSitiosBloqueados()
        {
            // Capa de seguridad opcional pero recomendada:
            // Solo permite la descarga si el usuario es un director.
            if (Auth::user()->rol !== 'director') {
                abort(403, 'Acción no autorizada.');
            }

            // Usa la clase de exportación que creamos para generar el archivo
            // y lo descarga en el navegador del usuario.
            return Excel::download(new SitiosBloqueadosExport, 'reporte_sitios_bloqueados.xlsx');
        }
}
