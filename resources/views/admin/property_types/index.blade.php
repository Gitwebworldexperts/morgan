@extends('admin.adminLayout')
@section('title', 'Pages: Property Type')
@section('content')
 	@if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <section>
    	<p class="heading_for_admin_section">Property Type (<span class="text-captilized"><strong> {{$category}} </strong></span>)</p>
    	<div class="section_content">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($propertyTypes as $propertyType)
                        <tr>
                            <td>{{ $propertyType->id }}</td>
                            <td>{{ $propertyType->type_name }}</td>
                            <td>{{ $propertyType->status ? 'Active' : 'Inactive' }}</td>
                            <td>
                                <a href="{{ route('property-types.edit', $propertyType) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('property-types.destroy', $propertyType) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    	</div>
	</section>
@endsection
@section('scripts')    
   
@endsection
