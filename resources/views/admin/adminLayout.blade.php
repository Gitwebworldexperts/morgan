<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel')</title>
    <link rel="icon" type="image/x-icon" href="{{asset('img/favicon.png')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <!-- CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.6/css/dataTables.bootstrap5.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <link href="{{asset('css/admin.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark left_sidebar">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="{{ route('home') }}" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="bg-light custom_logo d-sm-inline"><img style="max-width: 100%" src="{{asset('img/logo.svg')}}"></span>
                </a>
                <ul class="nav nav-pills flex-column w-100 mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item hav_child w-100">
                        <span  class="nav-link align-middle px-0">
                            <i class="fa-solid fa-thumbtack"></i> <span class="ms-1 d-none d-sm-inline">Pages</span>
                        </span>
                        <ul class="remove_bullets ">
                            <li class="nav-item">
                                <a href="{{ url('/admin/home') }}" class="nav-link align-middle px-0">
                                    <span class="ms-1 d-none d-sm-inline">Home</span>
                                </a>    
                            </li>
                        </ul>
                    </li>                    
                    <li class="nav-item hav_child w-100">
                        <a href="{{ route('properties.index') }}" class="nav-link align-middle px-0">
                            <i class="fa-regular fa-building"></i> <span class="ms-1 d-none d-sm-inline">Properties</span>
                        </a>
                        <ul class="remove_bullets ">
                            <li class="nav-item">
                                <a href="{{ route('private_properties.index') }}" class="@if (request()->is('private-properties*') || Route::is('private_properties.index')) active_nav @endif nav-link align-middle px-0">
                                    <span class="ms-1 d-none d-sm-inline">Private</span>
                                </a>    
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('international_properties.index') }}" class="@if (request()->is('international_properties*') || Route::is('international_properties.index')) active_nav @endif nav-link align-middle px-0">
                                    <span class="ms-1 d-none d-sm-inline">International</span>
                                </a>    
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('project_properties.index') }}" class="@if (request()->is('project_properties*') || Route::is('project_properties.index')) active_nav @endif nav-link align-middle px-0">
                                    <span class="ms-1 d-none d-sm-inline">Devlopment/Project</span>
                                </a>    
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('rent_properties.index') }}" class="@if (request()->is('rent_properties*') || Route::is('rent_properties.index')) active_nav @endif nav-link align-middle px-0">
                                    <span class="ms-1 d-none d-sm-inline">Rent</span>
                                </a>    
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('buy_properties.index') }}" class="@if (request()->is('buy_properties*') || Route::is('buy_properties.index')) active_nav @endif nav-link align-middle px-0">
                                    <span class="ms-1 d-none d-sm-inline">Buy</span>
                                </a>    
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('faq.index') }}" class="@if (request()->is('faq*') || Route::is('faq.index')) active_nav @endif nav-link align-middle px-0">
                            <i class="fa-solid fa-circle-question"></i> <span class="ms-1 d-none d-sm-inline">Faq</span>
                        </a>
                    </li>
                   
                </ul>
                <hr>
                <div class="dropdown pb-4">
                    @if (Auth::check())
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{asset('img/user.svg')}}" alt="hugenerd" width="30" height="30" class="rounded-circle">
                        <span class="d-none d-sm-inline mx-1 self_captilize">{{ Auth::user()->name }}</span>
                    </a>
                    @endif
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        <!-- <li><a class="dropdown-item" href="{{ route('settings') }}">Settings</a></li> -->
                        <li><a class="dropdown-item" href="{{ route('settings') }}"><i class="fa-solid fa-gear"></i> Settings</a></li>
                        <!-- <li><a class="dropdown-item" href="#">Profile</a></li> -->
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col offset-md-3 offset-xl-2 py-3" id="header_right_block">
            <div class="p-3 admin_block_wrraper">
            @yield('content')
            </div>
        </div>
    </div>
</div>


 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@yield('scripts')
</body>
</html>

