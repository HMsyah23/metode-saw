<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">    
    <meta name="msapplication-tap-highlight" content="no">
    <link href="{{asset('css/main.css')}}" rel="stylesheet">
    <link href="{{asset('assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css')}}" rel="stylesheet">
    <link href="{{asset('assets/pe-icon-7-stroke/css/helper.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
</head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <div class="logo-src"><img src="{{asset('assets/images/logo-inverse.png')}}" alt=""></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>    <div class="app-header__content">
                <div class="app-header-left">
                    {{-- <div class="search-wrapper">
                        <div class="input-holder">
                            <input type="text" class="search-input" placeholder="Type to search">
                            <button class="search-icon"><span></span></button>
                        </div>
                        <button class="close"></button>
                    </div> --}}
                </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                            <img width="42" class="rounded-circle" src="{{asset('assets/images/avatars/1.jpg')}}" alt="">
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                            {{-- <button type="button" tabindex="0" class="dropdown-item">User Account</button>
                                            <button type="button" tabindex="0" class="dropdown-item">Settings</button>
                                            <h6 tabindex="-1" class="dropdown-header">Header</h6>
                                            <button type="button" tabindex="0" class="dropdown-item">Actions</button>
                                            <div tabindex="-1" class="dropdown-divider"></div> --}}
                                            <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                        {{Auth::user()->nama}}
                                    </div>
                                    <div class="widget-subheading">
                                        @if (Auth::user()->role == 0)
                                            Pimpinan
                                        @else
                                            Staf
                                        @endif
                                    </div>
                                </div>
                                {{-- <div class="widget-content-right header-user-info ml-3">
                                    <button type="button" class="btn-shadow p-1 btn btn-primary btn-sm show-toastr-example">
                                        <i class="fa text-white fa-calendar pr-1 pl-1"></i>
                                    </button>
                                </div> --}}
                            </div>
                        </div>
                    </div>        </div>
            </div>
        </div>           
        <div class="app-main">
                <div class="app-sidebar sidebar-shadow">
                    <div class="app-header__logo">
                        <div class="logo-src"></div>
                        <div class="header__pane ml-auto">
                            <div>
                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="app-header__mobile-menu">
                        <div>
                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="app-header__menu">
                        <span>
                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
                    </div>    <div class="scrollbar-sidebar">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                <li class="app-sidebar__heading">SPK</li>
                                <li>
                                    <a href="{{route('home')}}" class="{{ Request::routeIs('home') ? 'mm-active' : '' }}">
                                        <i class="metismenu-icon pe-7s-home"></i>
                                        Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('siswa.index')}}" class="{{ Request::routeIs('siswa.index') ? 'mm-active' : '' }} {{ Request::routeIs('siswa.show') ? 'mm-active' : '' }}">
                                        <i class="metismenu-icon pe-7s-users"></i>
                                        Data Siswa
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="{{ Request::Is('kriteria') ? 'mm-active' : '' }} {{ Request::Is('subkriteria') ? 'mm-active' : '' }}">
                                        <i class="metismenu-icon pe-7s-science"></i>
                                        Kriteria
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="{{route('kriteria.index')}}" class="{{ Request::Is('kriteria') ? 'mm-active' : '' }}">
                                                <i class="metismenu-icon">
                                                </i>Kriteria
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('subkriteria.index')}}" class="{{ Request::Is('subkriteria') ? 'mm-active' : '' }}">
                                                <i class="metismenu-icon">
                                                </i>Sub Kriteria
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#" class="{{ Request::routeIs('ranking.index') ? 'mm-active' : '' }} {{ Request::routeIs('ranking.saw') ? 'mm-active' : '' }}">
                                        <i class="metismenu-icon pe-7s-display1"></i>
                                        Perankingan
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="{{route('ranking.index')}}" class="{{ Request::routeIs('ranking.index') ? 'mm-active' : '' }}">
                                                <i class="metismenu-icon">
                                                </i>Ranking Calon Siswa
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('ranking.saw')}}" class="{{ Request::routeIs('ranking.saw') ? 'mm-active' : '' }}">
                                                <i class="metismenu-icon">
                                                </i>Perhitungan SAW
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                @if(Auth::user()->role == 0)
                                <li  >
                                    <a href="{{route('user')}}" class="{{ Request::routeIs('user') ? 'mm-active' : '' }}">
                                        <i class="metismenu-icon pe-7s-user"></i>
                                        Data Pengguna
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>    
                <div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                        <i class="{{$icon ?? ''}} icon-gradient bg-mean-fruit">
                                        </i>
                                    </div>
                                    <div>{{$title ?? ''}}<div class="page-title-subheading">{{$keterangan ?? ''}}</div>
                                    </div>
                                </div>
                                <div class="page-title-actions">
                                    @yield('tombol')
                                </div>    
                            </div>
                        </div>      
                        @if(session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show fade show" role="alert">
                                {{ session()->get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                            </div>
                        @endif
                        @if(session()->has('error'))
                            <div class="alert alert-danger alert-dismissible fade show fade show" role="alert">
                                {{ session()->get('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if (count($errors) > 0)
                            <div class="alert alert-danger alert-dismissible fade show fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>    
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div> 
                        @endif     
                        @yield('content')
                    </div>
                    
                    <div class="app-wrapper-footer">
                        <div class="app-footer">
                            <div class="app-footer__inner">
                                <div class="app-footer-left">
                                    <ul class="nav">
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                SD Negeri 004 Sanggata Utara
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>
                <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
<script type="text/javascript" src="{{asset('assets/scripts/main.js')}}"></script></body>
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

@stack('js')
</html>

@yield('modal')