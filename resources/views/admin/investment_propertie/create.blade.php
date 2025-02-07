@extends('admin.adminLayout')
@section('title', 'Pages: Add Properties')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <section>
        <p class="heading_for_admin_section">New Investment Properties</p>
        <div class="section_content">
            <form id="image-upload-form" action="{{ route('investment_properties.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Name <span class="mandatory">*</span></label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}"
                        required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="property_description">Property Description </label>
                        <textarea class="form-control" name="property_description" id="property_description" rows="3" >{{ old('property_description') }}</textarea>
                        @error('property_description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">Address </label>
                        <textarea class="normal_textbox" name="address" id="address" rows="3" >{{ old('address') }}</textarea>
                        @error('address')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                



                <div class="form-group">
                    <label for="google_maps_link">Detailed Location</label>
                    <textarea class="normal_textbox" name="google_maps_link" id="google_maps_link" rows="3" >{{ old('google_maps_link') }}</textarea>
                    @error('google_maps_link')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <!-- <small class="form-text text-muted">Please enter a valid URL.</small> -->
                </div>
                
                <div class="form-group">
                    <label for="iframe">Iframe</label>
                    <input type="text" class="form-control" name="iframe" id="iframe" value="{{ old('iframe') }}" >
                    @error('iframe')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <!-- <small class="form-text text-muted">Please enter a valid URL.</small> -->
                </div>

                <div class="form-group">
                    <label for="images">Choose Images</label>
                    <input type="file" accept="image/*" name="images[]" id="images" class="form-control" multiple>
                    @error('images.*')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div id="image-preview" class="mt-3"></div>
                </div>

                <div class="form-group">
                    <label for="featured_image">Featured Image</label>
                    <input type="file" accept="image/*" name="featured_image" class="form-control">
                    @error('featured_image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label for="area">Area</label>
                <input type="number" class="form-control" min="0" name="area" id="area" value="{{ old('area') }}">
                @error('area')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="bed">Bed</label>
                <input type="number" class="form-control"  min="0" name="bed" id="bed" value="{{ old('bed', 0) }}">
                @error('bed')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="price">Price</label>
                <input type="number"  min="0" class="form-control" min="0" name="price" id="price" value="{{ old('price') }}">
                @error('price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="sale_price">Sale Price</label>
                <input type="number"  min="0" class="form-control" min="0" name="sale_price" id="sale_price" value="{{ old('sale_price') }}">
                @error('sale_price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            
        </div>

                </div>


                <div class="form-group">
                    <label>Additional Settings</label><br>

                    <div class="form-check form-check-inline col-md-6">
                        <label class="form-check-label" for="jacuzzi">Jacuzzi</label>
                        <input type="number" min="0" class="form-control" name="jacuzzi" id="jacuzzi" min="0" value="{{ old('jacuzzi') }}">    
                    </div>
                    @error('jacuzzi')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1"
                            {{ old('is_featured') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_featured">Is Featured</label>
                    </div>
                    @error('is_featured')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <!-- <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="is_private" id="is_private" value="1" {{ old('is_private') ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_private">Is Private</label>
                </div>
                @error('is_private')
        <div class="text-danger">{{ $message }}</div>
    @enderror -->
                </div>



                <div class="row">
                    <div class="form-group">
                        <label for="floor_plan">Floor Plan</label>
                        <input type="file" name="floor_plan" class="form-control">
                        @error('floor_plan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="brochure">Brochure</label>
                        <input type="file" name="brochure" class="form-control">
                        @error('brochure')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Facilities</label><br>
                    <div class="form-group">
                        <label for="amenitie_id">Amenities <span class="mandatory">*</span></label>
                        <select class="form-control select2" multiple data-placeholder="Select a Amenity" name="amenities_id[]" id="amenities_id">
                            <option value="">Select amenities</option>
                            @if ($amenitie)
                                @foreach ($amenitie as $item)
                                    <option value="{{ $item->id }}"> {{ $item->amenity_name }} </option>
                                @endforeach
                            @endif
                        </select>
                        @error('amenities_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                        <label class="pt-2" for="property_size">Property Size<span class="mandatory">*</span></label>
                        <select class="form-control" name="property_size" id="property_size">
                            <option value="1 BHK" {{ old('property_size') == '1 BHK' ? 'selected' : '' }}>1 BHK</option>
                            <option value="2 BHK" {{ old('property_size') == '2 BHK' ? 'selected' : '' }}>2 BHK</option>
                            <option value="3 BHK" {{ old('property_size') == '3 BHK' ? 'selected' : '' }}>3 BHK</option>
                            <option value="4 BHK" {{ old('property_size') == '4 BHK' ? 'selected' : '' }}>4 BHK</option>
                            <option value="Studio" {{ old('property_size') == 'Studio' ? 'selected' : '' }}>Studio</option>
                        </select>
                        @error('property_size')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                <div class="form-group">
                    <label for=""><b>Blog Section:</b></label>
                    <div class="form-group col-md-12">
                        <label for="address">Heading </label>
                        <input type="text" class="form-control" name="eighth_heading" id="eighth_heading"
                            value="{{ old('eighth_heading', '') }}">
                        @error('eighth_heading')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group  col-md-12">
                        <label for="blog_background">Background</label>
                        <input type="file" accept="image/*" name="blog_background" id="blog_background" class="form-control">
                        @error('blog_background')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <label>Description </label>
                        <textarea class="form-control" name="eighth_description" id="eighth_description" rows="3">{{ old('eighth_description', '') }}</textarea>
                        @error('eighth_description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        {!! getButtonUrl('eighth_section_button', old('eighth_section_button'), old('eighth_section_button_2'), '') !!}
                    </div>
                    <div class="col-12">
                        {!! getButtonUrl(
                            'eighth_section_button_3',
                            old('eighth_section_button_3'),
                            old('eighth_section_button_3_2'),
                            '',
                            1,
                        ) !!}
                    </div>
                </div>


                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="country_id">Country</label>
                        {!! getCountry('country_id', 'country_id') !!}
                        @error('country_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                   

                    <div class="form-group col-md-6">
                        <label for="category_id">Property Type  <span class="help_url"><a
                                    href="{{ route('property-type.create', 'investment') }}" target="_blank">Add Property
                                    Type</a></label>
                        <select class="form-control" name="category_id" id="category_id">
                            <option value="">Select a property type</option>
                            @if ($propertyTypes)
                                @foreach ($propertyTypes as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('category_id') == $item->id ? 'selected' : '' }}>{{ $item->type_name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="agent_id">Agent</label>
                        <select class="form-control" name="agent_id" id="agent_id">
                            <option value="">Select an Agent</option>
                            @if ($agents)
                                @foreach ($agents as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('agent_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('agent_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {!!  addCommunity(isset($property->community_id)?$property->community_id:'') !!}
                <div class="form-group col-md-12 mt-2">
                    <!-- <label for="meta_tags">Meta Tags <span class="mandatory">*</span></label>
                    <input class="form-control" name="meta_tags" id="meta_tags" rows="3" value="{{ old('meta_tags') }}" > -->
                    {!!  addMetaTag(isset($property->meta_title)?$property->meta_title:'',isset($property->meta_description2)?$property->meta_description2:'') !!}
                    @error('meta_tags')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <label for="status">Status<span class="mandatory">*</span></label>
                <select class="form-control" name="status" id="status">
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>

                    @error('status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="green-btn">Submit</button>
            </form>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.bootstrap5.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            new DataTable('#example');
        });
        document.getElementById('images').addEventListener('change', function() {
            const previewContainer = document.getElementById('image-preview');
            previewContainer.innerHTML = ''; // Clear previous previews

            for (const file of this.files) {
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.classList.add('img-thumbnail', 'mr-2');
                img.style.maxHeight = '150px';
                previewContainer.appendChild(img);
            }
        });
    </script>
@endsection
