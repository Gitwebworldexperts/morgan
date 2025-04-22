@extends('layouts.app')
@section('title', $foundProperty['page_title'] ?? '')
@section('meta')

@endsection
@section('content')

<section class="breadcrumb-sec">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="bread-container">
                            <ul>
                                <li><a href="{{ asset('/') }}" class="">Home</a></li>
                                <li><span class="">Property Management</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="about-sec zig-zag-about zig-about after-none space">
            <div class="container">
			 <div class="row">
					<div class="col-lg-8 col-xl-8 mx-auto">
						<div class="welcome-text mb-5 text-center">
							<h2>{{ $data->title }}</h2>	
						</div>
					</div>
				</div>	
                <div class="row align-items-center">
					
                    <div class="col-lg-6">
						<div class="about-content pl-0">
                            <h3 class="text-left">{{ $data->section_1_title }}</h3>
							{!! $data->section_1_description !!}
							@if($data->section_1_anchor_link)
                                <a href="{{ $data->section_1_anchor_link }}" class="link-btn">Read More</a>
                            @endif
                        </div>
                    </div>
					
					<div class="col-lg-6 order--1">	
						<div class="about-left">
							<div class="about-img">
								<div class="img-item">
                                    <img src="{{ asset($data->section_1_image)}}">
								</div>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="welcome-text-section space bg-grey">
            <div class="container">
                <div class="row">
					<div class="col-lg-12">
						<div class="welcome-text">
							<h3 class="text-left mb-3">{{ $data->section_2_title }}</h3>
                            {!! $data->section_2_description !!}
							<br>
                            @if($data->section_2_anchor_link)
							    <a href="{{ $data->section_2_anchor_link }}" download class="green-btn"><img src="img/download-light.svg" class=""> Download the brochure</a>
                            @endif    
                        </div>
					</div>
				</div>
			</div>
		</section>

        <section class="login-page space">
            <div class="container">
                <div class="row no-gutters ">
                    <div class="col-lg-6">
						<div class="login-img">
                            @if($data->get_an_quote_image)
                            <img src="{{ asset($data->get_an_quote_image) }}" alt="" class="w-100">
                            @else
                            <img src="{{ asset('img/login-image.png') }}" alt="" class="w-100">
                            @endif
						</div>
                    </div>
                    <div class="col-lg-6">
                        <div class="login-from">
                            <h2 class="mb-2">Get a quote for your property.</h2>

							@if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form action="{{ route('property-quote.store') }}" method="POST">
                                @csrf
                                <div class="form-group"> 
                                    <label>Full Name</label> 
                                    <input class="form-control" placeholder="John Doe" name="full_name" type="text" required> 
                                </div>
                                <div class="form-group"> 
                                    <label>Email Address </label> 
                                    <input class="form-control" placeholder="example@gmail.com" name="email" type="email" required> 
                                </div>
                                <div class="form-group"> 
                                    <label>Property Location </label> 
                                    <input class="form-control"  placeholder="Property Location" name="property_location" type="text" required> 
                                </div>
                                <div class="form-group"> 
                                    <label>Message</label> 
                                    <textarea class="form-control" placeholder="Enter your Message..." name="message" rows="4" style="height: auto;"></textarea>
                                </div>
                                <div class="form-group"> 
                                    <button type="submit" class="green-btn submit-btn">Submit Details</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        @if(isset($posts) && !empty($posts) && count($posts))
        <section class="space blogs-sec blog-listing-page pt-0">
            <div class="container">
                <div class="heading-pnel text-center">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="m-0">Resources</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                
                    @foreach($posts as $item)
                    @php 
                            $imageLinks = $item->images;

                            $imageArray = explode(',', $imageLinks);

                            $firstImage = isset($imageArray[0]) ? $imageArray[0] : null;
                        @endphp
                    <div class="col-lg-3 col-md-6 col-6">
                        <div class="blog-box">
                            <figure> <img alt="Image not found" onerror="this.onerror=null; this.src='{{ asset('featured_images/featured_image_1731072533.jpg') }}';"  src="{{ asset('post/'.$firstImage) }}" class="w-100" alt=""> </figure>
                            <figcaption> <span>{{ $item->created_at->format('d M Y') }}</span>
                                <a href="{{ $item->slug ? route('blog', ['slug' => $item->slug]) : '#' }}">
                                    <h4>{{ $item->name }}</h4>
                                </a>
                            </figcaption>
                        </div>
                    </div>
                    @endforeach
                
                </div>
            </div>
    </section>
    @endif
    @include('faq', ['page_name' => 'propertyManagement'])



@endsection

@section('scripts')

@endsection
