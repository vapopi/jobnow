@extends('layouts.app')

@section('content')

<style>
    .color{  
        color: #6356e5;
        font-weight: bold;
    }

    .bColor{  
        background-color: #6356e5 !important;
        border-color: #6356e5 !important;
    }

    .bsColor{  
        background-color: #323232 !important;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">

                    <a href="{{ route('dashboard') }}" class="float-end link-secondary" role="button"> 🡰 Go back</a>
                    {{ __('Edit User') }}
                    
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input value='{{$user->name}}' type="text" class="form-control" name="name" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="surnames" class="col-md-4 col-form-label text-md-end">{{ __('Surnames') }}</label>

                            <div class="col-md-6">
                                <input value='{{$user->surnames}}' type="text" class="form-control" name="surnames" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input value='{{$user->email}}' type="text" class="form-control" name="email" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Date of birth') }}</label>

                            <div class="col-md-6">
                                <input value='{{$user->birth_date}}' type="text" class="form-control" name="birth" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Phone') }}</label>

                            <div class="col-md-6">
                                <input value='{{$user->phone}}' type="text" class="form-control" name="phone" required>
                            </div>
                        </div>

                        
                        <div class="text-center">
                        
                            @if($user->premium == 0)
                                <p>You are not premium yet! <a class="color" href="{{ route('premium.index') }}">Buy it here.</a></p>
                            @else
                                <p class="color">Congrats, you are premium!</p>
                            @endif
                        </div>


                        <div class="row mb-0">
                            <div class="mt-3 col-md-12 text-center">
                                <button type="button" class="w-50 bColor btn btn-primary">Edit profile</button>
                            </div>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection