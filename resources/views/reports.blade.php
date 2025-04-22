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

                <div class="row " >
                    <div id="my_report"></div>
                    @if(isset($reports) && !empty($reports))
                        @foreach($reports as $item)
                        <div class="box home{{ $item->report_type }} col-lg-4" <?php if($item->report_type == 1){ ?> style="display: block;" <?php }else{ ?> style="display: none;" <?php } ?>>
                            <div class="studio-box">
                                <a href="{{ route('report_inidividual.shows', $item->slug) }}">
                                    <figure>
                                    @if($item->background_image)
                                        <img src="{{ asset($item->background_image) }}" class="w-100" alt="">
                                    @else
                                        <img src="{{ asset('img/thumbnail-placeholder-gallery.png') }}" class="w-100" alt="">
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
        {!! mediaSection('all'); !!}
        </section>


    @include('faq', ['page_name' => 'report'])
@endsection

@section('scripts')
    <script>
// Add an event listener to all nav-link elements
document.querySelectorAll('.nav-link').forEach(tab => {
    tab.addEventListener('click', function () {
        // Get the value of aria-controls of the clicked tab
        const targetClass = this.getAttribute('aria-controls');

        // Hide all boxes
        document.querySelectorAll('.box').forEach(box => {
            box.style.display = 'none';
        });

        // Select all boxes with the corresponding class name
        const matchingBoxes = document.querySelectorAll(`.${targetClass}`);
        const element = document.getElementById('my_report');
        if (element) {
            element.innerHTML = "";
        }
        // Check if matching boxes are found
        if (matchingBoxes.length > 0) {
            // Show the boxes with the corresponding class name
            matchingBoxes.forEach(box => {
                box.style.display = 'block';
            });
        } else {
            // If no matching boxes found, display an alert
            const element = document.getElementById('my_report');
            if (element) {
                element.innerHTML = "No report found for the selected tab.";
            }

        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const africaTab = document.getElementById('Africa-tab1');
    if (africaTab) {
        africaTab.click();
    } else {
        console.error("Element with ID 'Africa-tab1' not found.");
    }
});

    </script>
@endsection
