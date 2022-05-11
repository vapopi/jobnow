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
                    {{ __('Edit Company') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('companies.update', $company->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input value='{{$company->name}}' type="text" class="form-control" name="name" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="surnames" class="col-md-4 col-form-label text-md-end">{{ __('Creation Date') }}</label>

                            <div class="col-md-6">
                                <input value='{{$company->creation_date}}' type="text" class="form-control" name="creation_date" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input value='{{$company->email}}' type="text" class="form-control" name="email" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Logo') }}</label>

                            <div class="col-md-6">
                                <input type="file" class="form-control" id="customFile" name="logo"/>
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