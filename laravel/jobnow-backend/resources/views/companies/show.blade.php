@extends('layouts.app')
@section('content')

<style>
    .color{  
        color: #2d0793;
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

<div class="card w-50 mx-auto" style="width: 18rem;">

    <div class="card-header">
        <a href="{{ url()->previous() }}" class="float-end link-secondary" role="button"> 🡰 Go back</a>
        {{ __('Companies') }}
    </div>

    <div class="card-body">

        <div class="w-50 float-start">
            <p class="card-text"><strong>Name</strong> {{$company->name}}</p>
            <p class="card-text"><strong>Email:</strong> {{$company->email}}</p>
            <p class="card-text"><strong>Creation Date:</strong> {{$company->creation_date}}</p>
        </div>

        <div class="w-50 float-end">
            <img class="float-end w-75" src="{{ asset("storage/{$file->filename}") }}" title="Logo"/>
        </div>
    </div>
</div>
@endsection