@extends('admin.adminLayout')

@section('title', 'Report Page')

@section('content')

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


    <section>
        <div class="container">
            <p class="heading_for_admin_section">Create Report</p>

            <form class="home_section" id="report-form" action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row row-container-section pl-2 pr-2">
                    <div class="col-12">

                       <!-- Title -->
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $report->title ?? '') }}" class="form-control" required>
                        </div>

                        <!-- Background -->
                        <div class="form-group">
                            <label for="background">Background</label>
                            <input type="file" name="background" id="background" class="form-control">
                            @if($report && $report->background)
                                <div id="image-preview" class="mt-3">
                                    <img src="{{ asset($report->background) }}" class="img-thumbnail mr-2" style="max-height: 150px;">
                                </div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea name="content" id="content" class="form-control" rows="3" required>{!! old('content', $report->content ?? '') !!}</textarea>
                        </div>

                        <!-- Read More -->
                        <div class="form-group">
                            <label for="read_more">Read More</label>
                            <input type="text" name="read_more" id="read_more" class="form-control" value="{{ old('read_more', $report->read_more ?? '') }}" required>
                        </div>

                        <!-- Section 1 Heading -->
                        <div class="form-group">
                            <label for="section1_heading">Section 1 Heading</label>
                            <input type="text" name="section1_heading" id="section1_heading" class="form-control" value="{{ old('section1_heading', $report->section1_heading ?? '') }}" required>
                        </div>

                        <!-- Section 1 Images and Content -->
                        @for ($i = 1; $i <= 3; $i++)
                            <div class="form-group">
                                <label for="section1_image_{{ $i }}">Section 1 Image {{ $i }}</label>
                                <input type="file" name="section1_image_{{ $i }}" id="section1_image_{{ $i }}" class="form-control">
                                @if($report && isset($report->{'section1_image_' . $i}) && !old('section1_image_' . $i))
                                    <img src="{{ asset($report->{'section1_image_' . $i}) }}" alt="Section {{ $i }} Image" class="img-thumbnail mt-2" width="150">
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="section1_content_{{ $i }}">Section 1 Content {{ $i }}</label>
                                <textarea name="section1_content_{{ $i }}" id="section1_content_{{ $i }}" class="form-control" rows="3">
                                    {!! old('section1_content_' . $i, $report->{'section1_content_' . $i} ?? '') !!}
                                </textarea>
                            </div>

                            <div class="form-group">
                                <label for="section1_title_{{ $i }}">Section 1 Title {{ $i }}</label>
                                <input type="text" name="section1_title_{{ $i }}" id="section1_title_{{ $i }}" class="form-control" 
                                    value="{{ old('section1_title_' . $i, $report->{'section1_title_' . $i} ?? '') }}">
                            </div>
                        @endfor

                        <!-- Section 2 Title -->
                        <div class="form-group">
                            <label for="section2_title">Section 2 Title</label>
                            <input type="text" name="section2_title" id="section2_title" value="{{ old('section2_title', $report->section2_title ?? '') }}" class="form-control">
                        </div>

                        <!-- Section 2 Images -->
                        <div class="row d-none">
                            @for ($i = 1; $i <= 6; $i++)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="section2_image_{{ $i }}">Section 2 Image {{ $i }}</label>
                                        <input type="file" name="section2_image_{{ $i }}" id="section2_image_{{ $i }}" class="form-control">
                                        @if($report && isset($report->{'section2_image_' . $i}) && !old('section2_image_' . $i))
                                            <img src="{{ asset($report->{'section2_image_' . $i}) }}" alt="Section {{ $i }} Image" class="img-thumbnail mt-2" width="150">
                                        @endif
                                    </div>       
                                </div>           

                                <div class="col-md-6">          
                                    <div class="form-group">
                                        <label for="section2_title_{{ $i }}">Section 2 Title {{ $i }}</label>
                                        <input type="text" name="section2_title_{{ $i }}" id="section2_title_{{ $i }}" class="form-control" 
                                            value="{{ old('section2_title_' . $i, $report->{'section2_title_' . $i} ?? '') }}">
                                    </div>
                                </div>
                            @endfor
                        </div>


                        <!-- Submit Button -->
                        <button type="submit" class="green-btn">Create Report</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection

@section('scripts')
    <!-- Optional JS for form validation or additional features -->
@endsection
