@extends('admin.adminLayout')
@section('title', 'Pages: Testimonials')
@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="container">
<p class="heading_for_admin_section">Testimonials</p>
<a href="{{ route('testimonials.create') }}" class="green-btn mb-4">Create Testimonial</a>


<table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Rating</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($testimonials as $testimonial)
                    <tr>
                        <td>{{ $testimonial->name }}</td>
                        <td>{{ $testimonial->location }}</td>
                        <td>{{ $testimonial->rating }}</td>
                        <td>{{ $testimonial->status ? 'Active' : 'Inactive' }}</td>
                        <td>
                            <a href="{{ route('testimonials.edit', $testimonial->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('testimonials.destroy', $testimonial->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure you want to delete this privacy policy?');" type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

</div>


@endsection
