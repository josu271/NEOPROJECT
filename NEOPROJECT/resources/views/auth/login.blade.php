@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-sm p-4" style="max-width: 400px; width:100%;">
        <h3 class="text-center mb-4">Iniciar Sesión</h3>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="mb-3">
                <label for="dni" class="form-label">Usuario</label>
                <input type="text"
                       class="form-control @error('dni') is-invalid @enderror"
                       id="dni"
                       name="dni"
                       value="{{ old('dni') }}"
                       required
                       autofocus>
                @error('dni')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       id="password"
                       name="password"
                       required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-check mb-4">
                <input type="checkbox"
                       class="form-check-input"
                       id="remember"
                       name="remember"
                       {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    Recordarme
                </label>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                Ingresar
            </button>
        </form>
    </div>
</div>
@endsection
