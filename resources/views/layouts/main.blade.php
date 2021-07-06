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
    <link rel="stylesheet" href="{{ asset('css/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/toastr-master/build/toastr.min.css') }}">
    <!-- custom stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
    {{-- <link rel="stylesheet" href="{{ mix('css/all.css') }}" /> --}}
    <title>@yield('pageTitle',config('app.name'))</title>

</head>

<body>
    <!-- NAVBAR -->
    <nav class="main-nav">
        <div class="nav-center">
            <div class="nav-header">
                <img src="{{ asset('src/logo.svg') }}" alt="logo" class="logo">
                <button class="nav-toggle"><i class="fas fa-bars"></i></button>
            </div>
            <!-- links left side-->
            <ul class="links links-left">
                <li><a href="{{ url('/') }}" class="active">{{ config('app.name', 'Welcome') }}</a></li>
                @guest
                    <li><a href="{{ url('/') }}#info">Info</a></li>
                    <li><a href="{{ url('/') }}#showcase">{{ __('Books') }}</a></li>
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
                    <li><a href="{{ route('users.show', Auth::user() ) }}">{{ Auth::user()->username }}</a></li>
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            {{ csrf_field() }}
                        </form>
                    </li>
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

    {{-- MODAL --}}
    <div class="hidden flex bg-transparent bg-indigo-500 bg-opacity-50 inset-0 justify-center items-center fixed top-0 left-0 "
        id="overlay">
        <div class="bg-gray-300 max-w-sm py-4 px-5 rounded shadow-2xl text-gray-800">
            <div class="flex justify-between items-center">
                <h4 class="text-lg font-bold" id="deleteModalLabel">
                    {{ __('Confirm delete') }}?
                </h4>
                <!-- *** close "x" -Button, SVG od ev statdessen Font awesome? *** -->
                {{-- <svg class="h-6 w-6 ml-2 cursor-pointer p-1 hover:bg-gray-400 rounded-full" id="close-modal"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg> --}}
                {{-- *** close- Button FA --}}
                <i class="fas fa-window-close h-6 w-6 ml-2 cursor-pointer text-gray-400 hover:text-indigo-900 hover:text-opacity-50"
                    id="close-modal"></i>
                <!-- *** End close- Button *** -->
            </div>
            <div class="mt-2 text-sm">
                <p id="deleteModalBody">
                    {{ __('Are you sure') }}?
                </p>
            </div>
            <div class="mt-3 flex justify-end space-x-3">
                <button
                    class="dismiss-btn px-3 py-1 rounded hover:bg-indigo-900 hover:bg-opacity-50 hover:text-gray-200">
                    Cancel
                </button>
                <button class="delete-btn-modal px-3 py-1 bg-red-800 text-gray-200 hover:bg-red-600 rounded">
                    Delete
                </button>
            </div>
        </div>
    </div>
    {{-- END MODAL --}}

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
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/toastr-master/build/toastr.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- <script src="{{ asset('js/index.js') }}"></script> --}}

    @if (View::hasSection('jsScript'))
        <script>
            "use strict";
            (function($) {
                $(document).ready(function() {
                    @yield('jsScript')
                })
            })(jQuery)
        </script>
    @endif

</body>

</html>
