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
            <form id="image-upload-form" action="{{ route('listing.update', $listing->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Page Name <span class="mandatory">*</span></label>
                    <input type="text" class="form-control" disabled name="name" id="name" value="{{ old('name',$listing->page_name) }}"
                        required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group d-none">
                    <label for="name">Breadcrumbs<span class="mandatory">*</span></label>
                    <input type="text" class="form-control" name="breadcrumbs" id="breadcrumbs" value="{{ old('breadcrumbs',$listing->breadcrumbs) }}"
                        >
                    @error('breadcrumbs')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-group">
                    <label for=""><b>Blog Section:</b></label>
                    <div class="form-group col-md-12">
                        <label for="address">Heading </label>
                        <input type="text" class="form-control" name="eighth_heading" id="eighth_heading"
                            value="{{ old('eighth_heading', $listing->blog_heading) }}">
                        @error('eighth_heading')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group  col-md-12">
                        <label for="blog_background">Background</label>
                        <input type="file" name="blog_background" id="blog_background" class="form-control">
                        @error('blog_background')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-12">
                        <div class="current-banners row">
                            @if($listing->blog_background)
                                
                                    <div class="banner col-xl-2 col-md-3 col-sm-4 pr">
                                        <img src="{{ asset($listing->blog_background) }}" alt="Blog Left Image" style="height: auto;">
                                    </div>
                            @else
                                <p>No image found .</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label>Description </label>
                        <textarea class="form-control" name="eighth_description" id="eighth_description" rows="3">{{ old('eighth_description', $listing->blog_description) }}</textarea>
                        @error('eighth_description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        {!! getButtonUrl('eighth_section_button', old('eighth_section_button',$listing->blog_button_label), old('eighth_section_button_2',$listing->blog_button_url), '') !!}
                    </div>
                </div>
                
                <div class="form-group">
                
                    <div class="form-group col-md-12">
                        <label>Development/International Top Description (Listing)</label>
                        <textarea class="form-control" name="dtd" id="dtd" rows="3">{{ old('dtd', $listing->dtd) }}</textarea>
                        @error('dtd')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <label>Development/International Bottom Description (Listing)</label>
                        <textarea class="form-control" name="dbd" id="dbd" rows="3">{{ old('dbd', $listing->dbd) }}</textarea>
                        @error('dbd')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                      <div class="form-group  col-md-6">
                        <label for="image_1">Image</label>
                        <input type="file" name="image_1" id="image_1" class="form-control">
                        @error('image_1')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="current-banners row">
                            @if($listing->image_1)
                                
                                    <div class="banner col-xl-2 col-md-3 col-sm-4 pr">
                                        <img src="{{ asset($listing->image_1) }}" alt="Blog Left Image" style="height: auto;">
                                    </div>
                            @else
                                <p>No image found .</p>
                            @endif
                        </div>
                    </div>
                        <div class="form-group  col-md-6">
                        <label for="image_2">Image II</label>
                        <input type="file" name="image_2" id="image_2" class="form-control">
                        @error('image_1')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="current-banners row">
                            @if($listing->image_2)
                                
                                    <div class="banner col-xl-2 col-md-3 col-sm-4 pr">
                                        <img src="{{ asset($listing->image_2) }}" alt="Blog Left Image" style="height: auto;">
                                    </div>
                            @else
                                <p>No image found .</p>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="number_property">Number of property sell (International)<span class="mandatory">*</span></label>
                        <input type="text" class="form-control" name="number_property" id="number_property" value="{{ old('number_property',$listing->number_property) }}"
                            >
                        @error('number_property')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="number_client">Number of happy client (International) <span class="mandatory">*</span></label>
                        <input type="text" class="form-control" name="number_client" id="number_client" value="{{ old('number_client',$listing->number_client) }}"
                            >
                        @error('number_client')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    </div> 

                </div>

                <div class="row">
                    <div class="form-group col-md-12 mt-2">
                        <label for="meta_tags">Meta Tags <span class="mandatory">*</span></label>
                        <input class="form-control" name="meta_tags" id="meta_tags" rows="3" value="{{ old('meta_tags',$listing->meta_tags) }}" >
                        @error('meta_tags')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                

                <button type="submit" class="green-btn">Update</button>
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
 

@endsection
