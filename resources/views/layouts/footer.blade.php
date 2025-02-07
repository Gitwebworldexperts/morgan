@php
$footerSection = getFooterSection();
$property_type = allPropertyType();
@endphp

<!-- Modal -->
<div class="modal fade" id="search-modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body"> <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close"> <span aria-hidden="true">×</span> </button>
                <div class="search-container">
                    <div class="TopTabsBar">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item"> <a class="nav-link active" id="home-tab" data-toggle="tab"
                                    href="#Buy-two" role="tab" aria-controls="home"
                                    aria-selected="true">Buy</a> </li>
                            <li class="nav-item"> <a class="nav-link" id="profile-tab" data-toggle="tab"
                                    href="#Rent-two" role="tab" aria-controls="profile"
                                    aria-selected="false">Rent</a> </li>
                        </ul>
                    </div> <!-- tab content -->
                    <div class="tab-content" id="myTabContent">
                        <div id="Buy-two" class="tab-pane fade show active" role="tabpanel"
                            aria-labelledby="home-tab">
                            <form action="{{ route('common.search') }}" method="POST">
                            @csrf
                                <div class="BookingBox">
                                    <div class="BookingLocation">
                                        <div class="BookingFrom"> <input type="" name="location"
                                                class="form-control"  placeholder="Search country and city...">
                                        </div>
                                        <input type="hidden" value="buy" name="property_name">
                                        <div class="BookingFrom p-0"> <select name="property_type" class="form-control">
                                            <option>Property Type</option>
                                                @if(isset($property_type) && !empty($property_type))
                                                    @foreach($property_type as $property => $item)
                                                        @if($property == "buy")
                                                            @if(isset($item) && !empty($item))
                                                                @foreach($item as $option)
                                                                    <option value="{{$option->id}}">{{ $option->type_name }}</option>
                                                                @endforeach                                                    
                                                            @endif
                                                        @endif    
                                                    @endforeach
                                                @endif
                                            </select> </div>
                                        <div class="BookingFrom p-0"> <select class="form-control" name="buy">
                                                <option value="">Bedrooms</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7+</option>
                                            </select> </div>
                                        <div class="BookingFromBtn"><button type="submit"><img
                                        src="{{ asset('img/search.svg') }}"> Search</button></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="Rent-two" class="tab-pane fade">
                                <form action="{{ route('common.search') }}" method="POST">
                                @csrf
                                <div class="BookingBox">
                                    <div class="BookingLocation">
                                        <div class="BookingFrom"> <input type="" name="location"
                                                class="form-control" placeholder="Search country and city...">
                                        </div>
                                        <input type="hidden" value="rent" name="property_name"> 
                                        <div class="BookingFrom p-0"> <select name="property_type" class="form-control">
                                            <option>Property Type</option>
                                            @if(isset($property_type) && !empty($property_type))
                                                @foreach($property_type as $property => $item)
                                                    @if($property == "rent")
                                                        @if(isset($item) && !empty($item))
                                                            @foreach($item as $option)
                                                                <option value="{{$option->id}}">{{ $option->type_name }}</option>
                                                            @endforeach                                                    
                                                        @endif
                                                    @endif    
                                                @endforeach
                                            @endif
                                            </select> </div>
                                        <div class="BookingFrom p-0"> <select class="form-control" name="buy">
                                                    <option value="">Bedrooms</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7+</option>
                                            </select> </div>
                                       
                                        <div class="BookingFromBtn"><button type="submit"><img
                                        src="{{ asset('img/search.svg') }}"> Search</button></div>
                                        
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
                                        @php
                                            // Unset variables (not usually necessary in Laravel, but included if required by your logic)
                                            unset($temp, $temp1, $temp2);

                                            // Split the $key into parts
                                            $temp = explode("-", $key);

                                            // Initialize variables with proper validation
                                            $temp1 = isset($temp[0]) && is_numeric($temp[0]) ? $temp[0] : null; // Set to null if not valid
                                            $temp2 = isset($temp[1]) && in_array($temp[1], ['buy', 'rent']) ? ($temp[1] === 'buy' ? 'sales' : $temp[1]) : null;
                                        @endphp

                                        @if($temp2 && $temp1)
                                            <li><a href="{{ route('search', [
                                                'prop_for' => $temp2,
                                                'sub_type' => $temp1, // Use $temp1 here
                                            ]) }}">{{ $item }}</a></li>
                                        @endif

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
                                        <!-- snippet -->
                                            
                                        <link rel="stylesheet" href="https://sibforms.com/forms/end-form/build/sib-styles.css">
                                    <div class="sib-form" style="text-align: center;
                                    background-color: #EFF2F7;                                 ">
                                    <div id="sib-form-container" class="sib-form-container">
                                        <div id="error-message" class="sib-form-message-panel" style="font-size:16px; text-align:left; font-family:Helvetica, sans-serif; color:#661d1d; background-color:#ffeded; border-radius:3px; border-color:#ff4949;max-width:540px;">
                                            <div class="sib-form-message-panel__text sib-form-message-panel__text--center">
                                                <svg viewBox="0 0 512 512" class="sib-icon sib-notification__icon">
                                                <path d="M256 40c118.621 0 216 96.075 216 216 0 119.291-96.61 216-216 216-119.244 0-216-96.562-216-216 0-119.203 96.602-216 216-216m0-32C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm-11.49 120h22.979c6.823 0 12.274 5.682 11.99 12.5l-7 168c-.268 6.428-5.556 11.5-11.99 11.5h-8.979c-6.433 0-11.722-5.073-11.99-11.5l-7-168c-.283-6.818 5.167-12.5 11.99-12.5zM256 340c-15.464 0-28 12.536-28 28s12.536 28 28 28 28-12.536 28-28-12.536-28-28-28z" />
                                                </svg>
                                                <span class="sib-form-message-panel__inner-text">
                                                Your subscription could not be saved. Please try again.
                                                </span>
                                            </div>
                                        </div>
                                        <div></div>
                                        <div id="success-message" class="sib-form-message-panel" style="font-size:16px; text-align:left; font-family:Helvetica, sans-serif; color:#085229; background-color:#e7faf0; border-radius:3px; border-color:#13ce66;max-width:540px;">
                                            <div class="sib-form-message-panel__text sib-form-message-panel__text--center">
                                                <svg viewBox="0 0 512 512" class="sib-icon sib-notification__icon">
                                                <path d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 464c-118.664 0-216-96.055-216-216 0-118.663 96.055-216 216-216 118.664 0 216 96.055 216 216 0 118.663-96.055 216-216 216zm141.63-274.961L217.15 376.071c-4.705 4.667-12.303 4.637-16.97-.068l-85.878-86.572c-4.667-4.705-4.637-12.303.068-16.97l8.52-8.451c4.705-4.667 12.303-4.637 16.97.068l68.976 69.533 163.441-162.13c4.705-4.667 12.303-4.637 16.97.068l8.451 8.52c4.668 4.705 4.637 12.303-.068 16.97z" />
                                                </svg>
                                                <span class="sib-form-message-panel__inner-text">
                                                Your subscription has been successful.
                                                </span>
                                            </div>
                                        </div>
                                        <div></div>
                                        <div id="sib-container" class="sib-container--large sib-container--vertical" style="text-align:center; background-color:rgba(255,255,255,1); max-width:540px; border-radius:3px; border-width:1px; border-color:#C0CCD9; border-style:solid; direction:ltr">
                                            <form id="sib-form" method="POST" action="https://32bf3784.sibforms.com/serve/MUIFAOY4u10vrw5_FjkDnJZbTBRnKk0tW-ucJXBeKirxbyE1j2MG4UxJLjRGZLKWpP7M878cQZgxnXjqAHeJzhF7cVFJkuu-pfJXw7SHVBdG0Oqdv_cPNbf26pZtqsX8h_msuFdDHNGVy5pHy_nzOhhCfOAbCVPh44NpKqVxv5lj9BHpy8UEDAg_iT6CxEEJwiFkSu5sC5vADsD-" data-type="subscription">
                                                
                                                <div style="padding: 8px 0;">
                                                <div class="sib-input sib-form-block">
                                                    <div class="form__entry entry_block">
                                                        <div class="form__label-row ">
                                                            <label class="entry__label" style="display: none; font-weight: 700; text-align:left; font-size:16px; text-align:left; font-weight:700; font-family:Helvetica, sans-serif; color:#3c4858;" for="EMAIL" data-required="*">Enter your email address to subscribe</label>
                                                            <div class="entry__field">
                                                            <input class="input " type="text" id="EMAIL" name="EMAIL" autocomplete="off" placeholder="Enter your email address..." data-required="true" required />
                                                            </div>
                                                        </div>
                                                        <label class="entry__error entry__error--primary" style="font-size:16px; text-align:left; font-family:Helvetica, sans-serif; color:#661d1d; background-color:#ffeded; border-radius:3px; border-color:#ff4949;">
                                                        </label>
                                                    </div>
                                                </div>
                                                </div>
                                                <div style="padding: 8px 0;">
                                                <div class="sib-form-block" style="text-align: left">
                                                    <button class="sib-form-block__button sib-form-block__button-with-loader" style="font-size:16px; text-align:left; font-weight:700; font-family:Helvetica, sans-serif; color:#FFFFFF; background-color:#3E4857; border-radius:3px; border-width:0px;" form="sib-form" type="submit">
                                                        <svg class="icon clickable__icon progress-indicator__icon sib-hide-loader-icon" viewBox="0 0 512 512">
                                                            <path d="M460.116 373.846l-20.823-12.022c-5.541-3.199-7.54-10.159-4.663-15.874 30.137-59.886 28.343-131.652-5.386-189.946-33.641-58.394-94.896-95.833-161.827-99.676C261.028 55.961 256 50.751 256 44.352V20.309c0-6.904 5.808-12.337 12.703-11.982 83.556 4.306 160.163 50.864 202.11 123.677 42.063 72.696 44.079 162.316 6.031 236.832-3.14 6.148-10.75 8.461-16.728 5.01z" />
                                                        </svg>
                                                        SUBSCRIBE
                                                    </button>
                                                </div>
                                                </div>
                                                <input type="text" name="email_address_check" value="" class="input--hidden">
                                                <input type="hidden" name="locale" value="en">
                                            </form>
                                        </div>
                                    </div>
                                    </div>
                                    <!-- END - We recommend to place the above code where you want the form in your website html  -->
                                    <!-- START - We recommend to place the below code in footer or bottom of your website html  -->
                                    <script>
                                    window.REQUIRED_CODE_ERROR_MESSAGE = 'Please choose a country code';
                                    window.LOCALE = 'en';
                                    window.EMAIL_INVALID_MESSAGE = window.SMS_INVALID_MESSAGE = "The information provided is invalid. Please review the field format and try again.";
                                    
                                    window.REQUIRED_ERROR_MESSAGE = "This field cannot be left blank. ";
                                    
                                    window.GENERIC_INVALID_MESSAGE = "The information provided is invalid. Please review the field format and try again.";
                                    
                                    
                                    
                                    
                                    window.translation = {
                                        common: {
                                        selectedList: '{quantity} list selected',
                                        selectedLists: '{quantity} lists selected'
                                        }
                                    };
                                    
                                    var AUTOHIDE = Boolean(0);
                                    </script>
                                    <script defer src="https://sibforms.com/forms/end-form/build/main.js"></script>
                                            <!-- END - We recommend to place the above code in footer or bottom of your website html  -->
                                            <!-- End Brevo Form -->
                                        <!-- snippet -->
                                        
                                        <!-- <form action="#">
                                            <div class="form-group"> <input name="" type="email" class="form-control" placeholder="Enter your email address..."> <input type="submit" value=""> </div>
                                        </form> -->
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
                                            <li><a href="{{$key}}" target="_blank">{!! $item !!}</a></li>    
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



/* snippet */

.from-newsltr .sib-form {
    padding: 0;
    border: 0;
}


</style>

