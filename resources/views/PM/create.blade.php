@extends('admin.adminLayout')
@section('title', 'Pages: Property Management')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <section>
        <p class="heading_for_admin_section">Property Management</p>
    <form class="home_section" id="image-upload-form" action="{{ route('property_management.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="row row-container-section pl-2 pr-2">
            <div class="col-12">
                <div class="form-group">
                    <label for="title">Page Title:</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title',$pm->title) }}" required>
                </div>
                <div >
                    <div class="section_breaker pr">
                        <span class="end_section_name">Section 1</span>
                    </div>
                    <div class="form-group">
                        <label for="section_1_title">Section 1 Title:</label>
                        <input type="text" name="section_1_title" class="form-control" id="section_1_title" value="{{ old('section_1_title',$pm->section_1_title) }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="section_1_description">Section 1 Description:</label>
                        <textarea name="section_1_description" id="section_1_description" required>{{ old('section_1_description',$pm->section_1_description) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="section_1_anchor_link">Section 1 Anchor Link (URL):</label>
                        <input type="url" name="section_1_anchor_link" class="form-control" id="section_1_anchor_link" value="{{ old('section_1_anchor_link',$pm->section_1_anchor_link) }}" >
                    </div>

                    <div class="form-group">
                        <label for="section_1_image">Section 1 Image (optional):</label>
                        <input type="file" class="form-control" name="section_1_image" id="section_1_image">
                        @if($pm->section_1_image)
                            <div id="image-preview" class="mt-3">
                                <img src="{{ asset($pm->section_1_image)}}" class="img-thumbnail mr-2" style="max-height: 150px;">
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="section_breaker pr">
                        <span class="end_section_name">Section 2</span>
                    </div>
                    <div class="form-group">
                        <label for="section_2_title">Section 2 Title:</label>
                        <input type="text" name="section_2_title" id="section_2_title" class="form-control" value="{{ old('section_2_title',$pm->section_2_title) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="section_2_description">Section 2 Description:</label>
                        <textarea name="section_2_description" class="form-control" id="section_2_description" required>{{ old('section_2_description',$pm->section_2_description) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="section_2_anchor_link">Brochure:</label>
                        <input type="file" class="form-control" name="section_2_anchor_link" id="section_2_anchor_link">
                        @if($pm->section_2_anchor_link)
                            <a href="{{ asset($pm->section_2_anchor_link)}}" target="_blank">Download</a>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Get a Quote Image</label>
                     <input type="file" class="form-control" name="get_an_quote_image" id="section_1_image">
                        @if($pm->get_an_quote_image)
                            <div id="image-preview" class="mt-3">
                                <img src="{{ asset($pm->get_an_quote_image)}}" class="img-thumbnail mr-2" style="max-height: 150px;">
                            </div>
                        @endif
                </div>

                <!-- Reource Blog Selection  -->

                @php
                            $selectedBlogs = explode(',', $pm->blog); // Convert the stored string into an array
                        @endphp

                <div class="form-group">
                    <label for="blog">Blogs</label>
                    <select class="form-control select2" multiple data-placeholder="Select Blogs" name="blog[]" id="blog">
                        <option value=""> Select Blogs</option>
                        

                        @if(isset($blogs) && !empty($blogs))
                            @foreach ($blogs as $blog)
                                <option value="{{ $blog->id }}" {{ in_array($blog->id, $selectedBlogs) ? 'selected' : '' }}>
                                    {{ $blog->name }}
                                </option>
                            @endforeach
                        @endif

                    </select>
                    @error('blog')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Reource Blog Selection  -->

            </div>
        </div>
        <button type="submit" class="green-btn">Create Page</button>
    </form>

</section>
    @endsection
    @section('scripts')

    @endsection
    
