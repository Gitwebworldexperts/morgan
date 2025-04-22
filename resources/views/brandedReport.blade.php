@php
$footerSection = getFooterSection();
$whatsapp = $report->whatsapp_number;
$copy = $footerSection->copyright;
@endphp

<!DOCTYPE html>
<html lang="en">
    <head>
    <title>{{ $report->meta_title }}</title>
        <meta property="og:title" content="{{ $report->meta_title }}" />
        <meta property="og:description" content="{{ strip_tags($report->meta_title) }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" type="image/x-icon" href="{{ asset(siteLogo()) }}" />
        <meta charset="utf-8" />
        <meta name="keywords" content="" /> 
        <meta name="title" content="Dubai’s Branded Residences Report – H1 2024">
        <meta description="{{ $report->meta_description }}" />
        <link href="{{ asset('css/indireport/bootstrap.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/branded/common.css?v1') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/branded/responsive.css') }}" rel="stylesheet" type="text/css" /> 
       
        <link rel="canonical" href="{{ url()->current() }}">

       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />       
         <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-H0L8EQZMHD"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-H0L8EQZMHD');
    </script>
    <meta name="google-site-verification" content="ZdLhyH7_yM8MxGSfrrIQu3sxAh8c1dwoN7A2mvQsBMI" />
    
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NTMCLWV');</script>
    <!-- End Google Tag Manager -->
    
    
       <!-- Meta Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '1164815760335008');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=1164815760335008&ev=PageView&noscript=1"
    /></noscript>
    </head>
    <body>
	<!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NTMCLWV"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    
    @if($whatsapp)
      <div class="whatsapp-float">    
          <a href="https://api.whatsapp.com/send?phone={{ $whatsapp }}" target="_blank" class="whatsapp-btn">
              <img src="{{ asset('img/indireport/whatsapp.svg') }}" class="" />
          </a>
      </div>
    @endif
		
        <!-- header -->
        <header class="header js-header">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <!-- logo -->
                    <div class="logo-web">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <div class="logo-box">
                                <img src="{{ asset($footerSection->logo_url) }}" alt="Site Logo">
                            </div>
                        </a>
                    </div>
                    <div class="right-head">
                        <!-- Navbar -->
                        <div class="schedule-call">
                            <button class="btn green-btn" onclick="copyToClipboard()">
                                <img src="{{ asset('img/share.png') }}">
                            </button>
                            <input style="display:none;" type="text" value="{{  url()->full() }}" id="myInput">
                        </div>
                        <div class="notification" id="copyNotification">Text copied to clipboard!</div>
                    </div>
                </nav>
            </div>
        </header>
        <!-- banner -->
        <section class="banner" style="background-image: url('{{ asset($report->background_image) }}');">
            <div class="slider-info banner-bg">
                <div class="container">
                    <div class="bannerContent">
                        <h1>{{ $report->heading }}</h1>
                        <p>{{ $report->subheading }}</p>
                         <a class="btn green-btn" href="#formSection">
                            Download Now
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <section class="space ContentSecion">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <span>
                        {!!  $report->description !!}
                        </span>
                    </div>
                </div>
            </div>
        </section>


    @if(isset($report->slug) && !empty($report->slug) && $report->slug == "dubai-branded-residences-report-h2-2024")
        @php
            $darker_BG = "#800020";
            $lighter_color_dark_BG = "#F7E7CE";
            $button_color = "#E4C9A4";
            $darker_color_light_BG = "#3E2723";
        @endphp
    @endif
    
    @if(isset($darker_BG))
        <style>
            .header.js-header.darkHeader.darkHeader-2,.copyright,section.space.ContentSecion,.formSection {
                background: <?= $darker_BG ?>;
            }
            .copyright p,.footerIcons ul li a,.bannerContent h1,.bannerContent p {
                color: #F7E7CE !important;
                
            } 
            .ContentSecion2{
                background: #F7E7CE;
            }
            .ContentSecion2-Box h3,.ContentSecion2-Box ul li{
                color: <?= $darker_color_light_BG ?>;
            }
            .ContentSecion p{
                color: #F7E7CE !important;
            }
        </style>
    @endif
    
    @if(isset($button_color))
        <style>
            .green-btn,.green-btn:hover,button.form-BTN,button.form-BTN:hover{
                background: <?= $button_color ?>;
                color: <?= $darker_color_light_BG ?>;
            }
            .FormBox{
                background: <?= $lighter_color_dark_BG ?>;
            }
            .FormBox .formHeading h3{
                color: <?= $darker_color_light_BG ?>;
            }
            input.form-control::placeholder,body .FormBox .form-control, body .FormBox .sib-form input, body .sib-form .input:not(textarea), body .sib-form .input__button, body .sib-form .input:first-child, body .sib-form .input__affix:first-child, body .sib-form .input:last-child, body .sib-form .input__affix:last-child{
                color: <?= $darker_color_light_BG ?>;                
            }
            input.form-control::placeholder{
                color: <?= $darker_color_light_BG ?> !important;
            }
            input.form-control::-webkit-input-placeholder { color: <?= $darker_color_light_BG ?> !important; }
            input.form-control:-moz-placeholder { color: <?= $darker_color_light_BG ?> !important; }
            input.form-control::-moz-placeholder { color: <?= $darker_color_light_BG ?> !important; }
            input.form-control:-ms-input-placeholder { color: <?= $darker_color_light_BG ?> !important; }
        </style>
    @endif


        <section class="space ContentSecion2">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-md-6 col-lg-5">
                        <div class="ContentSecion2-Image">
                            <img src="{{ asset($report->section_ii_background_image) }}" class="img-fluid" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="ContentSecion2-Box">
                            <h3>KEY TAKEAWAYS</h3>
                            <ul>
                            @php 
                            $faq = json_decode($report->section2_content,true);
                            @endphp
                            @if(isset($faq) && !empty($faq))
                            @foreach($faq['question'] as $key => $question)
                            <li><strong>{{ $question }}</strong> {{ isset($faq['answer'][$key]) ? $faq['answer'][$key] :  "" }}</li>
                            @endforeach
                            @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="formSection" id="formSection">
         <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-5">
                <div class="FormBox">    
                  <div class="formHeading">
                    <h3>Fill out the form to download the full report</h3>
                  </div>
                  @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif
                <form action="{{ route('report-form.store') }}" method="POST">
                @csrf
                <input type="hidden" name="report_id" value="{{ $report->id }}">
                  <div class="form-group">
                    <input class="form-control" placeholder="First Name" required name="first_name">
                  </div>
                  <div class="form-group">
                    <input class="form-control" placeholder="Last Name" required name="last_name">
                  </div>
                  <div class="form-group">
                    <input class="form-control" placeholder="Email Address" name="email">
                  </div>
                    <div class="form-group mb-0">
                    <button class="form-BTN" style=" border: 0; "><img src="{{ asset('img/indireport/download.svg') }}"> Download the full report</button>
                    
                  </div>
              </form>
            </div>
                </div>
                  <div class="col-md-6">
                  @if($report->footer_image)
                     <div class="formSectionImage text-right">
                        <img src="{{ asset($report->footer_image) }}" class="img-fluid">
                     </div>
                     @endif
                  </div>
            </div>
         </div>
        </section>
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
                                            @if(isset($item[0]) && isset($item[1]))
                                                <li><a style="color: #fff;" target="_blank" href="{{$key}}">{!! $item[0] !!}</a></li>    
                                            @endif
                                        @endforeach
                                        @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    <script src="https://widgets.leadconnectorhq.com/loader.js" data-resources-url="https://widgets.leadconnectorhq.com/chat-widget/loader.js" data-widget-id="67e261b014647143f91cdbf4"></script>
        <script src="{{ asset('js/indireport/jquery-3.6.0.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/indireport/bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/indireport/main.js') }}" type="text/javascript"></script>


<!-- START - We recommend to place the below code in footer or bottom of your website html  -->

<!-- END - We recommend to place the above code in footer or bottom of your website html  -->

<script>

function copyToClipboard() {
    var copyText = document.getElementById("myInput");

    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices

    navigator.clipboard.writeText(copyText.value)
      .then(() => {
        var notification = document.getElementById("copyNotification");
        notification.style.display = "block";

        setTimeout(function() {
          notification.style.display = "none";
        }, 2000); // Hide notification after 2 seconds
      })
      .catch(err => {
        console.error('Could not copy text: ', err);
        alert("Failed to copy text to clipboard. Please try again.");
      });
}
</script>

    </body>
</html>