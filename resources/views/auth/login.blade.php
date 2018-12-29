<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon-180x180.png') }}" />
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
    <div class="container-fluid login-section">
        <div class="row">
            <form method="POST" class="col-sm-6 col-md-5 login-form" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                @csrf
                <div class="row">
                    <div class="col-md-7 offset-md-2">
                        <h1>Login</h1>
                        <br>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-7 offset-md-2">
                        <input id="email" placeholder="{{ __('E-Mail Address') }}" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                            name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-7 offset-md-2">
                        <input id="password" placeholder="{{ __('Password') }}" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                            name="password" required>

                        @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-7 offset-md-2">
                        <label class="c-form__checkbox">
                            <input type="checkbox" class="c-form__input" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <span class="c-form__checkbox-indicator"></span>
                            Remember me
                        </label>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-7 offset-md-2">
                        <button type="submit" class="c-btn c-btn--primary">
                            {{ __('Login') }}
                        </button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="c-btn c-btn--link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <div class="login-image" style="background-image: url(https://dummyimage.com/1024x1024/e3e3e3/000)">
            <img src="{{ asset('logo.jpg') }}" width="60" style="border-radius: 8px" class="login-logo" alt="">
        </div>
    </div>
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    @yield('script')
</body>

</html>