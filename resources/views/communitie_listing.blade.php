@extends('layouts.app')
@section('title', $foundProperty['page_title'] ?? '')
@section('meta')

@endsection
@section('content')

<section class="banner inr-banner" style="background-image: url({{ asset('img/inr-banner.png') }});">
         <div class="container">
            <div class="slider-info">
               <div class="BannerBox">
                  <div class="banner-heading text-center">
                     <h1>Communities</h1>
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
								<li><a href="{{ asset('/') }}" class="">Home</a></li>
								<li><span class="">Communities</span></li>
							</ul>
						</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="space position-relative">
          <div class="container">

              <div class="listing-top-area">
                  <div class="row">
                      <div class="col-12">
                          <div class="listing-top-area-container">
                              <div class="item-counter">
                                  <p>Results: <span> {{ $data['communities']->total() }} Properties</span></p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="cards-main">
                  <div class="row">
                      @if (isset($data['communities']) && !empty($data['communities']) && count($data['communities']))
                          @foreach ($data['communities'] as $communitie)
                              <div class="col-lg-3 col-md-6 col-12">
                                    <div class="new-development card-box"> <a href="{{ route('detail.communitie', $communitie->slug) }}">
                                            <figure> <img src="{{ assets($communitie->featured_image,337,340) }}" class="" alt="">
                                            </figure>
                                        </a>
                                        <figcaption> <a href="{{ route('detail.communitie', $communitie->slug) }}">
                                                <h3>{{ $communitie->community_name}}</h3>
                                            </a> </figcaption>
                                    </div>
                              </div>
                          @endforeach
                      @endif
                  </div>
              </div>



              {{ $data['communities']->links('vendor.pagination.custom-pagination') }}





          </div>
      </section>


    @include('faq',['page_name' => 'communities'])

@endsection

@section('scripts')

@endsection
