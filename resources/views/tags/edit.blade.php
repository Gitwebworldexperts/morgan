@extends('admin.adminLayout')
@section('title', 'Pages: Edit Tag Page')
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
        <p class="heading_for_admin_section">Edit Tag</p>
        <div class="section_content">
            <form action="{{ route('tags.update', $tag->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="name">Tag Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $tag->name }}" required>
                </div>
                
                    <button type="submit" class="green-btn">Update Tag</button>
            </form>
        </div>
    </section>
@endsection
