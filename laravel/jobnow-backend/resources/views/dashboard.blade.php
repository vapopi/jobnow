@extends('layouts.app')
@section('content')

<!doctype html>
<html lang="en">

<head>
	<link rel="stylesheet" href={{ asset('/css/home.css') }}>
    <link href="/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    @if(Auth::user()->email_verified_at != null)
        <main role="main">
            <div class="shadow jumbotron">
                <div class="container">
                    <h1 class="display-3">Hello, {{Auth::user()->name}}!</h1>
                    <p>We are glad to see you here. We hope you enjoy our application and have fun on it.</p>
                </div>
            </div>
        </main>
    @else
        <main role="main">
            <div class="shadow jumbotron">
                <div class="container">
                    <h1 class="display-3">Hello, {{Auth::user()->name}}!</h1>
                    <p>Verify your account for starting using the app.</p>
                </div>
            </div>
        </main>
    @endif

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
</body>

</html>

@endsection