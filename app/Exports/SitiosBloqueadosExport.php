<?php

namespace App\Exports;

use App\Models\SitioBloqueado;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SitiosBloqueadosExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
    * Esta función obtiene los datos de la base de datos.
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Obtenemos todos los sitios bloqueados con la información
        // de su clase y el profesor de esa clase, usando las relaciones que ya definimos.
        return SitioBloqueado::with('clase.profesor')->get();
    }

    /**
     * Esta función define los encabezados de las columnas en el Excel.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Grado',
            'Sección',
            'Profesor a Cargo',
            'URL Bloqueada',
            'Razón del Bloqueo',
            'Fecha de Bloqueo',
        ];
    }

    /**
     * Esta función toma cada fila de datos y la organiza
     * en el orden que definimos en los encabezados.
     *
     * @param mixed $sitio
     *
     * @return array
     */
    public function map($sitio): array
    {
        return [
            $sitio->clase->grado,
            $sitio->clase->seccion,
            $sitio->clase->profesor->name,
            $sitio->url,
            $sitio->razon_bloqueo,
            $sitio->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
