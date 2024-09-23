@extends('admin.adminLayout')
@section('title', 'Pages: Home Page')
@section('content')
 	@if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <section>
    	<p class="heading_for_admin_section">New Properties</p>
    	<div class="section_content">
    		<form id="image-upload-form" action="{{ route('international_properties.store') }}" method="POST" enctype="multipart/form-data">
    			 @csrf
	            <div class="form-group">
            <label for="name">Name <span class="mandatory">*</span></label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="address">Address <span class="mandatory">*</span></label>
            <textarea class="form-control" name="address" id="address" rows="3" required>{{ old('address') }}</textarea>
            @error('address')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>



        <div class="form-group">
            <label for="google_maps_link">Google Maps Link</label>
            <input type="url" class="form-control" name="google_maps_link" id="google_maps_link" pattern="https?://.*" placeholder="https://example.com" value="{{ old('google_maps_link') }}">
            @error('google_maps_link')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <small class="form-text text-muted">Please enter a valid URL.</small>
        </div>

        <div class="form-group">
            <label for="images">Choose Images</label>
            <input type="file" name="images[]" id="images" class="form-control" multiple>
            @error('images.*')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <div id="image-preview" class="mt-3"></div>
        </div>

        <div class="form-group">
            <label for="featured_image">Featured Image</label>
            <input type="file" name="featured_image" class="form-control">
            @error('featured_image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label for="area">Area</label>
                <input type="text" class="form-control" name="area" id="area" value="{{ old('area') }}">
                @error('area')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="bed">Bed</label>
                <input type="number" class="form-control" name="bed" id="bed" value="{{ old('bed', 0) }}">
                @error('bed')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="price">Price</label>
                <input type="number" class="form-control" name="price" id="price" step="0.01" value="{{ old('price') }}">
                @error('price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="sale_price">Sale Price</label>
                <input type="number" class="form-control" name="sale_price" id="sale_price" step="0.01" value="{{ old('sale_price') }}">
                @error('sale_price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            
        </div>


        <div class="form-group">
            <label>Additional Settings</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                <label class="form-check-label" for="is_featured">Is Featured</label>
            </div>
            @error('is_featured')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="is_private" id="is_private" value="1" {{ old('is_private') ? 'checked' : '' }}>
                <label class="form-check-label" for="is_private">Is Private</label>
            </div>
            @error('is_private')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Facilities</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="jacuzzi" id="jacuzzi" value="1" {{ old('jacuzzi') ? 'checked' : '' }}>
                <label class="form-check-label" for="jacuzzi">Jacuzzi</label>
            </div>
            @error('jacuzzi')
                <div class="text-danger">{{ $message }}</div>
            @enderror

        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="country_id">Country</label>
              {!! getCountry('country_id','country_id') !!}
                @error('country_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="category_id">Property Type <span class="mandatory">*</span> <span class="help_url"><a href="{{ route('property-type.create','international') }}" target="_blank">Add Property Type</a></label>
                <select class="form-control" name="category_id" id="category_id">
                    <option value="">Select a property type</option>
                    @if($propertyTypes)
                        @foreach($propertyTypes as $item)
                            <option value="{{$item->id}}" {{ old('category_id') == $item->id ? 'selected' : '' }}>{{$item->type_name}}</option>
                        @endforeach
                    @endif
                </select>
                @error('category_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>    
        </div>
        

	            <button type="submit" class="btn btn-primary">Submit</button>
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
