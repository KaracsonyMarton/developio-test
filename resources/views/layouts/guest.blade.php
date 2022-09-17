<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
</head>
<body>
<header class="p-3 text-bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <span class="fs-4">Developio Ticketing Test Project</span>
                </a>
            </div>
            <div class="col-8">
                <div class="text-end ml-auto">
                    <a type="button" href="{{route('login')}}" class="btn btn-outline-light me-2">Login</a>
                    <a type="button" href="{{route('register')}}" class="btn btn-warning">Sign-up</a>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container mt-4 mb-4">
    @yield('content')
</div>
<script src="{{ asset('js/app.js') }}"></script>
@include('components.messages')
</body>
</html>
