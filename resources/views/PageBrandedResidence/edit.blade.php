@extends('admin.adminLayout')
@section('title', 'Edit Section')
@section('content')
    <section>
        <h1>Edit Section</h1>
        <form action="{{ route('sections.update', $section->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row row-container-section pl-2 pr-2">
            <div class="col-12">
            <!-- Section I -->
            <div class="form-group">
                <label for="title">Title (Section I):</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $section->title) }}">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description (Section I):</label>
                <textarea name="description" class="form-control">{{ old('description', $section->description) }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Image (Section I):</label>
                @if($section->image)
                    <img src="{{ asset('storage/' . $section->image) }}" alt="Current Image" width="100" class="mb-2">
                @endif
                <input type="file" name="image" class="form-control">
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="link">Link (Section I):</label>
                <input type="text" name="link" class="form-control" value="{{ old('link', $section->link) }}">
                @error('link')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Section II -->
            <div class="form-group">
                <label for="heading_1">Heading (Section II):</label>
                <input type="text" name="heading_1" class="form-control" value="{{ old('heading_1', $section->heading_1) }}">
                @error('heading_1')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image_1">Image (Section II):</label>
                @if($section->image_1)
                    <img src="{{ asset('storage/' . $section->image_1) }}" alt="Current Image 1" width="100" class="mb-2">
                @endif
                <input type="file" name="image_1" class="form-control">
                @error('image_1')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description_1">Description (Section II):</label>
                <textarea name="description_1" class="form-control">{{ old('description_1', $section->description_1) }}</textarea>
                @error('description_1')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image_2">Image 2 (Section II):</label>
                @if($section->image_2)
                    <img src="{{ asset('storage/' . $section->image_2) }}" alt="Current Image 2" width="100" class="mb-2">
                @endif
                <input type="file" name="image_2" class="form-control">
                @error('image_2')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description_2">Description 2 (Section II):</label>
                <textarea name="description_2" class="form-control">{{ old('description_2', $section->description_2) }}</textarea>
                @error('description_2')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Section III -->
            <div class="form-group">
                <label for="heading_3">Heading (Section III):</label>
                <input type="text" name="heading_3" class="form-control" value="{{ old('heading_3', $section->heading_3) }}">
                @error('heading_3')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="images_3[]">Images (Section III):</label>
                @foreach(json_decode($section->images_3 ?? '[]') as $image)
                    <img src="{{ asset('storage/' . $image) }}" alt="Image" width="100" class="mb-2">
                @endforeach
                <input type="file" name="images_3[]" multiple class="form-control">
                @error('images_3')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="headings_3[]">Headings (Section III):</label>
                @foreach(json_decode($section->headings_3 ?? '[]') as $heading)
                    <input type="text" name="headings_3[]" class="form-control mb-2" value="{{ $heading }}">
                @endforeach
                <input type="text" name="headings_3[]" class="form-control mb-2">
                @error('headings_3')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Section IV -->
            <div class="form-group">
                <label for="title_4">Title (Section IV):</label>
                <input type="text" name="title_4" class="form-control" value="{{ old('title_4', $section->title_4) }}">
                @error('title_4')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description_4">Description (Section IV):</label>
                <textarea name="description_4" class="form-control">{{ old('description_4', $section->description_4) }}</textarea>
                @error('description_4')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image_4">Image (Section IV):</label>
                @if($section->image_4)
                    <img src="{{ asset('storage/' . $section->image_4) }}" alt="Current Image 4" width="100" class="mb-2">
                @endif
                <input type="file" name="image_4" class="form-control">
                @error('image_4')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="link_4">Link (Section IV):</label>
                <input type="text" name="link_4" class="form-control" value="{{ old('link_4', $section->link_4) }}">
                @error('link_4')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="green-btn">Update Section</button>
            </div>
            </div>
        </form>
    </section>
@endsection
