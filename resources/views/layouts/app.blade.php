<!DOCTYPE html>
<html lang="en">
    @include('layouts.head')
<body>
    @include('layouts.header')    
    @include('layouts.nav')    

    @yield('content')
@include('layouts.footer')
        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.js')}}"></script>
        <script src="{{asset('js/owl.carousel.js')}}"></script>
        <script src="{{asset('js/main.js')}}"></script>

</body></html>

