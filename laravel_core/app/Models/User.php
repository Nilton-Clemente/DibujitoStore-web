<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'usuarios';

    public $timestamps = false;

    protected $guarded = [];

    // Clave primaria
    protected $primaryKey = 'id';

    // Contraseña
    public function getAuthPassword()
    {
        return $this->contrasena;
    }
}
