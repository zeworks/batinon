<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:200,200i,300,300i,400,400i,500,600,700,800,900" qrel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,900" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body class="@yield('body_class')">
    <div id="app">
    @auth
        <header-component logout="{{ route('logout') }}"></header-component>
        <nav-component username="{{ Auth::user()->name }}"></nav-component>
    @endauth
        <main>
            @yield('content')
        </main>
    </div>

    
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/batinon.js') }}" defer></script>

    @yield('script')
</body>

</html>