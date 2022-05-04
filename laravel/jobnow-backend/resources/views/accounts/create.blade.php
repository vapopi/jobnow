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
        border-color: #323232 !important;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('security.index') }}" class="float-end link-secondary" role="button"> 🡰 Go back</a>
                    {{ __('Create User') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('accounts.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="surnames" class="col-md-4 col-form-label text-md-end">{{ __('Surnames') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="surnames" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="email" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Date of birth') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="birth_date" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Phone') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="phone" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Repeat Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>

                            <div class="col-md-6">
                                <select class="w-100" name="role_id" id="role_id">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select> 
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Terms and conditions') }}</label>

                            <div class="col-md-6">
                                <select class="w-100" name="terms" id="terms">
                                    <option value="0" selected>Not accepted</option>
                                    <option value="1">Accepted</option>
                                </select> 
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Premium') }}</label>

                            <div class="col-md-6">
                                <select class="w-100" name="premium" id="premium">
                                        <option value="0" selected>Not obtained</option>
                                        <option value="1">Obtained</option>
                                </select> 
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Profile Picture') }}</label>

                            <div class="col-md-6">
                                <input type="file" class="form-control" id="customFile" name="avatar_id"/>
                            </div>
                        </div>
                        <br>
                        <div class="row mb-0">
                            <div class="mt-3 col-md-12 text-center">
                                <button type="submit" class="w-50 bColor btn btn-primary">Save changes</button>
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