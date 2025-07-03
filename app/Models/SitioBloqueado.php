<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SitioBloqueado extends Model
{
    use HasFactory;

    protected $table = 'sitios_bloqueados'; // Especificamos el nombre de la tabla

    protected $fillable = [
        'url',
        'razon_bloqueo',
        'clase_id',
    ];

    // Un sitio bloqueado pertenece a una clase
    public function clase()
    {
        return $this->belongsTo(Clase::class);
    }
}
