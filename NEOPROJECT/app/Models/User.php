<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;


    protected $table = 'empleado';
    protected $primaryKey = 'idEmpleado';

    public $timestamps = false;

    protected $fillable = [
        'DNI',
    ];

    protected $hidden = [
        'ContrasenaEmpleado',
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->ContrasenaEmpleado;
    }
}
