@extends('layouts.app')

@php
  $page_name = $data['detail']->page_name ?? $data['page_title'] ?? 'The Market';
@endphp


@section('title', $page_name)
@section('meta')
  @if(isset($data['detail']->meta_tags) && !empty($data['detail']->meta_tags))
      {!! $data['detail']->meta_tags !!}
  @endif
@endsection
@section('content')
    <!-- breadcrumb -->
    <section class="breadcrumb-sec">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="bread-container">
                            <ul>
                                <li><a href="{{ asset('/') }}" class="">Home</a></li>
                                <li><a href="{{ route('blogList') }}" class="">The Market</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <section class="space blogs-sec blog-listing-page">
            <div class="container">
                <div class="heading-pnel HeadingMiddleBorder">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="m-0">The Market</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                @if(isset($posts) && !empty($posts))
                    @foreach($posts as $key => $item)
                        @php 
                            $imageLinks = $item->images;

                            $imageArray = explode(',', $imageLinks);

                            $firstImage = isset($imageArray[0]) ? $imageArray[0] : null;
                        @endphp
                        @if($key == 0)
                        <div class="col-12">
                            <div class="feature-box-blog">
                                <figure>
                                    <a href="{{ $item->slug ? route('blog', ['slug' => $item->slug]) : '#' }}"><img alt="Image not found" onerror="this.onerror=null; this.src='{{ asset('featured_images/featured_image_1731072533.jpg') }}';"  src="{{ asset('post/'.$firstImage) }}" class="w-100" alt=""> </a>
                                </figure>
                                <figcaption>
                                    <span>{{ $item->created_at->format('d M Y') }}</span>
                                    <a href="{{ $item->slug ? route('blog', ['slug' => $item->slug]) : '#' }}">
                                        <h3>{{ $item->name }}</h3>
                                        <p class="m-0">
                                            @php
                                                $first42Words = Str::words($item->description, 42);
                                            @endphp    
                                            {!! $first42Words !!}
                                        </p>
                                    </a>
                                </figcaption>
                            </div>
                        </div>
                        @else
                        <div class="col-lg-3 col-md-6 col-6">
                            <div class="blog-box">
                            <figure>
                                <a href="{{ $item->slug ? route('blog', ['slug' => $item->slug]) : '#' }}">
                                <img 
                                    src="{{ asset('post/'.$firstImage) }}" 
                                    alt="Image not found" 
                                    onerror="this.onerror=null; this.src='{{ asset('featured_images/featured_image_1731072533.jpg') }}';" >
                                    </a>
                            </figure>
                                <figcaption> <span>{{ $item->created_at->format('d M Y') }}</span>
                                    <a href="{{ $item->slug ? route('blog', ['slug' => $item->slug]) : '#' }}">
                                        <h4>{{ $item->name }}</h4>
                                    </a>
                                </figcaption>
                            </div>
                        </div>
                        @endif    
                    @endforeach
                @endif

                </div>
                {{ $posts->links('vendor.pagination.custom-pagination') }}
                <!-- pagination -->
                <!-- <div class="pagination-main">
                    <div class="row">
                        <div class="col-12">
                            <div class="pagination-container">
                                <ul>
                                    <li class="prev"><a href="">Prev</a></li>
                                    <li><a href="">1</a></li>
                                    <li><a href="">2</a></li>
                                    <li><a href="">3</a></li>
                                    <li><a href="">4</a></li>
                                    <li class="next"><a href="">Next</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>

    
    </section>
        <?php $posts->links('vendor.pagination.custom-pagination') ?>

  <!-- filters -->
  <div id="filters-sidebar" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">
          <img src="img/cross.svg" alt="" class="" />
        </a>
        
        <div class="filter-head">
          <h2>Filters</h2>
        </div>
        <div class="filter-boxes">
          <div class="filter-box">
              <h4>Sort By</h4>
              <div class="filter-checkboxes">
                  <ul>
                      <li>
                          <input class="styled-checkbox" id="styled-checkbox-1" type="checkbox" value="value1">
                          <label for="styled-checkbox-1">Low  to High</label>
                      </li>
                      
                      <li>
                          <input class="styled-checkbox" id="styled-checkbox-2" type="checkbox" value="value2">
                          <label for="styled-checkbox-2">Low  to High</label>
                      </li>
                  </ul>
              </div>
          </div>
          
          
          <div class="filter-box">
              <h4>Property Type</h4>
              <div class="filter-checkboxes">
                  
              </div>
          </div>
          
          
          
          <div class="filter-box">
              <h4>Property Size</h4>
              <div class="filter-checkboxes">
                  <ul>
                      <li>
                          <input class="styled-checkbox" id="styled-checkbox-8" type="checkbox" value="1 BHK">
                          <label for="styled-checkbox-8">1 BHK</label>
                      </li>
                      
                      <li>
                          <input class="styled-checkbox" id="styled-checkbox-9" type="checkbox" value="2 BHK">
                          <label for="styled-checkbox-9">2 BHK</label>
                      </li>
                      
                      <li>
                          <input class="styled-checkbox" id="styled-checkbox-10" type="checkbox" value="3 BHK">
                          <label for="styled-checkbox-10">3 BHK</label>
                      </li>
                      
                      <li>
                          <input class="styled-checkbox" id="styled-checkbox-11" type="checkbox" value="4 BHK">
                          <label for="styled-checkbox-11">4 BHK</label>
                      </li>
                      
                      <li>
                          <input class="styled-checkbox" id="styled-checkbox-12" type="checkbox" value="Studio">
                          <label for="styled-checkbox-12">Studio</label>
                      </li>
                  </ul>
              </div>
          </div>
          
          
          <div class="filter-box">
              <h4>Price Range <span>(2m - 240m)</span></h4>
              <div class="filter-checkboxes">
                    <div class="d-flex">
                      <div class="wrapper">
                       
                        <div class="slider">
                          <div class="progress"></div>
                        </div>
                        <div class="range-input">
                          <input type="range" class="range-min" min="0" max="10000" value="2500" step="100">
                          <input type="range" class="range-max" min="0" max="10000" value="7500" step="100">
                        </div>
                         <div class="price-input">
                          <div class="field">
                            <span>Min</span>
                            <input type="number" class="input-min" value="$2500">
                          </div>
                          <div class="separator">-</div>
                          <div class="field">
                            <span>Max</span>
                            <input type="number" class="input-max" value="$7500000000">
                          </div>
                        </div>
                      </div>
                    </div>
              </div>
          </div>
          
          
          <div class="filter-box">
              <div class="menu-btn-grup filter-btn-grp p-0">
                  <a class="btn border-btn" href="">Clear Filters</a> 
                  <a class="btn green-btn" href="">Apply Filters</a> 
              </div>
          </div>
          
          
          
        </div>
      </div>
      <div id="filter-overlay"></div>
    @endsection
