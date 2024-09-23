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
                            <p> {!! isset($footerSection->address) ? $footerSection->address : ""!!}</p>
                            <ul>
                                <li><a href="mailto:{{ isset($footerSection->email) ? $footerSection->email : ''}}">{{ isset($footerSection->email) ? $footerSection->email : ""}}</a></li>
                                <li><a href="tel:{{ isset($footerSection->phone) ? $footerSection->phone : ''}}">{{ isset($footerSection->phone) ? $footerSection->phone : ""}}</a></li>
                            </ul>
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
                                        <p>{{$footerSection->newsletter_section}}</p>
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
                                <p>{{$footerSection->copyright}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
                <div class="overlay-body"></div>