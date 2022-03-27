<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .navbar{
            position: fixed;
            width: 100%;
            top: 0;
            height: 60px;
            z-index: 999;
        }
        .main {
            margin-top: 55px; /* Add a top margin to avoid content overlay */
            z-index: -1;
        }
    </style>
</head>
<body style="background-image: url({{ URL::asset('images/bg.jpg') }})">
    <div id="app" style="background-image: url({{url('images/bg.png')}})">
        <nav class="navbar navbar-expand-md navbar-dark  shadow-sm" style="background-color: #000010;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/blogs') }}">
                    {{-- {{ config('app.name', 'Laravel') }} --}}
                    <img src="{{url('images/logo.png')}}" height="40px;"/>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('about-us') }}">{{ __('About Us') }}</a>
                            </li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('welcome') }}">{{ __('Login') }}</a>
                            </li>
                        @else
                            @if(Auth::user()->type=='admin')
                                <a class="nav-link" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <a class="dropdown-item" href="{{route('profile',['id'=>Auth::user()->id])}}">View Profile</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
       
        <div class="main" style="background-image: linear-gradient(to bottom, rgba(245, 246, 252, 0), rgba(255, 255, 255, 0.699)),url({{url('images/bg.png')}})">
        @yield('content')
        </div>
        
    </div>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/assets/css/chat.min.css">
    <script type="text/javascript">
        var botmanWidget = {
            introMessage: "Hi,I am here to help you navigate! Try Typing something like 'hi' or 'Create' or 'Logout' or 'Blogs'",
            aboutText: 'Ask Ikigai'
        }
    </script>
    <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
</body>
</html>
