@extends('layouts.app')
@section('content')

<!doctype html>
<html lang="en">

<head>
    <link rel="stylesheet" href={{ asset('/css/home.css') }}>
</head>

<body>
    <!-- @if(Auth::user()->email_verified_at != null)
    @else
    @endif -->
    <br>
    <section id="main" class="d-flex align-items-center">
        <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-9 text-center">
                    <h1><strong>Welcome to jobnow {{ Auth::user()->name }}!</strong></h1>
                    <h3>Enjoy using our application!</h3>
                </div>
            </div>
            <!-- <div class="mt-5 text-center">
                <a href="#about" class="btn btn-primary scrollto">Get Started</a>
            </div> -->
            <br>
            <div class="mt-5 row icon-boxes">
                <div class="box  col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                    <div class="icon-box">
                        <div class="icon"><i class="bi bi-flag-fill"></i></div>
                        <br>
                        <h4 class="title"><a href="#"><strong>Apps</strong></a></h4>
                        <p class="description">This application was created to satisfy all your needs in the work environment, that's why we offer all the features that you can see in the sidebar!</p>
                    </div>
                </div>

                <div class="box  col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                    <div class="icon-box">
                        <div class="icon"><i class="bi bi-bookmarks-fill bi-lg"></i></div>
                        <br>
                        <h4 class="title"><a href="#"><strong>Premium</strong></a></h4>
                        <p class="description">Remember that if you buy premium, you will get a variety of exclusive features to offer you a better experience in the application!</p>
                    </div>
                </div>

                <div class="box  col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
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
    <h4>Mini tips</h4>
    <div class="container">
    <div id="carouselContent" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active text-center p-4">
                 <p>...</p>
            </div>
            <div class="carousel-item text-center p-4">
                
                <p>...</p>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselContent" role="button" data-slide="prev">
            <span class=" carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="text-dark sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselContent" role="button" data-slide="next">
            <span class=" carousel-control-next-icon" aria-hidden="true"></span>
            <span class="text-dark sr-only">Next</span>
        </a>
    </div>
</div>
</body>

</html>

@endsection