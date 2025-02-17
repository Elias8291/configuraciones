<header class="dashboard-header">
    <div class="header-left">
        <button id="sidebar-toggle" class="sidebar-toggle">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    
    <div class="header-right">
        <div class="user-menu dropdown">
            <button class="dropdown-toggle" type="button" id="userMenuDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="user-name">{{ Auth::user()->name }}</span>
                <i class="fas fa-user-circle"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="userMenuDropdown">
                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                    <i class="fas fa-user-cog"></i> Perfil
                </a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>

<!-- layouts/partials/sidebar.blade.php -->
<aside class="dashboard-sidebar">
    <div class="sidebar-header">
        <img src="{{ asset('assets/images/logoSe.png') }}" alt="Logo" class="sidebar-logo">
    </div>
    
    <nav class="sidebar-nav">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-users"></i>
                    <span>Usuarios</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-cog"></i>
                    <span>Configuración</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>

<!-- layouts/partials/footer.blade.php -->
<footer class="dashboard-footer">
    <div class="footer-content">
        <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Todos los derechos reservados.</p>
    </div>
</footer>