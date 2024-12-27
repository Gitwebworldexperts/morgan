@extends('admin.adminLayout')
@section('title', 'Edit Property')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <section>
        <div class="container">
            <!-- resources/views/privacy/edit.blade.php -->
            <form action="{{ route('update.policy', base64_encode($privacy->id)) }}" class="row" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <p class="heading_for_admin_section">Edit Privacy Page</p>

                <div class="form-group col-md-6 pb-3">
                    <label for="heading">Page Heading</label>
                    <input type="text" class="form-control" name="heading" id="heading"
                        value="{{ old('heading', $privacy->heading) }}">
                    @error('heading')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-6 pb-3">
                    <label for="slug">Page Slug</label>
                    <input type="text" class="form-control" name="slug" id="slug"
                        value="{{ old('slug', $privacy->slug) }}">
                    @error('slug')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-12">
                    <label for="page_content">Page Content</label>
                    <textarea class="form-control" name="page_content">{{ old('page_content', $privacy->page_content) }}</textarea>
                    @error('page_content')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 form-group pt-4">
                    <button id="update_policy" type="submit" class="green-btn">Update</button>
                </div>
            </form>

        </div>
    </section>

@endsection

@section('scripts')

@endsection
