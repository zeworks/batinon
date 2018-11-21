@extends('layouts.app')
@section('body_class', 'login_page')
@section('content')
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
        <img src="{{ asset('logo.png') }}" class="login-logo" alt="">
    </div>
</div>
@endsection