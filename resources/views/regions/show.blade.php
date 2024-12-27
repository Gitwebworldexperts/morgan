@extends('admin.adminLayout')
@section('title', 'Pages: View Region')
@section('content')
    <div class="container">
        <p class="heading_for_admin_section">View Region</p>
        <div class="row row-container-section pl-2 pr-2">
            <div class="col-12">
                <div class="form-group">
                    <label for="name">Region Name</label>
                    <input type="text" id="name" class="form-control" value="{{ $region->name }}" disabled>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" class="form-control" disabled>{{ $region->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="image_url">Image URL</label>
                    <input type="url" id="image_url" class="form-control" value="{{ $region->image_url }}" disabled>
                </div>
                <a href="{{ route('regions.edit', $region->id) }}" class="green-btn">Edit Region</a>
            </div>
        </div>
    </div>
@endsection
