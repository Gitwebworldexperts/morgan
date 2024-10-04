  @extends('layouts.app')
    @section('title', 'Home Page')
    @section('content')
        <section class="banner inr-banner" style="background-image: url(img/inr-banner.png);">
            <div class="container">
                <div class="slider-info">
                    <div class="BannerBox">
                        <div class="banner-heading text-center">
                            @if (isset($data['page_title']) && !empty($data['page_title']))
                                <h1>{{ $data['page_title'] }}</h1>
                            @else
                                <h1>Properties</h1>
                            @endif

                            }
                        </div>
                        <div class="banner-form mobile-none">
                            <div class="banner-form">
                                <form action="">
                                    <div class="BookingBox">
                                        <div class="BookingLocation">
                                            <div class="BookingFrom">
                                                <input type="" name="" class="form-control"
                                                    placeholder="Search country and city...">
                                            </div>
                                            <div class="BookingFrom p-0">
                                                <select class="form-control">
                                                    <option>Property Type</option>
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                </select>
                                            </div>
                                            <div class="BookingFrom p-0">
                                                <select class="form-control">
                                                    <option>Buy</option>
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                </select>
                                            </div>
                                            <div class="BookingFrom p-0">
                                                <select class="form-control">
                                                    <option>Beds</option>
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                </select>
                                            </div>
                                            <div class="BookingFrom p-0">
                                                <select class="form-control">
                                                    <option>Price</option>
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                </select>
                                            </div>
                                            <div class="BookingFromBtn">
                                                <a href=""><img src="img/header/search.svg"></a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
                                <li><a href="javascript:void(0)" class="">Featured Properties</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="CTA-strip space pb-0">
            <div class="container">
                <div class="row" style="background-image:url(img/buy.png);">
                    <div class="col-lg-6">
                        <div class="heading-pnel fff m-0">
                            <h2 class="m-0">About Properties <br> in Dubai</h2>
                            <p>Discover some of the very best apartments, penthouses, townhouses and villas for rent across
                                Dubai. Located in some of the most prime communities, these homes are designed to cater to
                                every type of lifestyle.Some of the top Dubai communities for apartment rentals include
                                Dubai Marina, Palm Jumeirah, and the Downtown district. Waterfront apartment complexes are
                                always popular, offering a resort-like atmosphere and amenities to match. </p>
                            <a href="" class="border-btn fff">Explore all reports</a>
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
                                    <p>Results: <span> {{ $data['property']->total(); }} Properties</span></p>
                                </div>
                                <div class="filter-trigger">
                                    <a href="" class="green-btn"><img src="img/filter.svg" class=""
                                            alt=""> Filters</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cards-main">
                    <div class="row">
                        @if (isset($data['property']) && !empty($data['property']) && count($data['property']))
                            @foreach ($data['property'] as $property)
                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="card-box"> <a href="#">
                                            <figure>
                                                <div class="VillaText">
                                                    <p>Villa</p>
                                                </div> <img src="{{ asset($property->featured_image) }}" 
     onerror="this.onerror=null; this.src='{{ asset('img/list/4.png') }}';" 
     alt="">

                                                <div class="Wishlist"><img class="heart-o-icon"
                                                        src="img/hotel/heart-o.svg"><img src="img/hotel/heart.svg"
                                                        class="heart-icon"></div>
                                            </figure>
                                        </a>
                                        <figcaption>
                                            <a href="detail.html">
                                                <h3>{{ $property->name }}</h3>
                                                <p><img src="img/hotel/map.svg">{{ $property->address }}</p>
                                                <div class="HotelViews">
                                                    <ul>
                                                        <li><img src="img/hotel/1.svg"> {{ number_format($property->area) }}
                                                            SQ FT</li>
                                                        @if ($property->bed)
                                                            <li><img src="img/hotel/2.svg"> {{ $property->bed }}</li>
                                                        @endif
                                                        @if ($property->jacuzzi)
                                                            <li><img src="img/hotel/3.svg"> {{ $property->jacuzzi }}</li>
                                                        @endif
                                                    </ul>
                                                </div>
                                                <h6><span>$</span> {{ number_format($property->sale_price) }}/-</h6>
                                            </a>
                                        </figcaption>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>



                {{ $data['property']->links('vendor.pagination.custom-pagination') }}





            </div>
        </section>


        @include('faq')
    @endsection
