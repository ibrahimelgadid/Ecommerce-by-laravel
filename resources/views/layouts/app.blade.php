<!DOCTYPE html>
<html dir="{{app()->getLocale()==='ar' ? 'rtl' : 'ltr'}}" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    {{-- @if(app()->getLocale() === 'ar')
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    @else --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- @endif --}}
    <link href="{{ asset('css/fonts/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.fancybox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dropzone.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/css.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-sm navbar-dark sticky-top bg-dark navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ __('navbar.market')}}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="{{app()->getLocale()==='ar' ? 'navbar-nav ml-auto':'navbar-nav mr-auto'}}">

                        @auth
                        <li class="nav-item">
                            <a class="{{Request::is('myorders') ? "nav-link active":'nav-link'}}" href="/myorders">{{__('navbar.orders')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class='{{Request::is('profile') ? "nav-link active":'nav-link'}}' href="/profile/{{ Auth::user()->id }}">{{__('navbar.profile')}}</a>
                        </li>
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="{{app()->getLocale()==='ar' ?'navbar-nav mr-auto':'navbar-nav ml-auto'}}">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('navbar.login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('navbar.register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                            <a class='{{Request::is('cart') ? "nav-link active":'nav-link'}}' href="/cart">{{__('navbar.cart')}}<span class="badge badge-danger">{{Cart::count()}}<span></a>
                                </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                        {{ __('navbar.logout') }}
                                    </a>

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

        <main class="{{Request::is('/') ? '':'py-4'}}" >
            @if (Request::is('/'))
                @include('inc.slider')
            @endif

            <div class='text-center'>
                <a class='d-inline'  href="{{ url('locale/en') }}">English</a>
                <a class='d-inline'  href="{{ url('locale/ar') }}">عربى</a>
            </div>

            <div class="container">
                @include('inc.message')
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Scripts -->
    {{-- @if(app()->getLocale() === 'ar')
        <script src="js/bootstrap.min.js"  ></script>
    @else --}}
        <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- @endif --}}
    <script src="{{ asset('js/dropzone.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery.fancybox.min.js') }}" defer></script>
    <script src="{{ asset('js/js.js') }}" defer></script>
</body>
</html>
