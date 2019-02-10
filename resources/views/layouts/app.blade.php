<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon-180x180.png') }}"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- app title -->
    <title>Batinon</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,900" rel="stylesheet">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz"
        crossorigin="anonymous">
    <!-- app style -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body class="@yield('body_class')">
    <div id="app">
        @auth
        <v-header logout="{{ route('logout') }}"></v-header>
        <v-drawer></v-drawer>
        @endauth
        <main>
            @auth
            <v-breadcrumb></v-breadcrumb>
            @endauth
            <router-view></router-view>
        </main>
        <footer class="clearfix">
            <div class="container-fluid">
                <div class="float-right">
                    made by <a href="#">Batinon</a>&copy;
                    <?= date('Y') ?>
                </div>
            </div>
        </footer>
        <v-loading />
    </div>

    <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    @auth
    <script>
        window.user = {!! json_encode($user); !!};
    </script>
    @endauth
</body>

</html>