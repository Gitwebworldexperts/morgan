@php
$footerSection = getFooterSection();
$whatsapp = $footerSection->phone;
$copy = $footerSection->copyright;
@endphp

<!DOCTYPE html>
<html lang="zxx">
    <head>
        <title>{{ $report->meta_title }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" type="image/x-icon" href="img/favicon.png" />
        <meta charset="utf-8" />
        <meta name="keywords" content="" /> 
        <meta name="title" content="Dubai’s Branded Residences Report – H1 2024">
        <meta description="{{ $report->meta_description }}" />
        <link href="{{ asset('css/indireport/bootstrap.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/branded/common.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/branded/responsive.css') }}" rel="stylesheet" type="text/css" /> 
       
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />       
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
                  {!! $report->html_code !!}  
<!-- END - We recommend to place the above code where you want the form in your website html  -->
                  </div>
                </div>
                  <div class="col-md-6">
                     <div class="formSectionImage text-right">
                        <img src="{{ asset($report->footer_image) }}" class="img-fluid">
                     </div>
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
                                            <li><a style="color: #fff;" target="_blank" href="{{$key}}">{!! $item !!}</a></li>    
                                        @endforeach
                                        @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
<!-- 
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script> 
        <script src="{{ asset('js/bootstrap.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script> -->


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