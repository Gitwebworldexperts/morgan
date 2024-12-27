<div class="owl-carousel" id="team-slider">
    @if(isset($team) && !empty($team) && $team)
        @foreach($team as $item)
            <div class="item">
                <div class="member-box">
                    <a data-toggle="modal" data-target="#member-modal">
                        <figure>
                            <img src="{{ asset($item->photo) }}" alt="" class="" />
                        </figure>
                        <figcaption>
                            <h4>{{ $item->name }}</h4>
                            <p>{!! Str::words($item->detail, 6, '...') !!}</p>
                        </figcaption>
                    </a>
                </div>
            </div>
        @endforeach
    @endif    
</div>