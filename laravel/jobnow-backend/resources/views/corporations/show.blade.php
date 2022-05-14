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
        {{ __('Companies') }}
    </div>

    <div class="card-body">

        <div class="w-50 float-start">
            <p class="card-text"><strong>Name: </strong>{{$corporation->name}}</p>
            <p class="card-text"><strong>Email:</strong> {{$corporation->email}}</p>
            <p class="card-text"><strong>Creation Date: </strong> {{$corporation->creation_date}}</p>
        </div>

        <div class="w-50 float-end">
            <img class="float-end w-75" src="{{ asset("storage/{$file->filename}") }}" title="Logo"/>
        </div>
    </div>
</div>
<br>
<h5 class="text-center">offers of the company</h5>
<br>
<div class="card w-50 mx-auto" style="width: 18rem;">
    <div class="card-header">
        {{ __('Offers of the company') }}
    </div>
    <div class="card-body overflow-auto">
        <table class="table">
            <thead>
                <tr>
                    <td scope="col">ID</td>
                    <td scope="col">Title</td>
                    <td scope="col">Description</td>
                    <td scope="col">Options</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($offers as $o)
                    <tr>
                        <td>{{ $o->id }}</td>
                        <td>{{ $o->title }}</td>
                        <td>{{ $o->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection