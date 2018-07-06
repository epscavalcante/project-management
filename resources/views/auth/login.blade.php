@extends('layouts.auth')

@section('content')

<h1 class="h2">Olá &#x1f44b;</h1>
<p class="lead">Faça o login antes de continuar</p>
<form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
@csrf
    <div class="form-group">
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="{{ __('E-mail') }}">
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="{{ __('Senha') }}">

        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif

        <div class="text-right">
            <small><a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
            </small>
        </div>
    </div>
    <div class="form-group">
        <div class="checkbox">
            <label>
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
            </label>
        </div>
    </div>
    <button class="btn btn-lg btn-block btn-primary" role="button" type="submit">{{ __('Login') }}</button>
    <small>Não tem conta? <a href="#">Crie uma aqui</a>
    </small>
</form>
@endsection
