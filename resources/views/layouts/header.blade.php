<header class="dashboard-header">
    <button id="sidebarToggle" class="d-md-none">
        <i class="fas fa-bars"></i>
    </button>
    <div class="user-menu dropdown">
        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown">
            @if(Auth::check())
                {{ Auth::user()->name }}
            @else
                Invitado
            @endif
            <i class="fas fa-chevron-down"></i>
        </button>
        @if(Auth::check())
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Perfil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('welcome') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">Cerrar Sesión</button>
                    </form>
                </li>
            </ul>
        @endif
    </div>
</header>
