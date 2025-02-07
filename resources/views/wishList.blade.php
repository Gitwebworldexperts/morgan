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

      <section class="banner inr-banner" style="background-image: url('{{ asset('img/inr-banner.png') }}');">
          <div class="container">
              <div class="slider-info">
                  <div class="BannerBox">
                      <div class="banner-heading text-center">
                         <h1>My Favourites</h1>
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
                                <li><a href="{{ route('home') }}" class="">Home</a></li>
                                <li><span  class="">Wishlist</span></li>
                            </ul>
                      </div>
                  </div>
              </div>
          </div>
      </section>
 
   

      <section class="space position-relative">
          <div class="container">
             <div class="row">
              <div class="col-md-3">
                   <div class="ProfileSidebar">
            <h3>My Account</h3>
            <ul>
                <li><a href="{{ route('profile.show') }}">Profile</a></li>
                <li><a href="{{ route('wishlist.index') }}">My Favourites</a></li>
                <li><a href="{{ route('my.inquiries') }}">My Enquiries</a></li>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
            </ul>
            </div>
                  </div>
                  <div class="col-md-9">
              <div class="listing-top-area">
                  <div class="row">
                      <div class="col-12">
                          <div class="listing-top-area-container">
                              <div class="item-counter">
                                  <p class="m-0">Results: <span> {{ $wishList ? count($wishList) : "" }} Properties</span></p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="cards-main">
                  <div class="row">
                      @if (isset($wishList) && !empty($wishList) && count($wishList))
                          @foreach ($wishList as $property)
                            @if(getPropertyDeatil($property->product_type, $property->product_id, 'id') || 1)                          
                              <div class="col-lg-4 col-md-6 col-12">
                                  <div class="card-box" title="{!! getPropertyDeatil($property->product_type,$property->product_id,'name') !!}"> 
                                   
                                   
                                          <figure>
                                              <a href="{{ $property->product_slug }}">
                                                <img src="{{ asset( getPropertyDeatil($property->product_type, $property->product_id, 'featured_image') ) }}"
                                                  onerror="this.onerror=null; this.src='{{ asset('img/thumbnail-placeholder-gallery.png') }}';"
                                                  alt="">
                                                </a>

                                            
                                          </figure>
                                      
                                      <figcaption>
                                          <a href="{{ $property->product_slug }}">
                                              <h3> 
                                              {!! getPropertyDeatil($property->product_type,$property->product_id,'name') !!}
                                              </h3>
                                          </a>
                                      </figcaption>
                                  </div>
                              </div>
                              @endif
                          @endforeach
                      @endif
                      <div class="col-12">
                            {{ $wishList->links('vendor.pagination.custom-pagination') }}
                      </div>
                  </div>
              </div>



    </div>
 </div>



          </div>
      </section>

         

      @endsection
