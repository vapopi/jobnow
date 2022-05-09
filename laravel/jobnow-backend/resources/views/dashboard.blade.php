@extends('layouts.app')
@section('content')


<style>
    .color{  
        background-color: #6356e5 !important;
    }
</style>


<div class="text-center">
    @if (Auth::user()->email_verified_at != null)

    <h3><strong>
        Welcome to jobnow {{ Auth::user()->name }}!
        </strong>
    </h3>
    @else
    <h3><strong>
        Verify your email!
        </strong>
    </h3>
    @endif
</div>

@endsection