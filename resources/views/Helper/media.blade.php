<section class="Brands-sec">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-12">
                <div class="heading-pnel m-0">
                    <h2 class="m-0">
                        {!! !empty($new_heading) ? $new_heading : 'media <br>Mentions' !!}
                    </h2>
                    <div class="headingBorder"></div>
                </div>
            </div>

            <div class="col-lg-9 col-md-8 col-12">
                @if(!empty($gallery))
                    <div class="owl-carousel" id="Brands" aria-label="Media Mentions Carousel">
                        @foreach($gallery as $item)
                            @php
                                $imageSrc = asset($item->image);
                                $alt = e($item->alt ?? 'Media Mention Image');
                            @endphp
                            <div class="brand-box">
                                <img
                                    src="{{ $imageSrc }}"
                                    alt="{{ $alt }}"
                                    loading="lazy"
                                    decoding="async"
                                    class="img-fluid"
                                    width="200"
                                    height="auto"
                                />
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
