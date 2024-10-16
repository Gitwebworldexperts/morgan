@extends('admin.adminLayout')
@section('title', 'Privacy Policy')
@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@if($errors->any())
{!! implode('', $errors->all('<div>:message</div>')) !!}
@endif
@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
<section>
    <div class="container-fluid">
        <form action="{{ route('store.privacy') }}" class="row" method="POST" enctype="multipart/form-data">
            @csrf
            <p class="heading_for_admin_section">Privacy Pages</p>

            <div class="box-common">
                <div class="form-group col-md-6 pb-3">
                    <label for="address">Page Heading </label>
                    <input type="text" class="form-control" name="heading" id="heading" value="{{ old('heading') }}">
                    @error('heading')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
    
                <div class="form-group col-md-6 pb-3">
                    <label for="address">Page Slug </label>
                    <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') }}">
                    @error('slug')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
    
                <div class="form-group col-md-12">
                    <label for="address">Page Content </label>
                    <textarea name="page_content"></textarea>
                    @error('page_content')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
    
                <div class="col-12 form-group pt-4">
                    <button type="submit" class="green-btn">Submit</button>
                </div>
            </div>

        </form>
    </div>
</section>
@endsection

@section('scripts')
<!-- Place the first <script> tag in your HTML's <head> -->
<script src="https://cdn.tiny.cloud/1/0bhoqku69v9e5xlhdurqb41r41h8ibv8xq2d47hpb5zpr9y5/tinymce/7/tinymce.min.js"
    referrerpolicy="origin"></script>

<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
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
</script>@endsection
