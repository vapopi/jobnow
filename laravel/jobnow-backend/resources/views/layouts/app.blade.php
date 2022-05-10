<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'jobnow') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/general.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/general.css') }}" rel="stylesheet">
    <link href="{{ asset('css/translator.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>

<script defer type="text/javascript"> 
   function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
  }
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm">
            <div class="container">
                <div id="logo">
                <a href="{{route('dashboard')}}" class="navbar-brand">
                    <img id="img" style="width: 150px;"src={{ asset('/images/black_logo.png') }} alt="login image" class="form-img">
                </a>
                </div>
                <!-- <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fas fa-align-left"></i>
                    <span>Show/Hide Sidebar</span>
                </button> -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="name dropdown-toggle nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  >
                                {{ Auth::user()->name }}

                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('users.show', Auth::user()->id, Auth::user()->avatar_id) }}"">
                                        {{ __('My profile') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @if (Auth::user()->email_verified_at != null)
            <div class="wrapper">
            <nav class="shadow-lg" id="sidebar">
                <ul class="list-unstyled components">
                        <li>
                            <a class="special nav gradient-btn" href="{{route('dashboard')}}"><i class="bi bi-house-door-fill"></i> DASHBOARD</a>
                        </li>
                        <hr>
                    @if (Auth::user()->role_id == 4)

                        <li>
                            <a class="nav nospecial" href="{{route('offers.index')}}"><i class="bi bi-calendar2-week-fill"></i> OFFERS</a>
                        </li>
                        <li>
                            <a class="nav nospecial" href="{{route('premium.index')}}" role="button"><i class="bi bi-cart-fill"></i> PREMIUM</a>
                        </li>

                        <li>
                            <a class="nav nospecial"  href="{{route('menu.index')}}" role="button"><i class="bi bi-briefcase-fill"></i> COMPANIES</a>
                        </li>
                        <li>
                            <a class="nav nospecial"  href="{{route('posts.index')}}" role="button"><i class="bi bi-bookmark-fill"></i> POSTS</a>
                        </li>
                        <li>
                            <a class="nav nospecial" href="" role="button"><i class="bi bi-bell-fill"></i> NOTIFICATIONS</a>
                        </li>
                        <li>
                            <a class="nav nospecial"  href="{{route('tickets.index')}}" role="button"><i class="bi bi-ticket-detailed-fill"></i> TICKETS</a>
                        </li>
                        <li>
                            <a class="nav nospecial"  href="{{route('chatapp.index')}}" role="button"><i class="bi bi-chat-fill"></i> CHATAPP</a>
                        </li>
                        <li>
                            <a class="nav nospecial"  href="{{route('mynetwork.index')}}" role="button"><i class="bi bi-wifi"></i> MY NETWORK</a><!-- React -->
                        </li>
                    @else
                        <li>
                            <a class="nav nospecial"  href="{{route('security.index')}}" role="button"><i class="bi bi-shield-fill"></i> SECURITY</a><!-- React -->
                        </li>
                    @endif
                </ul>

                <!-- <ul class="list-unstyled CTAs">
                    <li>
                        <a href="" class="download">button</a>
                    </li>
                </ul> -->
            </nav>

            <div id="content">
                <main class="py-4">
                    @include('flash')
                    @yield('content')
                </main>
            </div>
        </div>
    @endif

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });
    </script>
</body>
</html>



                        

