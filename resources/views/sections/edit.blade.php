@extends('admin.adminLayout')

@section('title', 'Edit Section')

@section('content')
    <section>
        <div class="container">
            <h1 class="heading_for_admin_section">List With Us</h1>

            @if (session('success'))
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

            <form class="home_section" id="image-upload-form" action="{{ route('sections.update', $section->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row row-container-section pl-2 pr-2">
                    <div class="col-12">
                        <!-- Heading Field -->
                        <div class="form-group">
                            <label for="heading">Heading</label>
                            <input 
                                type="text" 
                                name="heading" 
                                id="heading" 
                                class="form-control" 
                                value="{{ old('heading', $section->heading) }}" 
                                required>
                        </div>

                        <!-- Sub Heading Field -->
                        <div class="form-group">
                            <label for="sub_heading">Sub Heading</label>
                            <input 
                                type="text" 
                                name="sub_heading" 
                                id="sub_heading" 
                                class="form-control" 
                                value="{{ old('sub_heading', $section->sub_heading) }}" 
                                required>
                        </div>

                        <!-- Anchor Link Field -->
                        <div class="form-group">
                            <label for="anchor_link">Booking Button Url</label>
                            <input 
                                type="text" 
                                name="anchor_link" 
                                id="anchor_link" 
                                class="form-control" 
                                value="{{ old('anchor_link', $section->anchor_link) }}">
                        </div>

                        <div class="form-group">
                            <label for="section_1_heading">Section I Heading</label>
                            <input 
                                type="text" 
                                name="section_1_heading" 
                                id="section_1_heading" 
                                class="form-control" 
                                value="{{ old('section_1_heading', $section->section_1_heading) }}" 
                                required>
                        </div>

                        <div class="form-group">
                            <label for="section_1_description">Section I Description</label>
                            <textarea name="section_1_description" id="section_1_description" class="form-control" required>{{ old('section_1_heading', $section->section_1_description) }}</textarea>
                        </div>

                        <!-- Section 1 Image -->
                        <div class="form-group">
                            <label for="section_1_image">Section I Image</label>
                            <input 
                                type="file"  accept="image/*"
                                name="section_1_image" 
                                id="section_1_image" 
                                class="form-control">
                            @if ($section->section_1_image)
                                <img src="{{ asset($section->section_1_image) }}" alt="Section 1 Image" style="max-height: 100px;">
                            @endif
                        </div>

                        <!-- Additional Fields for Section 2 -->
                        <!-- Section 2 Images and Titles -->

                        <div class="row">

                        @foreach ([1, 2, 3] as $i)
                        <div class="col-md-4">

                        <div class="form-group">
                                <label for="section_2_image_{{ $i }}">Section 2 Image {{ $i }}</label>
                                <input 
                                    type="file" accept="image/*"
                                    name="section_2_image_{{ $i }}" 
                                    id="section_2_image_{{ $i }}" 
                                    class="form-control">
                                @if ($section->{"section_2_image_$i"})
                                    <img src="{{ asset( $section->{"section_2_image_$i"}) }}" alt="Section 2 Image {{ $i }}" style="max-height: 100px;">
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="section_2_title_{{ $i }}">Section 2 Title {{ $i }}</label>
                                <input 
                                    type="text" 
                                    name="section_2_title_{{ $i }}" 
                                    id="section_2_title_{{ $i }}" 
                                    class="form-control" 
                                    value="{{ old("section_2_title_$i", $section->{"section_2_title_$i"}) }}">
                            </div>

                            <div class="form-group">
                                <label for="section_2_subheading_{{ $i }}">Section 2 Subheading {{ $i }}</label>
                                <input 
                                    type="text" 
                                    name="section_2_subheading_{{ $i }}" 
                                    id="section_2_subheading_{{ $i }}" 
                                    class="form-control" 
                                    value="{{ old("section_2_subheading_$i", $section->{"section_2_subheading_$i"}) }}">
                            </div>
                            <div class="form-group">
                                <label for="section_2_url_{{ $i }}">Section 2 Url {{ $i }}</label>
                                <input type="text" name="section_2_url_{{ $i }}" id="section_2_url_{{ $i }}"
                                value="{{ old("section_2_url_$i", $section->{"section_2_url_$i"}) }}"
                                class="form-control">
                            </div>
                        </div>

                            @endforeach
                        </div>
                        <!-- Section 3 Fields -->
                        <div class="form-group">
                            <label for="section_3_heading">Section 3 Heading</label>
                            <input 
                                type="text" 
                                name="section_3_heading" 
                                id="section_3_heading" 
                                class="form-control" 
                                value="{{ old('section_3_heading', $section->section_3_heading) }}">
                        </div>

                        <div class="form-group">
                            <label for="section_3_subheading">Section 3 Subheading</label>
                            <input 
                                type="text" 
                                name="section_3_subheading" 
                                id="section_3_subheading" 
                                class="form-control" 
                                value="{{ old('section_3_subheading', $section->section_3_subheading) }}">
                        </div>

                        <div class="form-group">
                            <label for="section_3_anchor_link">Section 3 Anchor Link</label>
                            <input 
                                type="text" 
                                name="section_3_anchor_link" 
                                id="section_3_anchor_link" 
                                class="form-control" 
                                value="{{ old('section_3_anchor_link', $section->section_3_anchor_link) }}">
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="green-btn">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
