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
    <p class="heading_for_admin_section">New Blog</p>
    <div class="section_content">

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Blog Name <span class="mandatory">*</span></label>
                <input class="form-control" type="text" name="name" value="{{ old('name') }}" id="name" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>    

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" >{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>    

            <div class="form-group">
                <label for="tags">Tags</label>
                <select class="form-control select2" name="tags[]" multiple data-placeholder="Select tags">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
                @error('tags')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="related_post_id">Related Post</label>
                <select name="related_post_id[]" class="select2 form-control" multiple data-placeholder="Select Related Posts">
                    <option value="">None</option>
                    @foreach($relatedPosts as $relatedPost)
                        <option value="{{ $relatedPost->id }}">{{ $relatedPost->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- New input for multiple image uploads -->
            <div class="form-group">
                <label for="images">Upload Images</label>
                <input class="form-control" type="file" name="images[]" id="images" accept="image/*" multiple>
                @error('images')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="meta_title">Meta Title <span class="mandatory">*</span></label>
                <input class="form-control" type="text" name="meta_title" value="{{ old('meta_title') }}" id="meta_title" required>
                @error('meta_title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>    

            <div class="form-group">
                <label for="meta_description">Meta Description <span class="mandatory">*</span></label>
                <input class="form-control" type="text" name="meta_description" value="{{ old('meta_description') }}" id="meta_description" required>
                @error('meta_description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>    

            <button class="green-btn" type="submit">Create</button>
        </form>
    </div>
</section>
@endsection

@section('scripts')
@endsection
