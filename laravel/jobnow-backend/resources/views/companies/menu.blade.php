@extends('layouts.app')

@section('content')
<style>
    .color{  
        background-color: #6356e5 !important;
    }


    .bColor{  
        background-color: #6356e5 !important;
        border-color: #6356e5 !important;
    }

	.b2Color{  
        background-color: #2d0793 !important;
        border-color: #6356e5 !important;
    }

    .bsColor{  
        background-color: #323232 !important;
        border-color: #323232 !important;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('dashboard') }}" class="float-end link-secondary" role="button"> 🡰 Go back</a>
                    {{ __('Companies') }}
                </div>
                <div class="card-body">
                    <br>
                    <div class="p-2">
                        <h5>Companies you have created</h5>
                        <hr>
                        <div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td scope="col">ID</td>
                                        <td scope="col">Name</td>
                                        <td scope="col">Email</td>
                                        <td scope="col">Creation Date</td>
                                        <td scope="col">Options</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($companies as $company)
                                    <tr>
                                        <td>{{ $company->id }}</td>
                                        <td>{{ $company->name }}</td>
                                        <td>{{ $company->email }}</td>
                                        <td>{{ $company->creation_date }}</td>
                                        <td>
                                            <a class="w-100 color b2Color btn btn-primary" href="{{route('companies.edit', $company)}}" role="button">Edit</a>
                                        </td>
                                        <td>
                                            <button class="w-100 bsColor color btn btn-secondary" id="destroy" type="submit" role="button" data-bs-toggle="modal" data-bs-target="#confirmModal{{$company->id}}">Delete</button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="confirmModal{{$company->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Delete Company</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete the company <strong>{{ $company->name }}</strong> ? <br>
                                                            <span class="text-danger">This action cannot be undone.</span>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="color bsColor btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <form id="form" method="POST" action="{{route('companies.destroy', $company->id)}}">
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
                            <a class="bColor btn btn-primary" href="{{route('companies.create')}}" role="button"> + Add New Company</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection