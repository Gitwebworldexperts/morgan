@extends('admin.adminLayout')
@section('title', 'Pages: Create Section')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <section>
        <div class="container">
            <p class="heading_for_admin_section">Create Section</p>
            <form class="home_section" id="image-upload-form" action="{{ route('sections.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row row-container-section pl-2 pr-2">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="heading">Heading</label>
                            <input type="text" name="heading" id="heading" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="sub_heading">Sub Heading</label>
                            <input type="text" name="sub_heading" id="sub_heading" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="anchor_link">Anchor Link</label>
                            <input type="text" name="anchor_link" id="anchor_link" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="section_1_heading">Section 1 Heading</label>
                            <input 
                                type="text" 
                                name="section_1_heading" 
                                id="section_1_heading" 
                                class="form-control" 
                                value="{{ old('section_1_heading') }}" 
                                required>
                        </div>

                        <div class="form-group">
                            <label for="section_1_description">Section 1 Description</label>
                            <textarea name="section_1_description" id="section_1_description" class="form-control" required>{{ old('section_1_description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="section_1_image">Section 1 Image</label>
                            <input type="file" name="section_1_image" id="section_1_image" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="section_2_image_1">Section 2 Image 1</label>
                            <input type="file" name="section_2_image_1" id="section_2_image_1" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="section_2_title_1">Section 2 Title 1</label>
                            <input type="text" name="section_2_title_1" id="section_2_title_1" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="section_2_subheading_1">Section 2 Subheading 1</label>
                            <input type="text" name="section_2_subheading_1" id="section_2_subheading_1" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="section_2_url_1">Section 2 Url 1</label>
                            <input type="text" name="section_2_url_1" id="section_2_url_1" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="section_2_image_2">Section 2 Image 2</label>
                            <input type="file" name="section_2_image_2" id="section_2_image_2" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="section_2_title_2">Section 2 Title 2</label>
                            <input type="text" name="section_2_title_2" id="section_2_title_2" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="section_2_subheading_2">Section 2 Subheading 2</label>
                            <input type="text" name="section_2_subheading_2" id="section_2_subheading_2" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="section_2_url_2">Section 2 Url 2</label>
                            <input type="text" name="section_2_url_2" id="section_2_url_2" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="section_2_image_3">Section 2 Image 3</label>
                            <input type="file" name="section_2_image_3" id="section_2_image_3" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="section_2_title_3">Section 2 Title 3</label>
                            <input type="text" name="section_2_title_3" id="section_2_title_3" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="section_2_subheading_3">Section 2 Subheading 3</label>
                            <input type="text" name="section_2_subheading_3" id="section_2_subheading_3" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="section_2_url_3">Section 2 Url 3</label>
                            <input type="text" name="section_2_url_3" id="section_2_url_3" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="section_3_heading">Section 3 Heading</label>
                            <input type="text" name="section_3_heading" id="section_3_heading" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="section_3_subheading">Section 3 Subheading</label>
                            <input type="text" name="section_3_subheading" id="section_3_subheading" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="section_3_anchor_link">Section 3 Anchor Link</label>
                            <input type="text" name="section_3_anchor_link" id="section_3_anchor_link" class="form-control">
                        </div>
                        <button type="submit" class="green-btn">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
@section('scripts')

@endsection
