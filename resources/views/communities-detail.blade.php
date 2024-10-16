@extends('layouts.app')
@section('title', 'Communities Detail')
@section('content')
@if(session('success'))
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
<section class="banner inr-banner" style="background-image: url(img/inr-banner.png);">
    <div class="container">
       <div class="slider-info">
          <div class="BannerBox">
             <div class="banner-heading text-center">
                <h1>Most Expensive Properties Sold in Q3 2022</h1>
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
                        <li><a href="" class="">Home</a></li>
                        <li><a href="" class="">Communities</a></li>
                        <li><a href="" class="">Most Expensive Properties Sold in Q3 2022</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about-sec zig-zag-about zig-about after-none icon-top-right space">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">	
                <div class="about-left">
                    <div class="about-img">
                        <div class="img-item">
                            <img src="img/dubai.png" alt="" class="w-100">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-content">
                    <h3>Dubai Hills Estate :  <br>All you need to know</h3>
                    <p>Discover some of the very best apartments, penthouses, townhouses and villas for rent across Dubai. Located in some of the most prime communities, these homes are designed to cater to every type of lifestyle.Some of the top Dubai communities for apartment rentals include Dubai Marina, Palm Jumeirah, and the Downtown district. Waterfront apartment complexes are always popular, offering a resort-like atmosphere and amenities to match. There is also tremendous interest in branded and serviced residences, which offer a complete lifestyle package where residents don’t have to worry about any of the smaller details.For families moving to Dubai and planning to stay for the long term, villa rentals are an excellent option. </p>
                    <p>The city is home to several master planned communities that are designed to provide a family lifestyle – Arabian Ranches 1 &amp; 2, Dubai Hills Estate and Jumeirah Golf Estates, to name a few. At the higher end of the market, Emirates Hills and Palm Jumeirah are the top choices for villa rentals, offering the finest homes in the city.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="about-sec overflow-image after-none space">
    <div class="container">
    
        <div class="overflow-image-main bg-grey">
        <div class="row align-items-center">
            
            <div class="col-lg-7">
                <div class="about-content">
                    <h2>Branded Residences <br>Definition &amp; Structure</h2>
                    <p>Discover some of the very best apartments, penthouses, townhouses and villas for rent across Dubai. Located in some of the most prime communities, these homes are designed to cater to every type of lifestyle. Some of the top Dubai communities for apartment rentals include Dubai Marina, Palm Jumeirah, and the Downtown district. Waterfront apartment complexes are always popular, offering a resort-like atmosphere and amenities to match. There is also tremendous interest in branded and serviced residences, which offer a complete lifestyle package where residents don’t have to worry about any of the smaller details </p>
                    <div class="btn-grp mt-4">
                        <a href="" class="green-btn">Luxury Properties for sale in Dubai Hills Estate</a>
                        <a href="" class="green-btn">Contact an expert</a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-5 order--1">	
                <div class="about-left">
                    <div class="about-img">
                        <div class="img-item text-right ml-auto">
                            <img src="img/overflow.png" alt="" class="w-100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        
        
    </div>
</section>
<section class="CTA-strip">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="heading-pnel fff m-0">
                    <h2 class="m-0">Insights</h2>
                    <p>Morgan’s International Realty is a luxury real estate brokerage and property investment consultancy firm. Established in Dubai at a tipping point of the industry, to create...</p> 
                    <a href="" class="green-btn fff">Download the latest market report</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="space position-relative">
    <div class="container">
        <div class="heading-pnel HeadingMiddleBorder">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <h2 class="m-0">Featured Properties</h2>
                </div>
                <div class="col-lg-4 col-12"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="cards-main">
                    <div class="owl-carousel owl-loaded owl-drag" id="instructor-slider">
                        
                        
                        
                        
                        
                    <div class="owl-stage-outer owl-height" style="height: 468.344px;"><div class="owl-stage" style="transform: translate3d(-1270px, 0px, 0px); transition: all; width: 4128px;"><div class="owl-item cloned" style="width: 297.5px; margin-right: 20px;"><div class="item">
                            <div class="card-box"> <a href="#">
                                    <figure>
                                        <div class="VillaText">
                                            <p>Villa</p>
                                        </div> <img src="img/list/2.png" class="" alt="">
                                        <div class="Wishlist"><img class="heart-o-icon" src="img/hotel/heart-o.svg"><img src="img/hotel/heart.svg" class="heart-icon"></div>
                                    </figure>
                                </a>
                                <figcaption> <a href="#">
                                        <h3>Stunning 4-Bedroom I Full Sea View</h3>
                                        <p><img src="img/hotel/map.svg">75 Prince St, NY, USA</p>
                                        <div class="HotelViews">
                                            <ul>
                                                <li><img src="img/hotel/1.svg"> 7228 SQ FT</li>
                                                <li><img src="img/hotel/2.svg"> 2</li>
                                                <li><img src="img/hotel/3.svg"> 2</li>
                                            </ul>
                                        </div>
                                        <h6><span>$</span> 195,000,000/-</h6>
                                    </a> </figcaption>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 297.5px; margin-right: 20px;"><div class="item">
                            <div class="card-box"> <a href="#">
                                    <figure>
                                        <div class="VillaText">
                                            <p>Villa</p>
                                        </div> <img src="img/list/3.png" class="" alt="">
                                        <div class="Wishlist"><img class="heart-o-icon" src="img/hotel/heart-o.svg"><img src="img/hotel/heart.svg" class="heart-icon"></div>
                                    </figure>
                                </a>
                                <figcaption> <a href="#">
                                        <h3>Stunning 4-Bedroom I Full Sea View</h3>
                                        <p><img src="img/hotel/map.svg">75 Prince St, NY, USA</p>
                                        <div class="HotelViews">
                                            <ul>
                                                <li><img src="img/hotel/1.svg"> 7228 SQ FT</li>
                                                <li><img src="img/hotel/2.svg"> 2</li>
                                                <li><img src="img/hotel/3.svg"> 2</li>
                                            </ul>
                                        </div>
                                        <h6><span>$</span> 195,000,000/-</h6>
                                    </a> </figcaption>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 297.5px; margin-right: 20px;"><div class="item">
                            <div class="card-box"> <a href="#">
                                    <figure>
                                        <div class="VillaText">
                                            <p>Villa</p>
                                        </div> <img src="img/list/4.png" class="" alt="">
                                        <div class="Wishlist"><img class="heart-o-icon" src="img/hotel/heart-o.svg"><img src="img/hotel/heart.svg" class="heart-icon"></div>
                                    </figure>
                                </a>
                                <figcaption> <a href="#">
                                        <h3>Stunning 4-Bedroom I Full Sea View</h3>
                                        <p><img src="img/hotel/map.svg">75 Prince St, NY, USA</p>
                                        <div class="HotelViews">
                                            <ul>
                                                <li><img src="img/hotel/1.svg"> 7228 SQ FT</li>
                                                <li><img src="img/hotel/2.svg"> 2</li>
                                                <li><img src="img/hotel/3.svg"> 2</li>
                                            </ul>
                                        </div>
                                        <h6><span>$</span> 195,000,000/-</h6>
                                    </a> </figcaption>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 297.5px; margin-right: 20px;"><div class="item">
                            <div class="card-box"> 
                                <a href="#">
                                    <figure>
                                        <div class="VillaText">
                                            <p>Villa</p>
                                        </div> <img src="img/list/3.png" class="" alt="">
                                        <div class="Wishlist"><img class="heart-o-icon" src="img/hotel/heart-o.svg"><img src="img/hotel/heart.svg" class="heart-icon"></div>
                                    </figure>
                                </a>
                                <figcaption> 
                                    <a href="#">
                                        <h3>Stunning 4-Bedroom I Full Sea View</h3>
                                        <p><img src="img/hotel/map.svg">75 Prince St, NY, USA</p>
                                        <div class="HotelViews">
                                            <ul>
                                                <li><img src="img/hotel/1.svg"> 7228 SQ FT</li>
                                                <li><img src="img/hotel/2.svg"> 2</li>
                                                <li><img src="img/hotel/3.svg"> 2</li>
                                            </ul>
                                        </div>
                                        <h6><span>$</span> 195,000,000/-</h6>
                                    </a>
                                </figcaption>
                            </div>
                        </div></div><div class="owl-item active" style="width: 297.5px; margin-right: 20px;"><div class="item">
                            <div class="card-box"> <a href="#">
                                    <figure>
                                        <div class="VillaText">
                                            <p>Villa</p>
                                        </div> <img src="img/list/1.png" class="" alt="">
                                        <div class="Wishlist"><img class="heart-o-icon" src="img/hotel/heart-o.svg"><img src="img/hotel/heart.svg" class="heart-icon"></div>
                                    </figure>
                                </a>
                                <figcaption> <a href="#">
                                        <h3>Stunning 4-Bedroom I Full Sea View</h3>
                                        <p><img src="img/hotel/map.svg">75 Prince St, NY, USA</p>
                                        <div class="HotelViews">
                                            <ul>
                                                <li><img src="img/hotel/1.svg"> 7228 SQ FT</li>
                                                <li><img src="img/hotel/2.svg"> 2</li>
                                                <li><img src="img/hotel/3.svg"> 2</li>
                                            </ul>
                                        </div>
                                        <h6><span>$</span> 195,000,000/-</h6>
                                    </a> </figcaption>
                            </div>
                        </div></div><div class="owl-item active" style="width: 297.5px; margin-right: 20px;"><div class="item">
                            <div class="card-box"> <a href="#">
                                    <figure>
                                        <div class="VillaText">
                                            <p>Villa</p>
                                        </div> <img src="img/list/2.png" class="" alt="">
                                        <div class="Wishlist"><img class="heart-o-icon" src="img/hotel/heart-o.svg"><img src="img/hotel/heart.svg" class="heart-icon"></div>
                                    </figure>
                                </a>
                                <figcaption> <a href="#">
                                        <h3>Stunning 4-Bedroom I Full Sea View</h3>
                                        <p><img src="img/hotel/map.svg">75 Prince St, NY, USA</p>
                                        <div class="HotelViews">
                                            <ul>
                                                <li><img src="img/hotel/1.svg"> 7228 SQ FT</li>
                                                <li><img src="img/hotel/2.svg"> 2</li>
                                                <li><img src="img/hotel/3.svg"> 2</li>
                                            </ul>
                                        </div>
                                        <h6><span>$</span> 195,000,000/-</h6>
                                    </a> </figcaption>
                            </div>
                        </div></div><div class="owl-item active" style="width: 297.5px; margin-right: 20px;"><div class="item">
                            <div class="card-box"> <a href="#">
                                    <figure>
                                        <div class="VillaText">
                                            <p>Villa</p>
                                        </div> <img src="img/list/3.png" class="" alt="">
                                        <div class="Wishlist"><img class="heart-o-icon" src="img/hotel/heart-o.svg"><img src="img/hotel/heart.svg" class="heart-icon"></div>
                                    </figure>
                                </a>
                                <figcaption> <a href="#">
                                        <h3>Stunning 4-Bedroom I Full Sea View</h3>
                                        <p><img src="img/hotel/map.svg">75 Prince St, NY, USA</p>
                                        <div class="HotelViews">
                                            <ul>
                                                <li><img src="img/hotel/1.svg"> 7228 SQ FT</li>
                                                <li><img src="img/hotel/2.svg"> 2</li>
                                                <li><img src="img/hotel/3.svg"> 2</li>
                                            </ul>
                                        </div>
                                        <h6><span>$</span> 195,000,000/-</h6>
                                    </a> </figcaption>
                            </div>
                        </div></div><div class="owl-item active" style="width: 297.5px; margin-right: 20px;"><div class="item">
                            <div class="card-box"> <a href="#">
                                    <figure>
                                        <div class="VillaText">
                                            <p>Villa</p>
                                        </div> <img src="img/list/4.png" class="" alt="">
                                        <div class="Wishlist"><img class="heart-o-icon" src="img/hotel/heart-o.svg"><img src="img/hotel/heart.svg" class="heart-icon"></div>
                                    </figure>
                                </a>
                                <figcaption> <a href="#">
                                        <h3>Stunning 4-Bedroom I Full Sea View</h3>
                                        <p><img src="img/hotel/map.svg">75 Prince St, NY, USA</p>
                                        <div class="HotelViews">
                                            <ul>
                                                <li><img src="img/hotel/1.svg"> 7228 SQ FT</li>
                                                <li><img src="img/hotel/2.svg"> 2</li>
                                                <li><img src="img/hotel/3.svg"> 2</li>
                                            </ul>
                                        </div>
                                        <h6><span>$</span> 195,000,000/-</h6>
                                    </a> </figcaption>
                            </div>
                        </div></div><div class="owl-item" style="width: 297.5px; margin-right: 20px;"><div class="item">
                            <div class="card-box"> 
                                <a href="#">
                                    <figure>
                                        <div class="VillaText">
                                            <p>Villa</p>
                                        </div> <img src="img/list/3.png" class="" alt="">
                                        <div class="Wishlist"><img class="heart-o-icon" src="img/hotel/heart-o.svg"><img src="img/hotel/heart.svg" class="heart-icon"></div>
                                    </figure>
                                </a>
                                <figcaption> 
                                    <a href="#">
                                        <h3>Stunning 4-Bedroom I Full Sea View</h3>
                                        <p><img src="img/hotel/map.svg">75 Prince St, NY, USA</p>
                                        <div class="HotelViews">
                                            <ul>
                                                <li><img src="img/hotel/1.svg"> 7228 SQ FT</li>
                                                <li><img src="img/hotel/2.svg"> 2</li>
                                                <li><img src="img/hotel/3.svg"> 2</li>
                                            </ul>
                                        </div>
                                        <h6><span>$</span> 195,000,000/-</h6>
                                    </a>
                                </figcaption>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 297.5px; margin-right: 20px;"><div class="item">
                            <div class="card-box"> <a href="#">
                                    <figure>
                                        <div class="VillaText">
                                            <p>Villa</p>
                                        </div> <img src="img/list/1.png" class="" alt="">
                                        <div class="Wishlist"><img class="heart-o-icon" src="img/hotel/heart-o.svg"><img src="img/hotel/heart.svg" class="heart-icon"></div>
                                    </figure>
                                </a>
                                <figcaption> <a href="#">
                                        <h3>Stunning 4-Bedroom I Full Sea View</h3>
                                        <p><img src="img/hotel/map.svg">75 Prince St, NY, USA</p>
                                        <div class="HotelViews">
                                            <ul>
                                                <li><img src="img/hotel/1.svg"> 7228 SQ FT</li>
                                                <li><img src="img/hotel/2.svg"> 2</li>
                                                <li><img src="img/hotel/3.svg"> 2</li>
                                            </ul>
                                        </div>
                                        <h6><span>$</span> 195,000,000/-</h6>
                                    </a> </figcaption>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 297.5px; margin-right: 20px;"><div class="item">
                            <div class="card-box"> <a href="#">
                                    <figure>
                                        <div class="VillaText">
                                            <p>Villa</p>
                                        </div> <img src="img/list/2.png" class="" alt="">
                                        <div class="Wishlist"><img class="heart-o-icon" src="img/hotel/heart-o.svg"><img src="img/hotel/heart.svg" class="heart-icon"></div>
                                    </figure>
                                </a>
                                <figcaption> <a href="#">
                                        <h3>Stunning 4-Bedroom I Full Sea View</h3>
                                        <p><img src="img/hotel/map.svg">75 Prince St, NY, USA</p>
                                        <div class="HotelViews">
                                            <ul>
                                                <li><img src="img/hotel/1.svg"> 7228 SQ FT</li>
                                                <li><img src="img/hotel/2.svg"> 2</li>
                                                <li><img src="img/hotel/3.svg"> 2</li>
                                            </ul>
                                        </div>
                                        <h6><span>$</span> 195,000,000/-</h6>
                                    </a> </figcaption>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 297.5px; margin-right: 20px;"><div class="item">
                            <div class="card-box"> <a href="#">
                                    <figure>
                                        <div class="VillaText">
                                            <p>Villa</p>
                                        </div> <img src="img/list/3.png" class="" alt="">
                                        <div class="Wishlist"><img class="heart-o-icon" src="img/hotel/heart-o.svg"><img src="img/hotel/heart.svg" class="heart-icon"></div>
                                    </figure>
                                </a>
                                <figcaption> <a href="#">
                                        <h3>Stunning 4-Bedroom I Full Sea View</h3>
                                        <p><img src="img/hotel/map.svg">75 Prince St, NY, USA</p>
                                        <div class="HotelViews">
                                            <ul>
                                                <li><img src="img/hotel/1.svg"> 7228 SQ FT</li>
                                                <li><img src="img/hotel/2.svg"> 2</li>
                                                <li><img src="img/hotel/3.svg"> 2</li>
                                            </ul>
                                        </div>
                                        <h6><span>$</span> 195,000,000/-</h6>
                                    </a> </figcaption>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 297.5px; margin-right: 20px;"><div class="item">
                            <div class="card-box"> <a href="#">
                                    <figure>
                                        <div class="VillaText">
                                            <p>Villa</p>
                                        </div> <img src="img/list/4.png" class="" alt="">
                                        <div class="Wishlist"><img class="heart-o-icon" src="img/hotel/heart-o.svg"><img src="img/hotel/heart.svg" class="heart-icon"></div>
                                    </figure>
                                </a>
                                <figcaption> <a href="#">
                                        <h3>Stunning 4-Bedroom I Full Sea View</h3>
                                        <p><img src="img/hotel/map.svg">75 Prince St, NY, USA</p>
                                        <div class="HotelViews">
                                            <ul>
                                                <li><img src="img/hotel/1.svg"> 7228 SQ FT</li>
                                                <li><img src="img/hotel/2.svg"> 2</li>
                                                <li><img src="img/hotel/3.svg"> 2</li>
                                            </ul>
                                        </div>
                                        <h6><span>$</span> 195,000,000/-</h6>
                                    </a> </figcaption>
                            </div>
                        </div></div></div></div><div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div><div class="owl-dots disabled"></div></div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection