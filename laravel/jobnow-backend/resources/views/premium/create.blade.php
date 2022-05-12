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
                    {{__('Buy premium') }}
                </div>
                <div class="card-body">
                    <form role="form" method="POST" action="{{route('premium.store')}}">
                        @csrf
                        <label for="category-name">Card number</label>
                        <input class="form-control" type="text" name="card_number" required/>
                        <br>
                        <label for="category-name">Expiration date</label>
                        <input class="form-control" type="date" name="expiration_date" required/>
                        <br>
                        <label for="category-name">CVV</label>
                        <input class="form-control" type="text" name="cvv" required/>
                        <br>
                        <button type="submit" class="color bColor btn btn-primary">Buy now</button>
                        <button type="reset" class="color bsColor btn btn-secondary">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection