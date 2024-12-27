@extends('admin.adminLayout')
@section('title', 'Pages: Add Listing')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <section>
        <p class="heading_for_admin_section">New Listing</p>
        <div class="section_content">
            <form id="image-upload-form" action="{{ route('listing.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Page Name <span class="mandatory">*</span></label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}"
                        required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Breadcrumbs<span class="mandatory">*</span></label>
                    <input type="text" class="form-control" name="breadcrumbs" id="breadcrumbs" value="{{ old('breadcrumbs') }}"
                        required>
                    @error('breadcrumbs')
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
                        <input type="file" name="blog_background" id="blog_background" class="form-control">
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
                </div>


                <div class="row">
                    <div class="form-group col-md-12 mt-2">
                        <label for="meta_tags">Meta Tags <span class="mandatory">*</span></label>
                        <input class="form-control" name="meta_tags" id="meta_tags" rows="3" value="{{ old('meta_tags') }}" >
                        @error('meta_tags')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="green-btn">Submit</button>
            </form>
        </div>
    </section>
@endsection
@section('scripts')
<script type="text/javascript">
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
