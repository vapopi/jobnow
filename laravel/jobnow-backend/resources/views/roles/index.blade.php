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

                                <td><a class="color bColor btn btn-primary" href="{{route('roles.edit', $role)}}" role="button">Edit Role</a>
                                    <form id="form" method="POST" action="{{route('roles.destroy', $role)}}">
                                        @csrf
                                        @method('delete')
                                        <a id ="destroy" class="color btn btn-secondary" data-bs-toggle="modal" data-bs-target="#confirmModal" role="button">Delete Role</button>
                                    </form>
                                </td>
                                    
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a class="bColor btn btn-primary" href="{{route('roles.create')}}" role="button"> + Add New Role</a>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete that role?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            This action cannot be undone
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="color bsColor btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button id="confirm" type="button" class="color bColor btn btn-primary">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit confirm -->
            <script type="text/javascript">

                const submit = document.getElementById("destroy");
                const confirm = document.getElementById("confirm");

                // Disable form submit button
                submit.addEventListener("click", function(event) {

                    event.preventDefault();
                    return false;

                });

                // Enable submit via modal confirmation
                confirm.addEventListener("click", function(event) {

                    document.getElementById("form").submit();

                });

            </script>
        </div>
    </div>
</div>
@endsection