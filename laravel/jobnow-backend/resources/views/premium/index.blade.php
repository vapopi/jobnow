@extends('layouts.app')

@section('content')
<!DOCTYPE html>

<head>
    <link href="{{ asset('css/premium.css') }}" rel="stylesheet">
</head>

<body>
    <section>
        <div class="container py-5">

            <header class="text-center mb-5 text-white">
                <div class="row">
                    <div class="col-lg-7 mx-auto">
                        <h1><strong>Jobnow Premium</strong></h1>
                        <p>Buy this premium plan and unlock exclusive features <br><span> to enhance your experience in jobnow.</span></p>
                    </div>
                </div>
            </header>

            <div class="text-center">
                <div class="mx-auto w-75 mb-5 mb-lg-0">
                    <div class="bg-white p-5 rounded-lg shadow">
                        <h1 class="h6 text-uppercase font-weight-bold mb-4">Premium</h1>
                        <h2 class="h1 font-weight-bold">$9.99</h2>

                        <div class="custom-separator my-4 mx-auto bg-primary"></div>

                        <ul class="list-unstyled my-5 text-small text-center font-weight-normal">
                            <li class="mb-3">
                                <i class="bi bi-check"></i>You can use a gif in your profile picture
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-check"></i> You can use a gif in your companies logos
                            </li>
                        </ul>
                        @if(Auth::user()->premium == 0)
                        <a href="{{ route('premium.create') }}" class="w-50 btn btn-primary btn-block p-2 shadow rounded-pill">Buy now</a>
                        @else
                        <p class="text-danger">You are already a premium user!</p>
                        <a href="#" style="background-color: #323232 !important; border-color: #323232 !important;" class="btn btn-primary btn-block p-2 shadow rounded-pill">Buy now</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>

@endsection