@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <ul class="nav nav-tabs" id="authTabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="login-tab" data-bs-toggle="tab" href="#loginForm">Iniciar Sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="register-tab" data-bs-toggle="tab" href="#registerForm">Registrarse</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <!-- Formulario de Login -->
                    <div class="tab-pane fade show active" id="loginForm">
                        @include('auth.login')
                    </div>

                    <!-- Formulario de Registro -->
                    <div class="tab-pane fade" id="registerForm">
                        @include('auth.register')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection