@extends('layouts.app')
@section('title', $foundProperty['page_title'] ?? '')
@section('meta')

@endsection
@section('content')

<section class="banner inr-banner" style="background-image: url(img/inr-banner.png);">
         <div class="container">
            <div class="slider-info">
               <div class="BannerBox">
                  <div class="banner-heading">
                     <h1>List With Us</h1>
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
                                <li><span href="" class="">List with us</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="welcome-text-section space">
            <div class="container">
                <div class="row">
					<div class="col-lg-8 mx-auto">
						<div class="welcome-text text-center">
							<h2>{{ $section->heading }}</h2>	
							<p class="mb-4"><b>{{ $section->sub_heading }}</b></p>
							<a href="{{ $section->anchor_link ?? '#' }}" class="green-btn mx-auto">Book an instant property valuation</a>
						</div>
					</div>
				</div>
			</div>
		</section>
        <section class="dark-report-sec space position-relative pt-0">
        <div class="container">
          <div class="dark-report-main">
            <div class="row">
              <div class="col-lg-7 col-12">
                <div class="heading-pnel fff mb-0">
                  <div class="dark-report-content">
                    <h2 class="mb-3">{{ $section->section_1_heading }}</h2>
                    <div class="mb-4">{!! $section->section_1_description !!}</div>
                  </div>
                </div>
              </div>
              <div class="col-lg-5 col-12 order--1">
                <div class="dark-report-img">
                  <img src="{{ asset($section->section_1_image) }}" class="w-100" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
    <section class="studio-panel space pt-0">
		<div class="container">
			<div class="row">
				<div class="col-lg-4">
					<div class="studio-box">
						<div class="studio-head">
							<h2 style=" max-width: 70%; margin: 0 auto; ">{{ $section->section_2_title_1 }}</h2>
						</div>
						<a href="{{ $section->section_2_url_1 }}">
							<figure>
								<img src="{{ asset($section->section_2_image_1) }}" class="w-100" alt="">
								<figcaption>
									<h3>{{ $section->section_2_subheading_1 }}</h3>
								</figcaption>
							</figure>
						</a>
					</div>
				</div>

                <div class="col-lg-4">
					<div class="studio-box">
						<div class="studio-head">
							<h2 style=" max-width: 70%; margin: 0 auto; ">{{ $section->section_2_title_2 }}</h2>
						</div>
						<a href="{{ $section->section_2_url_2 }}">
							<figure>
								<img src="{{ asset($section->section_2_image_2) }}" class="w-100" alt="">
								<figcaption>
									<h3>{{ $section->section_2_subheading_2 }}</h3>
								</figcaption>
							</figure>
						</a>
					</div>
				</div>

                <div class="col-lg-4">
					<div class="studio-box">
						<div class="studio-head">
							<h2 style=" max-width: 70%; margin: 0 auto; ">{{ $section->section_2_title_3 }}</h2>
						</div>
						<a href="{{ $section->section_2_url_3 }}">
							<figure>
								<img src="{{ asset($section->section_2_image_3) }}" class="w-100" alt="">
								<figcaption>
									<h3>{{ $section->section_2_subheading_3 }}</h3>
								</figcaption>
							</figure>
						</a>
					</div>
				</div>

			</div>
		</div>
	</section>
    <section class="list-us-sec studio-list-form space">
            <div class="container">
				<div class="row">
					<div class="col-12">
						<div class="heading-pnel fff text-center">
							<h2>Listing form</h2>
						</div>
					</div>
                </div>
                <div class="row">
					<div class="col-lg-12">

						<div class="list-from">
                        @if (session('success'))
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
                            {!! renderInterestForm('listing_form') !!}
						</div>
					</div>
                </div>
            </div>
        </section>
        <section class="welcome-text-section">
            <div class="container">
                <div class="row">
					<div class="col-lg-8 mx-auto">
						<div class="welcome-text text-center">
							<h2>{{ $section->section_3_heading }}</h2>	
							<p><b>{{ $section->section_3_subheading }}</b></p>
							<a href="{{ $section->section_3_anchor_link ?? '#' }}" class="green-btn mx-auto">Connect With Us</a>
							
							<div class="frame-building-img">
								<img src="{{ asset('img/building-frame.png') }}" class="w-100" alt="">
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

@endsection

@section('scripts')

@endsection
