@extends('layouts.app')

@section('content')


<!doctype html>
<html lang="en">

<head>
    <link rel="stylesheet" href={{ asset('/css/security.css') }}>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Security') }}
                    </div>
                    <div class="card-body">
                        <br>
                        @if(Auth::user()->role_id == 1)
                        <div class="p-2 text-center">
                            <h5>Users Configuration</h5>
                            <hr>
                            <div>
                                <a class="w-25 color btn btn-primary" href="{{route('roles.index')}}" role="button">Roles</a>
                                <a class="w-25 color btn btn-primary" href="{{route('accounts.index')}}" role="button">Users</a>
                                <a class="w-25 color btn btn-primary" href="{{route('corporations.index')}}" role="button">Companies</a>
                            </div>
                        </div>
                        <br><br>
                        <div class="p-2 text-center">
                            <h5>Components Configuration</h5>
                            <hr>
                            <div>
                                <a class="w-25 color btn btn-primary" href="{{route('adverts.index')}}" role="button">Offers</a>
                                <a class="w-25 color btn btn-primary" href="{{route('publications.index')}}" role="button">Posts</a>
                                <a class="w-25 color btn btn-primary" href="{{route('chat.index')}}" role="button">Chat</a>
                                <a class="mt-5 w-25 color btn btn-primary" href="" role="button">Tickets</a>
                            </div>
                        </div>
                        @endif
                        @if(Auth::user()->role_id == 2)
                        <div class="p-2 text-center">
                            <h5>Components Configuration</h5>
                            <hr>
                            <div>
                                <a class="w-25 color btn btn-primary" href="" role="button">Tickets</a>
                            </div>
                        </div>
                        @endif
                        @if(Auth::user()->role_id == 3)
                        <div class="p-2 text-center">
                            <h5>Components Configuration</h5>
                            <hr>
                            <div>
                                <a class="w-25 color btn btn-primary" href="{{route('chat.index')}}" role="button">ChatApp</a>
                                <a class="w-25 color btn btn-primary" href="{{route('publications.index')}}" role="button">Posts</a>
                            </div>
                        </div>
                        @endif
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
@endsection