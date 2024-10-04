@extends('layouts.app')
@section('title', 'Home Page')
@section('content')

    <!-- banner -->
    <section class="banner" style="background-image: url('{{ $home->first_section_image ? asset($home->first_section_image) : asset('img/Home-banner.png') }}');">

        <div class="container">
            <div class="slider-info banner-bg">
                <div class="BannerBox">
                    <div class="banner-heading">
                        <h1>
                            @php
    $heading = $home->first_section_heading;
    $words = explode(' ', $heading);
    $last_word = array_pop($words);
    $new_heading = implode(' ', $words) . ' <span>' . $last_word . '</span>';
    $button_name = "Button";
    $button_url = "#";
@endphp


{!! $new_heading !!}
</h1>
                    </div>
                    <div class="banner-form mobile-none">
                        <div class="banner-form mobile-none">
                            <div class="TopTabsBar">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    @php
                                            $list_property = json_decode($home->list_property); // true for associative array
                                            if (json_last_error() !== JSON_ERROR_NONE) {
                                                echo "JSON Decode Error: " . json_last_error_msg();
                                            }
                                              $firstActive = true;
                                              $contentActive = true;
                                    @endphp

                                    @if($list_property->buy)
                                    <li class="nav-item"> <a class="nav-link {{ $firstActive ? 'active show' : '' }}" id="home-tab" data-toggle="tab"
                                            href="#Buy" role="tab" aria-controls="home" aria-selected="true">Buy</a>
                                    </li>
                                    @php $firstActive = false; @endphp
                                    @endif
                                    @if($list_property->rent)
                                    <li class="nav-item"> <a class="nav-link {{ $firstActive ? 'active show' : '' }}" id="profile-tab" data-toggle="tab"
                                            href="#Rent" role="tab" aria-controls="profile"
                                            aria-selected="false">Rent</a> </li>
                                    @php $firstActive = false; @endphp
                                    @endif
                                    @if($list_property->project)
                                    <li class="nav-item"> <a class="nav-link {{ $firstActive ? 'active show' : '' }}" id="profile-tab" data-toggle="tab"
                                            href="#Project" role="tab" aria-controls="profile"
                                            aria-selected="false">Project</a> </li>
                                    @php $firstActive = false; @endphp
                                    @endif
                                    @if($list_property->private)
                                    <li class="nav-item"> <a class="nav-link {{ $firstActive ? 'active show' : '' }}" id="profile-tab" data-toggle="tab"
                                            href="#Private" role="tab" aria-controls="profile"
                                            aria-selected="false">Private</a> </li>
                                    @php $firstActive = false; @endphp
                                    @endif
                                    @if($list_property->international)
                                    <li class="nav-item"> <a class="nav-link {{ $firstActive ? 'active show' : '' }}" id="profile-tab" data-toggle="tab"
                                            href="#International" role="tab" aria-controls="profile"
                                            aria-selected="false">International</a> </li>
                                    @php $firstActive = false; @endphp
                                    @endif
                                </ul>
                            </div>
                            <div class="tab-content">
                                @if($list_property->buy)
                                <div id="Buy" class="tab-pane fade {{ $contentActive ? 'active show' : '' }}">
                                    <form action="#">
                                        <div class="BookingBox">
                                            <div class="BookingLocation">
                                                <div class="BookingFrom"> <input type="" name=""
                                                        class="form-control" placeholder="Search country and city...">
                                                </div>
                                                <div class="BookingFrom p-0"> <select class="form-control">
                                                        <option>Property Type</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select> </div>
                                                <div class="BookingFrom p-0"> <select class="form-control">
                                                        <option>Buy</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select> </div>
                                                <div class="BookingFrom p-0"> <select class="form-control">
                                                        <option>Beds</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select> </div>
                                                <div class="BookingFrom p-0"> <select class="form-control">
                                                        <option>Price</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select> </div>
                                                <div class="BookingFromBtn"> <a href="#"><img
                                                            src="{{ asset('img/search.svg') }}"></a> </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @php $contentActive = false; @endphp
                                @endif
                                @if($list_property->rent)
                                <div id="Rent" class="tab-pane fade {{ $contentActive ? 'active show' : '' }}">
                                    <form>
                                        <div class="BookingBox">
                                            <div class="BookingLocation">
                                                <div class="BookingFrom"> <input type="" name=""
                                                        class="form-control" placeholder="Search country and city...">
                                                </div>
                                                <div class="BookingFrom p-0"> <select class="form-control">
                                                        <option>Property Type</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select> </div>
                                                <div class="BookingFrom p-0"> <select class="form-control">
                                                        <option>Buy</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select> </div>
                                                <div class="BookingFrom p-0"> <select class="form-control">
                                                        <option>Beds</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select> </div>
                                                <div class="BookingFrom p-0"> <select class="form-control">
                                                        <option>Price</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select> </div>
                                                <div class="BookingFromBtn"> <a href="#"><img
                                                            src="{{ asset('img/search.svg') }}"></a> </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @php $contentActive = false; @endphp
                                @endif
                                @if($list_property->project)
                                <div id="Project" class="tab-pane fade {{ $contentActive ? 'active show' : '' }}">
                                    <form>
                                        <div class="BookingBox">
                                            <div class="BookingLocation">
                                                <div class="BookingFrom"> <input type="" name=""
                                                        class="form-control" placeholder="Search country and city...">
                                                </div>
                                                <div class="BookingFrom p-0"> <select class="form-control">
                                                        <option>Property Type</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select> </div>
                                                <div class="BookingFrom p-0"> <select class="form-control">
                                                        <option>Buy</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select> </div>
                                                <div class="BookingFrom p-0"> <select class="form-control">
                                                        <option>Beds</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select> </div>
                                                <div class="BookingFrom p-0"> <select class="form-control">
                                                        <option>Price</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select> </div>
                                                <div class="BookingFromBtn"> <a href="#"><img
                                                            src="{{ asset('img/search.svg') }}"></a> </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @php $contentActive = false; @endphp
                                @endif
                                @if($list_property->private)
                                <div id="Private" class="tab-pane fade {{ $contentActive ? 'active show' : '' }}">
                                    <form>
                                        <div class="BookingBox">
                                            <div class="BookingLocation">
                                                <div class="BookingFrom"> <input type="" name=""
                                                        class="form-control" placeholder="Search country and city...">
                                                </div>
                                                <div class="BookingFrom p-0"> <select class="form-control">
                                                        <option>Property Type</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select> </div>
                                                <div class="BookingFrom p-0"> <select class="form-control">
                                                        <option>Buy</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select> </div>
                                                <div class="BookingFrom p-0"> <select class="form-control">
                                                        <option>Beds</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select> </div>
                                                <div class="BookingFrom p-0"> <select class="form-control">
                                                        <option>Price</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select> </div>
                                                <div class="BookingFromBtn"> <a href="#"><img
                                                            src="{{ asset('img/search.svg') }}"></a> </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @php $contentActive = false; @endphp
                                @endif
                                @if($list_property->international)
                                <div id="International" class="tab-pane fade {{ $contentActive ? 'active show' : '' }}">
                                    <form>
                                        <div class="BookingBox">
                                            <div class="BookingLocation">
                                                <div class="BookingFrom"> <input type="" name=""
                                                        class="form-control" placeholder="Search country and city...">
                                                </div>
                                                <div class="BookingFrom p-0"> <select class="form-control">
                                                        <option>Property Type</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select> </div>
                                                <div class="BookingFrom p-0"> <select class="form-control">
                                                        <option>Buy</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select> </div>
                                                <div class="BookingFrom p-0"> <select class="form-control">
                                                        <option>Beds</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select> </div>
                                                <div class="BookingFrom p-0"> <select class="form-control">
                                                        <option>Price</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select> </div>
                                                <div class="BookingFromBtn"> <a href="#"><img
                                                            src="{{ asset('img/search.svg') }}"></a> </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @php $contentActive = false; @endphp
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if($home->section_2)
    <section class="space panel-sec mobile-none">
        <div class="container">
            <div class="panel-box">
                <div class="row">
                    <div class="col-lg-5 col-md-6 col-12">
                        <div class="heading-pnel m-0">
                            <h2>{{$home->second_heading}}</h2>
                            <div class="headingBorder"></div>
                        </div>
                    </div>

                    @php
                        $jsonData = optional(json_decode($home->second_section_button, true))[0] ?? [];
                        $buttonName_1 = $jsonData['buttonName'] ?? $button_name;
                        $buttonUrl_2 = $jsonData['buttonUrl'] ?? $button_url;
                    @endphp
                    <div class="col-lg-7 col-md-6 col-12">
                        <div class="panel-sec-content">
                            <p>{{ Str::words($home->second_description, 45, '...') }}</p> <a
                                href="{{$buttonUrl_2}}" class="link-btn">{{$buttonName_1}}<img
                                    src="{{ asset('img/arrow.svg') }}"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- section -->
    @endif
    @if($home->section_3)
    <section class="space position-relative">
        <div class="container">
            <div class="heading-pnel HeadingMiddleBorder">
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <h2 class="m-0">Featured Properties</h2>
                    </div>
                    <div class="col-lg-4 col-12"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="cards-main">
                        <div class="owl-carousel owl-loaded owl-drag" id="instructor-slider">



                            <div class="owl-stage-outer owl-height" style="height: 468.328px;">
                                <div class="owl-stage"
                                    style="transform: translate3d(-1270px, 0px, 0px); transition: all; width: 4128px;">
                                        @if(isset($featured_properties) && !empty($featured_properties))
                                            @foreach($featured_properties as $featured)
                                                <div class="owl-item cloned" style="width: 297.5px; margin-right: 20px;">
                                                    <div class="item">
                                                        <div class="card-box">
                                                            <a href="#">
                                                                <figure>
                                                                    <div class="VillaText">
                                                                        <p>Villa</p>
                                                                    </div>
                                                                    <img src="{{ asset($featured->featured_image) }}" alt="Featured Image">
                                                                    <div class="Wishlist">
                                                                        <img class="heart-o-icon" src="{{ asset('img/heart-o.svg') }}">
                                                                        <img src="{{ asset('img/heart.svg') }}" class="heart-icon">
                                                                    </div>
                                                                </figure>
                                                            </a>
                                                            <figcaption>
                                                                <a href="#">
                                                                    <h3>{{ $featured->name }}</h3>
                                                                    <p><img src="{{ asset('img/map.svg') }}">{{ $featured->address}}</p>
                                                                    <div class="HotelViews">
                                                                        <ul>
                                                                            <li><img src="{{ asset('img/1.svg') }}"> {{ number_format($featured->area) }} SQ FT</li>
                                                                            @if($featured->bed)
                                                                            <li><img src="{{ asset('img/2.svg') }}"> {{ $featured->bed }}</li>
                                                                            @endif
                                                                            @if($featured->jacuzzi)
                                                                            <li><img src="{{ asset('img/3.svg') }}"> {{ $featured->jacuzzi }}</li>
                                                                            @endif
                                                                        </ul>
                                                                    </div>
                                                                    <h6><span>$</span> {{ number_format($featured->sale_price) }}/-</h6>
                                                                </a>
                                                            </figcaption>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                </div>
                            </div>
                            <div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><span
                                        aria-label="Previous">‹</span></button><button type="button" role="presentation"
                                    class="owl-next"><span aria-label="Next">›</span></button></div>
                            <div class="owl-dots disabled"></div>
                        </div>
                    </div>
                </div>
            </div> <!-- view all -->
            <div class="view-all">
                <div class="row">
                     @php
                        $jsonData = [];
                        $buttonName_1 = $buttonUrl_2 = "";
                        $jsonData = optional(json_decode($home->third_section_button, true))[0] ?? [];
                        $buttonName_1 = $jsonData['buttonName'] ?? $button_name;
                        $buttonUrl_2 = $jsonData['buttonUrl'] ?? $button_url;
                    @endphp
                    <div class="col-12"> <a href="{{$buttonUrl_2}}" class="green-btn">{{$buttonName_1}}</a> </div>
                </div>
            </div>
        </div>
    </section> <!-- section -->
    @endif
    @if($home->section_4)
    <section class="space private-office-sec bg-black mobile-none">
        <div class="container">
            <div class="heading-pnel HeadingMiddleBorder fff">
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <h2 class="m-0">{{$home->fourth_heading}}</h2>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="head-btn"> 
                        @php
                            $jsonData = [];
                            $buttonName_1 = $buttonUrl_2 = "";
                            $jsonData = optional(json_decode($home->fourth_section_button, true))[0] ?? [];
                            $buttonName_1 = $jsonData['buttonName'] ?? $button_name;
                            $buttonUrl_2 = $jsonData['buttonUrl'] ?? $button_url;
                        @endphp
                            <a href="{{ $buttonUrl_2 }}" class="light-btn ml-auto">{{ $buttonName_1 }}</a> 
                        </div>
                    </div>
                    <div class="col-12">
                        <p>{{ Str::words($home->fourth_description, 45, '...') }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @if(isset($private_properties) && !empty($private_properties))
                    @foreach($private_properties as $private)
                        <div class="col">
                            <div class="office-box"> <a href="#">
                                    <figure> <img src="{{ asset($private->featured_image) }}" class="" alt="">
                                        <figcaption>
                                            <div class="add-grp">
                                                <div class="VillaText">Villa</div>
                                                <p><img src="{{ asset('img/map.svg') }}">{{ $private->address}}</p>
                                            </div>
                                            <h3>{{ $private->name }}</h3>
                                            <div class="HotelViews">
                                                <ul>
                                                    <li><img src="{{ asset('img/1.svg') }}"> {{ number_format($private->area) }} SQ FT</li>
                                                    <li><img src="{{ asset('img/2.svg') }}"> {{ $private->bed }}</li>
                                                    <li><img src="{{ asset('img/3.svg') }}"> {{ $private->jacuzzi }}</li>
                                                </ul>
                                            </div>
                                            <h6><span>$</span> {{ number_format($private->sale_price) }}/-</h6>
                                        </figcaption>
                                    </figure>
                                </a> </div>
                        </div>                        
                    @endforeach
                @endif
            </div>
        </div>
    </section> <!-- section -->
    <section class="space private-office-sec bg-black desktop-none">
        <div class="container">
            <div class="heading-pnel HeadingMiddleBorder fff">
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <h2 class="m-0">{{$home->fourth_heading}}</h2>
                    </div>
                    <div class="col-lg-4 col-12 mobile-none">
                        <div class="head-btn"> <a href="{{ $buttonUrl_2 }}" class="border-btn fff">{{ $buttonName_1 }}</a> </div>
                    </div>
                    <div class="col-12">
                        <p>{{ Str::words($home->fourth_description, 45, '...') }}</p>
                    </div>
                </div>
            </div>
            <div class="row owl-carousel owl-loaded owl-drag" id="private-office">





                <div class="owl-stage-outer owl-height" style="height: 0px;">
                    <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all;">
                        <div class="owl-item">
                            <div class="office-box"> <a href="#">
                                    <figure> <img src="{{ asset('img/1(1).png') }}" class="" alt="">
                                    </figure>
                                    <figcaption>
                                        <div class="add-grp">
                                            <div class="VillaText">Villa</div>
                                            <p><img src="{{ asset('img/map.svg') }}">75 Prince St, NY, USA</p>
                                        </div>
                                        <h3>Stunning 4-Bedroom I Full Sea View</h3>
                                        <div class="HotelViews">
                                            <ul>
                                                <li><img src="{{ asset('img/1.svg') }}"> 7228 SQ FT</li>
                                                <li><img src="{{ asset('img/2.svg') }}"> 2</li>
                                                <li><img src="{{ asset('img/3.svg') }}"> 2</li>
                                            </ul>
                                        </div>
                                        <h6><span>$</span> 195,000,000/-</h6>
                                    </figcaption>
                                </a> </div>
                        </div>
                        <div class="owl-item">
                            <div class="office-box"> <a href="#">
                                    <figure> <img src="{{ asset('img/2(1).png') }}" class="" alt="">
                                    </figure>
                                    <figcaption>
                                        <div class="add-grp">
                                            <div class="VillaText">Villa</div>
                                            <p><img src="{{ asset('img/map.svg') }}">75 Prince St, NY, USA</p>
                                        </div>
                                        <h3>Stunning 4-Bedroom I Full Sea View</h3>
                                        <div class="HotelViews">
                                            <ul>
                                                <li><img src="{{ asset('img/1.svg') }}"> 7228 SQ FT</li>
                                                <li><img src="{{ asset('img/2.svg') }}"> 2</li>
                                                <li><img src="{{ asset('img/3.svg') }}"> 2</li>
                                            </ul>
                                        </div>
                                        <h6><span>$</span> 195,000,000/-</h6>
                                    </figcaption>
                                </a> </div>
                        </div>
                        <div class="owl-item">
                            <div class="office-box"> <a href="#">
                                    <figure> <img src="{{ asset('img/3(1).png') }}" class="" alt="">
                                    </figure>
                                    <figcaption>
                                        <div class="add-grp">
                                            <div class="VillaText">Villa</div>
                                            <p><img src="{{ asset('img/map.svg') }}">75 Prince St, NY, USA</p>
                                        </div>
                                        <h3>Stunning 4-Bedroom I Full Sea View</h3>
                                        <div class="HotelViews">
                                            <ul>
                                                <li><img src="{{ asset('img/1.svg') }}"> 7228 SQ FT</li>
                                                <li><img src="{{ asset('img/2.svg') }}"> 2</li>
                                                <li><img src="{{ asset('img/3.svg') }}"> 2</li>
                                            </ul>
                                        </div>
                                        <h6><span>$</span> 195,000,000/-</h6>
                                    </figcaption>
                                </a> </div>
                        </div>
                        <div class="owl-item">
                            <div class="office-box"> <a href="#">
                                    <figure> <img src="{{ asset('img/4(1).png') }}" class="" alt="">
                                    </figure>
                                    <figcaption>
                                        <div class="add-grp">
                                            <div class="VillaText">Villa</div>
                                            <p><img src="{{ asset('img/map.svg') }}">75 Prince St, NY, USA
                                            </p>
                                        </div>
                                        <h3>Stunning 4-Bedroom I Full Sea View</h3>
                                        <div class="HotelViews">
                                            <ul>
                                                <li><img src="{{ asset('img/1.svg') }}"> 7228 SQ FT</li>
                                                <li><img src="{{ asset('img/2.svg') }}"> 2</li>
                                                <li><img src="{{ asset('img/3.svg') }}"> 2</li>
                                            </ul>
                                        </div>
                                        <h6><span>$</span> 195,000,000/-</h6>
                                    </figcaption>
                                </a> </div>
                        </div>
                        <div class="owl-item">
                            <div class="office-box"> <a href="#">
                                    <figure> <img src="{{ asset('img/4(1).png') }}" class="" alt="">
                                    </figure>
                                    <figcaption>
                                        <div class="add-grp">
                                            <div class="VillaText">Villa</div>
                                            <p><img src="{{ asset('img/map.svg') }}">75 Prince St, NY, USA
                                            </p>
                                        </div>
                                        <h3>Stunning 4-Bedroom I Full Sea View</h3>
                                        <div class="HotelViews">
                                            <ul>
                                                <li><img src="{{ asset('img/1.svg') }}"> 7228 SQ FT</li>
                                                <li><img src="{{ asset('img/2.svg') }}"> 2</li>
                                                <li><img src="{{ asset('img/3.svg') }}"> 2</li>
                                            </ul>
                                        </div>
                                        <h6><span>$</span> 195,000,000/-</h6>
                                    </figcaption>
                                </a> </div>
                        </div>
                    </div>
                </div>
                <div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><span
                            aria-label="Previous">‹</span></button><button type="button" role="presentation"
                        class="owl-next"><span aria-label="Next">›</span></button></div>
                <div class="owl-dots disabled"></div>
            </div> <!-- view all -->
            <div class="view-all">
                <div class="row">
                    <div class="col-12"> <a href="#" class="green-btn fff">View all properties</a> </div>
                </div>
            </div>
        </div>
    </section> <!-- section -->
    @endif
    @if($home->section_5)
    <section class="space International-sec">
        <div class="container">
            <div class="heading-pnel HeadingMiddleBorder">
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <h2 class="m-0">{{ $home->fifth_heading }}</h2>
                    </div>
                </div>
            </div>
            @php
                $jsonData = [];
                $name = $url = "";
                $jsonData = optional(json_decode($home->fifth_section_button, true))[0] ?? [];
                $name = $jsonData['buttonName'] ?? $button_name;
                $url = $jsonData['buttonUrl'] ?? $button_url;
            @endphp
            <div class="international-main" style="background-image: url('{{ $home->fifth_section_image ? asset($home->fifth_section_image) : asset('img/international-bg.png') }}');">
                <div class="row">
                    <div class="col-12">
                        <div class="tabs-grp">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation"> <a class="nav-link active" id="Africa-tab"
                                        data-toggle="tab" data-target="#Africa" type="button" role="tab"
                                        aria-controls="home" aria-selected="true">Africa</a> </li>
                                <li class="nav-item"> <a class="nav-link" id="Europe-tab" data-toggle="tab"
                                        data-target="#Europe" type="button" role="tab" aria-controls="profile"
                                        aria-selected="false">Europe</a> </li>
                                <li class="nav-item"> <a class="nav-link" id="Middle-tab" data-toggle="tab"
                                        data-target="#MiddleEast" type="button" role="tab" aria-controls="contact"
                                        aria-selected="false">Middle East</a> </li>
                                <li class="nav-item"> <a class="nav-link" id="North-tab" data-toggle="tab"
                                        data-target="#NorthAmerica" type="button" role="tab"
                                        aria-controls="contact" aria-selected="false">North America</a> </li>
                                <li class="nav-item"> <a class="nav-link" id="South-tab" data-toggle="tab"
                                        data-target="#SouthAfrica" type="button" role="tab" aria-controls="contact"
                                        aria-selected="false">South Africa</a> </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="Africa" role="tabpanel"
                                    aria-labelledby="Africa-tab">
                                    <div class="tabs-caption fff">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-8 col-12">
                                                <div class="heading-pnel m-0 fff">
                                                    <h2 class="m-0">Africa</h2>
                                                    <p>Morgan’s International Realty is a luxury real estate brokerage and
                                                        property investment consultancy firm. Established in Dubai was just
                                                        evolving empowered by a joint effort...</p>
                                                    <div class="btn-grp"> <a href="{{$url}}" class="border-btn fff">{{$name}}</a> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="Europe" role="tabpanel" aria-labelledby="Europe-tab">
                                    <div class="tabs-caption fff">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-8 col-12">
                                                <div class="heading-pnel m-0 fff">
                                                    <h2 class="m-0">Europe</h2>
                                                    <p>Morgan’s International Realty is a luxury real estate brokerage and
                                                        property investment consultancy firm. Established in Dubai was just
                                                        evolving empowered by a joint effort...</p>
                                                    <div class="btn-grp"> <a href="{{$url}}" class="border-btn fff">{{$name}}</a> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="MiddleEast" role="tabpanel" aria-labelledby="Middle-tab">
                                    <div class="tabs-caption fff">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-8 col-12">
                                                <div class="heading-pnel m-0 fff">
                                                    <h2 class="m-0">Middle East</h2>
                                                    <p>Morgan’s International Realty is a luxury real estate brokerage and
                                                        property investment consultancy firm. Established in Dubai was just
                                                        evolving empowered by a joint effort...</p>
                                                    <div class="btn-grp"> <a href="{{$url}}" class="border-btn fff">{{$name}}</a> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="NorthAmerica" role="tabpanel"
                                    aria-labelledby="North-tab">
                                    <div class="tabs-caption fff">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-8 col-12">
                                                <div class="heading-pnel m-0 fff">
                                                    <h2 class="m-0">North America</h2>
                                                    <p>Morgan’s International Realty is a luxury real estate brokerage and
                                                        property investment consultancy firm. Established in Dubai was just
                                                        evolving empowered by a joint effort...</p>
                                                    <div class="btn-grp"> <a href="{{$url}}" class="border-btn fff">{{$name}}</a> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="SouthAfrica" role="tabpanel" aria-labelledby="South-tab">
                                    <div class="tabs-caption fff">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-8 col-12">
                                                <div class="heading-pnel m-0 fff">
                                                    <h2 class="m-0">South Africa</h2>
                                                    <p>Morgan’s International Realty is a luxury real estate brokerage and
                                                        property investment consultancy firm. Established in Dubai was just
                                                        evolving empowered by a joint effort...</p>
                                                    <div class="btn-grp"> <a href="{{$url}}" class="border-btn fff">{{$name}}</a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- section -->
    @endif
    @if($home->section_6)
    <section class="new-development-sec space pt-0">
        <div class="container">
            <div class="heading-pnel HeadingMiddleBorder">
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <h2 class="m-0">{{ $home->sixth_heading }}</h2>
                    </div>
                    <div class="col-lg-6 col-12"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="cards-main">
                        <div class="owl-carousel owl-loaded owl-drag" id="NewDevelopment">





                            <div class="owl-stage-outer owl-height" style="height: 364.438px;">
                                <div class="owl-stage"
                                    style="transform: translate3d(-1270px, 0px, 0px); transition: all; width: 4128px;">
                                    <div class="owl-item cloned" style="width: 297.5px; margin-right: 20px;">
                                        <div class="item">
                                            <div class="new-development card-box"> <a href="#">
                                                    <figure> <img src="{{ asset('img/2(2).png') }}" class=""
                                                            alt="">
                                                        <div class="Wishlist"><img class="heart-o-icon"
                                                                src="{{ asset('img/heart-o.svg') }}"><img
                                                                src="{{ asset('img/heart.svg') }}" class="heart-icon">
                                                        </div>
                                                    </figure>
                                                </a>
                                                <figcaption> <a href="#">
                                                        <h3>Bugatti Residences at Business Bay</h3>
                                                        <p><img src="{{ asset('img/map.svg') }}">75 Prince St, NY, USA
                                                        </p>
                                                    </a> </figcaption>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item cloned" style="width: 297.5px; margin-right: 20px;">
                                        <div class="item">
                                            <div class="new-development card-box"> <a href="#">
                                                    <figure> <img src="{{ asset('img/3(2).png') }}" class=""
                                                            alt="">
                                                        <div class="Wishlist"><img class="heart-o-icon"
                                                                src="{{ asset('img/heart-o.svg') }}"><img
                                                                src="{{ asset('img/heart.svg') }}" class="heart-icon">
                                                        </div>
                                                    </figure>
                                                </a>
                                                <figcaption> <a href="#">
                                                        <h3>Bugatti Residences at Business Bay</h3>
                                                        <p><img src="{{ asset('img/map.svg') }}">75 Prince St, NY, USA
                                                        </p>
                                                    </a> </figcaption>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item cloned" style="width: 297.5px; margin-right: 20px;">
                                        <div class="item">
                                            <div class="new-development card-box"> <a href="#">
                                                    <figure> <img src="{{ asset('img/4(2).png') }}" class=""
                                                            alt="">
                                                        <div class="Wishlist"><img class="heart-o-icon"
                                                                src="{{ asset('img/heart-o.svg') }}"><img
                                                                src="{{ asset('img/heart.svg') }}" class="heart-icon">
                                                        </div>
                                                    </figure>
                                                </a>
                                                <figcaption> <a href="#">
                                                        <h3>Bugatti Residences at Business Bay</h3>
                                                        <p><img src="{{ asset('img/map.svg') }}">75 Prince St, NY, USA
                                                        </p>
                                                    </a> </figcaption>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item cloned" style="width: 297.5px; margin-right: 20px;">
                                        <div class="item">
                                            <div class="new-development card-box"> <a href="#">
                                                    <figure> <img src="{{ asset('img/1(2).png') }}" class=""
                                                            alt="">
                                                        <div class="Wishlist"><img class="heart-o-icon"
                                                                src="{{ asset('img/heart-o.svg') }}"><img
                                                                src="{{ asset('img/heart.svg') }}" class="heart-icon">
                                                        </div>
                                                    </figure>
                                                </a>
                                                <figcaption> <a href="#">
                                                        <h3>Bugatti Residences at Business Bay</h3>
                                                        <p><img src="{{ asset('img/map.svg') }}">75 Prince St, NY, USA
                                                        </p>
                                                    </a> </figcaption>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item active" style="width: 297.5px; margin-right: 20px;">
                                        <div class="item">
                                            <div class="new-development card-box"> <a href="#">
                                                    <figure> <img src="{{ asset('img/1(2).png') }}" class=""
                                                            alt="">
                                                        <div class="Wishlist"><img class="heart-o-icon"
                                                                src="{{ asset('img/heart-o.svg') }}"><img
                                                                src="{{ asset('img/heart.svg') }}" class="heart-icon">
                                                        </div>
                                                    </figure>
                                                </a>
                                                <figcaption> <a href="#">
                                                        <h3>Bugatti Residences at Business Bay</h3>
                                                        <p><img src="{{ asset('img/map.svg') }}">75 Prince St, NY, USA
                                                        </p>
                                                    </a> </figcaption>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item active" style="width: 297.5px; margin-right: 20px;">
                                        <div class="item">
                                            <div class="new-development card-box"> <a href="#">
                                                    <figure> <img src="{{ asset('img/2(2).png') }}" class=""
                                                            alt="">
                                                        <div class="Wishlist"><img class="heart-o-icon"
                                                                src="{{ asset('img/heart-o.svg') }}"><img
                                                                src="{{ asset('img/heart.svg') }}" class="heart-icon">
                                                        </div>
                                                    </figure>
                                                </a>
                                                <figcaption> <a href="#">
                                                        <h3>Bugatti Residences at Business Bay</h3>
                                                        <p><img src="{{ asset('img/map.svg') }}">75 Prince St, NY, USA
                                                        </p>
                                                    </a> </figcaption>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item active" style="width: 297.5px; margin-right: 20px;">
                                        <div class="item">
                                            <div class="new-development card-box"> <a href="#">
                                                    <figure> <img src="{{ asset('img/3(2).png') }}" class=""
                                                            alt="">
                                                        <div class="Wishlist"><img class="heart-o-icon"
                                                                src="{{ asset('img/heart-o.svg') }}"><img
                                                                src="{{ asset('img/heart.svg') }}" class="heart-icon">
                                                        </div>
                                                    </figure>
                                                </a>
                                                <figcaption> <a href="#">
                                                        <h3>Bugatti Residences at Business Bay</h3>
                                                        <p><img src="{{ asset('img/map.svg') }}">75 Prince St, NY, USA
                                                        </p>
                                                    </a> </figcaption>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item active" style="width: 297.5px; margin-right: 20px;">
                                        <div class="item">
                                            <div class="new-development card-box"> <a href="#">
                                                    <figure> <img src="{{ asset('img/4(2).png') }}" class=""
                                                            alt="">
                                                        <div class="Wishlist"><img class="heart-o-icon"
                                                                src="{{ asset('img/heart-o.svg') }}"><img
                                                                src="{{ asset('img/heart.svg') }}" class="heart-icon">
                                                        </div>
                                                    </figure>
                                                </a>
                                                <figcaption> <a href="#">
                                                        <h3>Bugatti Residences at Business Bay</h3>
                                                        <p><img src="{{ asset('img/map.svg') }}">75 Prince St, NY, USA
                                                        </p>
                                                    </a> </figcaption>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item" style="width: 297.5px; margin-right: 20px;">
                                        <div class="item">
                                            <div class="new-development card-box"> <a href="#">
                                                    <figure> <img src="{{ asset('img/1(2).png') }}" class=""
                                                            alt="">
                                                        <div class="Wishlist"><img class="heart-o-icon"
                                                                src="{{ asset('img/heart-o.svg') }}"><img
                                                                src="{{ asset('img/heart.svg') }}" class="heart-icon">
                                                        </div>
                                                    </figure>
                                                </a>
                                                <figcaption> <a href="#">
                                                        <h3>Bugatti Residences at Business Bay</h3>
                                                        <p><img src="{{ asset('img/map.svg') }}">75 Prince St, NY, USA
                                                        </p>
                                                    </a> </figcaption>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item cloned" style="width: 297.5px; margin-right: 20px;">
                                        <div class="item">
                                            <div class="new-development card-box"> <a href="#">
                                                    <figure> <img src="{{ asset('img/1(2).png') }}" class=""
                                                            alt="">
                                                        <div class="Wishlist"><img class="heart-o-icon"
                                                                src="{{ asset('img/heart-o.svg') }}"><img
                                                                src="{{ asset('img/heart.svg') }}" class="heart-icon">
                                                        </div>
                                                    </figure>
                                                </a>
                                                <figcaption> <a href="#">
                                                        <h3>Bugatti Residences at Business Bay</h3>
                                                        <p><img src="{{ asset('img/map.svg') }}">75 Prince St, NY, USA
                                                        </p>
                                                    </a> </figcaption>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item cloned" style="width: 297.5px; margin-right: 20px;">
                                        <div class="item">
                                            <div class="new-development card-box"> <a href="#">
                                                    <figure> <img src="{{ asset('img/2(2).png') }}" class=""
                                                            alt="">
                                                        <div class="Wishlist"><img class="heart-o-icon"
                                                                src="{{ asset('img/heart-o.svg') }}"><img
                                                                src="{{ asset('img/heart.svg') }}" class="heart-icon">
                                                        </div>
                                                    </figure>
                                                </a>
                                                <figcaption> <a href="#">
                                                        <h3>Bugatti Residences at Business Bay</h3>
                                                        <p><img src="{{ asset('img/map.svg') }}">75 Prince St, NY, USA
                                                        </p>
                                                    </a> </figcaption>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item cloned" style="width: 297.5px; margin-right: 20px;">
                                        <div class="item">
                                            <div class="new-development card-box"> <a href="#">
                                                    <figure> <img src="{{ asset('img/3(2).png') }}" class=""
                                                            alt="">
                                                        <div class="Wishlist"><img class="heart-o-icon"
                                                                src="{{ asset('img/heart-o.svg') }}"><img
                                                                src="{{ asset('img/heart.svg') }}" class="heart-icon">
                                                        </div>
                                                    </figure>
                                                </a>
                                                <figcaption> <a href="#">
                                                        <h3>Bugatti Residences at Business Bay</h3>
                                                        <p><img src="{{ asset('img/map.svg') }}">75 Prince St, NY, USA
                                                        </p>
                                                    </a> </figcaption>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item cloned" style="width: 297.5px; margin-right: 20px;">
                                        <div class="item">
                                            <div class="new-development card-box"> <a href="#">
                                                    <figure> <img src="{{ asset('img/4(2).png') }}" class=""
                                                            alt="">
                                                        <div class="Wishlist"><img class="heart-o-icon"
                                                                src="{{ asset('img/heart-o.svg') }}"><img
                                                                src="{{ asset('img/heart.svg') }}" class="heart-icon">
                                                        </div>
                                                    </figure>
                                                </a>
                                                <figcaption> <a href="#">
                                                        <h3>Bugatti Residences at Business Bay</h3>
                                                        <p><img src="{{ asset('img/map.svg') }}">75 Prince St, NY, USA
                                                        </p>
                                                    </a> </figcaption>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><span
                                        aria-label="Previous">‹</span></button><button type="button" role="presentation"
                                    class="owl-next"><span aria-label="Next">›</span></button></div>
                            <div class="owl-dots disabled"></div>
                        </div>
                    </div>
                </div>
            </div> <!-- view all -->
            <div class="view-all">
                <div class="row">
                    <div class="col-12"> 
                    @php
                        $jsonData = [];
                        $name = $url = "";
                        $jsonData = optional(json_decode($home->sixth_section_button, true))[0] ?? [];
                        $name = $jsonData['buttonName'] ?? $button_name;
                        $url = $jsonData['buttonUrl'] ?? $button_url;
                    @endphp
                        <a href="{{$url}}" class="green-btn">{{$name}}</a> </div>
                </div>
            </div>
        </div>
    </section> <!-- section -->
    @endif
    @if($home->section_7)
    <section class="Brands-sec">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="heading-pnel m-0">
                        <h2 class="m-0">
                            @php
                            $new_heading = "";
                            $heading = $home->seventh_heading;
                            $words = explode(' ', $heading);
                            $last_word = array_pop($words);
                            $new_heading = implode(' ', $words) . ' <br>' . $last_word ;
                            @endphp

                            {!! $new_heading !!}
                        </h2>
                        <div class="headingBorder"></div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="owl-carousel owl-loaded owl-drag" id="Brands">





                        <div class="owl-stage-outer owl-height" style="height: 60px;">
                            <div class="owl-stage"
                                style="transform: translate3d(-950px, 0px, 0px); transition: 0.25s; width: 2850px;">
                                <div class="owl-item cloned" style="width: 170px; margin-right: 20px;">
                                    <div class="brand-box"> <img src="{{ asset('img/1(3).png') }}" class=""
                                            alt=""> </div>
                                </div>
                                <div class="owl-item cloned" style="width: 170px; margin-right: 20px;">
                                    <div class="brand-box"> <img src="{{ asset('img/2(3).png') }}" class=""
                                            alt=""> </div>
                                </div>
                                <div class="owl-item cloned" style="width: 170px; margin-right: 20px;">
                                    <div class="brand-box"> <img src="{{ asset('img/3(3).png') }}" class=""
                                            alt=""> </div>
                                </div>
                                <div class="owl-item cloned" style="width: 170px; margin-right: 20px;">
                                    <div class="brand-box"> <img src="{{ asset('img/4(3).png') }}" class=""
                                            alt=""> </div>
                                </div>
                                <div class="owl-item cloned" style="width: 170px; margin-right: 20px;">
                                    <div class="brand-box"> <img src="{{ asset('img/5.png') }}" class=""
                                            alt=""> </div>
                                </div>
                                <div class="owl-item active" style="width: 170px; margin-right: 20px;">
                                    <div class="brand-box"> <img src="{{ asset('img/1(3).png') }}" class=""
                                            alt=""> </div>
                                </div>
                                <div class="owl-item active" style="width: 170px; margin-right: 20px;">
                                    <div class="brand-box"> <img src="{{ asset('img/2(3).png') }}" class=""
                                            alt=""> </div>
                                </div>
                                <div class="owl-item active" style="width: 170px; margin-right: 20px;">
                                    <div class="brand-box"> <img src="{{ asset('img/3(3).png') }}" class=""
                                            alt=""> </div>
                                </div>
                                <div class="owl-item active" style="width: 170px; margin-right: 20px;">
                                    <div class="brand-box"> <img src="{{ asset('img/4(3).png') }}" class=""
                                            alt=""> </div>
                                </div>
                                <div class="owl-item active" style="width: 170px; margin-right: 20px;">
                                    <div class="brand-box"> <img src="{{ asset('img/5.png') }}" class=""
                                            alt=""> </div>
                                </div>
                                <div class="owl-item cloned" style="width: 170px; margin-right: 20px;">
                                    <div class="brand-box"> <img src="{{ asset('img/1(3).png') }}" class=""
                                            alt=""> </div>
                                </div>
                                <div class="owl-item cloned" style="width: 170px; margin-right: 20px;">
                                    <div class="brand-box"> <img src="{{ asset('img/2(3).png') }}" class=""
                                            alt=""> </div>
                                </div>
                                <div class="owl-item cloned" style="width: 170px; margin-right: 20px;">
                                    <div class="brand-box"> <img src="{{ asset('img/3(3).png') }}" class=""
                                            alt=""> </div>
                                </div>
                                <div class="owl-item cloned" style="width: 170px; margin-right: 20px;">
                                    <div class="brand-box"> <img src="{{ asset('img/4(3).png') }}" class=""
                                            alt=""> </div>
                                </div>
                                <div class="owl-item cloned" style="width: 170px; margin-right: 20px;">
                                    <div class="brand-box"> <img src="{{ asset('img/5.png') }}" class=""
                                            alt=""> </div>
                                </div>
                            </div>
                        </div>
                        <div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span
                                    aria-label="Previous">‹</span></button><button type="button" role="presentation"
                                class="owl-next"><span aria-label="Next">›</span></button></div>
                        <div class="owl-dots disabled"></div>
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- section -->
    @endif
    @if($home->section_8)
    <section class="space full-width-sec" style="background-image:url(img/full-img.png);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="heading-pnel fff">
                        <h2 class="m-0">{{$home->eighth_heading}}</h2>
                        <p>{{ Str::words($home->eighth_description, 45, '...') }}</p>
                        <div class="btn-grp"> 
                              @php
                                $jsonData = [];
                                $name = $url = "";
                                $jsonData = optional(json_decode($home->eighth_section_button, true))[0] ?? [];
                                $name = $jsonData['buttonName'] ?? $button_name;
                                $url = $jsonData['buttonUrl'] ?? $button_url;
                            @endphp
                            <a href="{{$url}}" class="border-btn fff">{{$name}}</a>
                            @php
                                $jsonData = [];
                                $name = $url = "";
                                $jsonData = optional(json_decode($home->eighth_section_button, true))[1] ?? [];
                                $name = $jsonData['buttonName'] ?? $button_name;
                                $url = $jsonData['buttonUrl'] ?? $button_url;
                            @endphp 
                            <a href="{{$url}}" class="border-btn fff">{{$name}}</a> </div>
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- section -->
    @endif
    @if($home->section_9)
    <section class="space blogs-sec">
        <div class="container">
            <div class="heading-pnel HeadingMiddleBorder">
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <h2 class="m-0">{{ $home->ninth_heading }}</h2>
                    </div>
                    <div class="col-lg-4 col-12 mobile-none">
                        <div class="head-btn"> <a href="#" class="border-btn">View all blogs</a> </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-6">
                    <div class="blog-box">
                        <figure> <img src="{{ asset('img/1(4).png') }}" class="" alt=""> </figure>
                        <figcaption> <span>20 APR 2024</span> <a href="#">
                                <h4>Luxurious Al Barari: A Premier Choice in Dubai's Real Estate Market</h4>
                            </a> </figcaption>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-6">
                    <div class="blog-box">
                        <figure> <img src="{{ asset('img/2(4).png') }}" class="" alt=""> </figure>
                        <figcaption> <span>20 APR 2024</span> <a href="#">
                                <h4>Luxurious Al Barari: A Premier Choice in Dubai's Real Estate Market</h4>
                            </a> </figcaption>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-6">
                    <div class="blog-box">
                        <figure> <img src="{{ asset('img/3(4).png') }}" class="" alt=""> </figure>
                        <figcaption> <span>20 APR 2024</span> <a href="#">
                                <h4>Luxurious Al Barari: A Premier Choice in Dubai's Real Estate Market</h4>
                            </a> </figcaption>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-6">
                    <div class="blog-box">
                        <figure> <img src="{{ asset('img/4(4).png') }}" class="" alt=""> </figure>
                        <figcaption> <span>20 APR 2024</span> <a href="#">
                                <h4>Luxurious Al Barari: A Premier Choice in Dubai's Real Estate Market</h4>
                            </a> </figcaption>
                    </div>
                </div>
            </div> <!-- view all -->
            <div class="view-all desktop-none">
                <div class="row">
                    <div class="col-12"> <a href="#" class="green-btn">View all blogs</a> </div>
                </div>
            </div>
        </div>
    </section> <!-- section -->
    @endif
    @if($home->section_10)

    <section class="CTA-strip">
        <div class="container">
            <div class="row"  style="background-image: url('{{ $home->tenth_section_image ? asset($home->tenth_section_image) : asset('img/Home-banner.png') }}');">
                <div class="col-lg-6">
                    <div class="heading-pnel fff m-0">
                        <h2 class="m-0">{{ $home->tenth_heading }}</h2>
                        <p>{{ $home->tenth_description }}</p> 
                            @php
                                $jsonData = [];
                                $name = $url = "";
                                $jsonData = optional(json_decode($home->tenth_section_button, true))[0] ?? [];
                                $name = $jsonData['buttonName'] ?? $button_name;
                                $url = $jsonData['buttonUrl'] ?? $button_url;
                            @endphp 
                        <a
                            href="{{$url}}" class="green-btn fff">{{$name}}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <div class="mt-4">
        @include('faq')        
    </div>
    <!-- back to top -->

<!-- Modal -->
<div class="modal fade" id="search-modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body"> <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close"> <span aria-hidden="true">×</span> </button>
                <div class="search-container">
                    <div class="TopTabsBar">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item"> <a class="nav-link active" id="home-tab" data-toggle="tab"
                                    href="#Buy-two" role="tab" aria-controls="home"
                                    aria-selected="true">Buy</a> </li>
                            <li class="nav-item"> <a class="nav-link" id="profile-tab" data-toggle="tab"
                                    href="#Rent-two" role="tab" aria-controls="profile"
                                    aria-selected="false">Rent</a> </li>
                        </ul>
                    </div> <!-- tab content -->
                    <div class="tab-content" id="myTabContent">
                        <div id="Buy-two" class="tab-pane fade show active" role="tabpanel"
                            aria-labelledby="home-tab">
                            <form action="#">
                                <div class="BookingBox">
                                    <div class="BookingLocation">
                                        <div class="BookingFrom"> <input type="" name=""
                                                class="form-control" placeholder="Search country and city...">
                                        </div>
                                        <div class="BookingFrom p-0"> <select class="form-control">
                                                <option>Property Type</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select> </div>
                                        <div class="BookingFrom p-0"> <select class="form-control">
                                                <option>Buy</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select> </div>
                                        <div class="BookingFrom p-0"> <select class="form-control">
                                                <option>Beds</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select> </div>
                                        <div class="BookingFrom p-0"> <select class="form-control">
                                                <option>Price</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select> </div>
                                        <div class="BookingFromBtn"> <a href="#"><img
                                                    src="{{ asset('img/search.svg') }}"> Search</a> </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="Rent-two" class="tab-pane fade">
                            <form action="#">
                                <div class="BookingBox">
                                    <div class="BookingLocation">
                                        <div class="BookingFrom"> <input type="" name=""
                                                class="form-control" placeholder="Search country and city...">
                                        </div>
                                        <div class="BookingFrom p-0"> <select class="form-control">
                                                <option>Property Type</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select> </div>
                                        <div class="BookingFrom p-0"> <select class="form-control">
                                                <option>Buy</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select> </div>
                                        <div class="BookingFrom p-0"> <select class="form-control">
                                                <option>Beds</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select> </div>
                                        <div class="BookingFrom p-0"> <select class="form-control">
                                                <option>Price</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select> </div>
                                        <div class="BookingFromBtn"> <a href="#"><img
                                                    src="{{ asset('img/search.svg') }}"> Search</a> </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
