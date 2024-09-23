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
</head>
<body>
<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark left_sidebar">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="bg-light custom_logo d-sm-inline"><img style="max-width: 100%" src="{{asset('img/logo.svg')}}"></span>
                </a>
                <ul class="nav nav-pills flex-column w-100 mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item hav_child w-100">
                        <span  class="nav-link align-middle px-0">
                            <i class="fa-solid fa-thumbtack"></i> <span class="ms-1 d-none d-sm-inline">Pages</span>
                        </span>
                        <ul class="remove_bullets ">
                            <li class="nav-item">
                                <a href="{{ route('home') }}" class="nav-link align-middle px-0">
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
<style>
    span.custom_logo {
    padding: 7px 10px;
    border-radius: 5px;
    margin-top: 12px;
}
.left_sidebar .nav-link{
    color: #fff;
}
.self_captilize{
    text-transform: capitalize;
}
.admin_block_wrraper {
    background: #3b352724;
    border-radius: 4px;
    box-shadow: 0 0 7px 0 #0000004d;
}
.heading_for_admin_section {
    border-bottom: 1px dashed #00000047;
}
.remove-row {
    cursor: pointer;
/*    margin-left: 10px;*/
    color: red;
}
button.clone_button {
    padding: 0;
    line-height: 0;
    border: 0;
    position: absolute;
    right: 10px;
    bottom: 5px;
}
button.clone_button i {
    font-size: 28px;
    color: #212529;
}
.section_content {
    position: relative;
}
.pr{
    position: relative; 
}
.text-danger.backend_error {
    font-size: 12px;
}
img.uploaded_logo {
    width: 155px;
    display: block;
    border-radius: 4px;
    margin-bottom: 12px;
}
.ui-state-highlight {
    height: 2.5em;
    background: #f0f0f0;
    border: 1px dashed #ddd;
}
.remove-row {
    cursor: pointer;
}
img.small_icon {
    background: #212529;
    color: #fff;
    padding: 5px 5px;
    border-radius: 3px;
    box-shadow: 0px 0px 4px 0 #00000073;
}
.left_sidebar .nav-link{
    line-height: 1;
}
a.nav-link:hover{
    color: #d9b592;
}
.text-right {
    text-align: right !important;
}
span.trash_button {
    margin-right: 7px;
}
.custom_clone_button.clone_button {
    bottom: 35px;
    right: 55px;
}
span.trash_button {
    margin-right: 7px;
    transition: all .3s;
    filter: drop-shadow(0px 2px 1px #757575);
}
span.trash_button:hover, span.trash_button:active, span.trash_button:focus {
    filter: drop-shadow(0 0 0 black);
    transition: all .3s;
}

a.add_new_button {
    color: #664d03;
    text-decoration: none;
    font-size: 14px;
    background: #fff;
    padding: 5px 10px;
    border-radius: 3px;
    LINE-HEIGHT: 1;
    box-shadow: 3px 3px 6px 0 rgb(0 0 0 / 20%);
    font-weight: 500;
    FLOAT: right;
    margin-right: 25px;
    margin-left: 10px !important;
}
a.faq_edit_button,button.faq_delete_button,span.linked_page_title,a.edit_button {
    color: #000;
    text-decoration: none;
    box-shadow: 2px 2px 2px 0 rgb(0 0 0 / 34%);
    font-size: 12px;
    font-weight: 500;
    padding: 2px 7px;
    border-radius: 2px;
    display: inline-block;
    margin-left: auto;
    border: 1px solid rgb(117 117 117 / 22%);
}
button.faq_delete_button {
/*    border: 0;*/
margin-left: auto;
    background: red;
    color: #fff;
}
.custom_accordian_body {
    box-shadow: inset 0 0 10px 0 rgb(0 0 0 / 22%);
}
span.linked_page_title {
    background: #ffd400;
    color: #000;
    margin-left: 10px;
}
.faq_edit_button {
    position: relative; /* or absolute, depending on your layout */
    z-index: 10; /* or higher */
}
form.faq_delete_form {
    margin-left: auto;
}
h2.accordion-header {
    position: relative;
}
a.faq_edit_button {
    position: absolute;
    right: 60px;
    top: 17px;
}
span.tooltiptext {
    opacity: 0;
    display: none;
}
.custom_tooltip .trigger_part {
    font-size: 12px;
    font-family: cursive;
    background: #86b7fe;
    height: 15px;
    width: 15px;
    display: inline-block;
    padding: 1px 5.5px;
    line-height: 1;
    border-radius: 50%;
    padding-top: 2px;
    font-weight: bold;
    box-shadow: 0 0 0px 2px #fff;
}
.custom_tooltip {
    display: inline-block;
    position: relative;
}
.custom_tooltip:hover .tooltiptext {
    display: block;
    opacity: 1;
    position: absolute;
    z-index: 9;
    background: #212529;
    color: #fff;
    font-size: 12px;
    padding: 2px 11px;
    top: 3px;
    left: 15px;
    width: 150px;
    border-radius: 2px;
    box-shadow: 0 0 2px 0px #00000052;
}
span.tooltiptext a {
    color: #fff;
    font-weight: 200;
}
.left_sidebar {
    position: fixed;
}
ul.remove_bullets {
    list-style: none;
    padding-left: 0;
    background: #000;
    margin-left: 15px;
    width: calc(100% - 15px) !important;
    padding: 0 3px;
    border-radius: 3px;
}
ul.remove_bullets li {
    border-bottom: 1px solid;
}
ul.remove_bullets li:last-child {
    border: 0;
}
.img-thumbnail {
    max-height: 150px;
}
div#image-preview {
    display: flex;
    flex-wrap: wrap;
}
div#image-preview img {
    width: calc(20% - 10px);
    margin: 5px 5px;
}
form#image-upload-form .form-group {
    margin-top: 10px;
}
span.mandatory {
    font-size: 11px;
    line-height: 1;
    position: relative;
    top: -4px;
    color: red;
}
.current-banners .banner > img {
    width: 100%;
    border: 3px solid #fff;
    padding: 3px;
    max-height: 150px;
}
button.x-delete {
    border: 0;
    font-size: 12px;
    line-height: 1;
    height: 20px;
    width: 20px;
    padding: 5px;
    color: red;
    position: absolute;
    top: 0;
    right: 12px;
}
ul.remove_bullets li a {
    text-overflow: ellipsis;
    overflow: hidden;
}
span.text-captilized {
    text-transform: capitalize;
}
span.help_url a {
    font-size: 12px;
/*    text-decoration: none;*/
    color: #df9000;
}
a.active_nav.nav-link.align-middle.px-0 {
    background: #fff;
    border-radius: 0;
    color: #442d16;
    font-weight: 700;
    box-shadow: inset 0 0 5px 0 #000000a6;
}
.image-preview img {
    width: 150px;
    border: 2px solid #fff;
    border-radius: 1px;
    box-shadow: 3px 2px 5px 0 #00000061;
    margin-top: 10px;
}
.image-upload {
/*    margin: 20px;*/
    border: 1px dashed #ccc;
    padding: 10px;
    display: inline-block;
    text-align: center;
}
.section_breaker::after {
    content: "";
    background: #777777;
    width: 100%;
    height: 1px;
    position: absolute;
    left: 0;
    top: 11.5px;
}
.section_name {
    background: #e3e2e1;
    position: relative;
    z-index: 1;
    padding-right: 12px;
    font-size: 14px;
    display: inline-block;
}
label.section_name input[type="checkbox"] {
    position: relative;
    top: 1px;
}
.section_breaker {
    display: flex;
}
span.end_section_name {
    background: #e3e2e1;
    margin-left: auto;
    position: relative;
    font-size: 14px;
    z-index: 1;
    padding-left: 9px;
}
span.end_section_name {
    background: #e3e2e1;
    margin-left: auto;
    position: relative;
    font-size: 14px;
    z-index: 1;
    padding: 0 9px;
    border: 1px solid #777777;
}
.row-container-section {
    margin: 10px 15px;
}
img.uploaded_logo {
    opacity: .7;
    border-color: #660000;
}
</style>


 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@yield('scripts')
</body>
</html>

