<aside class="dashboard-sidebar">
    <div class="sidebar-header">
        <img src="{{ asset('assets/images/logoSe.png') }}" alt="Logo" class="sidebar-logo">
    </div>
    <nav class="sidebar-nav">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fas fa-users"></i> 
            <span>Proveedores</span>
        </a>
       
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fas fa-user-plus"></i> <!-- Icono para inscribirse -->
            <span>Inscribirse</span>
        </a>
    </nav>

   
</aside>
