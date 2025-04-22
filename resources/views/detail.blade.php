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
    <meta name="description" content="{{ $foundProperty['meta_description2'] }}" />
    <meta property="og:description" content="{{ $foundProperty['meta_description2'] }}" />
  @endif
@endsection

@php
  if(isset($devlopment)){
    $property_type = 'project';
    $routeName = 'devlopment.detail_page';
  }elseif(isset($private)){
    $routeName = 'private.detail_page';
    $property_type = 'private';
  }elseif(isset($investment)){
    $routeName = 'investment.detail_page';
    $property_type = 'invest';
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
  }elseif($property_type == 'investment' || $property_type == 'invest'){
    $ListName = "Investment";  
    $ListRouteName = route('investment.listing');  
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
  
  @if(!$foundProperty->featured_image )
    @if(isset($foundProperty->banners[0]->image_url) && $foundProperty->banners[0]->image_url)
      <?php $foundProperty->featured_image =  $foundProperty->banners[0]->image_url; ?>
    @endif
  @endif

  

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
                                            <a class="dropdown-item" href="#" onclick="copyCurrentUrl(event)">
                                                <i class="fa-solid fa-copy"></i>
                                                Current Page URL
                                            </a>
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
          @if(!isset($investment))
          <div class="gallery-grid" id="aniimated-thumbnials">
            @if($foundProperty->featured_image)
            <a href="{{ asset($foundProperty->featured_image) }}" id="gallery-item-1">
                <div class="Big_Gallery">
                  <img decoding="async" src="{{ asset($foundProperty->featured_image) }}" class="img-fluid">
                </div>
            </a>
            @endif
            @if(isset($foundProperty->banners) && !empty($foundProperty->banners))
                @foreach ($foundProperty->banners as $key => $item)
                @php
                  $key = $key +1;
                @endphp
                    <a href="{{ asset($item->image_url) }}" class="{{ $key + 1 }} gallery-item-{{ $key + 1 }}" id="gallery-item-{{ $key + 1 }}">
                      <div class="Small_Gallery">
                        <img decoding="async" src="{{ asset($item->image_url) }}" class="img-fluid" alt="" />
                      </div>
                    </a>
                @endforeach
                @php
                  $number_of_banners = count($foundProperty->banners) + 1;
                @endphp
                @if(count($foundProperty->banners) < 4)
                  @for($i = 0; $i < (5 - $number_of_banners); $i++)
                    <a href="{{ asset('img/thumbnail-placeholder-gallery.png') }}" class="{{ $number_of_banners + 1 + $i }} gallery-item-{{ $number_of_banners + 1 + $i }}" id="gallery-item-{{ $number_of_banners + 1 + $i }}">
                      <div class="Small_Gallery">
                        <img decoding="async" src="{{ asset('img/thumbnail-placeholder-gallery.png') }}" class="img-fluid" alt="Placeholder Image" />
                      </div>
                    </a>
                  @endfor
                @endif


            @endif
          </div>
          @else
          <div style="500px">
              @php
                  $image = $foundProperty->featured_image ?? 
                          (!empty($foundProperty->banners) && isset($foundProperty->banners[0]) ? $foundProperty->banners[0]->image_url : 'img/thumbnail-placeholder-gallery.png');
              @endphp
              <img class="w-100" style="border-radius: 5px;" src="{{ asset($image) }}" alt="Feature highlights of our new property">
          </div>
          @endif
        </div>
      </div>
    </div>
  </section>
  @else
  <section class="property-gallery-sec  pb-0">
    <img src="{{ asset('INVESTIMG_0_1705910145_old.jpg') }}" style=" height: 70vh; object-fit: cover; " class="w-100" alt="">              
  </section>
  @endif
 
  <section class="space blog-detail-page <?= isset($private)?"bg-brown":"" ?>">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="content-wrapper">
            <h2 class="mt-0">{{ $foundProperty->name }}</h2>
            @if($foundProperty->address)
            <p>
              <img src="{{ asset('/img/hotel/map.svg') }}"> {{ strip_tags($foundProperty->address) }}
            </p>
            @endif
            @if((number_format($foundProperty->sale_price) || number_format($foundProperty->area) || $foundProperty->bed || $foundProperty->jacuzzi))
            <div class="price-amenitity">
                @if(isset($foundProperty->price_input))
                    <h3>{{ ucfirst($foundProperty->price_input) }}</h3>
                @else
                    @if(number_format($foundProperty->sale_price))
                      <h3>AED {{ number_format($foundProperty->sale_price) }}/-</h3>
                    @endif  
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
                  
                @if (strpos($foundProperty->description, "\n") !== false && !isset($private))  
                  {!! nl2br(e($foundProperty->description)) !!}
                @else
                    {!! $foundProperty->description !!}
                @endif
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
              <h5>Property Location </h5>
              {!! $foundProperty->google_maps_link !!}
              @if($foundProperty->iframe)
                  {!! $foundProperty->iframe !!}
              @else
                  <img class="w-100" src="{{ asset('logos/map_placholder.png') }}" alt="Map Placeholder">
              @endif
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
              
              <form id="contactForm" action="{{ route('intrest.submit') }}" method="POST">
                  @csrf
                    @if(isset($foundProperty->reference_number) && !empty($foundProperty->reference_number))
                        <input type="hidden" name="listingId" value="{{ $foundProperty->reference_number }}">    
                    @endif
                    
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="form" style="display:none;">
                    <input class="form-control" name="fullName" type="text" placeholder="John Doe" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" name="email" type="email" placeholder="example@gmail.com" required>
                </div>
                <div class="form-group">
                    <label>Contact Number</label>
                    <input class="form-control" name="contactNumber" type="text" placeholder="+91 2344 34332" required>
                </div>
                <div class="form-group">
                    <label>Message</label>
                    <textarea class="form-control" name="message" placeholder="Enter your message..." required></textarea>
                </div>
                <button type="submit" data-sitekey="6LdTOJIqAAAAAIzlPRlnrnXROcFEH92ZzhUR-pAs" data-callback='onSubmit' data-action='submit'  class="g-recaptcha green-btn submit-btn">Submit</button>
            </form>
              
        
              
            </div>
            @if(isset($agent) && !empty($agent))
            <div class="agent-panel">
              <div class="agent-info">
                <figure>
                  <img src="{{ asset($agent->photo) }}" alt="" class="" onError="this.onerror=null; this.src='{{ asset('img/inr-banner.png') }}';">
                </figure>
                <figcaption>
                  <h3>{{ $agent->name }}</h3>
                  {!! $agent->detail !!}
                </figcaption>
              </div>
              <div class="agent-contact-btn">
                @if(isset($agent->mobile) && $agent->mobile)
                <a href="https://wa.me/{{$agent->mobile}}" target="_blank" class="light-btn">
                  <img src="{{ asset('/img/whatsapp-dark.png') }}" alt="" class=""> Whatsapp </a>
                @endif
                @if(isset($agent->phone) && $agent->phone)
                <a href="tel:{{$agent->phone}}" class="light-btn">
                  <img src="{{ asset('/img/call-dark.png') }}" alt="" class=""> Call Us Now! </a>
                @endif
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
          <div class="dark-report-sec ">
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
                        @if($foundProperty->information_button_label_2 && $foundProperty->information_button_url_2)
                        <a href="{{ $foundProperty->information_button_url_2 }}" class="light-btn">{{ $foundProperty->information_button_label_2 }}</a>
                        @endif
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
        @elseif(isset($foundProperty->community) && !empty($foundProperty->community) && $foundProperty->community)
        <div class="seperator"></div>
        <div class="col-12">
          <div class="dark-report-sec white_font_color">
            <div class="dark-report-main">
              <div class="row no-gutters">
                <div class="col-lg-7 col-12">
                  <div class="heading-pnel fff mb-0">
                    <div class="dark-report-content">
                      <h2 class="mb-3">{{ $foundProperty->community->community_name }}</h2>
                      <div class="mb-4"><p>{!! \Illuminate\Support\Str::words(strip_tags($foundProperty->community->section_i_content), 100, '...') !!}</p></div>
                      <img src="{{ asset('/img/stroke-building.png')}}" class="stroke-building" alt="">
                      <div class="report-grp-btn d-flex" style="gap:10px;">
                        <a href="{{ route('detail.communitie', base64_encode($foundProperty->community->id)) }}" class="light-btn">Read more</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-5 col-12 order--1">
                  <div class="dark-report-img">
                    @if($foundProperty->community->featured_image)
                    <img src="{{ asset($foundProperty->community->featured_image)}}" class="w-100" alt="">
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
          @if(isset($devlopment))
          <h2 class="m-0">More New Developments</h2>
          @elseif($property_type == 'investment' || $property_type == 'invest')
          <h2 class="m-0">More Investments</h2>
          @elseif($property_type == 'private')
          <h2 class="m-0">More New Private Lists</h2>
          @elseif($property_type == 'international')
          <h2 class="m-0">More International Properties</h2>
          @elseif($property_type == 'branded')
          <h2 class="m-0">More Branded Properties</h2>
          @else
          <h2 class="m-0">More Properties</h2>
          @endif
            
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
                  <?php $new_id = $item->id; ?>
                    <div class="item">
                    <div class="card-box">
                  
                    <figure>
                      <div class="VillaText">
                        <p> {{ $item->type_name ?? "Property" }}</p>
                      </div>
                      <a href="{{ route($routeName, $item->slug ?? '#') }}">
                        @if($item->featured_image)
                        <img onerror="this.onerror=null; this.src='{{ asset('img/list/4.png') }}';" src="{{ asset($item->featured_image)}}" class="" alt="">
                        @elseif(getFirstBanner($item->id,$property_type))
                        <img src="{{ asset(getFirstBanner($item->id,$property_type)) }}" onerror="this.onerror=null; this.src='{{ asset('img/thumbnail-placeholder-gallery.png') }}';" alt="">
                        @else
                            <img src="{{ asset('img/thumbnail-placeholder-gallery.png') }}" alt="Featured Image">
                        @endif
                      </a>
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
                      @if($item->address)
                      <span class="address_section">
                        <p>
                          <img src="{{ asset('/img/hotel/map.svg')}}">{!! Str::words(strip_tags($item->address), 3, '...') !!}
                        </p>
                      </span>
                      @endif
                      @if($property_type != 'project')
                      <div class="HotelViews">
                        <ul>
                          <li>
                            <img src="{{ asset('/img/hotel/1.svg')}}"> {{ number_format($item->area) }} SQ FT
                          </li>
                          @if($item->bed)
                          <li>
                            <img src="{{ asset('/img/hotel/2.svg')}}"> {{ number_format($item->bed) }}
                          </li>
                          @endif
                          @if($item->jacuzzi)
                          <li>
                            <img src="{{ asset('/img/hotel/3.svg')}}"> {{ number_format($item->jacuzzi) }}
                          </li>
                          @endif
                        </ul>
                      </div>

                      <h6>
                        <span>AED</span> {{ number_format($item->sale_price) }}/-
                      </h6>
                      @endif
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
<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
   function onSubmit(token) {
     document.getElementById("contactForm").submit();
   }
 </script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Count the number of anchor tags in the gallery grid
    var anchorTags = document.querySelectorAll('#aniimated-thumbnials a');
    
    // Check if there are more than 5 anchor tags
    if (anchorTags.length > 5) {
      // Add the CSS rule to the document
      var style = document.createElement('style');
      style.innerHTML = `
        #gallery-item-5:after {
            content: "See more";
            display: block;
            width: 100%;
            height: 100%;
            background-color: #3a3526d4;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            font-family: 'ClashGrotesk-Medium';
            font-size: 14px;
            font-weight: 500;
            line-height: 17.22px;
            letter-spacing: 1px;
            text-align: left;
            color: #FCF9F2;
            padding: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }	
      `;
      document.head.appendChild(style);
    }
  });
</script>

<script>
function copyCurrentUrl(event) {
    event.preventDefault(); // Prevent the default action
    const currentUrl = window.location.href; // Get the current page URL
    navigator.clipboard.writeText(currentUrl) // Copy URL to clipboard
        .then(() => alert('URL copied to clipboard!')) // Success message
        .catch(err => alert('Failed to copy URL: ' + err)); // Error handling
}
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
<style>
.dark-report-sec.white_font_color h1, 
.dark-report-sec.white_font_color h2, 
.dark-report-sec.white_font_color h3, 
.dark-report-sec.white_font_color h4, 
.dark-report-sec.white_font_color h5, 
.dark-report-sec.white_font_color p, 
.dark-report-sec.white_font_color span {
  color: #fff !important;
}
</style>

@endsection
