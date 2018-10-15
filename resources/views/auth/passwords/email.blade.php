@extends('layouts.app')

@section('body_class', 'login_page')

@section('content')
<div class="container-fluid login-section">
    <div class="row">
        <form method="POST" class="col-sm-6 col-md-5 login-form" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                        <div class="row">
                            <div class="col-md-7 offset-md-2">
                                <h1>Reset Password</h1>
                                <br>
                            </div>
                        </div>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
                        @csrf

                        <div class="form-group row">
                            
                            <div class="col-md-7 offset-md-2">
                                <input id="email" placeholder="{{ __('E-Mail Address') }}" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-7 offset-md-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
    </div>
    <div class="login-image" style="background-image: url(https://dummyimage.com/1024x1024/e3e3e3/000)">
        <img src="{{ asset('logo.png') }}" class="login-logo" alt="">
    </div>
</div>
@endsection
