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
					<a href="{{ route('security.index') }}" class="float-end link-secondary" role="button"> 🡰 Go back</a>  
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
                                <form method="POST" action="{{route('roles.destroy', $role)}}">
                                        @csrf
                                        @method('delete')
                                        <button class="w-100 bsColor color btn btn-secondary" type="submit" role="button">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a class="b2Color btn btn-primary" href="{{route('roles.create')}}" role="button"> + Add New Role</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection