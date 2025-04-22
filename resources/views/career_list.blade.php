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
                        <a href="{{ $careerPage['button_link'] ?? '#' }}" target="_blank" class="green-btn ml-auto">Current job openings</a> 
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
                            <a href="https://www.morgansrealty.com/careers/apply">
                                <img src="{{ asset('img/compnay-logo.png') }}" class="" alt="">
                            </a>
                        </div>
                        <div class="job-info">
                            <span>{{ $item->position }}</span>
                            <h4><a href="{{ route('detail.career', $item->id) }}">{{ $item->job_name }}</a></h4>
                            <div class="job-location">
                                <ul>
                                    <li><img src="{{ asset('img/clock.svg') }}" alt=""> {{ $item->job_type }}</li>
                                    <li><img src="{{ asset('img/location.svg') }}" alt=""> {{ $item->job_location }}</li>
                                </ul>
                            </div>
                        </div>
                        <!-- <a href="{{ route('detail.career', base64_encode($item->id)) }}" class="link-btn">Apply Now</a> -->
                        @if($item->slug)
                        <a href="{{ route('detail.career', $item->slug) }}" class="link-btn">Apply Now</a>
                        @else
                        <a href="{{ route('detail.career', $item->id) }}" class="link-btn">Apply Now</a>
                        @endif
                    </div>
                </div>
                @endif
            @endforeach
        @endif

            
            
        </div>
    </div>
</section>

@if(0)
<section class="video-section space ">
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
@endif

        <!-- TODO remove -->
        <section class="list-us-sec studio-list-form space">
            <div class="container">
				<div class="row">
					<div class="col-12">
						<div class="heading-pnel fff text-center">
							<h2>Apply Now</h2>
						</div>
					</div>
                </div>
                <div class="row">
					<div class="col-lg-12">
						<div class="list-from">
						    @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <form action="{{ route('career.generic.submit') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Full Name</label>
                                            <input type="text" name="form" style="display:none;">
                                            <input class="form-control" placeholder="John Doe" name="full_name" type="text" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" placeholder="example@gmail.com" name="email" type="email" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Contact Number</label>
                                            <input class="form-control" placeholder="23543 4343 3433" name="contact_number" type="text" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Experience</label>
                                            <input class="form-control" name="experience" type="text" required="">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Add Resume</label>
                                            <input class="form-control" name="resume" type="file" required="" accept=".doc,.docx,.pdf">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <button type="submit" style="margin-left: 0;margin-top: 10px;" class="green-btn submit-btn">Submit <img src="{{ asset('/img/arrow-right3.svg') }}" alt="morgan"></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
						</div>
					</div>
                </div>
            </div>
        </section>
        <!-- TODO remove -->

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
                                        <img src="{{ assets($item->image_path) }}" class="w-100" alt="">
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
