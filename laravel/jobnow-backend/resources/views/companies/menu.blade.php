@extends('layouts.app')

@section('content')

<!DOCTYPE html>

<head>
    <link href="{{ asset('css/show.css') }}" rel="stylesheet">
</head>

<div class="container">
    <div class="main-body">
        <h5>
            Companies you have created ({{\App\Models\Company::where('author_id', '=', Auth::user()->id)->count()}}) /
            <a class="btn-profile btn btn-primary" href="{{route('companies.create')}}" role="button"> + Add new company</a>
        </h5>
        <hr>
        <div class="col-md-12">
            @foreach ($companies as $company)
            <div class="card w-100 mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Full Name</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{$company->name}}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Email</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{$company->email}}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Creation date</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{$company->created_at}}
                        </div>
                    </div>
                    <hr>
                    <a class="btn-profile btn btn-primary" href="{{route('companies.show', $company)}}" role="button">Show</a>
                    <a class="btn-profile btn btn-primary" href="{{route('companies.edit', $company)}}" role="button">Edit</a>
                    <button class="btn-delete btn btn-secondary" id="destroy" type="submit" role="button" data-bs-toggle="modal" data-bs-target="#confirmModal{{$company->id}}">Delete</button>
                    <div class="modal fade" id="confirmModal{{$company->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Company</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete the company <strong>{{ $company->name }}</strong> ? <br>
                                    <span class="text-danger">This action cannot be undone.</span>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="color btn-delete btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <form id="form" method="POST" action="{{route('companies.destroy', $company->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button id="confirm" type="submit" class="color btn-profile btn btn-primary">Confirm</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection