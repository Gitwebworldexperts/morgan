@extends('admin.adminLayout')
@section('title', 'Pages: Blog Edit Page')
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
    <p class="heading_for_admin_section">Edit Blog Post</p>
    <div class="section_content">
        <form action="{{ route('posts.update', $post->id) }}" method="POST"  enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Blog Name <span class="mandatory">*</span></label>
                <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $post->name) }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description </label>
                <textarea name="description" id="description" class="form-control" rows="5" required>{{ old('description', $post->description) }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tags">Tags</label>
                <select class="form-control select2" name="tags[]" multiple data-placeholder="Select tags">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}" 
                            {{ in_array($tag->id, $post->tags->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
                @error('tags')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="related_post_id">Related Post</label>
                <select name="related_post_id[]" class="form-control select2" data-placeholder="Select Related Posts" multiple>
                    <option value="">None</option>
                    @php 
                        $relatedPostIdsArray = $post->related_posts ? explode(',', $post->related_posts) : [];
                    @endphp

                    @foreach($relatedPosts as $relatedPost)
                        <option value="{{ $relatedPost->id }}" 
                            {{ in_array($relatedPost->id, $relatedPostIdsArray) ? 'selected' : '' }}>
                            {{ $relatedPost->name }}
                        </option>
                    @endforeach
                </select>
                @error('related_post_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
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
                <input class="form-control" type="text" name="meta_title" value="{{ old('meta_title',$post->meta_title) }}" id="meta_title" required>
                @error('meta_title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>    

            <div class="form-group">
                <label for="meta_description">Meta Description <span class="mandatory">*</span></label>
                <input class="form-control" type="text" name="meta_description" value="{{ old('meta_description',$post->meta_description) }}" id="meta_description" required>
                @error('meta_description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>    

            <div class="form-group">
                <button class="green-btn" type="submit">Update Post</button>
            </div>
        </form>

            <div class="col-12">
            <div class="form-group">
                <label for="">Uploaded Images</label>
                <div class="row">
                @if(isset($post->images) && !empty($post->images))
                    @php 
                        $post->images = explode(",", $post->images);
                    @endphp

                    @foreach($post->images as $item)
                        <div class="card col-md-4 p-4 m-2">
                            <img src="{{ asset('post/'.$item) }}" alt="image" class="img-thumbnail">
                            <!-- Button to copy image URL -->
                            <button class="btn btn-primary btn-sm mt-2 copy-btn" type="button" data-image="{{ asset('post/'.$item) }}">
                                Copy Image URL
                            </button>
                            <!-- Button to copy full img tag -->
                            <button class="btn btn-secondary btn-sm mt-2 copy-img-tag-btn" type="button" data-img-tag='<img src="{{ asset("post/".$item) }}" alt="image">'>
                                Copy Full Img Code
                            </button>
                            <form action="{{ route('remove_blog_image') }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this image?')">
                                @csrf
                                <input type="hidden" name="image_path" value="{{ $item }}">
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <button type="submit" class="btn btn-danger w-100 btn-sm mt-2">Remove</button>
                            </form>
                        </div>
                    @endforeach
                @endif
            </div>
            </div>
            </div>

        
    </div>
</section>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Handle copy image URL button click
        document.querySelectorAll('.copy-btn').forEach(button => {
            button.addEventListener('click', function () {
                const imageUrl = this.getAttribute('data-image');
                copyToClipboard(imageUrl);
                alert('Image URL copied to clipboard!');
            });
        });

        // Handle copy full img tag button click
        document.querySelectorAll('.copy-img-tag-btn').forEach(button => {
            button.addEventListener('click', function () {
                const imgTag = this.getAttribute('data-img-tag');
                copyToClipboard(imgTag);
                alert('Image HTML tag copied to clipboard!');
            });
        });

        // Function to copy text to clipboard
        function copyToClipboard(text) {
            const tempTextArea = document.createElement('textarea');
            tempTextArea.value = text;
            document.body.appendChild(tempTextArea);
            tempTextArea.select();
            document.execCommand('copy');
            document.body.removeChild(tempTextArea);
        }
    });
</script>
<style>
    .copy-btn, .copy-img-tag-btn {
        margin-top: 10px;
    }
</style>
@endsection
