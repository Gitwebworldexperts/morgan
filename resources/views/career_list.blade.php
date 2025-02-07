@extends('layouts.app')


@section('title', "Careers Apply ")
@section('meta')

@endsection
@section('content')

<section class="banner inr-banner" style="background-image: url('{{ asset('img/inr-banner.png') }}');">
    <div class="container">
        <div class="slider-info">
            <div class="BannerBox">
                <div class="banner-heading text-center">
                    <h1>Careers</h1>
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
                        <li><a href="{{ asset('/') }}" class="">Home</a></li>
                        <li><span class="">Careers</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="jobs-section space">
    <div class="container">
    <div class="heading-pnel HeadingMiddleBorder">
            <div class="row">
                <div class="col-lg-8 col-12">
                    {!! $careerPage['description'] ?? '' !!}
                </div>
                <div class="col-lg-4 col-12">
                    <div class="head-btn"> 
                        <a href="{{ $careerPage['button_link'] ?? '#' }}" target="_blank" class="green-btn ml-auto">Current job oppening</a> 
                    </div>
                </div>
                <div class="col-12">
                    
                </div>
            </div>
        </div>
        <div class="row">
        @if(isset($career) && !empty($career))
            @foreach($career as $item)
            @if($item->status   == "open")
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="job-box">
                        <div class="company-logo">
                            <img src="{{ asset('img/compnay-logo.png') }}" class="" alt="">
                        </div>
                        <div class="job-info">
                            <span>{{ $item->position }}</span>
                            <h4>{{ $item->job_name }}</h4>
                            <div class="job-location">
                                <ul>
                                    <li><img src="{{ asset('img/clock.svg') }}" alt=""> {{ $item->job_type }}</li>
                                    <li><img src="{{ asset('img/location.svg') }}" alt=""> {{ $item->job_location }}</li>
                                </ul>
                            </div>
                        </div>
                        <!-- <a href="{{ route('detail.career', base64_encode($item->id)) }}" class="link-btn">Apply Now</a> -->
                        <a href="{{ route('detail.career', $item->id) }}" class="link-btn">Apply Now</a>
                    </div>
                </div>
                @endif
            @endforeach
        @endif

            
            
        </div>
    </div>
</section>


<section class="video-section space">
            <div class="container">
				<div class="row">
					<div class="col-12">
						<div class="heading-pnel fff text-center">
							<h2>{{ $careerPage['section2_heading'] ?? '' }}</h2>
						</div>
					</div>
                </div>
				<div class="row">
					<div class="col-12">
						<div class="video-main">
							<video loop="loop" autoplay="autoplay" muted="muted">
							  <source src="{{ asset( $careerPage['video_path']) }}" width="100%" type="video/mp4">
							</video>
						</div>
					</div>
				</div>
            </div>
        </section>


        <section class="gallery-section space pt-0">
            <div class="container">
				<div class="row">
					<div class="col-12">
						<div class="heading-pnel text-center">
							<h2>Our Gallery</h2>
						</div>
					</div>
                </div>
				<div class="row">
					<div class="col-12">
						<div class="angry-grid">
                        @if(isset($careerPage->images) && !empty($careerPage->images))
                            @foreach($careerPage->images as $key => $item)
                                <div id="item-{{ $key }}">
                                    <div class="gallery-img">
                                        <img src="{{ asset($item->image_path) }}" class="w-100" alt="">
                                    </div>
                                </div>
                            @endforeach
                        @endif

						</div>
					</div>
				</div>
            </div>
        </section>

        @include('faq', ['page_name' => 'career'])

        {!! mediaSection('all',"media Mentions"); !!}

@endsection
