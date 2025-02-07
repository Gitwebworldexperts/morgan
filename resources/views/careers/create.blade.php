@extends('admin.adminLayout')
@section('title', 'Pages: Career Create')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <section>
    <div class="container">
        <p class="heading_for_admin_section">Create Career</p>
        <form class="home_section" id="image-upload-form" action="{{ route('careers.store') }}" method="POST">
            @csrf
            <div class="row row-container-section pl-2 pr-2">
                <div class="col-12">
                    <div class="form-group">
                        <label for="job_name">Job Name</label>
                        <input type="text" name="job_name" id="job_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="job_type">Job Type</label>
                        <input type="text" name="job_type" id="job_type" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="position">Position</label>
                        <input type="text" name="position" id="position" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="job_location">Location</label>
                        <input type="text" name="job_location" id="job_location" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="responsibilities">Responsibilities</label>
                        <textarea name="responsibilities" id="responsibilities" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="open">Open</option>
                            <option value="closed">Closed</option>
                            <!-- <option value="pending">Pending</option> -->
                        </select>
                    </div>
                    <button type="submit" class="green-btn">Create Career</button>
                </div>
            </div>
        </form>
    </div>
    </section>
@endsection
@section('scripts')

@endsection
