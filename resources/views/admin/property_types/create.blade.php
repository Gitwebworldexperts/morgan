@extends('admin.adminLayout')
@section('title', 'Pages: Create Property Type')
@section('content')
 	@if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <section>
    	<p class="heading_for_admin_section">New Property Type ( {{$category}} )</p>
    	<div class="section_content">
            <form action="{{ route('property-types.store') }}" method="POST">
                @csrf
                <input type="hidden" name="property" value="{{$category}}">
                <div class="form-group">
                    <label for="type_name">Type Name</label>
                    <input type="text" name="type_name" id="type_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <div class="btn-grp d-flex">
                    <button type="submit" class="green-btn">Add Property Type</button>
                    <a href="{{ route('property-type.index', $category) }}" class="border-btn">Cancel</a>
                </div>
            </form>
    	</div>
	</section>
@endsection
@section('scripts')    
   
@endsection
