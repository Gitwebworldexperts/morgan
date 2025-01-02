<div class="owl-carousel" id="team-slider">
    @if(isset($team) && !empty($team) && $team)
        @foreach($team as $item)
            <div class="item">
                <div class="member-box">
                    <a data-toggle="modal" data-target="#member-modal{{ $item->id }}">
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
@if(isset($team) && !empty($team) && $team)
    @foreach($team as $item)
        <div class="modal fade MemeberModal" id="member-modal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>	
                        <div class="instructor-box">
                            <figure>
                            <img src="{{ asset($item->photo) }}" class="" alt="">
                            </figure>
                            <figcaption>
                            <h3>{{ $item->name }}</h3>
                            <p class="designation">{!! $item->detail !!}</p>
                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi.</p>
                            <ul>
                                <li><a href=""><img src="{{ asset('img/linkedin.svg') }}" target="_blank"></a></li>
                                <li><a href="mailto: {{ $item->email }}"><img src="{{ asset('img/email.svg') }}" target="_blank"></a></li>
                            </ul>
                            </figcaption>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif
