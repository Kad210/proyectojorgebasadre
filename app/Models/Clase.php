<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'grado',
        'seccion',
        'user_id',
        'api_key',
    ];

    /**
     * Define la relación: una Clase pertenece a un User (profesor).
     */
public function profesor()
{
    // Una clase pertenece a un usuario (profesor)
    return $this->belongsTo(User::class, 'user_id');
}
// Una clase puede tener muchos sitios bloqueados
public function sitiosBloqueados()
{
    return $this->hasMany(SitioBloqueado::class);
}
}
