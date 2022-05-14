<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'jobnow') }}</title>

    <!-- Scripts -->
    <script defer src="{{ asset('js/app.js') }}" ></script>
    <script defer src="{{ asset('js/general.js') }}"></script>

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
</head>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm">
            <button type="button" id="sidebarCollapse" class="btn btn-info">
                <i class="bi bi-text-left"></i>
            </button>
            <div class="header-elements">

                <div id="logo">
                    <a href="{{route('dashboard')}}" class="navbar-brand">
                        <img id="img" src={{ asset('/images/black_logo.png') }} alt="login image" class="form-img">
                    </a>
                </div>
            </div>
        </nav>

        @if (Auth::user()->email_verified_at != null)
            <div class="wrapper">
            <nav class="shadow-lg" id="sidebar">
                <ul class="list-unstyled components">
                    <li>
                        <a class="special nav gradient-btn" href="{{route('dashboard')}}"><i class="bi bi-house-door-fill"></i> HOME</a>
                    </li>
                    @if (Auth::user()->role_id == 4)
                        <hr>
                        <li>
                            <a class="premium nav no-special" href="{{route('premium.index')}}" role="button"><i class="bi bi-cart-fill"></i> PREMIUM</a>
                        </li>
                        <li>
                            <a class="nav no-special"  href="{{route('menu.index')}}" role="button"><i class="bi bi-briefcase-fill"></i> COMPANIES</a>
                        </li>
                        <li>
                            <a class="nav no-special" href="{{route('offers.index')}}"><i class="bi bi-calendar2-week-fill"></i> OFFERS</a>
                        </li>
                        <li>
                            <a class="nav no-special"  href="{{route('posts.index')}}" role="button"><i class="bi bi-bookmark-fill"></i> POSTS</a>
                        </li>
                        <li>
                            <a class="nav no-special"  href="{{route('tickets.index')}}" role="button"><i class="bi bi-ticket-detailed-fill"></i> TICKETS</a>
                        </li>
                        <li>
                            <a class="nav no-special"  href="{{route('chatapp.index')}}" role="button"><i class="bi bi-chat-fill"></i> CHATAPP</a>
                        </li>
                        <li>
                            <a class="nav no-special"  href="{{route('mynetwork.index')}}" role="button"><i class="bi bi-wifi"></i> MY NETWORK</a><!-- React -->
                        </li>
                    @else
                        <hr>
                        <li>
                            <a class="nav no-special"  href="{{route('security.index')}}" role="button"><i class="bi bi-shield-fill"></i> SECURITY</a><!-- React -->
                        </li>
                    @endif
                </ul>
                <hr>
                <ul class="name ms-auto">
                    <div class="info-user">
                        @if(Auth::user()->role_id == 4 || Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
                            @if( \App\Models\Notification::where('author_id', '=', Auth::user()->id)->count() == 0)
                                <span>
                                    <a class="notis nav no-special" href="{{route('notifications.index')}}" role="button"><i class="bi bi-bell-fill"></i> 
                                    ({{ \App\Models\Notification::where('author_id', '=', Auth::user()->id)->count() }})
                                    </a>
                                </span>
                            @else
                                <span>
                                    <a class="text-danger notis nav no-special" href="{{route('notifications.index')}}" role="button"><i class="bi bi-bell-fill"></i> 
                                    ({{ \App\Models\Notification::where('author_id', '=', Auth::user()->id)->count() }})
                                    </a>
                                </span>    
                            @endif
                        @endif
                        <a href="#profile" data-toggle="collapse" aria-expanded="false" class="nameUser dropdown-toggle">
                        <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}</a>

                    </div>
                    <ul class="collapse list-unstyled" id="profile">
                        <br>
                        <li>
                            <a class="dropdown-item" href="{{ route('users.show', Auth::user()->id, Auth::user()->avatar_id) }}"">
                                {{ __('My profile') }}
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                            </form>
                        </li>
                    </ul>
                </ul>
            </nav>

            <div id="content">
                <main class="py-4">
                    @include('flash')
                    @yield('content')
                </main>
            </div>
        </div>
    @else
        <h3 class="mt-5 text-center">Verify your email for starting using jobnow!</h3><br>
        <div style="text-align:center;">
            <button class="btn btn-primary bg-dark text-light mx-auto w-25 dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </button>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
            </form>
        </div>
    @endif

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</body>
</html>



                        

