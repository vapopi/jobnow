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
                    <a href="{{ url()->previous() }}" class="float-end link-secondary" role="button"> 🡰 Go back</a>
                    {{ __('Edit User') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")

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
                                <input value='{{$user->birth_date}}' type="text" class="form-control" name="birth_date" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Phone') }}</label>

                            <div class="col-md-6">
                                <input value='{{$user->phone}}' type="text" class="form-control" name="phone" required>
                            </div>
                        </div>

                        @if(Auth::user()->role_id == 1)

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>

                            <div class="col-md-6">
                                <select class="w-100" name="role_id" id="role_id">
                                    @foreach ($roles as $role)
                                        @if ($role->id === $user->role_id)
                                            <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                        @else
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endif
                                    @endforeach
                                </select> 
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Terms and conditions') }}</label>

                            <div class="col-md-6">
                                <select class="w-100" name="terms" id="terms">
                                    @if ($user->terms === 0)
                                        <option value="0" selected>Not accepted</option>
                                        <option value="1">Accepted</option>
                                    @else
                                        <option value="0">Not accepted</option>
                                        <option value="1" selected>Accepted</option>
                                    @endif
                                </select> 
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Premium') }}</label>

                            <div class="col-md-6">
                                <select class="w-100" name="premium" id="premium">
                                    @if ($user->premium === 0)
                                        <option value="0" selected>Not obtained</option>
                                        <option value="1">Obtained</option>
                                    @else
                                        <option value="0">Not obtained</option>
                                        <option value="1" selected>Obtained</option>
                                    @endif
                                </select> 
                            </div>
                        </div>

                        @endif

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Profile Picture') }}</label>

                            <div class="col-md-6">
                                <input type="file" class="form-control" id="customFile" name="avatar_id"/>
                            </div>
                        </div>

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