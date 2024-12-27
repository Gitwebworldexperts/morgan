<!DOCTYPE html>
<html lang="en">
    @include('layouts.head')
<body>
    @include('layouts.header')    
    @include('layouts.nav')    

    @yield('content')
@include('layouts.footer')
        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="{{asset('js/bootstrap.js')}}"></script>
        <script src="{{asset('js/lightgallery.js')}}"></script>
        <script src="{{asset('js/owl.carousel.js')}}"></script>
        <script src="{{asset('js/main.js')}}"></script>
        <script>
        let profile = document.querySelector('.profile');
            let menu = document.querySelector('.profile-dropdown');
            
            profile.onclick = function () {
                menu.classList.toggle('active');
            }
        </script>

@yield('scripts')

</body></html>

