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
                            @if($user->premium == 0 )
                            <div class="circle-img">
                                <img src="{{ asset("storage/{$file->filename}") }}" alt="User" class="rounded-circle" width="150">
                            </div>
                            @else
                            <div class="circle-img">
                                <img src="{{ asset("storage/{$file->filename}") }}" alt="User" class="premium-photo rounded-circle" width="150">
                            </div>
                            @endif
                            <div class="mt-3">
                                <h4>{{$user->name}}</h4>

                                @if($user->premium == 0 )
                                <p class="text-secondary mb-1"><strong>Not Premium</strong></p>
                                @else
                                <p class="premium-user text-secondary mb-1"><strong>Premium User</strong></p>
                                @endif

                                <p class="text-muted font-size-sm"><strong>{{$follows}}</strong> followers</p>

                                @if($user->id != Auth::user()->id)

                                @if($validate)
                                <form method="POST" action="{{ route('followers.destroy', $validate->id) }}">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn-delete btn btn-primary" href="{{ route('followers.destroy', $validate->id) }}" role="button">
                                        Unfollow user
                                    </button>
                                    <input type="text" name="profile_id" value="{{ $user->id }}" hidden>
                                    <input type="text" name="follower_id" value="{{ Auth::user()->id }}" hidden>
                                </form>
                                @else
                                <form method="POST" action="{{ route('followers.store') }}">
                                    @csrf
                                    <button type="submit" class="btn-profile btn btn-primary" href="{{ route('followers.store') }}" role="button">
                                        Follow user
                                    </button>
                                    <input type="text" name="profile_id" value="{{ $user->id }}" hidden>
                                    <input type="text" name="follower_id" value="{{ Auth::user()->id }}" hidden>
                                </form>
                                @endif
                                @endif
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
                                {{$user->name}} {{$user->surnames}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{$user->email}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Phone</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{$user->phone}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Birth date</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{$user->birth_date}}
                            </div>
                        </div>
                        @if(Auth::user()->id == $user->id)
                        <hr>
                        @endif
                        <div class="row">
                            <div class="col-sm-12">
                                @if($user->id == Auth::user()->id)
                                <button id="destroy" type="button" class="btn-delete btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal{{ $user->id }}">Delete</button>
                                <div class="modal fade" id="confirmModal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete the user <strong>{{ $user->name }}</strong> ? <br>
                                                <span class="text-danger">This action cannot be undone.</span>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn-profile btn btn-secondary bsColor" data-bs-dismiss="modal">Close</button>
                                                <form id="form" method="POST" action="{{ route('users.destroy', $user->id) }}">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button id="confirm" type="submit" class="btn-delete btn btn-primary bColor">Confirm</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a class="btn-profile btn btn-info" href="{{route('users.edit', $user->id)}}">Edit</a>
                                @if (Route::has('password.request'))
                                <a class="btn-profile btn btn-info" href="{{ route('password.request') }}">
                                    Change Password
                                </a>
                                @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Companies ({{\App\Models\Company::where('author_id', '=', $user->id)->count()}})
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <span class="mt-4"></span>
                            <hr>
                            <div class="row gutters-sm">
                                @foreach($companies as $company)
                                <div class="col-sm-6 mb-3">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            @foreach($files as $file)
                                            @if($file->id == $company->logo_id)
                                            <div class="w-50 float-end">
                                                <img class="float-end w-75" src="{{ asset("storage/{$file->filename}") }}" title="Logo Company" />
                                            </div>
                                            @endif
                                            @endforeach
                                            <p>Name: {{ $company->name }}</p>
                                            <p>Email: {{ $company->email }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Posts ({{\App\Models\Post::where('author_id', '=', $user->id)->count()}})
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">


                            <div class="row gutters-sm">
                                @foreach($posts as $post)
                                <div class="col-sm-6 mb-3">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            @foreach($files as $file)
                                            @if($file->id == $post->image_id)
                                            <div class="w-50 float-end">
                                                <img class="float-end w-75" src="{{ asset("storage/{$file->filename}") }}" title="Profile picture" />
                                            </div>
                                            @endif
                                            @endforeach
                                            <p>Title: {{ $post->title }}</p>
                                            <p>Description: {{ $post->description }}</p>
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