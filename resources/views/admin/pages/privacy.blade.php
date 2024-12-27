@extends('admin.adminLayout')
@section('title', 'Privacy Policy')
@section('content')
@if(0)
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
@endif
<section>
    <div class="container-fluid">
        <form action="{{ route('store.privacy') }}" class="row" method="POST" enctype="multipart/form-data">
            @csrf
            <p class="heading_for_admin_section">Privacy Pages</p>

            <div class="box-common row">
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
                    <textarea name="page_content">{{ old('page_content') }}</textarea>
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
@endsection
