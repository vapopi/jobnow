@extends('layouts.app')
@section('content')

<!DOCTYPE html>

<head>
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
</head>


<div class="welcome">
    @if (Auth::user()->email_verified_at != null)

    <h3><strong>
        
        <span class="typed-text"></span><span class="cursor">&nbsp;</span>{{ Auth::user()->name }}!</p>
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