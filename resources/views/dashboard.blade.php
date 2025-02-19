@extends('layouts.app')

@section('content')
    <div class="dashboard-container">
        @include('layouts.sidebar')
        <div class="main-content">
            @include('layouts.header')
            <div class="content-wrapper">
                @yield('dashboard-content')
            </div>
            @include('layouts.footer')
        </div>
    </div>
@endsection
