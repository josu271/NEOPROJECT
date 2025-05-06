<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmpleadoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::all();
        return view('auth.empleado',   compact('empleados'));
    }

    public function create()
    {
        return view('empleados.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'DNI'               => 'required|integer|unique:Empleado,DNI',
            'NombreEmpleado'    => 'required|string',
            'ApellidopEmpleado' => 'required|string',
            'ApellidomEmpleado' => 'nullable|string',
            'TelefonoEmpleado'  => 'required|string',
            'RolEmpleado'       => 'required|string',
            'ActivoEmpleado'    => 'required|in:activo,inactivo',
            'password'          => 'required|string|min:6|confirmed',
        ]);
    
        // Renombra password → ContrasenaEmpleado y hashea
        $data['ContrasenaEmpleado'] = Hash::make($data['password']);
        unset($data['password'], $data['password_confirmation']);
    
        Empleado::create($data);
    
        return redirect()->route('empleados.index')->with('success','Empleado creado');
    }
}