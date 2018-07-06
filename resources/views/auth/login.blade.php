@extends('layouts.app')

@section('content')
    <h2>Login</h2>
    <form class="login-form" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
        @csrf

            <label for="email" class="">{{ __('E-Mail Address') }}</label>


                <input id="email" type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif


            <label for="password" class="">{{ __('Password') }}</label>


                <input id="password" type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif


        <div class="login-controls">
            <label>{{ __('Remember Me') }}</label>
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
            <button type="submit" class="">
                {{ __('Login') }}
            </button>
            <a class="btn-google" href="{{url('login/google/redirect')}}">Loguearse con Google</a>
        </div>
        <a class="" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
    </form>

@endsection
