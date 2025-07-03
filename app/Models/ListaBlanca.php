<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaBlanca extends Model
{
    use HasFactory;

    protected $table = 'lista_blancas'; // Especificamos el nombre correcto de la tabla

    protected $fillable = [
        'url',
        'motivo',
    ];
}
