<?php

namespace App\Policies;

use App\Models\ListaBlanca;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ListaBlancaPolicy
{
    /**
     * Determina si el usuario puede ver la lista de sitios.
     */
    public function viewAny(User $user): bool
    {
        // Solo los directores pueden ver la lista
        return $user->rol === 'director';
    }

    /**
     * Determina si el usuario puede crear un nuevo sitio en la lista.
     */
    public function create(User $user): bool
    {
        // Solo los directores pueden crear
        return $user->rol === 'director';
    }

    /**
     * Determina si el usuario puede eliminar un sitio de la lista.
     */
    public function delete(User $user, ListaBlanca $listaBlanca): bool
    {
        // Solo los directores pueden eliminar
        return $user->rol === 'director';
    }
}
