@extends('layouts.app')

@section('content')
<style>
    .color{  
        background-color: #6356e5 !important;
    }
</style>
<div class="container">
    <div class="mx-auto col-md-8">
        <div class="card-header">
            <a href="{{ url()->previous() }}" class="float-end link-secondary" role="button"> 🡰 Go back</a>
            {{ __('Buy premium') }}
        </div>
        <div class="border p-5 bg-white d-flex justify-content-center">
        <div class="p-2 shadow-sm float-start card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">$9.99</h5>
                    <p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
                    <a href="#" class="color btn btn-primary">Buy now</a>
                </div>
            </div>

            <div class="p-2 shadow-sm float-start card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">$24.99</h5>
                    <p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
                    <a href="#" class="color btn btn-primary">Buy now</a>
                </div>
            </div>

            <div class="p-2 shadow-sm float-start card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">$74.99</h5>
                    <p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
                    <a href="#" class="color btn btn-primary">Buy now</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection