@extends('layouts.app')

@php
  $page_name = $data['detail']->page_name ?? $data['page_title'] ?? 'Home Page';
    if(isset($home->meta_title) && !empty($home->meta_title)){
        $page_name = $home->meta_title;
    }
@endphp

@php
 $wish = getWhishList()
@endphp

@section('title', $page_name)
@section('meta')
  @if(isset($data['detail']->meta_tags) && !empty($data['detail']->meta_tags))
      {!! $data['detail']->meta_tags !!}
  @endif
  @if(isset($home->meta_title) && !empty($home->meta_title))
    <meta property="og:title" content="{{$page_name}}" />
  @endif
  @if(isset($home->meta_description) && !empty($home->meta_description))
    <meta property="og:description" content="{{ $home->meta_description }}" />
  @endif
@endsection

@section('content')

@if($home->section_1)
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
                    {!! searchBox() !!}
                </div>
            </div>
        </div>
    </section>
    @endif

    
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
                            <p>{!! Str::words($home->second_description, 45, '...') !!}</p> <a
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
                            <div class="owl-carousel" id="instructor-slider">

                                         @if(isset($featured_properties) && !empty($featured_properties))
                                            @foreach($featured_properties as $featured)
                                <div class="item">
                                    <div class="card-box"> 
                                        
                                            <figure>
                                                <div class="VillaText">
                                                    <p>Villa</p>
                                                </div>
                                                <a href="{{ route('detail.page',$featured->slug) }}">
                                                    @if($featured->featured_image)
                                                        <img src="{{ asset($featured->featured_image) }}" alt="Featured Image">
                                                    @else
                                                        <img src="{{ asset('img/list/3.png') }}" alt="Featured Image">
                                                    @endif  
                                                </a>
                                                <div class="Wishlist {{ in_array(route('detail.page', $featured->slug), $wish) ? 'added' : '' }}" 
                                                    data-id="{{ $featured->id }}" 
                                                    data-type="{{ $featured->property_source }}" 
                                                    data-url="{{ route('detail.page', $featured->slug) }}"  
                                                    data-auth="{{ isset(auth()->user()->id) ? auth()->user()->id : '' }}">
                                                    <img class="heart-o-icon" src="{{ asset('img/heart-o.svg') }}">
                                                    <img src="{{ asset('img/heart.svg') }}" class="heart-icon">
                                                </div>

                                            </figure>
                                      
                                        <figcaption>
                                            <a href="#">
                                                <h3>{{ $featured->name }}</h3>
                                                <span class="d-flex align-items-start"><img  style="width: 12px;margin-right: 7px;margin-top: 6px;" src="{{ asset('img/map.svg') }}"><span>{!! $featured->address !!}</span></span>
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
                                                <h6><span>AED</span> {{ number_format($featured->sale_price) }}/-</h6>
                                            </a>
                                        </figcaption>
                                    </div>
                                </div>
                            @endforeach
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
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
                        <p>{!! $home->fourth_description !!}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @if(isset($private_properties) && !empty($private_properties))
                    @foreach($private_properties as $private)
                        <div class="col">
                            <div class="office-box"> <a href="{{ route('private.detail_page',$private->slug) }}"> 
                                    <figure> <img src="{{ asset($private->featured_image) }}" class="" alt=""></figure>
                                        <figcaption>
                                            <div class="add-grp">
                                                @if(isset($private->propertyType->type_name) && $private->propertyType->type_name)
                                                    <div class="VillaText">{{ $private->propertyType->type_name ?? "" }}</div>
                                                @endif
                                                @if($private->address)
                                                <p><img src="{{ asset('img/map.svg') }}">{!! strip_tags($private->address) !!}</p>
                                                @endif
                                            </div>
                                            <h3>{{ $private->name }}</h3>
                                            <div class="HotelViews">
                                                <ul>
                                                    @if($private->area)
                                                    <li><img src="img/hotel/1.svg"> {{ number_format($private->area) }} SQ FT</li>
                                                    @endif
                                                    @if($private->bed)
                                                    <li><img src="img/hotel/2.svg"> {{ $private->bed }}</li>
                                                    @endif
                                                    @if($private->jacuzzi)
                                                    <li><img src="img/hotel/3.svg"> {{ $private->jacuzzi }}</li>
                                                    @endif
                                                </ul>
                                            </div>
                                            <h6><span>AED</span> {{ number_format($private->sale_price) }}/-</h6>
                                        </figcaption>
                                    
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
                        <p>{!! Str::words($home->fourth_description, 45, '...') !!}</p>
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
                                                <div class="VillaText">                                                
                                                Villa</div>
                                                <p><img src="{{ asset('img/map.svg') }}">{!! strip_tags($private->address) !!}</p>
                                            </div>
                                            <h3>{{ $private->name }}</h3>
                                            <div class="HotelViews">
                                                <ul>
                                                    <li><img src="{{ asset('img/1.svg') }}"> {{ number_format($private->area) }} SQ FT</li>
                                                    <li><img src="{{ asset('img/2.svg') }}"> {{ $private->bed }}</li>
                                                    <li><img src="{{ asset('img/3.svg') }}"> {{ $private->jacuzzi }}</li>
                                                </ul>
                                            </div>
                                            <h6><span>AED</span> {{ number_format($private->sale_price) }}/-</h6>
                                        </figcaption>
                                    </figure>
                                </a> </div>
                        </div>                        
                    @endforeach
                @endif
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
            <div class="international-main" id="international-main" 
     style="background-image: url('{{ $home->fifth_section_image ? asset($home->fifth_section_image) : asset('img/international-bg.png') }}');">
                <div class="row">
                    <div class="col-12">
                        <div class="tabs-grp">
                            <ul class="nav nav-tabs" id="myTab0" role="tablist">
                                @if(isset($regions) && !empty($regions))
                                    @php $first1 = true; @endphp
                                    @foreach($regions as $item)
                                        <li class="nav-item" role="presentation"> 
                                            <a class="nav-link {{ $first1 ? 'active' : '' }}" id="Africa-tab{{ $item->id }}"
                                            data-toggle="tab" data-image="{{ asset($item->image_url) }}" 
                                            data-target="#Africa{{ $item->id }}" type="button" role="tab"
                                            aria-controls="home" aria-selected="true">{{ $item->name }}</a> 
                                        </li>
                                        @php $first1 = false; @endphp
                                    @endforeach
                                @endif
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                @if(isset($regions) && !empty($regions))
                                    @php $first = true; @endphp
                                    @foreach($regions as $item)
                                        <div class="tab-pane fade {{ $first ? 'show active' : '' }}" 
                                            id="Africa{{ $item->id }}" role="tabpanel"
                                            aria-labelledby="Africa-tab{{ $item->id }}">
                                            <div class="tabs-caption fff">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-8 col-12">
                                                        <div class="heading-pnel m-0 fff">
                                                            <h2 class="m-0">{{ $item->name }}</h2>
                                                            <p>{!! Str::words($item->description, 45, '...') !!}</p>
                                                            <div class="btn-grp"> 
                                                                        
                                                                <a href="{{ route('search') }}?prop_for=international&region={{$item->id}}" class="border-btn fff">{{$name}}</a> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php $first = false; @endphp
                                    @endforeach
                                @endif  
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
                            <div class="owl-carousel" id="NewDevelopment">
                                
                                @if(isset($project_propertie) && !empty($project_propertie))
                                        @foreach($project_propertie as $item)
                                <div class="item">
                                    <div class="new-development card-box"> 
                                              <figure><a href="{{ route('devlopment.detail_page',$item->slug) }}"><img src="{{ asset($item->featured_image) }}" class=""
                                                                alt=""></a>
                                                                <div class="Wishlist {{ in_array(route('devlopment.detail_page',$item->slug), $wish) ? 'added' : '' }}" 
                                                                    data-id="{{ $item->id }}" 
                                                                    data-type="{{ $item->property_source }}" 
                                                                    data-url="{{ route('devlopment.detail_page', $item->slug) }}"  
                                                                    data-auth="{{ isset(auth()->user()->id) ? auth()->user()->id : '' }}">
                                                                    <img class="heart-o-icon" src="{{ asset('img/heart-o.svg') }}">
                                                                    <img src="{{ asset('img/heart.svg') }}" class="heart-icon">
                                                                </div>
                                                        </figure>
                                         <figcaption> <a href="{{ route('devlopment.detail_page',$item->slug) }}">
                                                            <h3>{{ $item->name }}</h3>
                                                            <p><img src="{{ asset('img/map.svg') }}">{!! strip_tags($item->address) !!}</p>
                                                        </a> </figcaption>
                                    </div>
                                </div>
                                @endforeach
                                @endif
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
    @php
        $new_heading = "";
        $heading = $home->seventh_heading;
        $words = explode(' ', $heading);
        $last_word = array_pop($words);
        $new_heading = implode(' ', $words) . ' <br>' . $last_word ;
        @endphp


    
        {!! mediaSection('all',$new_heading); !!}
        
     <!-- section -->
    @endif
    @if($home->section_8)
    <section class="space full-width-sec" style="background-image:url(img/full-img.png);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="heading-pnel fff">
                        <h2 class="m-0">{{$home->eighth_heading}}</h2>
                        <p>{!! Str::words($home->eighth_description, 45, '...') !!}</p>
                        <div class="btn-grp"> 
                              @php
                                $jsonData = [];
                                $name = $url = "";
                                $jsonData = optional(json_decode($home->eighth_section_button, true))[0] ?? [];
                                $name = $jsonData['buttonName'] ?? "";
                                $url = $jsonData['buttonUrl'] ?? "";
                            @endphp
                            @if($name && $url)
                            <a href="{{$url}}" class="border-btn fff">{{$name}}</a>
                            @endif
                            @php
                                $jsonData = [];
                                $name = $url = "";
                                $jsonData = optional(json_decode($home->eighth_section_button, true))[1] ?? [];
                                $name = $jsonData['buttonName'] ?? "";
                                $url = $jsonData['buttonUrl'] ?? "";
                            @endphp
                            @if($name && $url)
                            <a href="{{$url}}" class="border-btn fff">{{$name}}</a> </div>
                            @endif
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
                    @if($home->blog_section_button && $home->blog_section_button_2)
                    <div class="col-lg-4 col-12 mobile-none">
                        <div class="head-btn"> <a href="{{ $home->blog_section_button_2 }}" class="border-btn">{{ $home->blog_section_button }}</a> </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="row">
                @if(isset($posts) && !empty($posts))
                    @foreach($posts as $item)
                        @php 
                            $imageLinks = $item->images;

                            $imageArray = explode(',', $imageLinks);

                            $firstImage = isset($imageArray[0]) ? $imageArray[0] : null;
                        @endphp
                        <div class="col-lg-3 col-md-6 col-6">
                            <div class="blog-box">
                                <figure> <a href="{{ $item->slug ? route('blog', ['slug' => $item->slug]) : '#' }}"><img alt="Image not found" onerror="this.onerror=null; this.src='{{ asset('featured_images/featured_image_1731072533.jpg') }}';"  src="{{ asset('post/'.$firstImage) }}" class="w-100" alt=""></a> </figure>
                                <figcaption> <span style="text-transform: uppercase;">{{ $item->created_at->format('d M Y') }}</span> <a href="{{ $item->slug ? route('blog', ['slug' => $item->slug]) : '#' }}">
                                        <h4>{!! Str::words($item->name, 10, '...') !!}</h4> 
                                    </a> </figcaption>
                            </div>
                        </div>        
                    @endforeach
                @endif
               
            </div> <!-- view all -->
            <div class="view-all desktop-none">
                <div class="row">
                    <div class="col-12"> <a href="{{ $home->blog_section_button_2 }}" class="green-btn">{{ $home->blog_section_button }}</a> </div>
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
                        <p>{!! $home->tenth_description !!}</p> 
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
    <div class="mt-4 home_page_old">
        @include('faq', ['page_name' => 'home'])        
    </div>
    <!-- back to top -->


@endsection
@section('scripts')   
<script>
    // Ensure the document is ready before executing the script
    jQuery(document).ready(function() {
        // On tab click
        $('#myTab0 a').on('click', function() {
            // Get the background image URL from the clicked tab's data-image attribute
            var newImage = $(this).data('image');
            // Set the background image of the international-main div
            $('#international-main').css('background-image', 'url(' + newImage + ')');
        });
    });
</script>
@endsection
