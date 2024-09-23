@extends('admin.adminLayout')
@section('title', 'Edit Property')
@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <section>
        <p class="heading_for_admin_section">Edit Property</p>
        <div class="section_content">
            <form id="image-upload-form" action="{{ route('properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name <span class="mandatory">*</span></label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $property->name) }}" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address">Address <span class="mandatory">*</span></label>
                    <textarea class="form-control" name="address" id="address" rows="3" required>{{ old('address', $property->address) }}</textarea>
                    @error('address')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="google_maps_link">Google Maps Link</label>
                    <input type="url" class="form-control" name="google_maps_link" id="google_maps_link" pattern="https?://.*" placeholder="https://example.com" value="{{ old('google_maps_link', $property->google_maps_link) }}">
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
                    <input type="file" name="featured_image" class="form-control">
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
                        <input type="text" class="form-control" name="area" id="area" value="{{ old('area', $property->area) }}">
                        @error('area')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="bed">Bed</label>
                        <input type="number" class="form-control" name="bed" id="bed" value="{{ old('bed', $property->bed) }}">
                        @error('bed')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>                    
                    <div class="form-group col-md-6">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" name="price" id="price" step="0.01" value="{{ old('price', $property->price) }}">
                        @error('price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="sale_price">Sale Price</label>
                        <input type="number" class="form-control" name="sale_price" id="sale_price" step="0.01" value="{{ old('sale_price', $property->sale_price) }}">
                        @error('sale_price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Additional Settings</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured',$property->is_featured) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_featured">Is Featured</label>
                    </div>
                    @error('is_featured')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="is_private" id="is_private" value="1" {{ old('is_private',$property->is_private) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_private">Is Private</label>
                    </div>
                    @error('is_private')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>


                <div class="form-group">
                    <label>Facilities</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="jacuzzi" id="jacuzzi" value="1" {{ old('jacuzzi', $property->jacuzzi) ? 'checked' : '' }}>
                        <label class="form-check-label" for="jacuzzi">Jacuzzi</label>
                    </div>
                    @error('jacuzzi')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
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
                        <label for="category_id">Property Type <span class="mandatory">*</span> <span class="help_url"><a href="{{ route('property-type.create','master') }}" target="_blank">Add Property Type</a></span></label>
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
                </div>
                

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </section>
@endsection

@section('scripts')
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
                        method: 'DELETE',
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
    </script>

@endsection
