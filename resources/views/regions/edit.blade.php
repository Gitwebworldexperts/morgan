@extends('admin.adminLayout')
@section('title', 'Pages: Edit Region')
@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <p class="heading_for_admin_section">Edit Region</p>
        <form class="home_section" action="{{ route('regions.update', $region->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row row-container-section pl-2 pr-2">
                <div class="col-12">
                    <div class="form-group">
                        <label for="name">Region Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $region->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" required>{{ $region->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="image_url">Upload Image</label>
                        <input type="file" accept="image/*" name="image_url" id="image_url" class="form-control" value="{{ $region->image_url }}" >
                        @if($region->image_url)
                        <div id="image-preview" class="mt-3">
                            <img src="{{ asset($region->image_url) }}" class="img-thumbnail mr-2" style="max-height: 150px;">
                        </div>
                        @endif
                    </div>
                    <button type="submit" class="green-btn">Update Region</button>
                </div>
            </div>
        </form>
    </div>
@endsection
