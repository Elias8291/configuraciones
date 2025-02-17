@extends('layouts.auth')

@section('content')
    <div class="main-container">
        <div class="login-container">
            <div class="login-header">
                <img src="{{ asset('assets/images/logoSe.png') }}" alt="Logo"><br>
                <h1>Registro al Padrón de Proveedores</h1>
            </div>
            
            <ul class="nav nav-tabs" id="authTabs">
                <li class="nav-item">
                    <a class="nav-link active" id="login-tab" data-bs-toggle="tab" href="#loginForm">Iniciar Sesión</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="register-tab" data-bs-toggle="tab" href="#registerForm">Registrarse</a>
                </li>
            </ul>
            
            <div class="tab-content">
                <div class="tab-pane fade show active" id="loginForm">
                    @include('auth.login')
                </div>
                <div class="tab-pane fade" id="registerForm">
                    @include('auth.register')
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para mensaje de éxito -->
    @if (session('success'))
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Registro Exitoso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-envelope me-2"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        });
    </script>
    @endif
@endsection