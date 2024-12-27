@extends('admin.adminLayout')
@section('title', 'Page Brand Residence')
@section('content')

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <section>
        <h1>Page Brand Residence</h1>
        <form class="home_section" action="{{ route('page_branded_residence.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row row-container-section pl-2 pr-2">
                <div class="col-12">
                

            <div class="form-group">
                <label for="page_title">Page title:</label>
                <input type="text" class="form-control" name="page_title" value="{{ old('page_title',$sections->page_title) }}">
                @error('page_title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
                    
            <!-- Section I -->
            <div class="form-group">
                <label for="title">Title (Section I):</label>
                <input type="text" class="form-control" name="title" value="{{ old('title',$sections->title) }}">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description (Section I):</label>
                <textarea name="description" class="form-control">{{ old('description',$sections->description) }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Image (Section I):</label>
                <input type="file" class="form-control" name="image">
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                @if(isset($sections->image) && !empty($sections->image))
                <div id="image-preview" class="mt-3">
                        <img src="{{ asset($sections->image)}}" class="img-thumbnail mr-2" style="max-height: 150px;">
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="link">Link (Section I):</label>
                <input type="text" class="form-control" name="link" value="{{ old('link',$sections->link) }}">
                @error('link')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Section II -->
            <div class="form-group">
                <label for="heading_1">Heading (Section II):</label>
                <input type="text" class="form-control" name="heading_1" value="{{ old('heading_1',$sections->heading_1) }}">
                @error('heading_1')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image_1">Image (Section II):</label>
                <input type="file" class="form-control" name="image_1">
                @error('image_1')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                @if(isset($sections->image_1) && !empty($sections->image_1))
                <div id="image-preview" class="mt-3">
                        <img src="{{ asset($sections->image_1)}}" class="img-thumbnail mr-2" style="max-height: 150px;">
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="description_1">Description (Section II):</label>
                <textarea name="description_1" class="form-control">{{ old('description_1',$sections->description_1) }}</textarea>
                @error('description_1')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image_2">Image 2 (Section II):</label>
                <input type="file" class="form-control" name="image_2">
                @error('image_2')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                @if(isset($sections->image_2) && !empty($sections->image_2))
                <div id="image-preview" class="mt-3">
                        <img src="{{ asset($sections->image_2)}}" class="img-thumbnail mr-2" style="max-height: 150px;">
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="description_2">Description 2 (Section II):</label>
                <textarea name="description_2" class="form-control">{{ old('description_2',$sections->description_2) }}</textarea>
                @error('description_2')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Section III -->
            <div class="form-group">
                <label for="heading_3">Heading (Section III):</label>
                <input type="text" class="form-control" name="heading_3" value="{{ old('heading_3',$sections->heading_3) }}">
                @error('heading_3')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="images_3[]">Images (Section III):</label>
                <input type="file" class="form-control" name="images_3[]">
                @error('images_3')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                @if(isset($sections->images_3[0]) && !empty($sections->images_3[0]))
                <div id="image-preview" class="mt-3">
                        <img src="{{ asset($sections->images_3[0])}}" class="img-thumbnail mr-2" style="max-height: 150px;">
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="headings_3[]">Heading (Section III):</label>
                <input type="text" class="form-control" name="headings_3[]" value="{{ old('headings_3', isset($sections->headings_3[0]) ? $sections->headings_3[0] : '') }}
">
                @error('headings_3')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="images_3[]">Images (Section III):</label>
                <input type="file" class="form-control" name="images_3[]" >
                @error('images_3')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                @if(isset($sections->images_3[1]) && !empty($sections->images_3[1]))
                <div id="image-preview" class="mt-3">
                        <img src="{{ asset($sections->images_3[1])}}" class="img-thumbnail mr-2" style="max-height: 150px;">
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="headings_3[]">Heading (Section III):</label>
                <input type="text" class="form-control" name="headings_3[]" value="{{ old('headings_3', isset($sections->headings_3[1]) ? $sections->headings_3[1] : '') }}">
                @error('headings_3')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
                        <!-- Section III -->


            <div class="form-group">
                <label for="images_3[]">Images (Section III):</label>
                <input type="file" class="form-control" name="images_3[]">
                @error('images_3')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                @if(isset($sections->images_3[2]) && !empty($sections->images_3[2]))
                <div id="image-preview" class="mt-3">
                        <img src="{{ asset($sections->images_3[2])}}" class="img-thumbnail mr-2" style="max-height: 150px;">
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="headings_3[]">Heading (Section III):</label>
                <input type="text" class="form-control" name="headings_3[]" value="{{ old('headings_3', isset($sections->headings_3[2]) ? $sections->headings_3[2] : '') }}">
                @error('headings_3')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
                        

            <div class="form-group">
                <label for="images_3[]">Images (Section III):</label>
                <input type="file" class="form-control" name="images_3[]">
                @error('images_3')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                @if(isset($sections->images_3[3]) && !empty($sections->images_3[3]))
                <div id="image-preview" class="mt-3">
                        <img src="{{ asset($sections->images_3[3])}}" class="img-thumbnail mr-2" style="max-height: 150px;">
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="headings_3[]">Heading (Section III):</label>
                <input type="text" class="form-control" name="headings_3[]" value="{{ old('headings_3', isset($sections->headings_3[3]) ? $sections->headings_3[3] : '') }}">
                @error('headings_3')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Section IV -->
            <div class="form-group">
                <label for="title_4">Title (Section IV):</label>
                <input type="text" class="form-control" name="title_4" value="{{ old('title_4',$sections->title_4) }}">
                @error('title_4')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description_4">Description (Section IV):</label>
                <textarea name="description_4" class="form-control">{{ old('description_4',$sections->description_4) }}</textarea>
                @error('description_4')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image_4">Image (Section IV):</label>
                <input type="file" class="form-control" name="image_4">
                @error('image_4')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="link_4">Link (Section IV):</label>
                <input type="text" class="form-control" name="link_4" value="{{ old('link_4',$sections->link_4) }}">
                @error('link_4')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="section_title">
            Triple Win Formula Section
            </div>

            <div class="form-group">
                <label for="tripal_win_title_1">Title 1</label>
                <input type="text" class="form-control" name="tripal_win_title_1" value="{{ old('tripal_win_title_1',$sections->tripal_win_title_1) }}">
                @error('tripal_win_title_1')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tripal_win_image_1">Tripal Win Image 1:</label>
                <input type="file" class="form-control" name="tripal_win_image_1">
                @error('tripal_win_image_1')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                @if(isset($sections->tripal_win_image_1) && !empty($sections->tripal_win_image_1))
                <div id="image-preview" class="mt-3">
                        <img src="{{ asset($sections->tripal_win_image_1)}}" class="img-thumbnail mr-2" style="max-height: 150px;">
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="tripal_win_title_1">Title 2</label>
                <input type="text" class="form-control" name="tripal_win_title_2" value="{{ old('tripal_win_title_2',$sections->tripal_win_title_2) }}">
                @error('tripal_win_title_2')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tripal_win_image_2">Tripal Win Image 2:</label>
                <input type="file" class="form-control" name="tripal_win_image_2">
                @error('tripal_win_image_2')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                @if(isset($sections->tripal_win_image_2) && !empty($sections->tripal_win_image_2))
                <div id="image-preview" class="mt-3">
                        <img src="{{ asset($sections->tripal_win_image_2)}}" class="img-thumbnail mr-2" style="max-height: 150px;">
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="tripal_win_title_3">Title 3</label>
                <input type="text" class="form-control" name="tripal_win_title_3" value="{{ old('tripal_win_title_3',$sections->tripal_win_title_3) }}">
                @error('tripal_win_title_3')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tripal_win_image_3">Tripal Win Image 3:</label>
                <input type="file" class="form-control" name="tripal_win_image_3">
                @error('tripal_win_image_3')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                @if(isset($sections->tripal_win_image_3) && !empty($sections->tripal_win_image_3))
                <div id="image-preview" class="mt-3">
                        <img src="{{ asset($sections->tripal_win_image_3)}}" class="img-thumbnail mr-2" style="max-height: 150px;">
                    </div>
                @endif
            </div>

            <button type="submit" class="green-btn">Save Section</button>
            </div>
            </div>
        </form>
    </section>

@endsection
