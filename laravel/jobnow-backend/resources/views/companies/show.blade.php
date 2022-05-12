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
            <p class="card-text"><strong>Name</strong> {{$company->name}}</p>
            <p class="card-text"><strong>Email:</strong> {{$company->email}}</p>
            <p class="card-text"><strong>Creation Date:</strong> {{$company->creation_date}}</p>
        </div>

        <div class="w-50 float-end">
            <img class="float-end w-75" src="{{ asset("storage/{$file->filename}") }}" title="Logo"/>
        </div>
    </div>
</div>
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
                        @if(Auth::user()->id == $o->company_id)
                            <td><a href="{{ route('applicated.show', $o, $o) }}" class="w-100 bsColor btn btn-secondary" role="button">Show applicated users</a></td>
                        @else
                            <td><a href="{{ route('offers.index') }}" class="w-100 bsColor btn btn-secondary" role="button">Apply for this offer</a></td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection