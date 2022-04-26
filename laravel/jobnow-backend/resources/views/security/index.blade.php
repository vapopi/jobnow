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
                <div class="card-header">{{ __('Security') }}</div>
                <div class="card-body">
                    <br>
                    <div class="p-2">
                        <h5>Users Configuration</h5>
                        <hr>
                        <div class="text-center">
                            <a class="w-25 color btn btn-primary"  role="button">Users</a>
                            <a class="w-25 color btn btn-primary"  role="button">Companies</a>
                            <a class="w-25 color btn btn-primary"  role="button">Groups</a>
                        </div>
                    </div>
                    <br><br>
                    <div class="p-2">
                        <h5>Components Configuration</h5>
                        <hr>
                        <div class="text-center">
                            <a class="w-25 color btn btn-primary"  role="button">Roles</a>
                            <a class="w-25 color btn btn-primary"  role="button">Notifications</a>
                            <a class="w-25 color btn btn-primary"  role="button">Permissions</a>
                        </div>
                    </div>
                    <br><br>
                    <div class="p-2">
                        <h5>Premium Configuration</h5>
                        <hr>
                        <div class="text-center">
                            <a class="w-25 color btn btn-primary"  role="button">Premium users</a>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection