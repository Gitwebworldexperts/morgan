@extends('admin.adminLayout')
@section('title', 'Pages: Edit Testimonial')
@section('content')
    <div class="container section_content">
        <p class="heading_for_admin_section">Edit Testimonial</p>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('testimonials.update', $testimonial->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="detail">Detail</label>
                <textarea id="detail" name="detail" class="form-control" required>{{ old('detail', $testimonial->detail) }}</textarea>
                @error('detail')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $testimonial->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" id="location" name="location" class="form-control" value="{{ old('location', $testimonial->location) }}" required>
                @error('location')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="rating">Rating</label>
                <input type="number" id="rating" name="rating" class="form-control" value="{{ old('rating', $testimonial->rating) }}" min="1" max="5" required>
                @error('rating')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
            <label for="status">Status</label>
                <select id="status" name="status" class="form-control" required>
                    <option value="1" {{ old('status', $testimonial->status) == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status', $testimonial->status) == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="green-btn">Save Changes</button>
        </form>
    </div>
@endsection