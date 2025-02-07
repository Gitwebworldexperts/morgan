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
    <!-- Breadcrumb -->
    <section class="breadcrumb-sec">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-container">
                        <ul>
                            <li><a href="{{ asset('/') }}">Home</a></li>
                            <li><a href="{{ route('blogList') }}">The Market</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Listing Section -->
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
                            $firstImage = $imageArray[0] ?? null;

                        @endphp
                         <div class="d-none">
                           <!-- // $value = assets('post/'.$firstImage); -->
                        </div>
                        @if($key == 0)
                        <!-- Featured Blog -->
                        <div class="col-12">
                            <div class="feature-box-blog">
                                <figure>
                                    <a href="{{ $item->slug ? route('blog', ['slug' => $item->slug]) : '#' }}">
                                        <img 
                                            src="{{ asset('post/'.$firstImage) }}" 
                                            alt="Image not found" 
                                            onerror="this.onerror=null; this.src='{{ asset('img/thumbnail-placeholder-gallery.png') }}';" 
                                            class="w-100">
                                    </a>
                                </figure>
                                <figcaption>
                                    <span>{{ $item->created_at->format('d M Y') }}</span>
                                    <a href="{{ $item->slug ? route('blog', ['slug' => $item->slug]) : '#' }}">
                                        <h3>{{ $item->name }}</h3>
                                        <p class="m-0">
                                        {!! Str::words(strip_tags($item->description), 42) !!}
                                        </p>
                                    </a>
                                </figcaption>
                            </div>
                        </div>
                        @else
                        <!-- Other Blogs -->
                        <div class="col-lg-3 col-md-6 col-6">
                            <div class="blog-box">
                                <figure>
                                    <a href="{{ $item->slug ? route('blog', ['slug' => $item->slug]) : '#' }}">
                                        <img 
                                            src="{{ asset('post/'.$firstImage) }}" 
                                            alt="Image not found" 
                                            onerror="this.onerror=null; this.src='{{ asset('img/thumbnail-placeholder-gallery.png') }}';">
                                    </a>
                                </figure>
                                <figcaption>
                                    <span>{{ $item->created_at->format('d M Y') }}</span>
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

            <!-- Custom Pagination -->
            {{ $posts->links('vendor.pagination.custom-pagination') }}
        </div>
    </section>

    <!-- Filters Sidebar -->
    <div id="filters-sidebar" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">
            <img src="img/cross.svg" alt="">
        </a>

        <div class="filter-head">
            <h2>Filters</h2>
        </div>
        <div class="filter-boxes">
            <!-- Sort By Filter -->
            <div class="filter-box">
                <h4>Sort By</h4>
                <div class="filter-checkboxes">
                    <ul>
                        <li>
                            <input class="styled-checkbox" id="styled-checkbox-1" type="checkbox" value="value1">
                            <label for="styled-checkbox-1">Low to High</label>
                        </li>
                        <li>
                            <input class="styled-checkbox" id="styled-checkbox-2" type="checkbox" value="value2">
                            <label for="styled-checkbox-2">High to Low</label>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Other Filters -->
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

            <!-- Price Range -->
            <div class="filter-box">
                <h4>Price Range <span>(2m - 240m)</span></h4>
                <div class="filter-checkboxes">
                    <!-- Range Slider -->
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

            <!-- Buttons -->
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
