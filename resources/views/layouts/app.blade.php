<!DOCTYPE html>
<html lang="en">
    @include('layouts.head')
<body>
<div id="preloader">
    <div class="spinner"></div>
</div>

    <!-- Google Tag Manager (noscript) -->
    <!--<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NTMCLWV"-->
    <!--height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>-->
    <!-- End Google Tag Manager (noscript) -->
    @include('layouts.header')    
    @include('layouts.nav')    

    @yield('content')
@include('layouts.footer')
        <script src="{{asset('js/jquery.min.js')}}" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous" defer></script>
        <script src="{{asset('js/bootstrap.js?v1')}}" type="text/javascript"></script>
        <script src="{{asset('js/lightgallery.js?v1')}}" type="text/javascript" defer></script>
        <script src="{{asset('js/owl.carousel.js?1')}}" type="text/javascript" ></script>
        <script src="{{asset('js/main.js')}}" type="text/javascript"></script>
        <script>
            let profile = document.querySelector('.profile');
            let menu = document.querySelector('.profile-dropdown');
            
            if (profile && menu) {
                profile.onclick = function () {
                    menu.classList.toggle('active');
                };
            }
        </script>


@yield('scripts')

</body></html>

