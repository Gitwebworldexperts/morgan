@extends('admin.adminLayout')
@section('title', 'Edit Property')
@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    

    <section>
        <p class="heading_for_admin_section">Edit Property</p>
        <div class="section_content">
            <form id="image-upload-form" action="{{ route('project_properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name <span class="mandatory">*</span></label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $property->name) }}" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="form-group">
                        <label for="property_description">Property Description </label>
                        <textarea class="form-control" name="property_description" id="property_description" rows="3" >{{ old('property_description',$property->description) }}</textarea>
                        @error('property_description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">Address </label>
                        <textarea class="normal_textbox" name="address" id="address" rows="3" >{{ old('address', $property->address) }}</textarea>
                        @error('address')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="google_maps_link">Detailed Location</label>
                    <textarea class="normal_textbox" name="google_maps_link" id="google_maps_link" rows="3" >{{ old('google_maps_link', $property->google_maps_link) }}</textarea>
                    @error('google_maps_link')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <!-- <small class="form-text text-muted">Please enter a valid URL.</small> -->
                </div>

                <div class="form-group">
                    <label for="iframe">Iframe</label>
                    <input type="text" class="form-control" name="iframe" id="iframe" value="{{ old('iframe',$property->iframe) }}" >
                    @error('iframe')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <!-- <small class="form-text text-muted">Please enter a valid URL.</small> -->
                </div>

                <div class="form-group">
                    <label for="images">Choose Images </label>
                    <input type="file" accept="image/*" name="images[]" id="images" class="form-control" multiple>
                    @error('images.*')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div id="image-preview" class="mt-3"></div>
                </div>

               <div class="col-12">
                    <div class="current-banners row">
                        @if($property->banners->isNotEmpty())
                            @foreach($property->banners as $banner)
                                <div class="banner col-xl-2 col-md-3 col-sm-4 pr">
                                    <img src="{{ asset($banner->image_url) }}" alt="Banner Image" style="height: auto;">
                                    <button type="button" class="btn btn-danger x-delete" 
                                        data-url="{{ route('banners.destroy', ['property' => $property->id, 'banner' => $banner->id]) }}">
                                        <i class="fa-solid fa-x"></i>
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <p>No banners found for this property.</p>
                        @endif
                    </div>
                </div>


                <div class="form-group">
                    <label for="featured_image">Featured Image</label>
                    <input type="file" accept="image/*" name="featured_image" class="form-control">
                    @error('featured_image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <div class="current-banners row">
                        @if($property->featured_image)
                            
                                <div class="banner col-xl-2 col-md-3 col-sm-4 pr">
                                    <img src="{{ asset($property->featured_image) }}" alt="Banner Image" style="height: auto;">
                                </div>
                        @else
                            <p>No banners found for this property.</p>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="area">Area</label>
                        <input type="number" min="0" class="form-control" name="area" id="area" value="{{ old('area', $property->area) }}">
                        @error('area')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="bed">Bed</label>
                        <input type="number"  min="0" class="form-control" name="bed" id="bed" value="{{ old('bed', $property->bed) }}">
                        @error('bed')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>                    
                    <div class="form-group col-md-6">
                        <label for="price">Price</label>
                        <input type="number"  min="0" class="form-control" name="price" id="price" min="0" value="{{ old('price', $property->price) }}">
                        @error('price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="sale_price">Sale Price</label>
                        <input type="number" min="0" class="form-control" name="sale_price" id="sale_price" min="0" value="{{ old('sale_price', $property->sale_price) }}">
                        @error('sale_price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Additional Settings</label><br>

                    <div class="form-check form-check-inline col-md-6">
                        <label class="form-check-label" for="jacuzzi">Jacuzzi</label>
                        <input type="number" min="0" class="form-control" name="jacuzzi" id="jacuzzi" min="0" value="{{ old('jacuzzi', $property->jacuzzi) }}">    
                    </div>
                    @error('jacuzzi')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured',$property->is_featured) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_featured">Is Featured</label>
                    </div>
                    @error('is_featured')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="is_branded" id="is_branded" value="1" {{ old('is_branded',$property->is_branded) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_branded">Is Branded</label>
                    </div>
                    @error('is_branded')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    

                    <!-- <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="is_private" id="is_private" value="1" {{ old('is_private',$property->is_private) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_private">Is Private</label>
                    </div>
                    @error('is_private')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror -->



                </div>

                <div class="col-12">
                    <div class="row">
                        
                        <div class="form-group">
                            <label for="floor_plan">Floor Plan</label>
                            <input type="file" name="floor_plan" class="form-control">
                            @if(isset($property->floor_plan) && !empty($property->floor_plan) && $property->floor_plan)
                            <a class="download_document" href="{{ asset($property->floor_plan) }}" download >Floor Plan</a>
                            @endif
                            @error('floor_plan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="brochure">Brochure</label>
                            <input type="file" name="brochure" class="form-control">
                            @if(isset($property->brochure) && !empty($property->brochure) && $property->brochure)
                            <a class="download_document" href="{{ asset($property->brochure) }}" download >Brochure</a>
                            @endif
                            @error('brochure')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

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
                                    <option value="{{ $item->id }}" <?php if(in_array($item->id, explode(",",$property->amenities_id))){ echo "selected"; } ?>> {{ $item->amenity_name }} </option>
                                @endforeach
                            @endif
                        </select>
                        @error('amenities_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <label class="pt-2" for="property_size">Property Size<span class="mandatory">*</span></label>
                    <select class="form-control" name="property_size" id="property_size">
                        <option value="1 BHK" {{ old('property_size',$property->property_size) == '1 BHK' ? 'selected' : '' }}>1 BHK</option>
                        <option value="2 BHK" {{ old('property_size',$property->property_size) == '2 BHK' ? 'selected' : '' }}>2 BHK</option>
                        <option value="3 BHK" {{ old('property_size',$property->property_size) == '3 BHK' ? 'selected' : '' }}>3 BHK</option>
                        <option value="4 BHK" {{ old('property_size',$property->property_size) == '4 BHK' ? 'selected' : '' }}>4 BHK</option>
                        <option value="Studio" {{ old('property_size',$property->property_size) == 'Studio' ? 'selected' : '' }}>Studio</option>
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
                            value="{{ old('eighth_heading', $property->information_heading) }}">
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


                    <div class="col-12">
                        <div class="current-banners row">
                            @if($property->blog_background)
                                
                                    <div class="banner col-xl-2 col-md-3 col-sm-4 pr">
                                        <img src="{{ asset($property->blog_background) }}" alt="Blog Left Image" style="height: auto;">
                                    </div>
                            @else
                                <p>No image found for this property.</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label>Description </label>
                        <textarea class="form-control" name="eighth_description" id="eighth_description" rows="3">{{ old('eighth_description', $property->information_description) }}</textarea>
                        @error('eighth_description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        {!! getButtonUrl('eighth_section_button', old('eighth_section_button',$property->information_button_label), old('eighth_section_button_2',$property->information_button_url), '') !!}
                    </div>
                    <div class="col-12">
                        {!! getButtonUrl('eighth_section_button_3',old('eighth_section_button_3',$property->information_button_label_2),old('eighth_section_button_3_2',$property->information_button_url_2),'',1,'') !!}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="country_id">Country</label>
                        {!! getCountry('country_id','country_id',$property->country_id) !!}
                        @error('country_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="category_id">Property Type  <span class="help_url"><a href="{{ route('property-type.create','project') }}" target="_blank">Add Property Type</a></span></label>
                        <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                            <option value="">Select a property type</option>
                            @if($propertyTypes)
                                @foreach($propertyTypes as $item)
                                    <option value="{{ $item->id }}" {{ old('category_id', $property->category_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->type_name }}
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
                                        {{ old('agent_id',$property->agent) == $item->id ? 'selected' : '' }}>{{ $item->name }}
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
                        <input class="form-control" name="meta_tags" id="meta_tags" rows="3" value="{{ old('meta_tags',$property->meta_tags) }}" > -->
                        {!!  addMetaTag(isset($property->meta_title)?$property->meta_title:'',isset($property->meta_description2)?$property->meta_description2:'') !!}
                        @error('meta_tags')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <label for="status">Status<span class="mandatory">*</span></label>
                        <select class="form-control" name="status" id="status">
                            <option value="active" {{ old('status', $property->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $property->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>

                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                

                <div id="itemsContainer">
                <label for="status">Payment Plan<span class="mandatory">*</span></label>
                <p>Total Percentage: <span id="totalPercentage">0</span>%</p>
                    @if(isset($property->plans) && !empty($property->plans))
                        @foreach($property->plans as $item)
                            <div class="form-row">
                                <input type="text" name="plan_name[]" value="{{ $item->name}}" class="m-auto mlr-1" placeholder="Name" required>
                                <input type="number" name="percentage[]" class="m-auto mlr-1" value="{{ $item->percentage}}" required placeholder="Percentage" min="0" max="100" oninput="updateTotalPercentage()">
                                <input type="text" name="detail[]" class="m-auto mlr-1" value="{{ $item->detail}}" placeholder="Detail" required>
                                <button type="button" class="clone-btn custom_clone_button clone_button border-btn">Clone</button>
                            </div>
                        @endforeach
                    @else
                    <div class="form-row">
                        <input type="text" name="plan_name[]" class="m-auto mlr-1" placeholder="Name" required>
                        <input type="number" name="percentage[]" class="m-auto mlr-1" required placeholder="Percentage" min="0" max="100" oninput="updateTotalPercentage()">
                        <input type="text" name="detail[]" class="m-auto mlr-1" placeholder="Detail" required>
                        <button type="button" class="clone-btn custom_clone_button clone_button border-btn">Clone</button>
                    </div>
                    @endif
                </div>

                


                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="company_id">Company<span class="mandatory">*</span> <a href="{{ route('companies.index') }}" target="_blank">Add Company</a></label>
                        <select class="form-control" name="company_id" id="company_id">
                            <option value="">Select an Company</option>
                            @if ($companies)
                                @foreach ($companies as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('company_id',$property->company_id) == $item->id ? 'selected' : '' }}>{{ $item->company_name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('company_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        {!! getButtonUrl('compnay_listing', old('compnay_listing',$property->compnay_listing), old('compnay_listing_2',$property->compnay_listing_2), '') !!}
                    </div>
                </div>



                <button type="submit" class="green-btn">Update</button>
            </form>
        </div>
    </section>
@endsection

@section('scripts')
<style>
.mlr-1{
    margin-left: 1rem;
    margin-right: 1rem;
}
div#itemsContainer input {
    width: 30%;
    border: 1px solid #777;
}
div#itemsContainer .form-row {
    margin-bottom: 4px;
}
div#itemsContainer .form-row:last-child button {
    display: inline-block;
}
.clone_button {
    display: none;
}
</style>
    <script>
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
    <script>
        document.querySelectorAll('.x-delete').forEach(button => {
            button.addEventListener('click', function() {
                const url = this.getAttribute('data-url');
                if (confirm('Are you sure you want to delete this banner?')) {
                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            // Optionally remove the banner from the DOM
                            button.closest('.banner').remove();
                            alert('Banner deleted successfully.');
                        } else {
                            alert('Error deleting banner.');
                        }
                    });
                }
            });
        });

        let itemCount = 1;
    document.querySelector('#image-upload-form').addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('clone-btn')) {
            const cloneRow = e.target.closest('.form-row').cloneNode(true);
            itemCount++;
            cloneRow.querySelectorAll('input, textarea').forEach(input => input.value = '');
            document.getElementById('itemsContainer').appendChild(cloneRow);
        }
    });

        function updateTotalPercentage() {
        const percentages = document.querySelectorAll('input[name="percentage[]"]');
        let total = 0;
        percentages.forEach(input => {
            total += parseFloat(input.value) || 0;
        });
        document.getElementById('totalPercentage').innerText = total;

        if (total > 100) alert('Total percentage cannot exceed 100!');
    }
    document.addEventListener("DOMContentLoaded", updateTotalPercentage);
    </script>

@endsection
