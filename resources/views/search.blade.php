@extends('layouts.app')
@php
    $page_name = $data['detail']->page_name ?? $data['page_title'] ?? 'Properties';
@endphp

@php
 $wish = getWhishList()
@endphp

  @section('title', $page_name)
  @section('meta')
    @if(isset($data['detail']->meta_tags) && !empty($data['detail']->meta_tags))
        {!! $data['detail']->meta_tags !!}
    @endif
  @endsection
  @section('content')
  @php
    if(isset($property_type_name)){
        if($property_type_name == 'rent'){
            $ListRouteName = route('search', ['prop_for' => 'rent']);
            $ListName = "Rent";
        }elseif($property_type_name == 'private'){
            $ListRouteName = route('private.listing');
            $ListName = "Private";
        }elseif($property_type_name == 'project'){
            $ListRouteName = route('devlopment.listing');
            $ListName = "Development";
 
        }elseif($property_type_name == 'international'){
            $ListName = "International";
            $ListRouteName = route('search', ['prop_for' => 'international']);
        }elseif($property_type_name == 'buy'){
            $ListName = "Buy";
            $ListRouteName = route('search', ['prop_for' => 'sales']);
        }elseif($property_type_name == 'branded'){
            $ListName = "Branded Residences";
            $ListRouteName = route('branded_residences');
        }elseif($property_type_name == 'investment' || $property_type_name == 'invest'){
            $ListName = "Investments";            
            $ListRouteName = route('search', ['prop_for' => 'investment']);
        }
    }


                                        if(isset($devlopment)){
                                            $routeName = 'devlopment.detail_page';
                                            $property_type_name = "project";
                                        }elseif(isset($private)){
                                            $routeName = 'private.detail_page';
                                        }elseif($property_type_name == 'international' && 0){
                                            $routeName = 'investment.detail_page';
                                        }elseif($property_type_name == 'investment' || $property_type_name == 'invest'){
                                            $routeName = 'investment.detail_page';
                                        }
                                        else{
                                            $routeName = 'detail.page';
                                        }
                                    @endphp
      <section class="banner inr-banner" style="background-image: url('{{ asset('img/inr-banner.png') }}');">
          <div class="container">
              <div class="slider-info">
                  <div class="BannerBox">
                      <div class="banner-heading text-center {{ var_dump(isset($data['detail']->page_name) && !empty($data['detail']->page_name)) }}">
                        @if(isset($data['detail']->page_name) && !empty($data['detail']->page_name))
                            <h1>{{ $data['detail']->page_name }}</h1>
                        @else
                            @if (isset($data['	']) && !empty($data['page_title']))
                                <h1>{{ $data['page_title'] }}</h1>
                            @else
                                <h1>Properties</h1>
                            @endif
                        @endif
                      </div>
                        @if(isset($searchData) && !empty($searchData))
                            {!! innerSearchBox($searchData) !!}
                        @elseif(isset($data) && !empty($data))
                            {!! innerSearchBox($data) !!}
                        @else
                            {!! innerSearchBox([]) !!}
                        @endif
                  </div>
              </div>
          </div>
      </section>
      
      <!-- breadcrumb -->
      <section class="breadcrumb-sec">
          <div class="container">
              <div class="row">
                  <div class="col-12">
                      <div class="bread-container">


                        @if(!isset($ListName))
                            @if(isset($data['detail']->breadcrumbs) && !empty($data['detail']->breadcrumbs))
                                {!! $data['detail']->breadcrumbs !!}
                            @else
                                <ul>
                                <li><a href="{{ route('home') }}" class="">Home</a></li>
                                </ul>
                            @endif
                        @else
                            <ul>
                                <li><a href="{{ route('home') }}" class="">Home</a></li>
                                <li><a href="{{ $ListRouteName }}">{{ $ListName }}</a></li>
                            </ul>
                        @endif
                        
                      </div>
                  </div>
              </div>
          </div>
      </section>
 
    @if(isset($property_type_name) && !empty($property_type_name) && $property_type_name == 'international')
    <section class="about-sec space">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
    				<div class="about-left">
    					<div class="about-img-grid">
    						<div class="img-grid-item">
    							@if(isset($data['detail']->image_1) && !empty($data['detail']->image_1))
    							    <img src="{{ asset($data['detail']->image_1) }}" alt="" class="w-100">
                                @else
                                <img src="img/about/1.png" alt="" class="w-100">
    							@endif
    							
    						</div>
    						<div class="text-grid-item">
    							<img src="img/about/building.svg" alt="" class="">
    							<h4>{{ $data['detail']->number_property }}</h4>
    							<p>Properties Sold</p>
    						</div>
    						<div class="text-grid-item">	
    							<h4>{{ $data['detail']->number_client }}</h4>
    							<p>Happy Clients</p>
    						</div>
    						<div class="img-grid-item">
    							@if(isset($data['detail']->image_2) && !empty($data['detail']->image_2))
    							    <img src="{{ asset($data['detail']->image_2) }}" alt="" class="w-100">
                                @else
                                <img src="img/about/2.png" alt="" class="w-100">
    							@endif
    						</div>
    						
    					</div>
    				</div>
                </div>		
    			
    			<div class="col-lg-6">
    				<div class="about-content">
                        @if(!empty($data['detail']->blog_description))
                            {!! $data['detail']->blog_description !!}
                        @endif 
    				</div>
    			</div>
    			
            </div>
        </div>
    </section>
    @endif
    @if(isset($devlopment) || (isset($property_type_name) && !empty($property_type_name) && $property_type_name == 'international'))
        <section class="region-sec bg-black space">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="heading-pnel fff">
                        {!! $data['detail']->dtd !!}
                            </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="owl-carousel" id="region-slider">
                            @if(isset($top_listing) && !empty($top_listing))
                            @foreach($top_listing as $item)
                            <div class="item">
                                <div class="new-development card-box"> 
                                        <figure> 
                                        <a href="{{ route($routeName, $item->slug ?? '#') }}">    
                                        <img src="{{ asset($item->featured_image) }}"
                                                  onerror="this.onerror=null; this.src='{{ asset('img/thumbnail-placeholder-gallery.png') }}';"
                                                  alt="">
                                                  </a>
                                                  <div class="Wishlist {{ in_array(route('devlopment.detail_page',$item->slug), $wish) ? 'added' : '' }}" 
                                                                    data-id="{{ $item->id }}" 
                                                                    data-type="{{ $item->property_source ?? $property_type_name }}" 
                                                                    data-url="{{ route('devlopment.detail_page', $item->slug) }}"  
                                                                    data-auth="{{ isset(auth()->user()->id) ? auth()->user()->id : '' }}">
                                                                    <img class="heart-o-icon" src="{{ asset('img/heart-o.svg') }}">
                                                                    <img src="{{ asset('img/heart.svg') }}" class="heart-icon">
                                                                </div>

                                        </figure>
                                    
                                    <figcaption> <a href="{{ route('devlopment.detail_page', $item->slug ?? '#') }}">
                                            <h3>{{ $item->name }}</h3>
                                            @if($item->address)
                                            <p><img src="{{ asset('img/hotel/map.svg') }}">{!! Str::words(strip_tags($item->address), 4, '...') !!}</p>
                                            @endif
                                        </a> </figcaption>
                                </div>
                            </div>
                            @endforeach
                            @endif
                            @if(isset($regions) && !empty($regions))
                            @foreach($regions as $item)
                            <div class="item">
								<div class="region-box">
									<a href="{{ route('search') }}?prop_for=international&region={{$item->id}}">
										<figure>
											<img src="{{ asset($item->image_url) }}" alt="" class="" />
											<figcaption>
												<h4>{{ $item->name }}</h4>
												<img src="{{ asset('img/arrow-right2.svg')}}" class="" alt="" />
											</figcaption>
										</figure>
									</a>
								</div>
							</div>
						    @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @else
          <section class="CTA-strip space pb-0 <?= (isset($property_type_name) && $property_type_name == 'private') ? 'bg-brown' : ''; ?>">
          <div class="container">
              <div class="row" style="background-image: url('{{ asset($data['detail']->blog_background) }}');" style="background-image: url('{{ asset('img/buy.png') }}');">
                  <div class="col-lg-6">
                      <div class="heading-pnel fff m-0">
                        @if(!empty($data['detail']->blog_heading) && !empty($data['detail']->blog_description))
                        <h2 class="m-0">{!! $data['detail']->blog_heading !!}</h2>
                        @if(!empty($data['detail']->blog_description))
                            {!! $data['detail']->blog_description !!}
                        @endif  
                        @if(!empty($data['detail']->blog_button_label) && !empty($data['detail']->blog_button_url))
                        <a href="{{ $data['detail']->blog_button_url }}" class="border-btn fff">{{ $data['detail']->blog_button_label }}</a>
                        @endif
                          
                        @else
                          <h2 class="m-0">About Properties <br> in Dubai</h2>
                          <p>Discover some of the very best apartments, penthouses, townhouses and villas for rent across
                              Dubai. Located in some of the most prime communities, these homes are designed to cater to
                              every type of lifestyle.Some of the top Dubai communities for apartment rentals include
                              Dubai Marina, Palm Jumeirah, and the Downtown district. Waterfront apartment complexes are
                              always popular, offering a resort-like atmosphere and amenities to match. </p>
                          <a href="" class="border-btn fff">Explore all reports</a>
                        @endif
                        </div>
                  </div>
              </div>
          </div>
      </section>        
        @endif
        

      <section class="space position-relative <?= (isset($property_type_name) && $property_type_name == 'private') ? 'bg-brown' : ''; ?>">
          <div class="container">

              <div class="listing-top-area">
                  <div class="row">
                    @if(isset($devlopment) && 0)
                    <div class="col">
                        <h2 class="m-0">More New Developments</h2>
                    </div>
                    @endif
                      <div class="col-12">
                          <div class="listing-top-area-container <?= (isset($property_type_name) && $property_type_name == 'private') ? 'dark-text' : ''; ?>">
                              <div class="item-counter">
                                  <p>Results: <span> {{ $data['property']->total() }} Properties</span></p>
                              </div>
                              
                            <div class="filter-trigger">
							    <a href="javascript:void(0)" onclick="openNav()" class="<?= (isset($property_type_name) && $property_type_name == 'private') ? 'light-btn' : 'green-btn'; ?>"><img src="{{ asset('img/filter.svg') }}"  class="" alt=""> Filters</a>
						    </div>
                          </div>
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
                                                  <p>{{ ucfirst(isset($property->propertyType->type_name) ? $property->propertyType->type_name: "Property") }}</p>
                                              </div> 
                                              <a href="{{ route($routeName, $property->slug ?? '#') }}">
                                              @if($property->featured_image)
                                                    <img src="{{ asset($property->featured_image) }}"
                                                    onerror="this.onerror=null; this.src='{{ asset('img/thumbnail-placeholder-gallery.png') }}';"
                                                    alt="">
                                                @elseif(isset($property->banners[0]->image_url) && $property->banners[0]->image_url)
                                                    <img src="{{ asset($property->banners[0]->image_url) }}"
                                                        onerror="this.onerror=null; this.src='{{ asset('img/thumbnail-placeholder-gallery.png') }}';"
                                                    alt="">
                                                @else
                                                    <img src="{{ asset('img/thumbnail-placeholder-gallery.png') }}" alt="Featured Image">
                                                @endif
                                                </a>

                                            
                                                <div class="Wishlist {{ in_array(route($routeName,$property->slug), $wish) ? 'added' : '' }}" 
                                                                    data-id="{{ $property->id }}" 
                                                                    data-type="{{ $property->property_source ?? $property_type_name }}" 
                                                                    data-url="{{ route($routeName, $property->slug) }}"  
                                                                    data-auth="{{ isset(auth()->user()->id) ? auth()->user()->id : '' }}">
                                                                    <img class="heart-o-icon" src="{{ asset('img/heart-o.svg') }}">
                                                                    <img src="{{ asset('img/heart.svg') }}" class="heart-icon">
                                                                </div>


                                          </figure>
                                      
                                      <figcaption>
                                          <a href="{{ route($routeName, $property->slug ?? '#') }}">
                                              <h3>{{ $property->name }}</h3>
                                              @if($property->address)
                                              <p><img src="{{ asset('img/hotel/map.svg') }}">{!! Str::words(strip_tags($property->address), 3, '...') !!}</p>
                                            @endif

                                              @if(!isset($devlopment) && $property_type_name != 'project')
                                              <div class="HotelViews">
                                                  <ul>
                                                      <li><img src="{{ asset('img/hotel/1.svg') }}"> {{ number_format($property->area) }}
                                                          SQ FT</li>
                                                      @if ($property->bed)
                                                          <li><img src="{{ asset('img/hotel/2.svg') }}"> {{ $property->bed }}</li>
                                                      @endif
                                                      @if ($property->jacuzzi)
                                                          <li><img src="{{ asset('img/hotel/3.svg') }}"> {{ $property->jacuzzi }}</li>
                                                      @endif
                                                  </ul>
                                              </div>
                                                @if(isset($property->price_input))
                                                        <h6>{{ ucfirst($property->price_input) }}</h6>
                                                @else
                                                    @if(number_format($property->sale_price))
                                                        <h6><span>AED</span> {{ number_format($property->sale_price) }}/-</h6>
                                                    @endif  
                                                @endif
                                              @endif
                                          </a>
                                      </figcaption>
                                  </div>
                              </div>
                          @endforeach
                      @endif
                  </div>
              </div>



              {{ $data['property']->links('vendor.pagination.custom-pagination') }}





          </div>
      </section>
    @if(isset($devlopment) || ( $property_type_name == 'investment' || $property_type_name == 'invest' ) || (isset($property_type_name) && !empty($property_type_name) && $property_type_name == 'international'))
        <section class="list-us-sec space bg-grey pt-0">
            <div class="container">
                <div class="row align-items-end">
                    <div class="col-lg-6">
                        <div class="list-us-content">
                            {!! $data['detail']->dbd !!}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="list-from">
                            <h2 class="mb-2">Register your interest!</h2>
                            <p class="mb-4 d-none"></p>
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
    <?php                              $pageName = $pageName ?? request()->route()->getName();
        $pageId = $pageId ?? request()->route('id'); // assuming 'id' is a parameter in the route
     ?>
        <form id="contactForm" action="{{ route('intrest.submit') }}" method="POST">
          @csrf
          <div class="form-group">
              <label>Full Name</label>
              <input class="form-control" name="fullName" type="text" placeholder="John Doe" required>
              <input type="text" name="form" style="display:none;">
          </div>
          <div class="form-group">
              <label>Email</label>
              <input class="form-control" name="email" type="email" placeholder="example@gmail.com" required>
          </div>
          <div class="form-group">
              <label>Contact Number</label>
              <input class="form-control" name="contactNumber" type="text" placeholder="+91 2344 34332" required>
          </div>
          <input type="hidden" name="pageName" value="${pageName}">
          <input type="hidden" name="pageId" value="${pageId}">
        <input type="hidden" name="type" value="dev">
        <button type="submit" data-sitekey="6LdTOJIqAAAAAIzlPRlnrnXROcFEH92ZzhUR-pAs" data-callback='onSubmit' data-action='submit'  class="g-recaptcha green-btn submit-btn">Submit</button>
      </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
    
      @php
      if(isset($data['page_type'])){
         $page_name = $data['page_type'];
      }else{
        $page_name = "home";
      }
       $page_name;
      @endphp
      @include('faq', ['page_name' => $page_name])
	
        @endif

    <!-- filters -->
     @if(url()->current() == "common_search")
     <form method="POST" action="{{ request()->fullUrl() }}">
     @else
     <form method="POST" action="{{ route('search', ['prop_for' => $data['page_type']]) }}">
     @endif
         
    <div id="filters-sidebar" class="sidenav">
		  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">
			<img src="{{ asset('img/cross.svg') }}" alt="" class="" />
		  </a>
		  @csrf
		  <div class="filter-head">
			<h2>Filters</h2>
		  </div>


		  <div class="filter-boxes">
			<div class="filter-box">
				<h4>Sort By</h4>
				<div class="filter-checkboxes">
					<ul>
						<li>
							<input class="styled-checkbox" id="styled-checkbox-1" {{ (old('sort_desc', $filter_array['sort']) == 'ASC') ? 'checked' : '' }} name="sort" type="radio" value="ASC">
							<label for="styled-checkbox-1">Low  to High</label>
						</li>
						
						<li>
							<input class="styled-checkbox" id="styled-checkbox-2" {{ (old('sort_desc', $filter_array['sort']) == 'DESC') ? 'checked' : '' }} name="sort" type="radio" value="DESC">
							<label for="styled-checkbox-2">High to low</label>
						</li>
					</ul>
				</div>
			</div>
			
			
			<div class="filter-box">
				<h4>Property Type</h4>
				<div class="filter-checkboxes">
					<ul>
                        @if($data['property_type'])
                            @foreach($data['property_type'] as $item)
                            <li>
                                <input class="styled-checkbox" id="type_styled-checkbox-{{ $item->id }}" {{ in_array($item->id, $filter_array['property_type'])? "checked":"" }} name="property_type[]" type="checkbox" value="{{ $item->id }}">
                                <label for="type_styled-checkbox-{{ $item->id }}">{!! ucfirst(Str::words($item->type_name, 4, '...')) !!}
                                </label>
                            </li>
                            @endforeach
                        @endif
					</ul>
				</div>
			</div>
			
			
			
			<div class="filter-box">
				<h4>Property Size</h4>
				<div class="filter-checkboxes">
					<ul>
						<li>
							<input class="styled-checkbox" id="styled-checkbox-8" name="size[]" {{ in_array('1 BHK', $filter_array['size'])?? "checked" }} type="checkbox" value="1 BHK">
							<label for="styled-checkbox-8">1 BHK</label>
						</li>
						
						<li>
							<input class="styled-checkbox" id="styled-checkbox-9" name="size[]" type="checkbox" value="2 BHK" {{ in_array('2 BHK', $filter_array['size'])?? "checked" }}>
							<label for="styled-checkbox-9">2 BHK</label>
						</li>
						
						<li>
							<input class="styled-checkbox" id="styled-checkbox-10" name="size[]" type="checkbox" value="3 BHK" {{ in_array('3 BHK', $filter_array['size'])?? "checked" }}>
							<label for="styled-checkbox-10">3 BHK</label>
						</li>
						
						<li>
							<input class="styled-checkbox" id="styled-checkbox-11" type="checkbox" name="size[]" value="4 BHK" {{ in_array('4 BHK', $filter_array['size'])?? "checked" }}>
							<label for="styled-checkbox-11">4 BHK</label>
						</li>
						
						<li>
							<input class="styled-checkbox" id="styled-checkbox-12" name="size[]" type="checkbox" value="Studio" {{ in_array('Studio', $filter_array['size'])?? "checked" }}>
							<label for="styled-checkbox-12">Studio</label>
						</li>
					</ul>
				</div>
			</div>
			
			
			<div class="filter-box">
				<h4>Price Range <span style="display: none;">(2m - 240m)</span></h4>
				<div class="filter-checkboxes">
					  <div class="d-flex">
						<div class="wrapper">
						 
						  <div class="slider">
							<div class="progress"></div>
						  </div>
                          <div class="range-input">
							<input type="range" class="range-min" min="0" max="10000" value="2500" step="100">
							<input type="range" class="range-max" min="0" max="10000" value="7500" step="100">
						  </div>
						   <div class="price-input">
							<div class="field">
							  <span>Min</span> 
							  <input type="number" value="{{ $filter_array['min_range'] }}" class="input-min" name="min_range" >
							</div>
							<div class="separator">-</div>
							<div class="field">
							  <span>Max</span>
							  <input type="number" value="{{ $filter_array['max_range'] }}" class="input-max" name="max_range" >
							</div>
						  </div>
						</div>
					  </div>
				</div>
			</div>
			
			
			<div class="filter-box">
				<div class="menu-btn-grup filter-btn-grp p-0">
					<a class="btn border-btn" href="">Clear Filters</a> 
					<button type="submit" class="green-btn" >Apply Filters</button> 
				</div>
			</div>
			
			
			
		  </div>
		</div>
		</form>
		<div id="filter-overlay"></div>
      @endsection

@section('scripts')
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
       function onSubmit(token) {
         document.getElementById("contactForm").submit();
       }
    </script>
@endsection      