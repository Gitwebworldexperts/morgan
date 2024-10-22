@extends('layouts.app')
@section('title', $foundProperty['page_title'] ?? '')
@section('content')
<section class="breadcrumb-sec">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="bread-container">
            <ul>
              <li>
                <a href="" class="">Home</a>
              </li>
              <li>
                <a href="" class="">Real Estate</a>
              </li>
              <li>
                <a href="" class="">United States</a>
              </li>
              <li>
                <a href="" class="">Colorado</a>
              </li>
              <li>
                <a href="" class="">Franktown</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  @if($foundProperty->featured_image)

  <section class="property-gallery-sec space pb-0">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="gallery-grid" id="aniimated-thumbnials">
            <div class="gallery-topbar">
              <div class="topbar-left">
                <p class="category-label">{{ $foundProperty->propertyType->type_name ?? $foundProperty->propertyType->type_name }}</p>
                <div class="Wishlist">
                  <img class="heart-o-icon" src="/img/hotel/heart-o.svg">
                  <img src="/img/hotel/heart.svg" class="heart-icon">
                </div>
              </div>
              <div class="topbar-right">
                <a href="" class="share-btn">
                  <img src="/img/share-dark.svg">
                </a>
              </div>
            </div>

            @if($foundProperty->featured_image)
            <a href="{{ $foundProperty->featured_image }}" id="gallery-item-1">
                <div class="Big_Gallery">
                  <img decoding="async" src="{{ asset($foundProperty->featured_image) }}" class="img-fluid">
                </div>
            </a>
            @endif
            @if(isset($foundProperty->banners) && !empty($foundProperty->banners))
                @foreach ($foundProperty->banners as $key => $item)
                    <a href="{{ asset($item->image_url) }}" id="gallery-item-{{$key}}">
                        <div class="Small_Gallery">
                          <img decoding="async" src="{{ asset($item->image_url) }}" class="img-fluid" alt="" />
                        </div>
                    </a>
                @endforeach
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>
  @endif
 
  <section class="space blog-detail-page">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="content-wrapper">
            <h2 class="mt-0">{{ $foundProperty->name }}</h2>
            <p>
              <img src="/img/hotel/map.svg"> {{ strip_tags($foundProperty->address) }}
            </p>
            <div class="price-amenitity">
              <h3>${{ number_format($foundProperty->sale_price) }}/-</h3>
              <div class="main-amenity">
                <div class="amenity-box">
                  <div class="amenty-img">
                    <img src="/img/square.svg" class="" alt="">
                  </div>
                  <p>{{ number_format($foundProperty->area) }} SQ FT</p>
                </div>
                <div class="amenity-box">
                  <div class="amenty-img">
                    <img src="/img/bed.svg" class="" alt="">
                  </div>
                  <p>{{ $foundProperty->bed }} Beds</p>
                </div>
                <div class="amenity-box">
                  <div class="amenty-img">
                    <img src="/img/bathtub.svg" class="" alt="">
                  </div>
                  <p>{{ $foundProperty->jacuzzi }} Bathrooms</p>
                </div>
              </div>
            </div>
            <div class="seperator"></div>
            <h5>Description</h5>
            <p>{!! $foundProperty->description !!}<a href="" class="link-btn" style="text-decoration:none;">Read more</a>
            </p>
            <div class="seperator"></div>
            <div class="ameneties-panel">
              <h5>Amenities</h5>
              <div class="ameneties-items">
                <div class="ameneties-item">
                  <img src="/img/check.svg">
                  <p>Air Conditioning</p>
                </div>
                <div class="ameneties-item">
                  <img src="/img/check.svg">
                  <p>Central Heating</p>
                </div>
                <div class="ameneties-item">
                  <img src="/img/check.svg">
                  <p>Internet</p>
                </div>
                <div class="ameneties-item">
                  <img src="/img/check.svg">
                  <p>Alarm System</p>
                </div>
                <div class="ameneties-item">
                  <img src="/img/check.svg">
                  <p>Free WiFi</p>
                </div>
                <div class="ameneties-item">
                  <img src="/img/check.svg">
                  <p>Car Parking</p>
                </div>
                <div class="ameneties-item">
                  <img src="/img/check.svg">
                  <p>Gym </p>
                </div>
                <div class="ameneties-item">
                  <img src="/img/check.svg">
                  <p>Window Covering</p>
                </div>
              </div>
            </div>
            <div class="seperator"></div>
            <div class="property-location">
              <h5>Property Location</h5>
              <p>{!! $foundProperty->address !!}</p>
              {!! $foundProperty->google_maps_link !!}
            </div>
            <!-- <div class="company-info"> -->
              <!-- <h5>Company Name</h5> -->
              <!-- <p>Luxury is front and centre throughout every aspect of this beautiful beachfront mansion. Expertly designed, this custom-built villa has an aura of excellence and serenity that will make it a dream family home. Inside the layout is spacious and modern with a double height ceiling reception room that immediately.</p> -->
              <!-- <h5>Developer Track Record</h5> -->
              <!-- <div class="record-boxes"> -->
                <!-- <div class="record-box"> -->
                  <!-- <h3>20</h3> -->
                  <!-- <p>Total Projects</p> -->
                <!-- </div> -->
                <!-- <div class="record-box"> -->
                  <!-- <h3>414</h3> -->
                  <!-- <p>Units Handed Over</p> -->
                <!-- </div> -->
                <!-- <div class="record-box"> -->
                  <!-- <h3>06</h3> -->
                  <!-- <p>Under Construction</p> -->
                <!-- </div> -->
              <!-- </div> -->
              <!-- <a href="" class="link-btn">Browse more developments by company name</a> -->
            <!-- </div> -->
          </div>
        </div>
        <div class="col-lg-4">
          <div class="new-p-detail-right">
           
            <div class="list-from">
              <h3 class="mb-2">Register Your Interest</h3>
              @if(session('success'))
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>
              @endif
              @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
              {{-- {!! renderInterestForm() !!} --}}

              {{-- {!! renderInterestForm('apply_job') !!} --}}

              {!! renderInterestForm('listing_form') !!}
              
            </div>
            @if(isset($agent) && !empty($agent))
            <div class="agent-panel">
              <div class="agent-info">
                <figure>
                  <img src="{{ asset($agent->photo) }}" alt="" class="">
                </figure>
                <figcaption>
                  <h3>{{ $agent->name }}</h3>
                  <p>Senior Consultant</p>
                </figcaption>
              </div>
              <div class="agent-contact-btn">
                <a href="https://wa.me/{{$agent->mobile}}" target="_blank" class="light-btn">
                  <img src="/img/whatsapp-dark.png" alt="" class=""> Whatsapp </a>
                <a href="tel:{{$agent->phone}}" class="light-btn">
                  <img src="/img/call-dark.png" alt="" class=""> Call Us Now! </a>
              </div>
            </div>
            @endif
            <div class="download-btn-grp">
              <a href="javascript:void(0);" onclick="checkAndDownload('{{$foundProperty->floor_plan}}', 'floor plan', event)" class="light-btn w-100 mb-3">
                <img src="/img/download-dark.svg" class=""> Download floor plans
            </a>
            <a href="javascript:void(0);" onclick="checkAndDownload('{{$foundProperty->brochure}}', 'brochure', event)" class="green-btn w-100">
                <img src="/img/download-light.svg" class=""> Download the brochure
            </a>              
            </div>
          </div>
        </div>
        <div class="seperator"></div>
        <div class="col-12">
          <div class="dark-report-sec">
            <div class="dark-report-main">
              <div class="row no-gutters">
                <div class="col-lg-7 col-12">
                  <div class="heading-pnel fff mb-0">
                    <div class="dark-report-content">
                      <h2 class="mb-3">{{ $foundProperty->information_heading }}</h2>
                      <p class="mb-4">{!! $foundProperty->information_description !!}</p>
                      <img src="/img/stroke-building.png" class="stroke-building" alt="">
                      <div class="report-grp-btn d-flex" style="gap:10px;">
                        @if($foundProperty->information_button_label && $foundProperty->information_button_url)
                          <a href="{{$foundProperty->information_button_url}}" class="light-btn">{{$foundProperty->information_button_label}}</a>
                        @endif
                        <a href="" class="light-btn">Read more</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-5 col-12 order--1">
                  <div class="dark-report-img">
                    <img src="/img/login-image.png" class="w-100" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

</section>

<section class="space position-relative pt-0">
    <div class="container">
      <div class="heading-pnel HeadingMiddleBorder">
        <div class="row">
          <div class="col-lg-8 col-12">
            <h2 class="m-0">More Properties</h2>
          </div>
          <div class="col-lg-4 col-12"></div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="cards-main">
            <div class="owl-carousel owl-loaded owl-drag" id="instructor-slider">
              
              
              
              
              
            <div class="owl-stage-outer owl-height" style="height: 468.344px;"><div class="owl-stage" style="transform: translate3d(-1270px, 0px, 0px); transition: all; width: 4128px;"><div class="owl-item cloned" style="width: 297.5px; margin-right: 20px;"><div class="item">
                <div class="card-box">
                  <a href="#">
                    <figure>
                      <div class="VillaText">
                        <p>Villa</p>
                      </div>
                      <img src="/img/list/2.png" class="" alt="">
                      <div class="Wishlist">
                        <img class="heart-o-icon" src="/img/hotel/heart-o.svg">
                        <img src="/img/hotel/heart.svg" class="heart-icon">
                      </div>
                    </figure>
                  </a>
                  <figcaption>
                    <a href="#">
                      <h3>Stunning 4-Bedroom I Full Sea View</h3>
                      <p>
                        <img src="/img/hotel/map.svg">75 Prince St, NY, USA
                      </p>
                      <div class="HotelViews">
                        <ul>
                          <li>
                            <img src="/img/hotel/1.svg"> 7228 SQ FT
                          </li>
                          <li>
                            <img src="/img/hotel/2.svg"> 2
                          </li>
                          <li>
                            <img src="/img/hotel/3.svg"> 2
                          </li>
                        </ul>
                      </div>
                      <h6>
                        <span>$</span> 195,000,000/-
                      </h6>
                    </a>
                  </figcaption>
                </div>
              </div></div><div class="owl-item cloned" style="width: 297.5px; margin-right: 20px;"><div class="item">
                <div class="card-box">
                  <a href="#">
                    <figure>
                      <div class="VillaText">
                        <p>Villa</p>
                      </div>
                      <img src="/img/list/3.png" class="" alt="">
                      <div class="Wishlist">
                        <img class="heart-o-icon" src="/img/hotel/heart-o.svg">
                        <img src="/img/hotel/heart.svg" class="heart-icon">
                      </div>
                    </figure>
                  </a>
                  <figcaption>
                    <a href="#">
                      <h3>Stunning 4-Bedroom I Full Sea View</h3>
                      <p>
                        <img src="/img/hotel/map.svg">75 Prince St, NY, USA
                      </p>
                      <div class="HotelViews">
                        <ul>
                          <li>
                            <img src="/img/hotel/1.svg"> 7228 SQ FT
                          </li>
                          <li>
                            <img src="/img/hotel/2.svg"> 2
                          </li>
                          <li>
                            <img src="/img/hotel/3.svg"> 2
                          </li>
                        </ul>
                      </div>
                      <h6>
                        <span>$</span> 195,000,000/-
                      </h6>
                    </a>
                  </figcaption>
                </div>
              </div></div><div class="owl-item cloned" style="width: 297.5px; margin-right: 20px;"><div class="item">
                <div class="card-box">
                  <a href="#">
                    <figure>
                      <div class="VillaText">
                        <p>Villa</p>
                      </div>
                      <img src="/img/list/4.png" class="" alt="">
                      <div class="Wishlist">
                        <img class="heart-o-icon" src="/img/hotel/heart-o.svg">
                        <img src="/img/hotel/heart.svg" class="heart-icon">
                      </div>
                    </figure>
                  </a>
                  <figcaption>
                    <a href="#">
                      <h3>Stunning 4-Bedroom I Full Sea View</h3>
                      <p>
                        <img src="/img/hotel/map.svg">75 Prince St, NY, USA
                      </p>
                      <div class="HotelViews">
                        <ul>
                          <li>
                            <img src="/img/hotel/1.svg"> 7228 SQ FT
                          </li>
                          <li>
                            <img src="/img/hotel/2.svg"> 2
                          </li>
                          <li>
                            <img src="/img/hotel/3.svg"> 2
                          </li>
                        </ul>
                      </div>
                      <h6>
                        <span>$</span> 195,000,000/-
                      </h6>
                    </a>
                  </figcaption>
                </div>
              </div></div><div class="owl-item cloned" style="width: 297.5px; margin-right: 20px;"><div class="item">
                <div class="card-box">
                  <a href="#">
                    <figure>
                      <div class="VillaText">
                        <p>Villa</p>
                      </div>
                      <img src="/img/list/3.png" class="" alt="">
                      <div class="Wishlist">
                        <img class="heart-o-icon" src="/img/hotel/heart-o.svg">
                        <img src="/img/hotel/heart.svg" class="heart-icon">
                      </div>
                    </figure>
                  </a>
                  <figcaption>
                    <a href="#">
                      <h3>Stunning 4-Bedroom I Full Sea View</h3>
                      <p>
                        <img src="/img/hotel/map.svg">75 Prince St, NY, USA
                      </p>
                      <div class="HotelViews">
                        <ul>
                          <li>
                            <img src="/img/hotel/1.svg"> 7228 SQ FT
                          </li>
                          <li>
                            <img src="/img/hotel/2.svg"> 2
                          </li>
                          <li>
                            <img src="/img/hotel/3.svg"> 2
                          </li>
                        </ul>
                      </div>
                      <h6>
                        <span>$</span> 195,000,000/-
                      </h6>
                    </a>
                  </figcaption>
                </div>
              </div></div><div class="owl-item active" style="width: 297.5px; margin-right: 20px;"><div class="item">
                <div class="card-box">
                  <a href="#">
                    <figure>
                      <div class="VillaText">
                        <p>Villa</p>
                      </div>
                      <img src="/img/list/1.png" class="" alt="">
                      <div class="Wishlist">
                        <img class="heart-o-icon" src="/img/hotel/heart-o.svg">
                        <img src="/img/hotel/heart.svg" class="heart-icon">
                      </div>
                    </figure>
                  </a>
                  <figcaption>
                    <a href="#">
                      <h3>Stunning 4-Bedroom I Full Sea View</h3>
                      <p>
                        <img src="/img/hotel/map.svg">75 Prince St, NY, USA
                      </p>
                      <div class="HotelViews">
                        <ul>
                          <li>
                            <img src="/img/hotel/1.svg"> 7228 SQ FT
                          </li>
                          <li>
                            <img src="/img/hotel/2.svg"> 2
                          </li>
                          <li>
                            <img src="/img/hotel/3.svg"> 2
                          </li>
                        </ul>
                      </div>
                      <h6>
                        <span>$</span> 195,000,000/-
                      </h6>
                    </a>
                  </figcaption>
                </div>
              </div></div><div class="owl-item active" style="width: 297.5px; margin-right: 20px;"><div class="item">
                <div class="card-box">
                  <a href="#">
                    <figure>
                      <div class="VillaText">
                        <p>Villa</p>
                      </div>
                      <img src="/img/list/2.png" class="" alt="">
                      <div class="Wishlist">
                        <img class="heart-o-icon" src="/img/hotel/heart-o.svg">
                        <img src="/img/hotel/heart.svg" class="heart-icon">
                      </div>
                    </figure>
                  </a>
                  <figcaption>
                    <a href="#">
                      <h3>Stunning 4-Bedroom I Full Sea View</h3>
                      <p>
                        <img src="/img/hotel/map.svg">75 Prince St, NY, USA
                      </p>
                      <div class="HotelViews">
                        <ul>
                          <li>
                            <img src="/img/hotel/1.svg"> 7228 SQ FT
                          </li>
                          <li>
                            <img src="/img/hotel/2.svg"> 2
                          </li>
                          <li>
                            <img src="/img/hotel/3.svg"> 2
                          </li>
                        </ul>
                      </div>
                      <h6>
                        <span>$</span> 195,000,000/-
                      </h6>
                    </a>
                  </figcaption>
                </div>
              </div></div><div class="owl-item active" style="width: 297.5px; margin-right: 20px;"><div class="item">
                <div class="card-box">
                  <a href="#">
                    <figure>
                      <div class="VillaText">
                        <p>Villa</p>
                      </div>
                      <img src="/img/list/3.png" class="" alt="">
                      <div class="Wishlist">
                        <img class="heart-o-icon" src="/img/hotel/heart-o.svg">
                        <img src="/img/hotel/heart.svg" class="heart-icon">
                      </div>
                    </figure>
                  </a>
                  <figcaption>
                    <a href="#">
                      <h3>Stunning 4-Bedroom I Full Sea View</h3>
                      <p>
                        <img src="/img/hotel/map.svg">75 Prince St, NY, USA
                      </p>
                      <div class="HotelViews">
                        <ul>
                          <li>
                            <img src="/img/hotel/1.svg"> 7228 SQ FT
                          </li>
                          <li>
                            <img src="/img/hotel/2.svg"> 2
                          </li>
                          <li>
                            <img src="/img/hotel/3.svg"> 2
                          </li>
                        </ul>
                      </div>
                      <h6>
                        <span>$</span> 195,000,000/-
                      </h6>
                    </a>
                  </figcaption>
                </div>
              </div></div><div class="owl-item active" style="width: 297.5px; margin-right: 20px;"><div class="item">
                <div class="card-box">
                  <a href="#">
                    <figure>
                      <div class="VillaText">
                        <p>Villa</p>
                      </div>
                      <img src="/img/list/4.png" class="" alt="">
                      <div class="Wishlist">
                        <img class="heart-o-icon" src="/img/hotel/heart-o.svg">
                        <img src="/img/hotel/heart.svg" class="heart-icon">
                      </div>
                    </figure>
                  </a>
                  <figcaption>
                    <a href="#">
                      <h3>Stunning 4-Bedroom I Full Sea View</h3>
                      <p>
                        <img src="/img/hotel/map.svg">75 Prince St, NY, USA
                      </p>
                      <div class="HotelViews">
                        <ul>
                          <li>
                            <img src="/img/hotel/1.svg"> 7228 SQ FT
                          </li>
                          <li>
                            <img src="/img/hotel/2.svg"> 2
                          </li>
                          <li>
                            <img src="/img/hotel/3.svg"> 2
                          </li>
                        </ul>
                      </div>
                      <h6>
                        <span>$</span> 195,000,000/-
                      </h6>
                    </a>
                  </figcaption>
                </div>
              </div></div><div class="owl-item" style="width: 297.5px; margin-right: 20px;"><div class="item">
                <div class="card-box">
                  <a href="#">
                    <figure>
                      <div class="VillaText">
                        <p>Villa</p>
                      </div>
                      <img src="/img/list/3.png" class="" alt="">
                      <div class="Wishlist">
                        <img class="heart-o-icon" src="/img/hotel/heart-o.svg">
                        <img src="/img/hotel/heart.svg" class="heart-icon">
                      </div>
                    </figure>
                  </a>
                  <figcaption>
                    <a href="#">
                      <h3>Stunning 4-Bedroom I Full Sea View</h3>
                      <p>
                        <img src="/img/hotel/map.svg">75 Prince St, NY, USA
                      </p>
                      <div class="HotelViews">
                        <ul>
                          <li>
                            <img src="/img/hotel/1.svg"> 7228 SQ FT
                          </li>
                          <li>
                            <img src="/img/hotel/2.svg"> 2
                          </li>
                          <li>
                            <img src="/img/hotel/3.svg"> 2
                          </li>
                        </ul>
                      </div>
                      <h6>
                        <span>$</span> 195,000,000/-
                      </h6>
                    </a>
                  </figcaption>
                </div>
              </div></div><div class="owl-item cloned" style="width: 297.5px; margin-right: 20px;"><div class="item">
                <div class="card-box">
                  <a href="#">
                    <figure>
                      <div class="VillaText">
                        <p>Villa</p>
                      </div>
                      <img src="/img/list/1.png" class="" alt="">
                      <div class="Wishlist">
                        <img class="heart-o-icon" src="/img/hotel/heart-o.svg">
                        <img src="/img/hotel/heart.svg" class="heart-icon">
                      </div>
                    </figure>
                  </a>
                  <figcaption>
                    <a href="#">
                      <h3>Stunning 4-Bedroom I Full Sea View</h3>
                      <p>
                        <img src="/img/hotel/map.svg">75 Prince St, NY, USA
                      </p>
                      <div class="HotelViews">
                        <ul>
                          <li>
                            <img src="/img/hotel/1.svg"> 7228 SQ FT
                          </li>
                          <li>
                            <img src="/img/hotel/2.svg"> 2
                          </li>
                          <li>
                            <img src="/img/hotel/3.svg"> 2
                          </li>
                        </ul>
                      </div>
                      <h6>
                        <span>$</span> 195,000,000/-
                      </h6>
                    </a>
                  </figcaption>
                </div>
              </div></div><div class="owl-item cloned" style="width: 297.5px; margin-right: 20px;"><div class="item">
                <div class="card-box">
                  <a href="#">
                    <figure>
                      <div class="VillaText">
                        <p>Villa</p>
                      </div>
                      <img src="/img/list/2.png" class="" alt="">
                      <div class="Wishlist">
                        <img class="heart-o-icon" src="/img/hotel/heart-o.svg">
                        <img src="/img/hotel/heart.svg" class="heart-icon">
                      </div>
                    </figure>
                  </a>
                  <figcaption>
                    <a href="#">
                      <h3>Stunning 4-Bedroom I Full Sea View</h3>
                      <p>
                        <img src="/img/hotel/map.svg">75 Prince St, NY, USA
                      </p>
                      <div class="HotelViews">
                        <ul>
                          <li>
                            <img src="/img/hotel/1.svg"> 7228 SQ FT
                          </li>
                          <li>
                            <img src="/img/hotel/2.svg"> 2
                          </li>
                          <li>
                            <img src="/img/hotel/3.svg"> 2
                          </li>
                        </ul>
                      </div>
                      <h6>
                        <span>$</span> 195,000,000/-
                      </h6>
                    </a>
                  </figcaption>
                </div>
              </div></div><div class="owl-item cloned" style="width: 297.5px; margin-right: 20px;"><div class="item">
                <div class="card-box">
                  <a href="#">
                    <figure>
                      <div class="VillaText">
                        <p>Villa</p>
                      </div>
                      <img src="/img/list/3.png" class="" alt="">
                      <div class="Wishlist">
                        <img class="heart-o-icon" src="/img/hotel/heart-o.svg">
                        <img src="/img/hotel/heart.svg" class="heart-icon">
                      </div>
                    </figure>
                  </a>
                  <figcaption>
                    <a href="#">
                      <h3>Stunning 4-Bedroom I Full Sea View</h3>
                      <p>
                        <img src="/img/hotel/map.svg">75 Prince St, NY, USA
                      </p>
                      <div class="HotelViews">
                        <ul>
                          <li>
                            <img src="/img/hotel/1.svg"> 7228 SQ FT
                          </li>
                          <li>
                            <img src="/img/hotel/2.svg"> 2
                          </li>
                          <li>
                            <img src="/img/hotel/3.svg"> 2
                          </li>
                        </ul>
                      </div>
                      <h6>
                        <span>$</span> 195,000,000/-
                      </h6>
                    </a>
                  </figcaption>
                </div>
              </div></div><div class="owl-item cloned" style="width: 297.5px; margin-right: 20px;"><div class="item">
                <div class="card-box">
                  <a href="#">
                    <figure>
                      <div class="VillaText">
                        <p>Villa</p>
                      </div>
                      <img src="/img/list/4.png" class="" alt="">
                      <div class="Wishlist">
                        <img class="heart-o-icon" src="/img/hotel/heart-o.svg">
                        <img src="/img/hotel/heart.svg" class="heart-icon">
                      </div>
                    </figure>
                  </a>
                  <figcaption>
                    <a href="#">
                      <h3>Stunning 4-Bedroom I Full Sea View</h3>
                      <p>
                        <img src="/img/hotel/map.svg">75 Prince St, NY, USA
                      </p>
                      <div class="HotelViews">
                        <ul>
                          <li>
                            <img src="/img/hotel/1.svg"> 7228 SQ FT
                          </li>
                          <li>
                            <img src="/img/hotel/2.svg"> 2
                          </li>
                          <li>
                            <img src="/img/hotel/3.svg"> 2
                          </li>
                        </ul>
                      </div>
                      <h6>
                        <span>$</span> 195,000,000/-
                      </h6>
                    </a>
                  </figcaption>
                </div>
              </div></div></div></div><div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div><div class="owl-dots disabled"></div></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <a id="back2Top" class="top-scroll" title="Back to top" href="#" style="">
    <img src="/img/arrow-right.svg" class="">
  </a>


@endsection

@section('scripts')
<script>
 
$(document).ready(function() {
    $('#contactForm').on('click', function(e) {
        alert('hello');return 1;  
      e.preventDefault(); // Prevent the default form submission

        // Collect form data
        const formData = $(this).serialize();

        // Send the data using AJAX
        $.ajax({
            type: 'POST',
            url: '/contact', // Make sure this matches your route
            data: formData,
            success: function(response) {
                alert(response.success); // Show success message
                $('#contactForm')[0].reset(); // Reset the form
            },
            error: function(xhr) {
                const errors = xhr.responseJSON.errors;
                let errorMessage = '';

                // Handle validation errors
                for (let key in errors) {
                    errorMessage += errors[key].join(', ') + '\n';
                }

                alert(errorMessage); // Show error messages
            }
        });
    });
});
</script>  
@endsection
