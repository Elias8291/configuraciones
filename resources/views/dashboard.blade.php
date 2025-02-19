{{-- resources/views/dashboard.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="dashboard-container">
        @include('layouts.sidebar')
        <div class="main-content">
            @include('layouts.header')
            <div class="content-wrapper">
                @yield('dashboard-content') <!-- Sección principal del dashboard -->
                @include('layouts.dashboard-content') <!-- Inclusión del archivo adicional -->
            </div>
            @include('layouts.footer')
        </div>
    </div>
@endsection
