<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact " dir="ltr" data-theme="theme-default" data-assets-path="" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title> {{ env('APP_NAME') }} </title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <input type="hidden" id="app_url" value="{{ env('APP_URL') }}">

    <meta name="description" content="Income & Expenses management system" />
    <meta name="keywords" content="Income & Expenses management system">
    <!-- Canonical SEO -->
    <link rel="canonical" href="https://1.envato.market/vuexy_admin">

    <!-- Favicon -->
    <!-- <link rel="icon" type="image/x-icon" href="https://demos.pixinvent.com/vuexy-html-admin-template/assets/img/favicon/favicon.ico" /> -->

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;ampdisplay=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="{{ url('portal/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ url('portal/vendor/fonts/tabler-icons.css') }}"/>
    <link rel="stylesheet" href="{{ url('portal/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ url('portal/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ url('portal/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ url('portal/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ url('portal/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ url('portal/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ url('portal/vendor/libs/typeahead-js/typeahead.css') }}" /> 
    <link rel="stylesheet" href="{{ url('portal/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ url('portal/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
    <link rel="stylesheet" href="{{ url('portal/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css') }}" />
    <link rel="stylesheet" href="{{ url('portal/vendor/libs/pickr/pickr-themes.css') }}" />
    
    <link rel="stylesheet" href="{{ url('portal/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ url('portal/vendor/libs/swiper/swiper.css') }}" />
    <link rel="stylesheet" href="{{ url('portal/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ url('portal/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ url('portal/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ url('portal/vendor/libs/select2/select2.css') }}" />

    <link rel="stylesheet" href="{{ url('portal/vendor/libs/bs-stepper/bs-stepper.css') }}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ url('portal/vendor/css/pages/cards-advance.css') }}" />

    <link rel="stylesheet" href="{{ url('portal/vendor/libs/form-validation/form-validation.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('custom/smart-search/jquery-ui.min.css') }}">

    <link rel="stylesheet" href="{{ url('portal/vendor/css/pages/app-invoice.css') }}">

    <!-- Helpers -->
    <script src="{{ url('portal/vendor/js/helpers.js') }}"></script>
    <script src="{{ url('portal/js/config.js') }}"></script>
</head>

    <body>
        <div class="layout-wrapper layout-content-navbar  ">
            <div class="layout-container">
                <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                    <div class="app-brand demo ">
                        <a href="{{ url('home') }}" class="app-brand-link">
                            <span class="app-brand-text demo menu-text fw-bold"> {{ env('APP_NAME') }} </span>
                        </a>

                        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
                            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
                        </a>
                    </div>

                    <div class="menu-inner-shadow"></div>

                    <ul class="menu-inner py-1">
                        <li class="menu-item active">
                            <a href="{{ url('home') }}" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                                <div data-i18n="Home"> Home </div>
                            </a>
                        </li>

                        <li class="menu-item">
                            <a href="{{ url('user-clothes') }}" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-components"></i>
                                <div data-i18n="Clothes"> Clothes </div>
                            </a>
                        </li>

                        <li class="menu-item">
                            <a href="{{ url('user-cloth-types') }}" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-components"></i>
                                <div data-i18n="Cloth Types"> Cloth Types </div>
                            </a>
                        </li>
                    </ul>
                </aside>

                <div class="layout-page">
                    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0   d-xl-none ">
                            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                                <i class="ti ti-menu-2 ti-sm"></i>
                            </a>
                        </div>

                        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

                            @php
                                $time = date("H");
                                $timezone = date("e");

                                /* If the time is less than 1200 hours, show good morning */
                                if($time < "12") {
                                    $greetings = "Good morning";
                                }else

                                /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
                                if($time >= "12" && $time < "16") {
                                    $greetings = "Good afternoon";
                                }else

                                /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
                                if($time >= "16") {
                                    $greetings = "Good evening";
                                }
                            @endphp

                            <div class="navbar-nav align-items-center">
                                <div class="nav-item navbar-search-wrapper mb-0"> {{ $greetings.' '.Auth::user()->username }} </div>
                            </div>

                            <ul class="navbar-nav flex-row align-items-center ms-auto">
                                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                        <div class="avatar avatar-online">
                                            <img src="{{ url('portal/img/user.png') }}" alt class="h-auto rounded-circle">
                                        </div>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="pages-account-settings-account.html">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar avatar-online">
                                                            <img src="{{ url('portal/img/user.png') }}" alt class="h-auto rounded-circle">
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <span class="fw-medium d-block"> {{ Auth::user()->username }} </span>

                                                        <small class="text-muted"> {{ Auth::user()->email }} </small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>

                                        <li> <div class="dropdown-divider"></div> </li>

                                        <li>
                                            <a href="{{ Auth::id() }}" username="{{ Auth::user()->username }}" phone="{{ Auth::user()->phone }}" email="{{ Auth::user()->email }}" class="edit-user dropdown-item">
                                                <i class="ti ti-user-check me-2 ti-sm"></i>
                                                <span class="align-middle"> My Profile </span>
                                            </a>
                                        </li>   

                                        <li>
                                            <a href="{{ Auth::id() }}" class="dropdown-item reset-password">
                                                <i class="ti ti-settings me-2 ti-sm"></i>
                                                <span class="align-middle"> Passowrd </span>
                                            </a>
                                        </li>
                                        
                                        <li>
                                            <a class="dropdown-item" href="{{ url('logout') }}">
                                                <i class="ti ti-logout me-2 ti-sm"></i>
                                                <span class="align-middle"> Log Out </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>