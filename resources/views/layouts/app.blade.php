<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Secretaría de Administración</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Stylesheets -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    <!-- Main JS for page-wide scripts -->
    <script src="{{ asset('assets/js/formController.js') }}" type="module" defer></script>
    <script src="{{ asset('assets/js/navigationController.js') }}" type="module" defer></script>
    <script src="{{ asset('assets/js/passwordController.js') }}" type="module" defer></script>
    <script src="{{ asset('assets/js/validationController.js') }}" type="module" defer></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Loading Screen -->
    <div id="loadingScreen" class="loading-screen">
        <div class="loading-content">
            <img src="{{ asset('assets/images/logoSe.png') }}" class="loading-logo" alt="Cargando">
            <div class="progress-bar">
                <div class="progress"></div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    @yield('content')  <!-- Here the content of each page will be loaded, such as the login form -->

    <!-- Loading Modal (used for long processes) -->
    <div class="modal fade" id="loadingModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Please wait...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Flash Messages (will show toast notifications) -->
    @if (session('status'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const toast = new bootstrap.Toast(document.querySelector('.toast'));
                toast.show();
            });
        </script>
    @endif

    <!-- Stack for additional scripts -->
    @stack('scripts')
</body>
</html>
