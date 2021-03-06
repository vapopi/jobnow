@extends('layouts.app')
@section('content')

<!doctype html>
<html lang="en">

<head>
    <link rel="stylesheet" href={{ asset('/css/home.css') }}>
</head>

<body>
    @if(Auth::user()->email_verified_at != null)
    <br><br>
    <section id="main" class="mt-5 align-items-center">
        <div class="container ">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-9 text-center">
                    <h1><strong>Welcome to <span>jobnow </span>{{ Auth::user()->name }}</strong></h1>
                    <h3>Enjoy using our application!</h3>
                </div>
            </div>
            <!-- <div class="mt-5 text-center">
                <a href="#about" class="btn btn-primary scrollto">Get Started</a>
            </div> -->
            <br>
            <div class="mt-5 row icon-boxes">
                <div class="box col-lg-4 mb-5 mb-lg-0">
                    <div class="icon-box">
                        <div class="icon"><i class="bi bi-flag-fill"></i></div>
                        <br>
                        <h4 class="title"><a href="#"><strong>Apps</strong></a></h4>
                        <p class="description">This application was created to satisfy all your needs in the work environment, that's why we offer all the features that you can see in the sidebar!</p>
                    </div>
                </div>

                <div class="box col-lg-4 mb-5 mb-lg-0">
                    <div class="icon-box">
                        <div class="icon"><i class="bi bi-bookmarks-fill bi-lg"></i></div>
                        <br>
                        <h4 class="title"><a href="#"><strong>Premium</strong></a></h4>
                        <p class="description">Remember that if you buy premium, you will get a variety of exclusive features to offer you a better experience in the application!</p>
                    </div>
                </div>

                <div class="box col-lg-4 mb-5 mb-lg-0">
                    <div class="icon-box">
                        <div class="icon"><i class="bi bi-image"></i></div>
                        <br>
                        <h4 class="title"><a href="#"><strong>Profile</strong></a></h4>
                        <p class="description">Make sure to create a good profile with your account, so everyone can see who you are and make them notice you. Above all, respect the rules and make this community a better place!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@else
    <div class="mt-5 row justify-content-center">
        <div class="col-xl-7 col-lg-9 text-center">
            <h1><strong>Welcome to <span style="color: #6356e5;">jobnow </span>{{ Auth::user()->name }}</strong></h1>
            <h4>Verify your email before starting please!</h4>
        </div>
    </div>
    <div class="text-center mt-5">
        <button class="mx-auto btn btn-primary bg-dark text-light w-25 dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </button>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
@endif

</body>

</html>

@endsection