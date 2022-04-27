@extends('layouts.app')

@section('content')
<style>
    h6 {
        width: 100%; 
        text-align: center; 
        border-bottom: 1px solid #000; 
        line-height: 0.1em;
        margin: 10px 0 20px; 
        font-weight: bold;
    } 

    h6 span { 
        background: #fff; 
        padding: 0 10px;.
        font-weight: bold;

    }

    .color{  
        background-color: #6356e5 !important;
        border-color: #6356e5 !important;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="mt-4 col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">

                                @if (Route::has('password.request'))
                                    <a class="float-end btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="w-50 offset-md-4">
                                <button type="submit" class="w-50 color btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="mx-auto w-75">
                        <h6 class="mt-5"><span>Or</span></h6>
                    </div>
                    <div class="mt-5 col-md-12 text-center">
                        <a id="client" href="{{ route('users.create') }}" class="color btn btn-primary">Sign up as a client</a>
                        <a id="client" href="{{ route('companies.create') }}" class="color btn btn-primary">Sign up as a company</a>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
