@extends('admin.adminLayout')
@section('title', 'Add Media')
@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
    <div class="container section_content">
    <p class="heading_for_admin_section">Add New Image to Media</p>

        <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 form-group">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image" required>
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 form-group">
                <label for="alt" class="form-label">Alt Text</label>
                <input type="text" class="form-control" id="alt" name="alt" required>
                @error('alt')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="green-btn">Upload Image</button>
        </form>
    </div>
@endsection
