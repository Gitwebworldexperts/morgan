<section class="region-sec testimonial-sec space">
    <div class="container">
        <div class="heading-pnel text-center">
            <h2>Testimonials</h2>
        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="owl-carousel" id="testimonials">
                    @if (isset($testimonials) && !empty($testimonials))
                        @foreach ($testimonials as $item)
                            <div class="item">
                                <div class="testimonial-box">
                                    <h4>{!! strip_tags($item->detail) !!}</h4>
                                    <div class="user-info">
                                        <h6>{{ $item->name }} / <span>{{ $item->location }}</span></h6>
                                    </div>
                                    <ul class="rating-star">
                                        <?php
                                        $rating = min(max($item->rating, 0), 5); // Ensure the rating is between 0 and 5
                                        
                                        // Loop to generate 5 stars
                                        for ($i = 1; $i <= 5; $i++) {
                                            // Check if the current star is filled
                                            $class = $i <= $rating ? 'fa-star' : 'fa-star-o'; // filled or empty star
                                            echo "<li><i class='fa {$class}' aria-hidden='true'></i></li>";
                                        }
                                        ?>
                                    </ul>


                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
