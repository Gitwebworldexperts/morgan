@extends('admin.adminLayout')
@section('title', 'Pages: Create Testimonial')
@section('content')

    <div class="container section_content">
        <p class="heading_for_admin_section">Create Testimonial</p>
        <form action="{{ route('testimonials.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="detail">Detail</label>
                <textarea id="detail" name="detail" class="form-control" required>{{ old('detail') }}</textarea>
                @error('detail')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" id="location" name="location" value="{{ old('location') }}" class="form-control" required>
                @error('location')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="rating">Rating</label>
                <input type="number" id="rating" name="rating" class="form-control" min="1"  value="{{ old('rating') }}"  max="5" required>
                @error('rating')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status" class="form-control" required>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="green-btn">Save</button>
        </form>
    </div>
@endsection
