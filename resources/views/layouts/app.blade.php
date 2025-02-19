<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Secretaría de Administración</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/formController.js') }}" type="module" defer></script>
    <script src="{{ asset('assets/js/navigationController.js') }}" type="module" defer></script>
    <script src="{{ asset('assets/js/passwordController.js') }}" type="module" defer></script>
    <script src="{{ asset('assets/js/validationController.js') }}" type="module" defer></script>
    <script src="{{ asset('assets/js/login-validation.js') }}" type="module" defer></script>
    @stack('scripts')
</head>

<body>

    <div class="content-wrapper">
        @yield('content')
    </div>

    </div>
</body>

</html>
