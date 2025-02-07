@extends('admin.adminLayout')
@section('title', 'Pages: Career Create')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <p class="heading_for_admin_section">Edit Career</p>
        <form class="home_section" id="image-upload-form" action="{{ route('careers.update', $career->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row row-container-section pl-2 pr-2">
            <div class="col-12">
            <div class="form-group">
                <label for="job_name">Job Name</label>
                <input type="text" name="job_name" id="job_name" class="form-control" value="{{ $career->job_name }}" required>
            </div>
            <div class="form-group">
                <label for="job_type">Job Type</label>
                <input type="text" name="job_type" id="job_type" class="form-control" value="{{ $career->job_type }}" required>
            </div>
            <div class="form-group">
                <label for="position">Position</label>
                <input type="text" name="position" id="position" class="form-control" value="{{ $career->position }}" required>
            </div>
            <div class="form-group">
                <label for="job_location">Location</label>
                <input type="text" name="job_location" id="job_location" class="form-control" value="{{ $career->job_location }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required>{{ $career->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="responsibilities">Responsibilities</label>
                <textarea name="responsibilities" id="responsibilities" class="form-control" required>{{ $career->responsibilities }}</textarea>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="open" {{ $career->status == 'open' ? 'selected' : '' }}>Open</option>
                    <option value="closed" {{ $career->status == 'closed' ? 'selected' : '' }}>Closed</option>
                    <!-- <option value="pending" {{ $career->status == 'pending' ? 'selected' : '' }}>Pending</option> -->
                </select>
            </div>
            <button type="submit" class="green-btn">Update Career</button>
            </div>
            </div>
        </form>
    </div>
@endsection
