@extends('admin.adminLayout')
@section('title', 'Pages: Edit Property Type')
@section('content')
 	@if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <section>
    	<p class="heading_for_admin_section">Edit Property Type</p>
    	<div class="section_content">
            <form action="{{ route('property-types.update', $propertyType) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="type_name">Type Name</label>
                    <input type="text" name="type_name" id="type_name" class="form-control" value="{{ $propertyType->type_name }}" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1" {{ $propertyType->status ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !$propertyType->status ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update Property Type</button>
                <a href="{{ route('property-types.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
    	</div>
	</section>
@endsection
@section('scripts')    
   
@endsection
