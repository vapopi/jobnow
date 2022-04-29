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
                    <form role="form" method="POST" action="{{route('roles.update', $role->id)}}">

                        @csrf
                        @method('PUT')
                        <label for='name'>Change role's name</label>
                        <input type='text' name='name' value="{{$role->name}}"/>
                        <button type="submit" class="color bColor btn btn-primary">Save</button>
                        <button type="reset" class="color bsColor btn btn-secondary">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection