<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base" content="comments">
    <meta name="description" content="Bulletin Board Web App">
    <meta name="base" content="/">
    <title>Bulletin Board</title>
    <link rel="icon" href="/favicon.png">
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/fa/css/fa.min.css') }}"/>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Bulletin Board') }}
        </a>
        <ul class="navbar-nav ml-auto">
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
            @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <img src="{{ asset(Auth::user()->image ? Auth::user()->image : '/up/users/avatar.jpg') }}" width="25px" style="border-radius:50%" />
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('home') }}">Cabinet</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @endguest
        </ul>
    </div>
</nav>
<main role="main">
    <div class="welcome-area">
        <div class="container">
            <a href="{{ asset('/') }}" style="color:#333;text-decoration: none"><h3 class="display-5">Bulletin Board</h3></a>
            <p style="max-width: 700px;">The bottom line is that only a small percentage of developers know how to design a truly object oriented system. The solution to this problem is getting harder every day as the aggressive nature of the software industry does not support an easy adjustment to existing processes, and also the related online teaching materials are either complex, or less practical, or sometimes even wrong.</p>
            <p><a class="btn btn-danger btn-sm" href="{{ route('adCreate') }}" role="button">Post Ad &raquo;</a>
                <span class="text-info font-weight-bold">{{ Auth::check() ? '' : 'Registration Needed' }}</span></p>
        </div>
    </div>
@yield('content')
</main>
<hr/>
<footer class="container">
    <p>&copy; Acme Corporation <script>document.write(new Date().getFullYear())</script></p>
</footer>
<script src="{{ asset('js/comments.js') }}"></script>
<script src="{{ asset('js/rating.js') }}"></script>
</body>
</html>























