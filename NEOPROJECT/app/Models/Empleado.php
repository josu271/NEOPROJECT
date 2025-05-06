<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'Empleado';
    protected $primaryKey = 'idEmpleado';
    public $timestamps = false;

    protected $fillable = [
        'DNI',
        'NombreEmpleado',
        'ApellidopEmpleado',
        'ApellidomEmpleado',
        'TelefonoEmpleado',
        'RolEmpleado',
        'ActivoEmpleado',
        'ContrasenaEmpleado',     
    ];
    protected $hidden = [
        'ContrasenaEmpleado',    
    ];
}