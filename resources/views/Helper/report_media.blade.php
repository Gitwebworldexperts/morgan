<div class="owl-carousel" id="Brands">
    @if(isset($gallery) && !empty($gallery))
        @foreach($gallery as $item)
            <div class="brand-box"> <img src="{{ asset($item->image) }}" class="" alt="{{ $item->alt }}" /> </div>
        @endforeach
    @endif
</div>