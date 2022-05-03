@extends('layouts.app')

@section('content')
<style>

    .color{  
        color: #ffffff;
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
                <div class="card-header">
					<a href="{{ route('roles.index') }}" class="float-end link-secondary" role="button">🡰 Go back</a>  
                    {{__('Roles') }}
                </div>
                <div class="card-body">
                    <form role="form" method="POST" action="{{route('roles.store')}}">
                        @csrf
                        <label for="category-name">Enter role name</label>
                        <input class="form-control" type="text" name="name"/>
                        <br>
                        <button type="submit" class="color bColor btn btn-primary">Create</button>
                        <button type="reset" class="color bsColor btn btn-secondary">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection