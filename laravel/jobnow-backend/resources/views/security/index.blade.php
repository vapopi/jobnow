@extends('layouts.app')

@section('content')
<style>
    .color{  
        background-color: #6356e5 !important;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('dashboard') }}" class="float-end link-secondary" role="button"> 🡰 Go back</a>
                    {{ __('Security') }}
                </div>
                <div class="card-body">
                    <br>
                    <div class="p-2">
                        <h5>Users Configuration</h5>
                        <hr>
                        <div>
                            <a class="w-25 color btn btn-primary" href="{{route('roles.index')}}" role="button">Roles</a>
                            <a class="w-25 color btn btn-primary" href="{{route('users.index')}}" role="button">Users</a>
                            <a class="w-25 color btn btn-primary" href="{{route('companies.index')}}" role="button">Companies</a>
                        </div>
                    </div>
                    <br><br>
                    <div class="p-2">
                        <h5>Components Configuration</h5>
                        <hr>
                        <div>
                            
                            <a class="w-25 color btn btn-primary" href="" role="button">Offers</a>
                            <a class="w-25 color btn btn-primary" href="" role="button">Posts</a>
                            <a class="w-25 color btn btn-primary" href="" role="button">Chat</a>
                            <a class="mt-5 w-25 color btn btn-primary" href="" role="button">Tickets</a>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection