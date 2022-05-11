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
                    {{__('Companies') }}
                </div>
                <div class="card-body">
                    <form role="form" method="POST" action="{{route('companies.store')}}" enctype="multipart/form-data">
                        @csrf
                        <label for="category-name">Enter Company Name</label>
                        <input class="form-control" type="text" name="name" autofocus required/>
                        <br>
                        <label for="category-name">Enter Company Email</label>
                        <input class="form-control" type="text" name="email" required/>
                        <br>
                        <label for="category-name">Enter Company Date of Creation</label>
                        <input class="form-control" type="date" name="creation_date" required/>
                        <br>
                        <label for="category-name">Enter Company Logo</label>
                        <input class="form-control" type="file" name="logo" required/>
                        <br>
                        <button type="submit" class="w-25 color bColor btn btn-primary">Create</button>
                        <button type="reset" class="w-25 color bsColor btn btn-secondary">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection