@extends('layouts.app')
@section('title', 'About Us')
@section('content')


		<!-- banner -->
        <section class="banner inr-banner" style="background-image: url('{{ asset($aboutPage->main_background) }}');">
         <div class="container">
            <div class="slider-info">
               <div class="BannerBox">
                  <div class="banner-heading text-center">
                     <h1>{{ $aboutPage->title }}</h1>
                  </div>
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
                            <ul>
                                <li><a href="{{ url('/')}}" class="">Home</a></li>
                                <li><span class="">About Us</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

		
		<!-- welcome text -->
		<section class="welcome-text-section space">
            <div class="container">
                <div class="row">
					<div class="col-lg-8 mx-auto">
						<div class="welcome-text text-center">
                            {!! $aboutPage->description !!}
						</div>
					</div>
				</div>
			</div>
		</section>
		
		
        @if(isset($aboutPage->sections) && !empty($aboutPage->sections) && $aboutPage->sections)
    @foreach($aboutPage->sections as $index => $item)
        <section class="about-sec zig-zag-about zig-about after-none space">
            <div class="container">
                <div class="row align-items-center">
                    @if($index % 2 == 0)
                        <!-- For even index: content on left, image on right -->
                        <div class="col-lg-6">
                            <div class="about-content">
                                <h2>{{$item->heading}}</h2>
                                {!! $item->description !!}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="about-left">
                                <div class="about-img">
                                    <div class="img-item" style="aspect-ratio:1/0.7">
                                        <img src="{{ asset($item->image) }}" alt="" class="w-100">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- For odd index: image on left, content on right -->
                        <div class="col-lg-6">
                            <div class="about-left">
                                <div class="about-img">
                                    <div class="img-item" style="aspect-ratio:1/0.7">
                                        <img src="{{ asset($item->image) }}" alt="" class="w-100">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="about-content">
                                <h2>{{$item->heading}}</h2>
                                {!! $item->description !!}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endforeach
@endif

		<!-- section -->
        {!! mediaSection(); !!}
		<!-- section -->
		
		
		 <section class="region-sec bg-black space">
            <div class="container">
                <div class="row">
					<div class="col-lg-3">
						<div class="heading-pnel fff">
                        {!! $aboutPage->team_description !!}
						</div>
					</div>
                    <div class="col-lg-9">
						{!! teamSlider(10); !!}
						
                    </div>
                </div>
            </div>
        </section>
		
		<!-- testimonials -->
        {!! testimonial(); !!}						
              

@endsection
