@extends('layouts.app')
@section('content')

<!DOCTYPE html>

<head>
    <link href="{{ asset('css/show.css') }}" rel="stylesheet">
</head>

<div class="container">
    <div class="main-body">
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <div class="circle-img">
                                <img src="{{ asset("storage/{$file->filename}") }}" alt="Logo" class="rounded-circle" width="150">
                            </div>
                            <div class="mt-3">
                                <h4>{{$corporation->name}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Full Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{$corporation->name}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{$corporation->email}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Creation Date</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{$corporation->created_at}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <span class="mt-4"></span>

            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Offers ({{\App\Models\Offer::where('company_id', '=', $corporation->id)->count()}})
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row gutters-sm">
                                @foreach($offers as $o)
                                <div class="col-sm-6 mb-3">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Title</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    {{$o->title}}
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Description</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    {{$o->description}}
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Creation Date</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    {{$o->created_at}}
                                                </div>
                                            </div>
                                            <hr>
                                            @if(Auth::user()->id == $corporation->author_id)
                                            <a href="{{ route('applicated.show', $o, $o) }}" class="w-100 btn-profile btn btn-secondary" role="button">Show applicated users</a>
                                            <button class="mt-2 w-100 btn-delete btn btn-secondary" id="destroy" type="submit" role="button" data-bs-toggle="modal" data-bs-target="#confirmModal{{$o->id}}">Delete</button>
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
                                                            <button type="button" class="btn-delete btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <form id="form" method="POST" action="{{route('offers.destroy', $o->id)}}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button id="confirm" type="submit" class="btn-profile btn btn-primary">Confirm</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @else
                                            <a href="{{ route('offers.index') }}" class="w-100 btn-profile bsColor btn btn-secondary" role="button">Apply for this offer</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection