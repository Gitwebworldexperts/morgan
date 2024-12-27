@extends('layouts.app')
@section('title', $foundProperty['page_title'] ?? '')
@section('meta')

@endsection
@section('content')
<section class="banner inr-banner" style="background-image: url(img/inr-banner.png);">
        <div class="container">
          <div class="slider-info">
            <div class="BannerBox">
              <div class="banner-heading text-center">
                <h1>{{ $report->title }}</h1>
              </div>
            </div>
          </div>
      </div></section>

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
                    <span class="">Research &amp; Insights</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="CTA-strip space">
        <div class="container">
          <div class="row" style="background-image:url({{ asset($report->background) }});">
            <div class="col-lg-6">
              <div class="heading-pnel fff m-0">
                {!! $report->content  !!}
                <a href="{{ old('read_more', $report->read_more ?? '#') }}" class="light-btn">Read more</a>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="space International-sec research-tabs bg-black">
            <div class="container">
                <div class="heading-pnel fff text-center">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="m-0">{{ old('section1_heading', $report->section1_heading ?? '') }}</h2>
                        </div>
                    </div>
                </div>
                <div class="international-main">
                    <div class="row">
                        <div class="col-12">
                            <div class="tabs-grp">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    @for ($i = 1; $i <= 3; $i++)
                                        <li class="nav-item" role="presentation"> 
                                            <a class="nav-link {{ $i == 1 ? 'active' : '' }}" id="Africa-tab{{$i}}" data-toggle="tab" data-target="#Africa{{$i}}" type="button" role="tab" aria-controls="home{{$i}}" aria-selected="{{ $i == 1 ? 'true' : 'false' }}">{{ old('section1_title_' . $i, $report->{'section1_title_' . $i} ?? '') }}</a>
                                        </li>
                                    @endfor
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    @for ($i = 1; $i <= 3; $i++)
                                    <div class="tab-pane fade {{ $i == 1 ? 'show active' : '' }}" id="Africa{{$i}}" role="tabpanel" aria-labelledby="Africa-tab{{$i}}">

                                            <div class="tabs-caption fff">
                                                <div class="row no-gutters">
                                                    <div class="col-lg-6 col-md-6 col-12">
                                                        <div class="res-tab-img m-0 fff">
                                                        @if($report && isset($report->{'section1_image_' . $i}) && !old('section1_image_' . $i))
                                                        <img src="{{ asset($report->{'section1_image_' . $i}) }}" alt="Section {{ $i }} Image" class="w-100" >
                                                        @else
                                                            <img src="img/research.png" class="w-100" alt="">
                                                        @endif
                                                        
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-12">
                                                        <div class="heading-pnel res-tab-content m-0 fff">
                                                            {!! old('section1_content_' . $i, $report->{'section1_content_' . $i} ?? '') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="reposts-section space">
            <div class="container">
				<div class="heading-pnel text-center">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="m-0">{{ $report->section2_title }}</h2>
                        </div>
                    </div>
                </div>
				
                <div class="row">
                    @if(isset($reports) && !empty($reports))
                        @foreach($reports as $item)
                        <div class="col-lg-4">
                            <div class="studio-box">
                                <a href="{{ route('report_inidividual.show', $item->slug) }}">
                                    <figure>
                                    @if($item->featured_image)
                                        <img src="{{ asset($item->featured_image) }}" class="w-100" alt="">
                                    @endif
                                        <figcaption>
                                            <h3>{{  $item->heading }}</h3>
                                        </figcaption>
                                    </figure>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    @endif
				</div>

                <div class="row">
                    @if(0)
                    @for ($i = 1; $i <= 6; $i++)
                        <div class="col-lg-4">
                            <div class="studio-box">
                                <a href="">
                                    <figure>
                                    @if($report && isset($report->{'section2_image_' . $i}) && !old('section2_image_' . $i))
                                        <img src="{{ asset($report->{'section2_image_' . $i}) }}" class="w-100" alt="">
                                    @endif
                                        <figcaption>
                                            <h3>{{ old('section2_title_' . $i, $report->{'section2_title_' . $i} ?? '') }}</h3>
                                        </figcaption>
                                    </figure>
                                </a>
                            </div>
                        </div>
                    @endfor
                    @endif
				</div>
			</div>
		</section>

        <section class="Brands-sec pt-0">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-12">
                        <div class="heading-pnel m-0">
                            <h2 class="m-0">media <br>Mentions</h2>
                            <div class="headingBorder"></div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                        <div class="owl-carousel owl-loaded owl-drag" id="Brands">
                            
                            
                            
                            
                            
                        <div class="owl-stage-outer owl-height" style="height: 60px;"><div class="owl-stage" style="transform: translate3d(-1520px, 0px, 0px); transition: 0.25s; width: 2850px;"><div class="owl-item cloned" style="width: 170px; margin-right: 20px;"><div class="brand-box"> <img src="img/brands/1.png" class="" alt=""> </div></div><div class="owl-item cloned" style="width: 170px; margin-right: 20px;"><div class="brand-box"> <img src="img/brands/2.png" class="" alt=""> </div></div><div class="owl-item cloned" style="width: 170px; margin-right: 20px;"><div class="brand-box"> <img src="img/brands/3.png" class="" alt=""> </div></div><div class="owl-item cloned" style="width: 170px; margin-right: 20px;"><div class="brand-box"> <img src="img/brands/4.png" class="" alt=""> </div></div><div class="owl-item cloned" style="width: 170px; margin-right: 20px;"><div class="brand-box"> <img src="img/brands/5.png" class="" alt=""> </div></div><div class="owl-item" style="width: 170px; margin-right: 20px;"><div class="brand-box"> <img src="img/brands/1.png" class="" alt=""> </div></div><div class="owl-item" style="width: 170px; margin-right: 20px;"><div class="brand-box"> <img src="img/brands/2.png" class="" alt=""> </div></div><div class="owl-item" style="width: 170px; margin-right: 20px;"><div class="brand-box"> <img src="img/brands/3.png" class="" alt=""> </div></div><div class="owl-item active" style="width: 170px; margin-right: 20px;"><div class="brand-box"> <img src="img/brands/4.png" class="" alt=""> </div></div><div class="owl-item active" style="width: 170px; margin-right: 20px;"><div class="brand-box"> <img src="img/brands/5.png" class="" alt=""> </div></div><div class="owl-item cloned active" style="width: 170px; margin-right: 20px;"><div class="brand-box"> <img src="img/brands/1.png" class="" alt=""> </div></div><div class="owl-item cloned active" style="width: 170px; margin-right: 20px;"><div class="brand-box"> <img src="img/brands/2.png" class="" alt=""> </div></div><div class="owl-item cloned active" style="width: 170px; margin-right: 20px;"><div class="brand-box"> <img src="img/brands/3.png" class="" alt=""> </div></div><div class="owl-item cloned" style="width: 170px; margin-right: 20px;"><div class="brand-box"> <img src="img/brands/4.png" class="" alt=""> </div></div><div class="owl-item cloned" style="width: 170px; margin-right: 20px;"><div class="brand-box"> <img src="img/brands/5.png" class="" alt=""> </div></div></div></div><div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div><div class="owl-dots disabled"></div></div>
                    </div>
                </div>
            </div>
        </section>


    @include('faq', ['page_name' => 'report'])
@endsection

@section('scripts')

@endsection
