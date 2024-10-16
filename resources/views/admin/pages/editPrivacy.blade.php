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
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>

        </div>
    </section>

@endsection

@section('scripts')
    <!-- Place the first <script>
        tag in your HTML 's <head> --> <script src =
            "https://cdn.tiny.cloud/1/0bhoqku69v9e5xlhdurqb41r41h8ibv8xq2d47hpb5zpr9y5/tinymce/7/tinymce.min.js"
        referrerpolicy = "origin" >
    </script>

    <!-- Place the following <script>
        and < textarea > tags your HTML 's <body> --> 
            <script>
            tinymce.init({
                selector: 'textarea',
                plugins: [
                    // Core editing features
                    'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link',
                    'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
                    // Your account includes a free trial of TinyMCE premium features
                    // Try the most popular premium features until Oct 23, 2024:
                    'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed',
                    'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable',
                    'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments',
                    'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography',
                    'inlinecss', 'markdown',
                ],
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                tinycomments_mode: 'embedded',
                tinycomments_author: 'Author name',
                mergetags_list: [{
                        value: 'First.Name',
                        title: 'First Name'
                    },
                    {
                        value: 'Email',
                        title: 'Email'
                    },
                ],
                ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
                    'See docs to implement AI Assistant')),
            });
    </script>
@endsection
