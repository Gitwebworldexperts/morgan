@extends('layouts.app')
@section('title', $foundProperty['page_title'] ?? '')
@section('meta')

@endsection
@php
 $wish = getWhishList()
@endphp
@section('content')

    <section class="banner inr-banner" style="background-image: url({{ asset('img/inr-banner.png') }});">
         <div class="container">
            <div class="slider-info">
               <div class="BannerBox">
                  <div class="banner-heading text-center">
                     <h1>{{ $data['communities']->community_name }}</h1>
                  </div>
               </div>
            </div>
      </div>
    </section>
      <section class="breadcrumb-sec">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="bread-container">
							<ul>
								<li><a href="{{ route('home') }}" class="">Home</a></li>
								<li><a href="{{ route('communities.listing') }}" class="">Communities</a></li>
								<li><span href="#" class="">{{ $data['communities']->community_name }}</span></li>
							</ul>
						</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="about-sec zig-zag-about zig-about after-none icon-top-right space">
            <div class="container">
                <div class="row align-items-center">
					<div class="col-lg-6">	
						<div class="about-left">
							<div class="about-img">
								<div class="img-item">
									<img src="{{ asset($data['communities']->section_i_image) }}" alt="" class="w-100">
								</div>
							</div>
						</div>
                    </div>
                    <div class="col-lg-6 parent-section">
                        <div class="about-content ">
                            <div class="show_more_content">
                            {!! $data['communities']->section_i_content !!}
                            </div>
                            <span id="toggleContentBtn" class="link-btn ">Show More</span>                           
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="about-sec overflow-image after-none space">
            <div class="container">
			
                <div class="overflow-image-main bg-grey">
                <div class="row align-items-center">
					
                    <div class="col-lg-7">
						<div class="about-content">
                        {!! $data['communities']->section_ii_content !!}
							<div class="btn-grp mt-4">
                                @if($data['communities']->button_i_name && $data['communities']->button_i_url)
                                    <a href="{{ $data['communities']->button_i_url }}" class="green-btn">{{ $data['communities']->button_i_name ?? "Luxury Properties for sale in Dubai Hills Estate" }}</a>
                                @endif
                                @if($data['communities']->button_ii_name && $data['communities']->button_ii_url)
                                    <a href="{{ $data['communities']->button_ii_url }}" class="green-btn">{{ $data['communities']->button_ii_name ?? "Contact an expert" }}</a>
                                @endif
							</div>
						</div>
                    </div>
					
					<div class="col-lg-5 order--1">	
						<div class="about-left">
							<div class="about-img">
								<div class="img-item text-right ml-auto">
									<img src="{{ asset($data['communities']->second_image) }}" alt="" class="w-100">
								</div>
							</div>
						</div>
                    </div>
                </div>
                </div>
				
				
            </div>
        </section>

        <br>
        <br>
        <br>

        <section class="CTA-strip">
            <div class="container">
                @if($data['communities']->third_image)
                <div class="row" style="background-image: url('{{ asset($data['communities']->third_image) }}');">
                @else
                <div class="row" style="background-image: url('{{ asset('img/strip-bg.png') }}');">
                @endif

                    <div class="col-lg-6">
                        <div class="heading-pnel fff m-0">
                            {!! $data['communities']->section_iii_content !!}    
                            @if($data['communities']->section_iii_button_name)
                                <a href="{{ $data['communities']->section_iii_button_name }}" class="green-btn fff">Download the latest market report</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

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
                            <div class="owl-carousel " id="instructor-slider">
                            
                            @if(isset($allProperties) && !empty($allProperties))
                              @foreach($allProperties as $item)
                                  
                              @php
                              $item= (object) $item;
                              if(($item->property_source == "project")){
                                        $routeName = 'devlopment.detail_page';
                                    }elseif($item->property_source == "private"){
                                        $routeName = 'private.detail_page';
                                    }elseif($item->property_source == "invest"){
                                        $routeName = 'investment.detail_page';
                                    }else{
                                        $routeName = 'detail.page';
                                    }
                                @endphp

                              <div class="item">
                                    <div class="card-box"> 
										
                                            <figure>
                                                <div class="VillaText">
                                                    <p>{{ ucfirst($item->property_type['type_name']) }}</p>
                                                </div> <a href="{{ route($routeName, $item->slug ?? '#') }}"><img src="{{ asset($item->featured_image) }}"
                                                  onerror="this.onerror=null; this.src='{{ asset('img/list/4.png') }}';"
                                                  alt=""> </a>

                                                  <div class="Wishlist {{ in_array(route($routeName,$item->slug), $wish) ? 'added' : '' }}" 
                                                                    data-id="{{ $item->id }}" 
                                                                    data-type="{{ $item->property_source }}" 
                                                                    data-url="{{ route($routeName, $item->slug) }}"  
                                                                    data-auth="{{ isset(auth()->user()->id) ? auth()->user()->id : '' }}">
                                                                    <img class="heart-o-icon" src="{{ asset('img/heart-o.svg') }}">
                                                                    <img src="{{ asset('img/heart.svg') }}" class="heart-icon">
                                                                </div>
                                            </figure>
                                        
                                        <figcaption>
                                            <a href="{{ route($routeName, $item->slug ?? '#') }}">
                                            <h3>{{ $item->name }}</h3>
                                            <span class="address_section d-flex align-items-start">
                                                <img style="width:12px;margin-top:4px;margin-right:5px;" src="{{ asset('/img/hotel/map.svg')}}">{!! $item->address !!}
                                            </span>
                                            @if($item->property_source != "branded")
                                            <div class="HotelViews">
                                                <ul>
                                                    @if(number_format($item->area))
                                                    <li>
                                                        <img src="{{ asset('/img/hotel/1.svg')}}"> {{ number_format($item->area) }} SQ FT
                                                    </li>
                                                    @endif
                                                    @if(number_format($item->bed))
                                                    <li>
                                                        <img src="{{ asset('/img/hotel/2.svg')}}"> {{ number_format($item->bed) }}
                                                    </li>
                                                    @endif
                                                    @if(number_format($item->jacuzzi))
                                                    <li>
                                                        <img src="{{ asset('/img/hotel/3.svg')}}"> {{ number_format($item->jacuzzi) }}
                                                    </li>
                                                    @endif
                                                </ul>
                                            </div>
                                            <h6>
                                                <span>$</span> {{ number_format($item->sale_price) }}/-
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



@endsection

@section('scripts')
<script>

</script>
<style>
    ol li {
    color: #fff;
}
</style>
@endsection
