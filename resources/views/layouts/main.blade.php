<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- font awesome -->
    {{-- <link rel="stylesheet" href=" {{ asset('css/fontawesome-free/css/all.css') }}"> --}}

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <link rel="stylesheet" href="css/fontawesome-free/css/all.min.css">
    <!-- custom stylesheet -->
    <link rel="stylesheet" href="css/styles.css">
    {{-- <link rel="stylesheet" href="{{ mix('css/all.css') }}" /> --}}
    <title>{{ config('app.name') }}</title>

</head>

<body>
    <!-- NAVBAR -->
    <nav>
        <div class="nav-center">
            <div class="nav-header">
                <img src="src/logo.svg" alt="logo" class="logo">
                <button class="nav-toggle"><i class="fas fa-bars"></i></button>
            </div>
            <!-- links left side-->
            <ul class="links links-left">
                <li><a href="{{ url('/') }}" class="active">{{ config('app.name', 'Welcome') }}</a></li>
                @guest
                    <li><a href="#info">Info</a></li>
                    <li><a href="#">{{ __('Books') }}</a></li>
                @else
                    <!-- Dropdown- Menü: -->
                    <div class="nav-dropdown">
                        <li class=""><a class="dropdown-open">{{ __('Books') }}<i
                                    class="dropbtn fas fa-caret-down"></a></i></li>
                        <div class="nav-dropdown-content">
                            <ul class="links-dropdown">
                                <li><a href="">{{ __('My Books') }}</a></li>
                                <li><a href="useritems.index.html">{{ __('All Titles') }}</a></li>
                            </ul>
                        </div>
                    </div>
                @endguest
            </ul>
            <!-- links rechte Seite -->
            <ul class="links links-right">
                <!-- Searchbar -->
                <li>
                    <div class="search-container">
                        <form action="">
                            <input type="text" placeholder="Suchen..." name="search">
                            <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                </li>
                <!-- <li><a href="dashboard.html">Profil</a></li>
                <li><a href="">Logout</a></li> -->
                @guest
                    <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                @else
                <li><a href="{{ route('users.show') }}">{{ Auth::user()->name }}</a></li>
                <li><a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            {{ csrf_field() }}
                        </form></li>
                @endguest
            </ul>

        </div>
        </div>

        </div>
    </nav>
    <!-- END NAVBAR -->
    {{-- <div class="sm:container sm:mx-auto sm:mt-10 sm:max-w-lg"> --}}

    @yield('content')

    {{-- </div> --}}

    <!-- footer  -->
    <footer>
        <!-- social media -->
        <ul class="social-icons">
            <li><a href="https://twitter.com/"><i class="fab fa-twitter"></i></a></li>
            <li><a href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a></li>
            <li><a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a></li>
            <li><a href="https://www.linkedin.com/"><i class="fab fa-linkedin"></i></a></li>
            <li><a href="https://gitlab.com/fines/xlib"><i class="fab fa-gitlab"></i></a></li>
            <li><a href="https://app.diagrams.net/"><i class="fas fa-project-diagram"></i></a></li>
            <li><a href="#"><i class="fas fa-arrow-up"></i></a></li>
        </ul>

        <!-- <p>&copy fi 2021</p> -->

    </footer>
    <!-- end footer -->

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- <script src="{{ asset('js/index.js') }}"></script> --}}
</body>

</html>
