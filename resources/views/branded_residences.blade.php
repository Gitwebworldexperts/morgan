@extends('layouts.app')
@section('title', $foundProperty['page_title'] ?? '')
@section('meta')

@endsection
@php
 $wish = getWhishList()
@endphp
@section('content')
<section class="banner inr-banner" style="background-image: url(img/inr-banner.png);">
        <div class="container">
          <div class="slider-info">
            <div class="BannerBox">
              <div class="banner-heading text-center">
                <h1>Branded Residences</h1>
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
                  <li>
                    <a href="{{ asset('/') }}" class="">Home</a>
                  </li>
                  <li>
                    <span class="">{{ $data['page_data']->page_title ?? 'Branded Residences' }}</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="CTA-strip space">
        <div class="container">
          <div class="row" style="background-image: url('{{ asset($data['page_data']->image) }}');">
            <div class="col-lg-6">
              <div class="heading-pnel fff m-0">
                <h2 class="m-0">{{ $data['page_data']->title }}</h2>
                {!! $data['page_data']->description !!}
                <a href="{{ $data['page_data']->link }}" class="light-btn">Read more</a>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="about-sec after-none space bg-grey">
        <div class="container">
          <div class="heading-pnel text-center">
            <h2>{{ $data['page_data']->heading_1 }}</h2>
          </div>
          <div class="row align-items-center">
            <div class="col-lg-6">
              <div class="about-left">
                <div class="about-img about-img-after">
                  <div class="img-item">
                    <img src="{{ asset($data['page_data']->image_1) }}" alt="" class="w-100">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="about-content">
                {!! $data['page_data']->description_1 !!}
              </div>
            </div>
          </div>
        </div>
        <br>
        <br>
      </section>

      <section class="formula-sec space">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6">
              <div class="formula-content">
                  {!! $data['page_data']->description_2 !!}
              </div>
            </div>
            <div class="col-lg-6">
              <div class="about-right d-none">
                <div class="about-img ">
                  <div class="img-item">
                    <img src="{{ asset($data['page_data']->image_2) }}" alt="" class="w-100">
                  </div>
                </div>
              </div>

              <div class="formula-boxes">
                <div class="formula-box">
                  <figure>
                    <img src="{{ asset($data['page_data']->tripal_win_image_1 ) }}" alt="" class="">
                  </figure>
                  <figcaption>
                    <h3>{{ $data['page_data']->tripal_win_title_1 }}</h3>
                  </figcaption>
                </div>
                <div class="formula-box">
                  <figure>
                    <img src="{{ asset($data['page_data']->tripal_win_image_2 ) }}" alt="" class="">
                  </figure>
                  <figcaption>
                    <h3>{{ $data['page_data']->tripal_win_title_2 }}</h3>
                  </figcaption>
                </div>
                <div class="formula-box center-box">
                  <figure>
                    <img src="{{ asset($data['page_data']->tripal_win_image_3 ) }}" alt="" class="">
                  </figure>
                  <figcaption>
                    <h3>{{ $data['page_data']->tripal_win_title_3 }}</h3>
                  </figcaption>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="residences-type-sec after-none">
        <div class="container">
          <div class="heading-pnel HeadingMiddleBorder">
            <div class="row">
              <div class="col-12">
                <h2 class="m-0">{{ $data['page_data']->heading_3 }}</h2>
              </div>
            </div>
          </div>
          <div class="row">
            @if(isset($data['page_data']->images_3) && !empty($data['page_data']->images_3))
              @foreach($data['page_data']->images_3 as $key => $item)
                <div class="col-lg-3 col-md-6 col-12">
                  <div class="resid-type-box">
                    <div class="type-img">
                      <img src="{{ asset($item) }}" alt="" class="">
                    </div>
                    <div class="type-content">
                      <h3>{{ isset($data['page_data']->headings_3[$key])? $data['page_data']->headings_3[$key] : "" }}</h3>
                    </div>
                  </div>
                </div>
              @endforeach
            @endif
          </div>
        </div>
      </section>

      <section class="space position-relative logo-icon">
            <div class="container">
                <div class="heading-pnel HeadingMiddleBorder">
                    <div class="row">
                        <div class="col-lg-8 col-12">
                            <h2 class="m-0">Featured Branded Residences in Dubai</h2>
                        </div>
                        <div class="col-lg-4 col-12 d-none">
                            <div class="head-btn"><a href="" class="green-btn ml-auto"><img src="img/filter.svg" class="" alt=""> Filters</a></div>
                        </div>
                    </div>
                </div>
                <div class="cards-main">
                  <div class="row">
                      @if (isset($data['property']) && !empty($data['property']) && count($data['property']))
                          @foreach ($data['property'] as $property)
                              <div class="col-lg-3 col-md-6 col-12">
                                  <div class="card-box"> 
                                          <figure>
                                              <div class="VillaText">
                                                  <p>{{ ucfirst(isset($property->propertyType->type_name) ? $property->propertyType->type_name: "Villa") }}</p>
                                              </div> 
                                              @if(isset($property->is_branded) && !empty($property->is_branded))
                                                <a href="{{ route('devlopment.detail_page', $property->slug ?? '#') }}">
                                              @else
                                                <a href="{{ route('detail.page', $property->slug ?? '#') }}">                                              
                                              @endif
                                                
                                              <img src="{{ asset($property->featured_image) }}"
                                                  onerror="this.onerror=null; this.src='{{ asset('img/list/4.png') }}';"
                                                  alt=""></a>

                                                  <div class="Wishlist {{ in_array(route('detail.page',$property->slug), $wish) ? 'added' : '' }}" 
                                                      data-id="{{ $property->id }}" 
                                                      data-type="{{ $property->property_source }}" 
                                                      data-url="{{ route('detail.page', $property->slug) }}"  
                                                      data-auth="{{ isset(auth()->user()->id) ? auth()->user()->id : '' }}">
                                                      <img class="heart-o-icon" src="{{ asset('img/heart-o.svg') }}">
                                                      <img src="{{ asset('img/heart.svg') }}" class="heart-icon">
                                                  </div>


                                          </figure>
                                          <figcaption>
                                      
                                      @if(isset($property->is_branded) && !empty($property->is_branded))
                                                <a href="{{ route('devlopment.detail_page', $property->slug ?? '#') }}">
                                              @else
                                                <a href="{{ route('detail.page', $property->slug ?? '#') }}">                                              
                                              @endif

                                              
                                          <h3>{{ $property->name }}</h3>
                                              <p><img src="{{ asset('img/hotel/map.svg') }}">{!! strip_tags($property->address) !!}</p>
                                          </a>
                                      </figcaption>
                                  </div>
                              </div>
                          @endforeach
                      @endif
                  </div>
              </div>
              @if(isset($data['property']) && !empty($data['property']))
                {{ $data['property']->links('vendor.pagination.custom-pagination') }}
              @endif
            </div>
        </section>

        <section class="dark-report-sec space position-relative pt-0">
        <div class="container">
          <div class="dark-report-main">
            <div class="row">
              <div class="col-lg-7 col-12">
                <div class="heading-pnel fff mb-0">
                  <div class="dark-report-content">
                    <h2 class="mb-3">{{$data['page_data']->title_4}} </h2>
                    <span class="mb-4">{!! $data['page_data']->description_4 !!}</span>
					<img src="img/stroke-building.png" class="stroke-building" alt="">
                    <a href="{{ $data['page_data']->link_4 }}" class="light-btn">Download Dubai Branded Residences Market Report</a>
                  </div>
                </div>
              </div>
              <div class="col-lg-5 col-12 order--1">
                <div class="dark-report-img">
                  <img src="{{ asset($data['page_data']->image_4) }}" class="w-100" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
    
    </section>
    @include('faq', ['page_name' => 'branded'])




@endsection

@section('scripts')

@endsection
