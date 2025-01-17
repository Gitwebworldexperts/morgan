<div class="banner-form mobile-none">
        <div class="TopTabsBar">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @php
                    $list_property = json_decode($home->list_property); // true for associative array
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        echo "JSON Decode Error: " . json_last_error_msg();
                    }
                    $firstActive = true;
                    $contentActive = true;
                @endphp

                @if($list_property->buy)
                <li class="nav-item"> <a class="nav-link {{ $firstActive ? 'active show' : '' }}" id="home-tab" data-toggle="tab"
                        href="#Buy" role="tab" aria-controls="home" aria-selected="true">Buy</a>
                </li>
                @php $firstActive = false; @endphp
                @endif
                @if($list_property->rent)
                <li class="nav-item"> <a class="nav-link {{ $firstActive ? 'active show' : '' }}" id="profile-tab" data-toggle="tab"
                        href="#Rent" role="tab" aria-controls="profile"
                        aria-selected="false">Rent</a> </li>
                @php $firstActive = false; @endphp
                @endif
                @if($list_property->project)
                <li class="nav-item"> <a class="nav-link {{ $firstActive ? 'active show' : '' }}" id="profile-tab" data-toggle="tab"
                        href="#Project" role="tab" aria-controls="profile"
                        aria-selected="false">Project</a> </li>
                @php $firstActive = false; @endphp
                @endif
                @if($list_property->private)
                <li class="nav-item"> <a class="nav-link {{ $firstActive ? 'active show' : '' }}" id="profile-tab" data-toggle="tab"
                        href="#Private" role="tab" aria-controls="profile"
                        aria-selected="false">Private</a> </li>
                @php $firstActive = false; @endphp
                @endif
                @if($list_property->international)
                <li class="nav-item"> <a class="nav-link {{ $firstActive ? 'active show' : '' }}" id="profile-tab" data-toggle="tab"
                        href="#International" role="tab" aria-controls="profile"
                        aria-selected="false">International</a> </li>
                @php $firstActive = false; @endphp
                @endif
            </ul>
        </div>
        <div class="tab-content">
            @if($list_property->buy)
            <div id="Buy" class="tab-pane fade {{ $contentActive ? 'active show' : '' }}">
                <form action="{{ route('common.search') }}" method="POST">
                    @csrf
                    <div class="BookingBox">
                        <div class="BookingLocation">
                            <div class="BookingFrom"> <input type="" name="location"
                                    class="form-control" placeholder="Search country and city...">
                            </div>
                            <div class="BookingFrom p-0">
                                <input type="hidden" value="buy" name="property_name">
                            
                            <select name="property_type" class="form-control">
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
                            <div class="BookingFrom p-0"> 
                                <select name="buy" class="form-control">
                                    <option value="">Bedrooms</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7+</option>
                                </select> 
                            </div>
                            <div class="BookingFrom p-0 d-none"> <select name="bed" class="form-control">
                                    <option value="">Property Size</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select> </div>
                            <div class="BookingFrom p-0 d-none">
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Price Range
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <div class="price-input">
                                        <div class="field">
                                            <span>Min</span> 
                                            <input type="number" value="" class="input-min" name="min_range">
                                        </div>
                                        <div class="separator">-</div>
                                        <div class="field">
                                            <span>Max</span>
                                            <input type="number" value="" class="input-max" name="max_range">
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="BookingFromBtn"> <button type="submit"><img
                            src="{{ asset('img/search.svg') }}"></button></div>
                        </div>
                    </div>
                </form>
            </div>
            @php $contentActive = false; @endphp
            @endif
            @if($list_property->rent)
            <div id="Rent" class="tab-pane fade {{ $contentActive ? 'active show' : '' }}">
            <form action="{{ route('common.search') }}" method="POST">
                    @csrf<div class="BookingBox">
                        <div class="BookingLocation">
                            <div class="BookingFrom"> <input type="" name="location"
                                    class="form-control" placeholder="Search country and city...">
                            </div>

                            <div class="BookingFrom p-0"> 
                            <input type="hidden" value="rent" name="property_name">    
                            <select name="property_type" class="form-control">
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
                            <div class="BookingFrom p-0"> 
                            <select name="buy" class="form-control">
                                    <option value="">Bedrooms</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7+</option>
                                </select> 
                            
                            </div>
                            <div class="BookingFrom p-0 d-none"> <select name="bed" class="form-control">
                                    <option value="">Property Size</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select> </div>
                            <div class="BookingFrom p-0 d-none">
                            <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Price Range
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <div class="price-input">
                                        <div class="field">
                                            <span>Min</span> 
                                            <input type="number" value="" class="input-min" name="min_range">
                                        </div>
                                        <div class="separator">-</div>
                                        <div class="field">
                                            <span>Max</span>
                                            <input type="number" value="" class="input-max" name="max_range">
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="BookingFromBtn"> <button type="submit"><img
                            src="{{ asset('img/search.svg') }}"></button></div>
                        </div>
                    </div>
                </form>
            </div>
            @php $contentActive = false; @endphp
            @endif
            @if($list_property->project)
            <div id="Project" class="tab-pane fade {{ $contentActive ? 'active show' : '' }}">
            <form action="{{ route('common.search') }}" method="POST">
                    @csrf<div class="BookingBox">
                        <div class="BookingLocation">
                            <div class="BookingFrom"> <input type="" name="location"
                                    class="form-control" placeholder="Search country and city...">
                            </div>
                            <div class="BookingFrom p-0"> 
                            <input type="hidden" value="project" name="property_name">    
                            <select name="property_type" class="form-control">
                                    <option>Property Type</option>
                                    @if(isset($property_type) && !empty($property_type))
                                        @foreach($property_type as $property => $item)
                                            @if($property == "project")
                                                @if(isset($item) && !empty($item))
                                                    @foreach($item as $option)
                                                        <option value="{{$option->id}}">{{ $option->type_name }}</option>
                                                    @endforeach                                                    
                                                @endif
                                            @endif    
                                        @endforeach
                                    @endif
                                </select> </div>
                            <div class="BookingFrom p-0">   <select name="buy" class="form-control">
                                    <option value="">Bedrooms</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7+</option>
                                </select>  </div>
                            <div class="BookingFrom p-0 d-none"> <select name="bed" class="form-control">
                                    <option value="">Property Size</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select> </div>
                            <div class="BookingFrom p-0"> <select name="price" class="form-control">
                                    <option value="">Price</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select> </div>
                            <div class="BookingFromBtn"> <button type="submit"><img
                            src="{{ asset('img/search.svg') }}"></button></div>
                        </div>
                    </div>
                </form>
            </div>
            @php $contentActive = false; @endphp
            @endif
            @if($list_property->private)
            <div id="Private" class="tab-pane fade {{ $contentActive ? 'active show' : '' }}">
            <form action="{{ route('common.search') }}" method="POST">
                    @csrf<div class="BookingBox">
                        <div class="BookingLocation">
                            <div class="BookingFrom"> <input type="" name="location"
                                    class="form-control" placeholder="Search country and city...">
                            </div>
                            <div class="BookingFrom p-0"> 
                            <input type="hidden" value="private" name="property_name">    
                            <select name="property_type" class="form-control">
                                    <option>Property Type</option>
                                    @if(isset($property_type) && !empty($property_type))
                                        @foreach($property_type as $property => $item)
                                            @if($property == "private")
                                                @if(isset($item) && !empty($item))
                                                    @foreach($item as $option)
                                                        <option value="{{$option->id}}">{{ $option->type_name }}</option>
                                                    @endforeach                                                    
                                                @endif
                                            @endif    
                                        @endforeach
                                    @endif
                                </select> </div>
                            <div class="BookingFrom p-0">   <select name="buy" class="form-control">
                                    <option value="">Bedrooms</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7+</option>
                                </select>  </div>
                            <div class="BookingFrom p-0 d-none"> <select name="bed" class="form-control">
                                    <option value="">Property Size</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select> </div>
                            <div class="BookingFrom p-0"> <select name="price" class="form-control">
                                    <option value="">Price</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select> </div>
                            <div class="BookingFromBtn"> <button type="submit"><img
                            src="{{ asset('img/search.svg') }}"></button></div>
                        </div>
                    </div>
                </form>
            </div>
            @php $contentActive = false; @endphp
            @endif
            @if($list_property->international)
            <div id="International" class="tab-pane fade {{ $contentActive ? 'active show' : '' }}">
            <form action="{{ route('common.search') }}" method="POST">
                    @csrf<div class="BookingBox">
                        <div class="BookingLocation">
                            <div class="BookingFrom"> <input type="" name="location"
                                    class="form-control" placeholder="Search country and city...">
                            </div>
                            <div class="BookingFrom p-0"> 
                            <input type="hidden" value="international" name="property_name">    
                            <select name="property_type" class="form-control">
                                    <option>Property Type</option>
                                    @if(isset($property_type) && !empty($property_type))
                                        @foreach($property_type as $property => $item)
                                            @if($property == "international")
                                                @if(isset($item) && !empty($item))
                                                    @foreach($item as $option)
                                                        <option value="{{$option->id}}">{{ $option->type_name }}</option>
                                                    @endforeach                                                    
                                                @endif
                                            @endif    
                                        @endforeach
                                    @endif
                                </select> </div>
                            <div class="BookingFrom p-0">   <select name="buy" class="form-control">
                                    <option value="">Bedrooms</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7+</option>
                                </select>  </div>
                            <div class="BookingFrom p-0 d-none"> <select name="bed" class="form-control">
                                    <option value="">Property Size</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select> </div>
                            <div class="BookingFrom p-0"> <select name="price" class="form-control">
                                    <option value="">Price</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select> </div>
                            <div class="BookingFromBtn"> <button type="submit"><img
                            src="{{ asset('img/search.svg') }}"></button></div>
                        </div>
                    </div>
                </form>
            </div>
            @php $contentActive = false; @endphp
            @endif
        </div>
    </div>
</div>