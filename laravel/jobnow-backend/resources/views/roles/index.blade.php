@extends('layouts.app')

@section('content')
<style>

    .color{  
        color: #ffffff;
    }

    .bColor{  
        background-color: #2d0793 !important;
        border-color: #2d0793 !important;
    }

    .b2Color{  
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
                <div class="card-header">
                    {{__('Roles') }}
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <td scope="col">ID</td>
                                <td scope="col">Name</td>
                                <td class="w-25" scope="col">Options</td>
                                <td class="w-25" scope="col"></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <a class="w-100 color bColor btn btn-primary" href="{{route('roles.edit', $role)}}" role="button">Edit</a>

                                </td>
                                <td>
                                    <button class="w-100 bsColor color btn btn-secondary" id="destroy" type="submit" role="button" data-bs-toggle="modal" data-bs-target="#confirmModal{{$role->id}}">Delete</button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="confirmModal{{$role->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Role</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete the role <strong>{{ $role->name }}</strong> ? <br>
                                                    <span class="text-danger">This action cannot be undone.</span>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="color bsColor btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <form id="form" method="POST" action="{{route('roles.destroy', $role->id)}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button id="confirm" type="submit" class="color bColor btn btn-primary">Confirm</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal -->                
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a class="b2Color btn btn-primary" href="{{route('roles.create')}}" role="button"> + Add new role</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection