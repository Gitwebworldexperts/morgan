@extends('admin.adminLayout')
@section('title', 'Pages: Create Region')
@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <p class="heading_for_admin_section">Create Region</p>
        <form class="home_section" action="{{ route('regions.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row row-container-section pl-2 pr-2">
                <div class="col-12">
                    <div class="form-group">
                        <label for="name">Region Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" required>{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="image_url">Image URL</label>
                        <input type="url" name="image_url" id="image_url" class="form-control" value="{{ old('image_url') }}" required>
                    </div>
                    <button type="submit" class="green-btn">Create Region</button>
                </div>
            </div>
        </form>
    </div>
@endsection
