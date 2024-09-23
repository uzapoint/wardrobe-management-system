<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('asset1/img/favFA.png') }}">
    @yield('title')
    <link rel="stylesheet" type="text/css" href="{{ asset('asset1/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset1/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset1/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset1/css/style.css') }}">
    <link href="{{ asset('asset1/fonts/css/font-awesome.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('select2/select2-bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('select2/select2-bootstrap.min.css') }}">
    <link href="{{asset('assets/plugins/toggle-sidebar/sidemenu.css')}}" rel="stylesheet">
    

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
</head>

<body>
    <div class="main-wrapper">
        <div style="background-color:#FF780F;"class="header">
            <div class="header-left">
                <a href="#" class="logo">
                    <img src="{{ asset('asset1/img/favFA.png') }}" width="40" height="40" alt="">
                    <span>Wardrobe Management</span>
                </a>
            </div>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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

        @yield('content')
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="{{ asset('asset1/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('asset1/js/popper.min.js') }}"></script>
    <script src="{{ asset('asset1/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('asset1/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('asset1/js/select2.min.js') }}"></script>
    <script src="{{ asset('asset1/js/moment.min.js') }}"></script>
    <script src="{{ asset('asset1/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('asset1/js/app.js') }}"></script>
    <script src="{{ asset('asset1/js/Chart.bundle.js') }}"></script>
    <script src="{{ asset('asset1/js/chart.js') }}"></script>
    <script>
        $(".dropdown").select2({
            theme: "bootstrap"
        });
    </script>
    
</body>

</html>
