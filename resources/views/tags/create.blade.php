@extends('admin.adminLayout')
@section('title', 'Pages: Blog Create Page')
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
        <p class="heading_for_admin_section">New Tag</p>
        <div class="section_content">
 
<div class="container">

        <form action="{{ route('tags.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Tag Name <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
                @error('name')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

                <button type="submit" class="green-btn">Create</button>
        </form>
    </div>
    </div>
</section>
@endsection
