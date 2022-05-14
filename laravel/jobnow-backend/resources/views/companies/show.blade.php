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
                        @if(Auth::user()->id == $company->author_id)
                            <td><a href="{{ route('applicated.show', $o, $o) }}" class="w-100 bsColor btn btn-secondary" role="button">Show applicated users</a></td>
                            <td>
                                <button class="w-100 bsColor btn btn-secondary" id="destroy" type="submit" role="button" data-bs-toggle="modal" data-bs-target="#confirmModal{{$o->id}}">Delete</button>
                                <div class="modal fade" id="confirmModal{{$o->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete offer</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete the offer with ID <strong>{{ $o->id }}</strong> ? <br>
                                                <span class="text-danger">This action cannot be undone.</span>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="bsColor btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <form id="form" method="POST" action="{{route('offers.destroy', $o->id)}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button id="confirm" type="submit" class="bColor btn btn-primary">Confirm</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
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