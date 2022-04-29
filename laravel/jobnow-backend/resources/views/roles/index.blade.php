@extends('layouts.app')

@section('content')
<style>

    .color{  
        color: #ffffff;
        font-weight: bold;
    }

    .bColor{  
        background-color: #6356e5 !important;
        border-color: #6356e5 !important;
    }

    .bsColor{  
        background-color: #323232 !important;
    }

</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{__('Roles') }}</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <td scope="col">ID</td>
                                <td scope="col">Name</td>
                                <td scope="col">Options</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td><button class="color bColor btn-btn-primary" href="{{route('roles.show', $role->id)}}">Edit Role</button>
                                    <button class="color bsColor btn-btn-secondary" href="{{route('roles.destroy', $role->id)}}">Delete Role</button>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a class="bColor btn btn-primary" href="{{route('roles.create')}}" role="button">Add New Role</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection