@php
$footerSection = getFooterSection();

$whatsapp = $footerSection->phone;
$copy = $footerSection->copyright;
@endphp


<!DOCTYPE html>
<html lang="zxx">
    <head>
        <title>{{ $report->meta_title }}</title>
        <meta property="og:title" content="{{ $report->meta_title }}" />
        <meta property="og:description" content="{{ strip_tags($report->meta_title) }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" type="image/x-icon" href="{{ asset(siteLogo()) }}" />
        <meta charset="utf-8" />
        <meta name="keywords" content="" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link href="{{ asset('css/indireport/bootstrap.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/indireport/owl.theme.default.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/indireport/owl.carousel.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/indireport/common.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link href="{{ asset('css/indireport/responsive.css') }}" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="whatsapp-float">
            <a href="'https://api.whatsapp.com/send?phone='.$whatsapp" target="_blank" class="whatsapp-btn">
                <img src="{{ asset('img/indireport/whatsapp.svg') }}" class="" />
            </a>
        </div>
        <!-- header -->
        <header class="header js-header">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <!-- logo -->
                    <div class="logo-web">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <div class="logo-box">
                                <img src="{{ asset(siteLogo()) }}" alt="Site Logo">
                            </div>
                        </a>
                    </div>
                    <div class="right-head">
                        <!-- Navbar -->
                        <div class="schedule-call">
                        <button class="btn green-btn" onclick="copyPageUrl()">
                            <img src="{{ asset('img/indireport/share.png') }}" />
                        </button>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <!-- banner -->
        <section class="banner" style="background-image: url('{{ asset($report->background_image) }}');">
            <div class="slider-info banner-bg">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="bannerContent">
                                <p>{{ $report->subheading }}</p>
                                <h1>{{ $report->heading }}</h1>
                                @if($report->file_upload)
                                <a class="sib-form-block__button sib-form-block__button-with-loader" href="{{ asset($report->file_upload) }}" ><img src="{{ asset('img/indireport/download.svg') }}"> Download the Catalogue</a>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- <div class="ContentSecionImage">
                                <img src="{{ asset('img/indireport/about.png') }}" class="img-fluid" />
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="space ContentSecion">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-12">
                          
                        <span class="m-0">
                            {!!  $report->description !!}
                        </span>
                    </div>
                </div>
            </div>
        </section>
        <section class="accordionSection accordionSection2">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-6 col-lg-5">
                          <div class="ContentSecionImage">
                                <img src="{{ asset($report->section_ii_background_image) }}" class="img-fluid" />
                            </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                 <div class="mediaHeading">
                           <h3>{{ $report->section2_heading }}</h3>
                        </div>
                <div class="panel-group row" id="accordion">
                    
                    @php 
                    $faq = json_decode($report->section2_content,true);
                    @endphp
                    @if(isset($faq) && !empty($faq))
                    @foreach($faq['question'] as $key => $question)
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion{{ $key }}" class="collapsed" href="#collapse11{{ $key }}"> {{ $question }}</a>
                                </h4>
                            </div>
                            <div id="collapse11{{ $key }}" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <p>
                                        {{ isset($faq['answer'][$key]) ? $faq['answer'][$key] :  "" }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif

                </div>
                </div>
                </div>
            </div>
        </section>

        <section class="mediaSection">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mediaHeading">
                            <h3>Media Mentions</h3>
                        </div>
                        {!! reportmediaSection(); !!}
                    </div>
                </div>
            </div>
        </section>

        <section class="opportunities">
            <div class="container">
                <div class="row">

                     <div class="col-md-12">
                            <div class="FormBox p-0 mw-100">
                                <div class="mediaHeading">
                           <h3>Leverage the opportunities.</h3>
                        </div>
                               {!! $report->html_code !!}  
                               
                            </div>
                        </div>
                    

                </div>
            </div>
        </section>
        <section class="ViewsSection">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                            <div class="mediaHeading">
                          <h3>{{ $report->section3_heading }}</h3>
                        </div>
                        @if(isset($testimonials) && !empty($testimonials))               
                            <div class="ViewsSlider owl-carousel" id="Testimonial">
                                @foreach($testimonials as $item)
                                <div class="ViewsSlideritems">
                                {!! $item->detail !!}    
                                

                                    <h4>{{ $item->name }}</h4>
                                    <p>{{ $item->location }}</p>
                                </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @if($report->seo_heading && $report->seo_description)
        <section class="accordionSection">
            <div class="container">
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" class="collapsed" href="#collapse1">{{ $report->seo_heading }}</a>
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                {!! $report->seo_description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
        <!-- footer -->
        <footer class="footer">
            <div class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="copy-cont text-center">
                                {!! $copy !!}
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="footerIcons">
                            <ul>
                                        @if(isset($footerSection->social_media_links) && !empty($footerSection->social_media_links))
                                        @php
                                                    $footerSections = json_decode($footerSection->social_media_links, true);
                                                    $footerSections = $footerSections ?? [];

                                        @endphp
                                        @foreach($footerSections as $key => $item)
                                            <li><a href="{{$key}}">{!! $item !!}</a></li>    
                                        @endforeach
                                        @endif
                                    </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <script src="{{ asset('js/indireport/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('js/indireport/bootstrap.js') }}"></script>
        <script src="{{ asset('js/indireport/owl.carousel.js') }}"></script>
        <script src="{{ asset('js/indireport/wow.js') }}"></script>
        <script src="{{ asset('js/indireport/main.js') }}"></script>
        <style>
            .footerIcons i {
                color: #fff;
            }
            .bannerContent .sib-form-block__button {
                padding: 16px 30px;
                display: inline-block;
            }
        </style>
        <script>
              
        $('.program-sidebar .nav-tabs li a').click( function(){
            if ( $(this).hasClass('active') ) {
                $(this).removeClass('active');
            } else {
                $('.program-sidebar .nav-tabs li a.active').removeClass('active');
                $(this).addClass('active');    
            }
        });


        var owl = $("#Brands");
        owl.owlCarousel({
            margin: 20,
            items: 5,
            dots: false,
            autoplay: true,
            loop: true,
            nav: true,
            autoHeight: true,
            responsive: {
                0: {
                    dots: false,
                    items: 3,
                },
                600: {
                    dots: false,
                    items: 3,
                },
                1000: {
                    dots: false,
                    items: 5,
                },
            },
        });


        $(window).scroll(function() {
                var scroll = $(window).scrollTop();
                if (scroll >= 300) {
                    $("header").addClass("darkHeader");
                } else {
                    $("header").removeClass("darkHeader");
                }
                });
                
                
                $(window).scroll(function() {
                var scrollDeep = $(window).scrollTop();
                if (scrollDeep >= 500) {
                $("header").addClass("darkHeader-2");
                } else {
                $("header").removeClass("darkHeader-2");
                }
                });

                
            


                var owl = $('#Testimonial');
                        owl.owlCarousel({
                        margin: 0,
                    items:1,
                        dots:true,
                        loop: true,
                    nav:true,
                    autoHeight: true,
                    navText : ["<img src='{{ asset('img/indireport/left.png')}}'>","<img src='{{ asset('img/indireport/right.png')}}'>"],
                        responsive: {
                            0: {
                            dots:true,
                            items: 1
                            },
                            600: {
                            dots:true,
                            items: 1
                            },
                            1000: {
                            dots:true,
                            items: 1
                            }
                        }
                        });			
                        
                        
        new WOW().init();

                        
        </script>
        <script>
    function copyPageUrl() {
        // Copy the current page URL to the clipboard
        navigator.clipboard.writeText(window.location.href).then(() => {
            alert('Page URL copied to clipboard!');
        }).catch(err => {
            console.error('Failed to copy URL:', err);
        });
    }
</script>
    </body>
</html>
