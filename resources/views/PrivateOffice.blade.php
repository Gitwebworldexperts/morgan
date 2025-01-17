@extends('layouts.app')
@section('title', $foundProperty['page_title'] ?? '')
@section('meta')

@endsection
@section('content')
<section class="banner inr-banner" style="background-image: url(img/inr-banner.png);">
      <div class="container">
        <div class="slider-info">
          <div class="BannerBox">
            <div class="banner-heading text-center">
              <h1>{{ $privateOffice->name }}</h1>
            </div>
          </div>
        </div>
    </div></section>

    <section class="breadcrumb-sec">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="bread-container">
              <ul>
              <li><a href="{{ route('home') }}" class="">Home</a></li>
                <li><span  class="">Morgan’s Private Office</span></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="advisor-panel bg-brown space">
      <div class="container">

        <div class="row align-items-center">
          <div class="col-lg-8">
            <div class="advisor-main">
              <div class="heading-pnel fff m-0">
                {!! $privateOffice->description !!}
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="advisor-box text-center">
              <figure>
                <img src="{{ asset($privateOffice->expert_image) }}" class="">
              </figure>
              <figcaption>
                <h4>{{ old('expert_name', $privateOffice->expert_name) }}</h4>
                <p>{{ old('expert_post', $privateOffice->expert_post) }}</p>
                <a href="{{ old('contact_link', $privateOffice->contact_link) }}" class="light-btn mx-auto mt-4">Contact</a>
              </figcaption>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="wealth-point-sec space" style="background-image:url(img/wealth/wealth-bg.png);">
      <div class="container">
        <div class="heading-pnel fff text-center">
          <h2>{{ old('section_2_heading', $privateOffice->section_2_heading) }}</h2>
        </div>
        <div class="wealth-main">
          <div class="row align-items-center">
            <div class="col-lg-6">
              <div class="wealth-box">
                <div class="wealth-icon">
                  <img src="img/wealth/1.png" class="" alt="">
                </div>
                {!! $privateOffice->expert_description !!}
              </div>
            </div>

            <div class="col-lg-6">
              <div class="wealth-box">
                <div class="wealth-icon">
                  <img src="img/wealth/2.png" class="" alt="">
                </div>
                {!! $privateOffice->mastery_description !!}
              </div>
            </div>

            <div class="col-lg-6">
              <div class="wealth-box">
                <div class="wealth-icon">
                  <img src="img/wealth/3.png" class="" alt="">
                </div>
                {!! $privateOffice->result_description !!}
              </div>
            </div>

            <div class="col-lg-6">
              <div class="wealth-box">
                <div class="wealth-icon">
                  <img src="img/wealth/4.png" class="" alt="">
                </div>
                {!! $privateOffice->access_description !!}
              </div>
            </div>

            <div class="col-lg-6">
              <div class="wealth-box">
                <div class="wealth-icon">
                  <img src="img/wealth/5.png" class="" alt="">
                </div>
                {!! $privateOffice->confidentiality_description !!}
              </div>
            </div>
            <div class="col-lg-6">
              <div class="wealth-box">
                <div class="wealth-icon">
                  <img src="img/wealth/6.png" class="" alt="">
                </div>
                {!! $privateOffice->legal_description !!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="diversity-sec space bg-black">
      <div class="container">
        <div class="heading-pnel fff text-center">
          <h2>{{ $privateOffice->section_3_heading }}</h2>
        </div>
        @php
            if($privateOffice->input_fields){
                $json = json_decode($privateOffice->input_fields,1);
            }                        
        @endphp
        <div class="row align-items-center">
          <div class="col-12">
            <div class="diversity-main">
            @if(isset($json) && !empty($json))
                @foreach($json as $item)
                    @foreach($item as $key => $value)
                    <div class="diversity-box">
                        <h2>{{ $key }}%</h2>
                        <img src="img/marker2.svg" class="" alt="">
                        <p>{{ $value}}</p>
                    </div>
                    @endforeach
                @endforeach
            @endif


            </div>

          </div>
        </div>
      </div>
    </section>
    <section class="provate-listing-sec bg-brown space dark-page">
      <div class="container">

        <div class="heading-pnel fff HeadingMiddleBorder brown-heading">
          <div class="row">
            <div class="col-lg-8 col-12">
              <h2 class="m-0">Featured Private Listings</h2>
            </div>
            <div class="col-lg-4 col-12">
              <!-- <div class="head-btn"><a href="" class="light-btn ml-auto">
                  <img src="img/filter-dark.svg" class="" alt=""> Filters</a>
              </div> -->
            </div>
          </div>
        </div>

        <div class="private-list-main">
          <div class="row">

          @if(isset($private_properties) && !empty($private_properties))
                @foreach($private_properties as $private)
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="private-list-box">
                            <a href="{{ route('private.detail_page',$private->slug) }}" target="_blank">
                            <figure>
                                <img src="{{ asset($private->featured_image) }}" class="" alt="">
                                <figcaption>
                                <div class="add-grp">
                                  @if(isset($private->propertyType->type_name) && $private->propertyType->type_name)
                                    <div class="VillaText">{{ $private->propertyType->type_name ?? "" }}</div>
                                  @endif
                                  @if($private->address)
                                    <p><img src="img/hotel/map.svg">{!! strip_tags($private->address) !!}</p>
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
                            </figure>
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif
            </div>
        <!-- view all -->
        <div class="view-all">
          <div class="row">
            <div class="col-12"> <a href="{{ route('private.listing') }}" class="light-btn">View all properties</a> </div>
          </div>
        </div>

      
    </section>

@endsection

@section('scripts')

@endsection
