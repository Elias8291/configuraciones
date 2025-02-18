{{-- resources/views/auth/forgot-password.blade.php --}}
@extends('layouts.auth')

@section('content')
    <div class="main-container">
        <div class="login-container">
            <div class="login-header">
                <img src="{{ asset('assets/images/logoSe.png') }}" alt="Logo"><br>
                <h1>Recuperación de Contraseña</h1>
            </div>
            
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary w-100">Enviar Enlace de Recuperación</button>
                </div>
            </form>

            <!-- Botón para regresar al inicio de sesión -->
            <div class="text-center mt-3">
                <a href="{{ route('welcome') }}" class="btn btn-secondary w-100">Regresar a Inicio de Sesión</a>
            </div>
        </div>
    </div>
@endsection
