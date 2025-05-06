@extends('layouts.app')

@section('title', 'Empleados')

@section('content')
<!-- x-data moved here so button and modal share the same Alpine scope -->
<div x-data="{ open: false }" class="py-8">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Listado de Empleados</h2>
        <div class="space-x-2">
            <!-- @click toggles `open` in this scope -->
            <button @click="open = true" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Añadir Empleado
            </button>
            <a href="{{ route('dashboard') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">
                &larr; Retroceder
            </a>
        </div>
    </div>

    <div class="overflow-x-auto mt-4">
        <table class="min-w-full table-auto bg-white rounded-lg shadow">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">DNI</th>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Ap. Paterno</th>
                    <th class="px-4 py-2">Ap. Materno</th>
                    <th class="px-4 py-2">Teléfono</th>
                    <th class="px-4 py-2">Rol</th>
                    <th class="px-4 py-2">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($empleados as $e)
                    <tr class="{{ $e->ActivoEmpleado === 'inactivo' ? 'bg-red-100' : '' }}">
                        <td class="border px-4 py-2">{{ $e->DNI }}</td>
                        <td class="border px-4 py-2">{{ $e->NombreEmpleado }}</td>
                        <td class="border px-4 py-2">{{ $e->ApellidopEmpleado }}</td>
                        <td class="border px-4 py-2">{{ $e->ApellidomEmpleado }}</td>
                        <td class="border px-4 py-2">{{ $e->TelefonoEmpleado }}</td>
                        <td class="border px-4 py-2">{{ $e->RolEmpleado }}</td>
                        <td class="border px-4 py-2 font-semibold">
                            <span class="{{ $e->ActivoEmpleado === 'inactivo' ? 'text-red-600' : 'text-green-600' }}">
                                {{ ucfirst($e->ActivoEmpleado) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal injected into the same x-data scope -->
    <div x-show="open" x-cloak x-transition.opacity
         class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
      <div class="bg-white rounded-2xl shadow-xl p-6 w-full max-w-lg mx-4">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-xl font-semibold">Nuevo Empleado</h3>
          <button @click="open = false" class="text-gray-500 hover:text-gray-800 text-2xl leading-none">&times;</button>
        </div>
        <form method="POST" action="{{ route('empleados.store') }}">
          @csrf
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium mb-1">DNI</label>
              <input name="DNI" type="number" required class="w-full border rounded p-2"/>
            </div>
            <div>
              <label class="block text-sm font-medium mb-1">Nombre</label>
              <input name="NombreEmpleado" type="text" required class="w-full border rounded p-2"/>
            </div>
            <div>
              <label class="block text-sm font-medium mb-1">Apellido Paterno</label>
              <input name="ApellidopEmpleado" type="text" required class="w-full border rounded p-2"/>
            </div>
            <div>
              <label class="block text-sm font-medium mb-1">Apellido Materno</label>
              <input name="ApellidomEmpleado" type="text" class="w-full border rounded p-2"/>
            </div>
            <div>
              <label class="block text-sm font-medium mb-1">Teléfono</label>
              <input name="TelefonoEmpleado" type="text" required class="w-full border rounded p-2"/>
            </div>
            <div>
              <label class="block text-sm font-medium mb-1">Rol</label>
              <input name="RolEmpleado" type="text" required class="w-full border rounded p-2"/>
            </div>
            <div class="sm:col-span-2">
              <label class="block text-sm font-medium mb-1">Estado</label>
              <select name="ActivoEmpleado" required class="w-full border rounded p-2">
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium mb-1">Contraseña</label>
              <input name="password" type="password" required class="w-full border rounded p-2"/>
            </div>
            <div>
              <label class="block text-sm font-medium mb-1">Confirmar Contraseña</label>
              <input name="password_confirmation" type="password" required class="w-full border rounded p-2"/>
            </div>
          </div>
          <div class="mt-6 flex justify-end space-x-2">
            <button type="button" @click="open = false" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Cancelar</button>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Guardar</button>
          </div>
        </form>
      </div>
    </div>
</div>
@endsection