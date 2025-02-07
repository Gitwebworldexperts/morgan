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
        <meta property="og:description" content="{{ strip_tags($report->meta_description) }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" type="image/x-icon" href="{{ asset(siteLogo()) }}" />
        <meta charset="utf-8" />
        <meta name="keywords" content="" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link href="{{ asset('css/indireport/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- <link href="{{ asset('css/indireport/owl.theme.default.css') }}" rel="stylesheet" type="text/css" /> -->
        <!-- <link href="{{ asset('css/indireport/owl.carousel.min.css') }}" rel="stylesheet" type="text/css" /> -->
        <link href="{{ asset('css/indireport/common.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link href="{{ asset('css/indireport/responsive.css') }}" rel="stylesheet" type="text/css" />
        <style>
            .footerIcons i {
                color: #fff;
            }
            .bannerContent .sib-form-block__button {
                padding: 16px 30px;
                display: inline-block;
            }
        </style>
    </head>

    <body>
    @if($whatsapp)
      <div class="whatsapp-float">    
          <a href="https://api.whatsapp.com/send?phone={{ $whatsapp }}" target="_blank" class="whatsapp-btn">
              <img src="{{ asset('img/indireport/whatsapp.svg') }}" class="" />
          </a>
      </div>
    @endif
	
	
	<!-- header -->
    <header class="header js-header darkHeader darkHeader-2">
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
          <div class="logo-web">
            <a class="navbar-brand" href="{{ url('/') }}">
              <div class="logo-box">
                <!-- <img src="{{ asset(siteLogo()) }}" alt="Site Logo"> -->
                <img src="{{ asset($footerSection->logo_url) }}" alt="Site Logo">
                
              </div>
            </a>
          </div>
          <div class="right-head">
            <!-- Navbar -->
            <div class="schedule-call">
            <button class="btn green-btn" onclick="copyToClipboard()">
                <img src="{{ asset('img/indireport/share.png') }}" />
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
            @if($report->subheading)
            <p>{{ $report->subheading }}</p>
            @endif
            <a class="btn green-btn" href="#formSection"> Download Now </a>
          </div>
        </div>
      </div>
    </section>
	
	
    <section class="space ContentSecion">
      <div class="container">
        <div class="row">
          <div class="col-12">
            {!!  $report->description !!}
          </div>
        </div>
      </div>
    </section>
    <section class="space ContentSecion2">
      <div class="container">
        <div class="row justify-content-between">
          <div class="col-md-6 col-lg-5">
            <div class="ContentSecion2-Image">
              <img src="{{ asset($report->section_ii_background_image) }}" class="img-fluid">
            </div>
          </div>
          <div class="col-md-6">
            <div class="ContentSecion2-Box">
              <h3>{{ $report->section2_heading }}</h3>
              <ul>
                     
                @php 
                $faq = json_decode($report->section2_content,true);
                @endphp
                @if(isset($faq) && !empty($faq))
                @foreach($faq['question'] as $key => $question)

                <li>
                  @if($question)<strong>{{ $question }}:</strong>@endif{{ isset($faq['answer'][$key]) ? $faq['answer'][$key] :  "" }}
                </li>

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
                  <div class="form-group checkboxGrid">
                    <input type="checkbox" id="vehicle1" name="newsletter" >
        <label for="vehicle1">I agree to receive your newsletters and information about Dubai Real Estate Market.</label>
                  </div>
                    <div class="form-group mb-0">
                    <button class="form-BTN"><img src="{{ asset('img/indireport/download.svg') }}"> Download the full report</button>
                    
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
 
    <script src="{{ asset('js/indireport/jquery-3.6.0.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/indireport/bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/indireport/owl.carousel.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/indireport/wow.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/indireport/main.js') }}" type="text/javascript"></script>
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

</body></html>