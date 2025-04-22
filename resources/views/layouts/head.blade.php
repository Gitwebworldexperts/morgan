<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dubai International Real Estate, Luxury Homes/Properties for Sale – Morgan’s International Realty')</title>
    <link rel="icon" type="image/x-icon" href="{{asset('img/favicon.png')}}">
    <link rel="icon" type="image/x-icon" href="{{asset('img/favicon.png')}}">
    
    <meta property="og:image" content="{{asset('img/favicon.png')}}" />
    <meta name="twitter:image" content="{{asset('img/favicon.png')}}" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />


    <!-- CSS -->
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/owl.carousel.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/owl.theme.default.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/lightgallery.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/common.css?ver2')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/responsive.css?ver1')}}" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('headscript')
    
    @if (!View::hasSection('headscript'))
        @php
            $fullUrl = url()->full();
            $baseUrl = url()->current();
            $page = request()->query('page');
        @endphp

        @if ($page && $page != 1)
            <link rel="canonical" href="{{ $fullUrl }}">
        @else
            <link rel="canonical" href="{{ $baseUrl }}">
        @endif
    @endif
    

    @if(request()->has('page') || request()->has('filter'))
        <meta name="robots" content="noindex, follow">
    @else
      <meta name="robots" content="index,follow,noodp,noydir" />
    @endif


    @php
    $footerSection = getFooterSection();
    @endphp
    {!! isset($footerSection->meta_tags) ? $footerSection->meta_tags : ""!!}
    @yield('meta')

     <!--Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-H0L8EQZMHD"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-H0L8EQZMHD');
    </script>
    <meta name="google-site-verification" content="ZdLhyH7_yM8MxGSfrrIQu3sxAh8c1dwoN7A2mvQsBMI" />
    
     <!--Google Tag Manager -->
    <!--<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':-->
    <!--new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],-->
    <!--j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=-->
    <!--'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);-->
    <!--})(window,document,'script','dataLayer','GTM-NTMCLWV');</script>-->
     <!--End Google Tag Manager -->
    
    
       <!-- Meta Pixel Code -->
    <!--<script>-->
    <!--!function(f,b,e,v,n,t,s)-->
    <!--{if(f.fbq)return;n=f.fbq=function(){n.callMethod?-->
    <!--n.callMethod.apply(n,arguments):n.queue.push(arguments)};-->
    <!--if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';-->
    <!--n.queue=[];t=b.createElement(e);t.async=!0;-->
    <!--t.src=v;s=b.getElementsByTagName(e)[0];-->
    <!--s.parentNode.insertBefore(t,s)}(window, document,'script',-->
    <!--'https://connect.facebook.net/en_US/fbevents.js');-->
    <!--fbq('init', '1164815760335008');-->
    <!--fbq('track', 'PageView');-->
    <!--</script>-->
    <!--<noscript><img height="1" width="1" style="display:none"-->
    <!--src="https://www.facebook.com/tr?id=1164815760335008&ev=PageView&noscript=1"-->
    <!--/></noscript>-->
    

    
</head>