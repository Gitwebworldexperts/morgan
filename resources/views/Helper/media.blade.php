<section class="Brands-sec">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-12">
                        <div class="heading-pnel m-0">
                            @if(isset($new_heading) && !empty($new_heading) && $new_heading)
                                <h2 class="m-0">{!! $new_heading !!}</h2>
                            @else
                                <h2 class="m-0">media <br>Mentions</h2>
                            @endif

                            <div class="headingBorder"></div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                        <div class="owl-carousel" id="Brands">
                            @if(isset($gallery) && !empty($gallery))
                                @foreach($gallery as $item)
                                    <div class="brand-box"> <img src="{{ asset($item->image) }}" class="" alt="{{ $item->alt }}" /> </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
				<br>
		<br>
        </section> 