<div class="banner-form mobile-none">
                          <div class="banner-form">
                              <form action="{{ route('common.search') }}" method="POST">
                                @csrf
                                  <div class="BookingBox">
                                      <div class="BookingLocation">
                                          <div class="BookingFrom">
                                              <input type="text" name="location" class="form-control"
                                                  placeholder="Search country and city..." value="{{ (isset($searchData['location']) && !empty($searchData['location']))? $searchData['location'] : ''  }}" name="location">
                                          </div>
                                          <div class="BookingFrom p-0">

                                            @if($searchData['property_name'])
                                                <input type="hidden" value="{{ $searchData['property_name'] }}" name="property_name">
                                            @elseif($data['property_name'])
                                                <input type="hidden" value="{{ $data['property_name'] }}" name="property_name">
                                            @else
                                                <input type="hidden" value="" name="property_name">
                                            @endif

                                          <select class="form-control" name="property_type">
                                                <option value="">Property Type</option>
                                                @if(isset($old_property_type) && !empty($old_property_type))
                                                    @if(isset($old_property_type) && !empty($old_property_type))
                                                        @foreach($old_property_type as $option)

                                                                    <option value="{{ $option->id }}" 
                                                                        @if(isset($searchData['property_type_id']) && $searchData['property_type_id'] == $option->id) 
                                                                            selected 
                                                                        @endif>
                                                                        {{ $option->type_name }}
                                                                    </option>
                                                                @endforeach
                                                                
                                                    @endif
                                                @else
                                                    @if(isset($property_type) && !empty($property_type))
                                                        @foreach($property_type as $property => $item)
                                                            @if(isset($item) && !empty($item) && $item)
                                                                @foreach($item as $option)

                                                                    <option value="{{ $option->id }}" 
                                                                        @if(isset($searchData['property_type_id']) && $searchData['property_type_id'] == $option->id) 
                                                                            selected 
                                                                        @endif>
                                                                        {{ $option->type_name }}
                                                                    </option>
                                                                @endforeach
                                                                
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endif
                                            </select>

                                          </div>
                                          <!-- <div class="BookingFrom p-0">
                                              <select class="form-control" name="buy">
                                                  <option ="">Buy</option>
                                                  <option @if(isset($searchData['buy']) && $searchData['buy'] == 1) selected @endif>1</option>
                                                  <option @if(isset($searchData['buy']) && $searchData['buy'] == 2) selected @endif>2</option>
                                                  <option @if(isset($searchData['buy']) && $searchData['buy'] == 3) selected @endif>3</option>
                                              </select>
                                          </div> -->
                                          <div class="BookingFrom p-0">
                                              <select class="form-control" name="buy">
                                                  <option>Bedrooms</option>
                                                  <option @if(isset($searchData['bed']) && $searchData['bed'] == 1) selected @endif>1</option>
                                                  <option @if(isset($searchData['bed']) && $searchData['bed'] == 2) selected @endif>2</option>
                                                  <option @if(isset($searchData['bed']) && $searchData['bed'] == 3) selected @endif>3</option>
                                                  <option @if(isset($searchData['bed']) && $searchData['bed'] == 4) selected @endif>4</option>
                                                  <option @if(isset($searchData['bed']) && $searchData['bed'] == 5) selected @endif>5</option>
                                                  <option @if(isset($searchData['bed']) && $searchData['bed'] == 6) selected @endif>6</option>
                                                  <option @if(isset($searchData['bed']) && $searchData['bed'] == 7) selected @endif>7+</option>
                                              </select>
                                          </div>
                                          <div class="BookingFrom p-0 d-none">
                                              <!-- <select class="form-control" name="price">
                                                  <option>Price</option>
                                                  <option @if(isset($searchData['price']) && $searchData['price'] == 1) selected @endif>1</option>
                                                  <option @if(isset($searchData['price']) && $searchData['price'] == 2) selected @endif>2</option>
                                                  <option @if(isset($searchData['price']) && $searchData['price'] == 3) selected @endif>3</option>
                                              </select> -->

                                              {{-- <div class="dropdown">
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
                                                </div> --}}

                                          </div>
                                          <div class="BookingFromBtn"> <button type="submit"><img
                                          src="{{ asset('img/search.svg') }}"></button></div>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </div>

                      <style>
                        .banner.inr-banner {
                            min-height: 300px;
                            padding-top: 72px;
                            padding-bottom: 72px;
                            border-radius: 0;
                            position: relative;
                            overflow: unset;
                            height: auto;
                            margin-bottom: 0;
                        }
                      </style>