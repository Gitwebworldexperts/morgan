@extends('layouts.app')
@php
  $page_name = $foundProperty['name'] ?? $foundProperty['name'] ?? 'Property Detail Page';
    if(isset($foundProperty['meta_title']) && !empty($foundProperty['meta_title'])){
        $page_name = $foundProperty['meta_title'];
    }
@endphp

@section('title', $page_name)
@php
 $wish = getWhishList()
@endphp

@section('meta')
  @if(isset($data['detail']->meta_tags) && !empty($data['detail']->meta_tags))
      {!! $data['detail']->meta_tags !!}
  @endif
  @if(isset($foundProperty['meta_title']) && !empty($foundProperty['meta_title']))
    <meta property="og:title" content="{{$page_name}}" />
  @endif
  @if(isset($foundProperty['meta_description2']) && !empty($foundProperty['meta_description2']))
    <meta property="og:description" content="{{ $foundProperty['meta_description2'] }}" />
  @endif
@endsection

@php
  if(isset($devlopment)){
    $routeName = 'devlopment.detail_page';
  }elseif(isset($private)){
    $routeName = 'private.detail_page';
  }elseif(isset($investment)){
    $routeName = 'investment.detail_page';
  }
  else{
    $routeName = 'detail.page';
  }

  if($property_type == 'rent'){
    $ListRouteName = route('search', ['prop_for' => 'rent']);
    $ListName = "Rent";
  }elseif($property_type == 'private'){
    $ListRouteName = route('private.listing');
    $ListName = "Private";
  }elseif($property_type == 'project'){
    $ListRouteName = route('devlopment.listing');
    $ListName = "Development";
  }elseif($property_type == 'international'){
    $ListName = "International";
    $ListRouteName = route('search', ['prop_for' => 'international']);
  }elseif($property_type == 'buy'){
    $ListName = "Buy";
    $ListRouteName = route('search', ['prop_for' => 'sales']);
  }elseif($property_type == 'branded'){
    $ListName = "Branded Residences";
    $ListRouteName = route('branded_residences');
  }elseif($property_type == 'investment'){
    $ListName = "Investment";
    $ListRouteName = route('search', ['prop_for' => 'investment']);    
  }
@endphp
@section('meta')
    {!! ($foundProperty->meta_tags)?$foundProperty->meta_tags :'' !!}
@endsection
@section('content')



<div class=" <?= isset($private)?"dark-page":"" ?> ">


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
                <a href="{{ $ListRouteName }}">{{ $ListName }}</a>
              </li>
              <li>
                <span class="">{{ $foundProperty->name}}</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  

  @if($foundProperty->featured_image && !isset($private))
  <section class="property-gallery-sec space pb-0">
    <div class="container">
      <div class="row">
        <div class="col-12">
            <div class="gallery-topbar">
              <div class="topbar-left">
                <p class="category-label">{{ ucfirst($foundProperty->propertyType->type_name ?? "") }}</p>
                <div class="Wishlist {{ in_array(route($routeName,$foundProperty->slug), $wish) ? 'added' : '' }}" 
                  data-id="{{ $foundProperty->id }}" 
                  data-type="{{ $property_type }}" 
                  data-url="{{ route($routeName, $foundProperty->slug) }}"  
                  data-auth="{{ isset(auth()->user()->id) ? auth()->user()->id : '' }}">
                  <img class="heart-o-icon" src="{{ asset('img/heart-o.svg') }}">
                  <img src="{{ asset('img/heart.svg') }}" class="heart-icon">
                </div>
                
              </div>
              <div class="topbar-right">
                <!--<a href="" class="share-btn">
                  <img src="{{ asset('/img/share-dark.svg') }}">
                </a>-->
                <div class="share-blog mb-0">
								<a href="" class="green-btn d-none"><img src="{{ asset('img/share.svg') }}" alt="">Share</a>

                                <div class="dropdown share dropdown social_share">
                                    <a href="javascript:void(0);" class="green-btn"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="{{ asset('img/share.svg') }}" alt="">Share
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <!-- Facebook Share Button -->
                                            <a class="dropdown-item" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank">
                                                <i class="fa-brands fa-facebook"></i>
                                                Share on Facebook
                                            </a>

                                            <!-- Twitter Share Button -->
                                            <a class="dropdown-item" href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text=Check%20this%20out!" target="_blank">
                                                <i class="fa-brands fa-square-twitter"></i>
                                                Share on Twitter
                                            </a>

                                            <!-- LinkedIn Share Button -->
                                            <a class="dropdown-item" href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}" target="_blank">
                                                <i class="fa-brands fa-linkedin"></i>
                                                Share on LinkedIn
                                            </a>

                                            <!-- WhatsApp Share Button -->
                                            <a class="dropdown-item" href="https://wa.me/?text={{ urlencode(url()->current()) }}" target="_blank">
                                                <i class="fa-brands fa-square-whatsapp"></i>
                                                Share on WhatsApp
                                            </a>

                                    </div>
                                </div>
					</div>
              </div>
            </div>
        </div>
        <div class="col-12">
          <div class="gallery-grid" id="aniimated-thumbnials">
            @if($foundProperty->featured_image)
            <a href="{{ $foundProperty->featured_image }}" id="gallery-item-1">
                <div class="Big_Gallery">
                  <img decoding="async" src="{{ asset($foundProperty->featured_image) }}" class="img-fluid">
                </div>
            </a>
            @endif
            @if(isset($foundProperty->banners) && !empty($foundProperty->banners))
                @foreach ($foundProperty->banners as $key => $item)
                    @if($key > 3)
                    <a href="{{ asset($item->image_url) }}" id="gallery-item-{{$key}}">
                      <div class="Small_Gallery">
                        <img decoding="async" src="{{ asset($item->image_url) }}" class="img-fluid" alt="" />
                      </div>
                    </a>
                    @else
                    @endif

                @endforeach
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>
  @else
  <section class="property-gallery-sec  pb-0">
    <img src="{{ asset('INVESTIMG_0_1705910145.jpg') }}" class="w-100" alt="">              
  </section>
  @endif
 
  <section class="space blog-detail-page <?= isset($private)?"bg-brown":"" ?>">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="content-wrapper">
            <h2 class="mt-0">{{ $foundProperty->name }}</h2>
            <p>
              <img src="{{ asset('/img/hotel/map.svg') }}"> {{ strip_tags($foundProperty->address) }}
            </p>
            @if((number_format($foundProperty->sale_price) || number_format($foundProperty->area) || $foundProperty->bed || $foundProperty->jacuzzi))
            <div class="price-amenitity">
              @if(number_format($foundProperty->sale_price))
              <h3>AED {{ number_format($foundProperty->sale_price) }}/-</h3>
              @endif
              <div class="main-amenity">
                @if(number_format($foundProperty->area))
                <div class="amenity-box">
                  <div class="amenty-img">
                    <img src="{{ asset('/img/square.svg')}}" class="" alt="">
                  </div>
                  <p>{{ number_format($foundProperty->area) }} SQ FT</p>
                </div>
                @endif
                @if($foundProperty->bed)
                <div class="amenity-box">
                  <div class="amenty-img">
                    <img src="{{ asset('/img/bed.svg')}}" class="" alt="">
                  </div>
                  <p>{{ $foundProperty->bed }} Beds</p>
                </div>
                @endif
                @if($foundProperty->jacuzzi)
                <div class="amenity-box">
                  <div class="amenty-img">
                    <img src="{{ asset('/img/bathtub.svg')}}" class="" alt="">
                  </div>
                  <p>{{ $foundProperty->jacuzzi }} Bathrooms</p>
                </div>
                @endif
              </div>
            </div>
            @endif
            <div class="seperator"></div>
              <h5>Description</h5>
              <div class="parent-section">
                <div class="show_more_content">
                {!! $foundProperty->description !!}
                </div>
                <span id="toggleContentBtn" class="link-btn ">Show More</span>                           
              </div>
            @if(isset($foundProperty->plans) && !empty($foundProperty->plans))
            <div class="seperator"></div>
            <div class="pay-plans">
                <h5>Payment Plan</h5>
                <div class="plan-items">
                @foreach($foundProperty->plans as $item)
                  <div class="plan-item">
                    <h4>
                      <span>{{ $item->name }}</span>{{ number_format($item->percentage, 2, '.', '') == number_format($item->percentage, 0, '.', '') ? number_format($item->percentage, 0) : number_format($item->percentage, 2) }} % <span>{{ $item->detail }}</span>
                    </h4>
                  </div>
                @endforeach
                </div>
              </div>
  
              @endif


            @if($foundProperty->amenities_id)
            @php 
            $amanities =  explode(",", $foundProperty->amenities_id);;
            @endphp
            <div class="seperator"></div>
            <div class="ameneties-panel">
              <h5>Amenities</h5>
              <div class="ameneties-items">
                @foreach($amanities as $item)
                <div class="ameneties-item">
                  <img src="{{ asset('/img/check.svg')}}">
                  @foreach($amenitie as $single)
                      @if($item == $single->id)
                      <p>{{ $single->amenity_name }}</p>
                      @endif    
                  @endforeach
                </div>
                @endforeach
              </div>
            </div>
            @endif
             <div class="seperator"></div>
            
            <div class="property-location">
              <h5>Property Location</h5>
              {!! $foundProperty->google_maps_link !!}
              {!! $foundProperty->iframe !!}
            </div>
           <!--<div class="seperator"></div>-->
            @if(isset($foundProperty->company) && !empty($foundProperty->company))
            
            <div class="company-info">
              @if(isset($foundProperty->company->company_name))
              <h5>{{ $foundProperty->company->company_name }}</h5>
              @endif 
              <p>{!! $foundProperty->company->company_detail !!}</p>
              <h5>Developer Track Record</h5>
              @php 
                $records = json_decode($foundProperty->company->track_record);
                $company_by = route('devlopment.listing') . '?company=' . base64_encode($foundProperty->company->id);
              @endphp
              @if(isset($records->data) && !empty($records->data))
              <div class="record-boxes">
                @foreach($records->data as $item)
                  <div class="record-box">
                    <h3>{{ $item->tr_id }}</h3>
                    <p>{{ $item->tr_name }}</p>
                  </div>
                @endforeach
              </div>
              @endif
              @if(isset($foundProperty->compnay_listing))
                <a href="{{ $foundProperty->compnay_listing_2 ? $foundProperty->compnay_listing_2 : $company_by }}" class="link-btn">{{ $foundProperty->compnay_listing }}</a>
              @endif
            </div>
            @endif
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
               {!! renderInterestForm() !!} 

              <!-- {{-- {!! renderInterestForm('apply_job') !!} --}} -->

              <!-- {!! renderInterestForm('listing_form') !!} -->
              
            </div>
            @if(isset($agent) && !empty($agent))
            <div class="agent-panel">
              <div class="agent-info">
                <figure>
                  <img src="{{ asset($agent->photo) }}" alt="" class="" onError="this.onerror=null; this.src='{{ asset('img/inr-banner.png') }}';">
                </figure>
                <figcaption>
                  <h3>{{ $agent->name }}</h3>
                  <p>Senior Consultant</p>
                </figcaption>
              </div>
              <div class="agent-contact-btn">
                <a href="https://wa.me/{{$agent->mobile}}" target="_blank" class="light-btn">
                  <img src="{{ asset('/img/whatsapp-dark.png') }}" alt="" class=""> Whatsapp </a>
                <a href="tel:{{$agent->phone}}" class="light-btn">
                  <img src="{{ asset('/img/call-dark.png') }}" alt="" class=""> Call Us Now! </a>
              </div>
            </div>
            @endif

            @auth
            <div class="download-btn-grp">
              @if($foundProperty->floor_plan)
              <a href="javascript:void(0);" onclick="checkAndDownload('{{ asset($foundProperty->floor_plan)}}', 'floor plan', event)" class="light-btn w-100 mb-3">
                <img src="{{ asset('/img/download-dark.svg')}}" class=""> Download floor plans
            </a>
            @endif
            @if($foundProperty->brochure)
            <a href="javascript:void(0);" onclick="checkAndDownload('{{ asset($foundProperty->brochure)}}', 'brochure', event)" class="green-btn w-100">
                <img src="{{ asset('/img/download-light.svg')}}" class=""> Download the brochure
            </a>              
            @endif
            </div>
            @else
            <div class="download-btn-grp">
              <a href="{{ route('login') }}" class="light-btn w-100 mb-3">
                <img src="{{ asset('/img/download-dark.svg')}}" class=""> Download floor plans
            </a>
            <a href="{{ route('login') }}"  class="green-btn dark w-100">
                <img src="{{ asset('/img/download-light.svg')}}" class=""> Download the brochure
            </a>              
            </div>
            @endauth
          </div>
        </div>
        @if(isset($foundProperty->information_description) && !empty($foundProperty->information_description) && $foundProperty->information_description)
        <div class="seperator"></div>
        <div class="col-12">
          <div class="dark-report-sec">
            <div class="dark-report-main">
              <div class="row no-gutters">
                <div class="col-lg-7 col-12">
                  <div class="heading-pnel fff mb-0">
                    <div class="dark-report-content">
                      <h2 class="mb-3">{{ $foundProperty->information_heading }}</h2>
                      <div class="mb-4">{!! $foundProperty->information_description !!}</div>
                      <img src="{{ asset('/img/stroke-building.png')}}" class="stroke-building" alt="">
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
                    @if($foundProperty->blog_background)
                    <img src="{{ asset($foundProperty->blog_background)}}" class="w-100" alt="">
                    @else
                    <img src="{{ asset('/img/login-image.png')}}" class="w-100" alt="">
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif
      </div>
    </div>

</section>


<section class="space position-relative  <?= isset($private)?"bg-brown":"" ?> pt-0">
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
              <div class="owl-carousel" id="instructor-slider">
             

                  @if(isset($property_list) && !empty($property_list) && count($property_list))
                  @foreach($property_list as $item)
                    <div class="item">
                    <div class="card-box">
                  
                    <figure>
                      <div class="VillaText">
                        <p>{{ $item->type_name ?? "Property" }}</p>
                      </div>
                      <a href="{{ route($routeName, $item->slug ?? '#') }}"><img onerror="this.onerror=null; this.src='{{ asset('img/list/4.png') }}';" src="{{ asset($item->featured_image)}}" class="" alt=""></a>
                      <div class="Wishlist {{ in_array(route($routeName,$item->slug), $wish) ? 'added' : '' }}" 
                        data-id="{{ $item->id }}" 
                        data-type="{{ $property_type }}" 
                        data-url="{{ route($routeName, $item->slug) }}"  
                        data-auth="{{ isset(auth()->user()->id) ? auth()->user()->id : '' }}">
                        <img class="heart-o-icon" src="{{ asset('img/heart-o.svg') }}">
                        <img src="{{ asset('img/heart.svg') }}" class="heart-icon">
                      </div>
                      
                    </figure>
                  
                  <figcaption>
                    <a href="{{ route($routeName, $item->slug ?? '#') }}">
                      <h3>{{ $item->name }}</h3>
                      <span class="address_section">
                        <p>
                          <img src="{{ asset('/img/hotel/map.svg')}}">{!! $item->address !!}
                        </p>
                      </span>
                      <div class="HotelViews">
                        <ul>
                          <li>
                            <img src="{{ asset('/img/hotel/1.svg')}}"> {{ number_format($item->area) }} SQ FT
                          </li>
                          <li>
                            <img src="{{ asset('/img/hotel/2.svg')}}"> {{ number_format($item->bed) }}
                          </li>
                          <li>
                            <img src="{{ asset('/img/hotel/3.svg')}}"> {{ number_format($item->jacuzzi) }}
                          </li>
                        </ul>
                      </div>
                      <h6>
                        <span>AED</span> {{ number_format($item->sale_price) }}/-
                      </h6>
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
      
    </div>
  </section>

</div>

  <a id="back2Top" class="top-scroll" title="Back to top" href="#" style="">
    <img src="{{ asset('/img/arrow-right.svg') }} " class="">
  </a>

  <style>
span.address_section {
    display: flex;
    overflow: hidden;
    flex-wrap: nowrap;
}
span.address_section p {
    margin-bottom: 12px;
}
</style>
@endsection

@section('scripts')

<script>
 
$(document).ready(function() {
    $('#contactForm_old').on('click', function(e) {
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
