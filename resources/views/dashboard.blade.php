@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    <!-- Sidebar -->
    <aside class="dashboard-sidebar">
        <div class="sidebar-header">
            <img src="{{ asset('assets/images/logoSe.png') }}" alt="Logo" class="sidebar-logo">
        </div>
        <nav class="sidebar-nav">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <!-- Más enlaces -->
        </nav>
    </aside>

    <!-- Contenido principal -->
    <div class="main-content">
        <header class="dashboard-header">
            <button id="sidebarToggle" class="d-md-none">
                <i class="fas fa-bars"></i>
            </button>
            <div class="user-menu dropdown">
                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    {{ Auth::user()->name }}
                    <i class="fas fa-chevron-down"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Perfil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Cerrar Sesión</button>
                        </form>
                    </li>
                </ul>
            </div>
        </header>

        <div class="content-wrapper">
            @yield('dashboard-content')
        </div>

        <footer class="dashboard-footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Todos los derechos reservados.</p>
        </footer>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('sidebarToggle')?.addEventListener('click', function() {
    document.querySelector('.dashboard-sidebar').classList.toggle('show');
});
</script>
@endpush