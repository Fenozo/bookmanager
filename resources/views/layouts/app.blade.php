<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>

    {{ config('app.name', 'Eventbrote') }}</title>
    
    <!-- Styles -->
    <link href="{{ asset('css/flashy.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style2.css') }}">

</head>
<body>
    <style>

        </style>
    <div id="app">
        
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Eventbrote') }}
                </a>
                <a class="navbar-brand" href="{{ route('events.create') }}">
                    new
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        
                           
                    </ul>
                </div>
            </div>
        </nav>

        <div class="content" style="padding-top:22px;">
            @if (session()->has('notification.message'))
            <div class="alert alert-{{ session()->get('notification.type') }}">
                {{ session()->get('notification.message') }}
            </div>
            @endif
             @yield('content')
        </div>

    </div>


    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" ></script>
    <script src="{{ asset('js/flashy.js') }}" ></script>

    @include('flashy::message')
    @yield('javascript')
</body>
</html>
