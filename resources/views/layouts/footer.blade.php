@php
$footerSection = getFooterSection();
@endphp
        <a id="back2Top" class="top-scroll" title="Back to top" href="#" style=""><img src="{{asset('img/arrow-right.svg')}}" class=""></a> 
        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-12 mb-3">
                        <div class="footer-item logo-item">
                            <div class="foot-logo"> <img src="{{asset(siteFooterLogo())}}" class="" alt="logo"> </div>
                            <div id="" class="vcard">
 <span class="fn n">
    <span class="given-name"></span>
  <span class="additional-name"></span>
  <span class="family-name"></span>
</span>
 <div class="org">Morgans International Realty</div>
 <div class="adr">
  <div class="street-address">{!! isset($footerSection->address) ? $footerSection->address : ""!!}</div>
  <span class="locality">Media City</span>
, 
  <span class="region">Dubai</span>
, 
  <span class="postal-code">450642</span>

 </div>
  <a class="email" href="mailto:{{ isset($footerSection->email) ? $footerSection->email : ''}}">{{ isset($footerSection->email) ? $footerSection->email : ""}}</a>

 <div class="tel"><a href="tel:{{ isset($footerSection->phone) ? $footerSection->phone : ''}}">{{ isset($footerSection->phone) ? $footerSection->phone : ""}}</a></div>
</div>
                         
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-12">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-6">
                                <div class="footer-item company-item">
                                    <div class="footer-title">
                                        <h4>Company</h4>
                                    </div>
                                    <ul>
                                        @if(isset($footerSection->navigation_menus) && !empty($footerSection->navigation_menus))
                                        @php
                                                    $footerSections = json_decode($footerSection->navigation_menus, true);
                                                    $urls = $footerSections['urls'] ?? [];

                                        @endphp
                                        @foreach($urls as $key => $item)
                                            <li><a href="{{$key}}">{{$item}}</a></li>    
                                        @endforeach
                                        @endif

                                        <li class="mega-menu-footer"><a style="text-decoration:none" class="" target="">Resources</a>
                                        <div class="submenu">
                                        <ul>
                                            <li class="footerSubMenuTT "><a href="{{ route('devlopment.detail_page','atlantis-the-royal-residences') }}">Atlantis the Royal Residences</a></li>
                                            <li class="footerSubMenuTT "><a href="{{ route('properties-for-sale-dubai') }}">Beach Front Properties for Sale</a></li>
                                            <li class="footerSubMenuTT "><a href="{{ route('beach-front-villas-for-rent-dubai') }}">Beach Front Villas for Rent</a></li>
                                            <li class="footerSubMenuTT "><a href="{{ route('best-real-estate-dubai') }}">Best Real Estate</a></li>
                                            <li class="footerSubMenuTT "><a href="{{ route('bluewaters-apartments-dubai') }}">Bluewaters Apartments Dubai</a></li>
                                            <li class="footerSubMenuTT "><a href="{{ route('blue-water-island-residences-dubai') }}">Blue Water Island Residences</a></li>
                                            <li class="footerSubMenuTT "><a href="{{ route('commercial-land-for-sale-dubai') }}">Commercial Land for Sale</a></li>
                                            <li class="footerSubMenuTT "><a href="{{ route('private.detail_page','district-one-mohammed-bin-rashid-city-villas') }}">District 1 Mohammed Rashid City</a></li>			
                                            <li class="footerSubMenuTT "><a href="{{ route('dubai-real-estate-for-sale') }}">Dubai Real Estate</a></li>
                                            <li class="footerSubMenuTT "><a href="{{ route('private.detail_page','mansion-in-emirates-hills') }}">Emirates Hill Mansions</a></li>
                                            <li class="footerSubMenuTT "><a href="{{ route('private.detail_page','emirates-hills-villas') }}">Emirates Hills Villas</a></li>
                                            <li class="footerSubMenuTT "><a href="{{ route('freehold-land-dubai') }}">Freehold Land in Dubai</a></li>
                                            <li class="footerSubMenuTT "><a href="{{ route('jumeirah-beach-residence-dubai') }}">Jumeirah Beach Residence</a></li>
                                            <li class="footerSubMenuTT "><a href="{{ route('jumeirah-bay-island-villas') }}">Jumeirah Bay Island Villas</a></li>
                                            <li class="footerSubMenuTT "><a href="{{ route('investment.detail_page','building-for-sale-jumeirah-golf-estates') }}">Jumeirah Golf Estates</a></li>
                                            <li class="footerSubMenuTT "><a href="{{ route('apartments-for-sale-dubai') }}">Luxury Apartments for Sale</a></li>
                                            <li class="footerSubMenuTT "><a href="{{ route('beach-house-properties-for-sale-dubai') }}">Luxury Beach House Properties</a></li>
                                            <li class="footerSubMenuTT "><a href="{{ route('villa-for-sale-dubai') }}">Luxury Villas for Sale</a></li>
                                            <li class="footerSubMenuTT "><a href="{{ route('land-for-rent-dubai') }}">Land for Rent</a></li>
                                            <li class="footerSubMenuTT "><a href="{{ route('land-for-sale-palm-jumeirah-dubai') }}">Land for Sale Palm Jumeirah</a></li>
                                            <li class="footerSubMenuTT "><a href="{{ route('land-for-sale-dubai-hills') }}">Land for sale in Dubai Hills</a></li>
                                            <li class="footerSubMenuTT "><a href="{{ route('investment.detail_page','rare-residential-plot-for-sale-in-dubai-marina') }}">Land for Sale in Dubai</a></li>
                                            <li class="footerSubMenuTT "><a href="{{ route('dubai-land-damac-hills') }}">Land in Damac Hills</a></li>
                                            <li class="footerSubMenuTT "><a href="{{ route('land-for-sale-dubai-industrial-city') }}">Land in Dubai Industrial City</a></li> 
                                            <li class="footerSubMenuTT "><a href="{{ route('palm-jumeirah-mansions') }}">Palm Jumeirah Mansions</a></li>  
                                            <li class="footerSubMenuTT "><a href="{{ route('penthouses-for-sale-dubai') }}">Penthouses for Sale</a></li>
                                            <li class="footerSubMenuTT "><a href="{{ route('villas-for-sale-jumeirah-bay-island') }}">Properties in Jumeirah Bay</a></li>
                                            <li class="footerSubMenuTT "><a href="{{ route('property-for-sale-dubai') }}">Property for Sale</a></li>        
                                            <li class="footerSubMenuTT "><a href="{{ route('property-downtown-dubai') }}">Property in Downtown</a></li>
                                            <li class="footerSubMenuTT "><a href="{{ route('real-estate-agents-dubai') }}">Real Estate Agent Dubai</a></li>			
                                            <li class="footerSubMenuTT "><a href="{{ route('villas-downtown-dubai') }}">Villas in Downtown</a></li>
                                        </ul>
                                        <ul>

                        </div>
                </li>
                </ul>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-6 order--1">
                                <div class="footer-item explore-item">
                                    <div class="footer-title">
                                        <h4>Explore Morgan’s</h4>
                                    </div>
                                    <ul>
                                      @if(isset($footerSection->navigation_menus) && !empty($footerSection->navigation_menus))
                                        @php
                                                    $footerSections = json_decode($footerSection->navigation_menus, true);
                                                    $dropdown_urls = $footerSections['dropdown_urls'] ?? [];

                                        @endphp
                                        @foreach($dropdown_urls as $key => $item)
                                            <li><a href="{{$key}}">{{$item}}</a></li>    
                                        @endforeach
                                        @endif

                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="footer-item newsletter-item">
                                    <div class="footer-title">
                                        <h4>Newsletter</h4>
                                    </div>
                                    <div class="from-newsltr">
                                        <p>{!! $footerSection->newsletter_section !!}</p>
                                        <form action="#">
                                            <div class="form-group"> <input name="" type="email" class="form-control" placeholder="Enter your email address..."> <input type="submit" value=""> </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="footer-item Social-Media">
                                    <div class="footer-title">
                                        <h4>Social Media</h4>
                                    </div>
                                    <ul>
                                        @if(isset($footerSection->social_media_links) && !empty($footerSection->social_media_links))
                                        @php
                                                    $footerSections = json_decode($footerSection->social_media_links, true);
                                                    $footerSections = $footerSections ?? [];

                                        @endphp
                                        @foreach($footerSections as $key => $item)
                                            <li><a href="{{$key}}">{!! $item !!}</a></li>    
                                        @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="copy-cont text-center">
                                <p>{!! $footerSection->copyright !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
 
                <div class="overlay-body"></div>

<style>
    li.mega-menu-footer {
        position: relative;
    }
    li.mega-menu-footer .submenu {
        bottom: 18px;
        display: none;
        left: 0;
        padding: 0 0 8px 0;
        position: absolute;
        width: 270px;
        z-index: 999999;
    }
    li.mega-menu-footer .submenu ul {
        background: #313131;
        padding: 0;
    }

    li.mega-menu-footer .submenu ul {
        max-height: 365px;
        overflow: auto;
    }
    li.mega-menu-footer .submenu ul li {
        padding: 0;
    }
    li.mega-menu-footer .submenu ul li a {
        width: 100%;
        display: inline-block;
        padding: 0px 15px;
        height: 30px;
        line-height: 30px;
        color: #fff;
    }
    li.mega-menu-footer:hover .submenu {
        display: block;
    }
.Wishlist.added .heart-o-icon {
    display: none !important;
}
.Wishlist.added .heart-icon {
    display: block !important;
}
.card-box figure a>img {
    height: 100%;
    object-fit: cover;
    width: 100%;
}
</style>

