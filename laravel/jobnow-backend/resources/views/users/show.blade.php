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
        {{ __('User Profile') }}
    </div>

    
    <div class="card-body">
        @if($user->id == Auth::user()->id)
            @if (Route::has('password.request'))
                <a class="float-end btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        @endif
        <div class="w-50 float-start">
            <p class="card-text"><strong>Name:</strong> {{$user->name}}</p>
            <p class="card-text"><strong>Surnames:</strong> {{$user->surnames}}</p>
            <p class="card-text"><strong>Email:</strong> {{$user->email}}</p>
            <p class="card-text"><strong>Phone:</strong> {{$user->phone}}</p>
            <p class="card-text"><strong>Data de naixement:</strong> {{$user->birth_date}}</p>
            <p class="card-text"><strong>Followers:</strong> {{$follows}}</p>


            <div>
                @if($user->premium == 0 )
                    <p class="color">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill" viewBox="0 0 16 16">
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                    </svg>
                    This user is not premium yet! <strong>@if(Auth::user()->id == $user->id)<a class="color" href="{{ route('premium.index') }}">Buy premium.</a></strong>@endif</p>
                @else
                    <p class="color">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-check" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                            <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                        </svg>
                        This user is premium!
                    </p>
                @endif
            </div>
            <br><br><br>

            @if($user->id != Auth::user()->id)
                    @if($validate)
                        <form method="POST" action="{{ route('followers.destroy', $validate->id) }}" >
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="bsColor btn btn-primary" href="{{ route('followers.destroy', $validate->id) }}" role="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-dash" viewBox="0 0 16 16">
                                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                    <path fill-rule="evenodd" d="M11 7.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z"/>
                                </svg>
                                    Unfollow user
                                </button>
                                <input type="text" name="profile_id" value="{{ $user->id }}" hidden>
                                <input type="text" name="follower_id" value="{{ Auth::user()->id }}" hidden>
                        </form>
                    @else
                        <form method="POST" action="{{ route('followers.store') }}" >
                            @csrf
                            <button type="submit" class="bColor btn btn-primary" href="{{ route('followers.store') }}" role="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                    <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                                </svg>
                                Follow user
                            </button>
                            <input type="text" name="profile_id" value="{{ $user->id }}" hidden>
                            <input type="text" name="follower_id" value="{{ Auth::user()->id }}" hidden>
                        </form>
                    @endif

            @endif
        </div>

        <div class="w-50 float-end">
            <img class="float-end w-75" src="{{ asset("storage/{$file->filename}") }}" title="Profile picture"/>
        </div>

    </div>
    <ul class="list-group list-group-flush">
        @if(Auth::user()->id == $user->id)
            <a href="{{ route('users.edit', $user->id) }}" class="text-white bColor w-100 btn btn-warning" role="button">Edit my profile</a>
            <button id="destroy" type="button" class="w-100 mt-2 btn btn-danger bsColor" data-bs-toggle="modal" data-bs-target="#confirmModal{{ $user->id }}">Delete</button>
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
                            <button type="button" class="btn btn-secondary bsColor" data-bs-dismiss="modal">Close</button>
                            <form id="form" method="POST" action="{{ route('users.destroy', $user->id) }}">
                                @csrf
                                @method("DELETE")
                                <button id="confirm" type="submit" class="btn btn-primary bColor">Confirm</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </ul>
    </div>

    <br>
    <h5 class="text-center">Posts of the user</h5>
    @foreach($posts as $post)

        <div class="card w-50 mx-auto" style="width: 18rem;">
            <div class="card-body overflow-auto">
                
                <div class="w-50">
                    @foreach($files as $file)
                        @if($file->id == $post->image_id)
                            <div class="w-50 float-end">
                                <img class="float-end w-75" src="{{ asset("storage/{$file->filename}") }}" title="Profile picture"/>
                            </div>
                        @endif
                    @endforeach

                    <p>Title: {{ $post->title }}</p>
                    <p>Description: {{ $post->description }}</p>
                </div>
            </div>
        </div>
        <br>
    @endforeach

</div>


@endsection