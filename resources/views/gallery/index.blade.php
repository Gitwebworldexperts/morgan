@extends('admin.adminLayout')
@section('title', 'Add Media')
@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="container">
<p class="heading_for_admin_section">Gallery</p>
<a href="{{ route('gallery.create') }}" class="green-btn mb-4">Add New Media</a>


        <div class="row mt-3">
            @foreach($galleries as $gallery)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset($gallery->image) }}" class="card-img-top" alt="{{ $gallery->alt }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $gallery->alt }}</h5>
                            <form action="{{ route('gallery.destroy', $gallery->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endsection

    @section('scripts')
    <style>
        img.card-img-top {
            height: 200px;
            object-fit: contain;
            box-shadow: inset 0 0 17px 0 #0000003b;
        }
    </style>
@endsection