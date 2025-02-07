@extends('admin.adminLayout')
@section('title', 'Edit User')

@section('content')
@if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<div class="container home_section">
    <h1>Edit User</h1>
    <form class="row-container-section" action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>
        <div class="form-group">
            <label for="password">Password (leave blank to keep current)</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>
        <!-- Additional Info  -->

                <!-- additional info -->

        <div class="form-group">
            <label for="phone" class="form-label">Phone</label>
            <input type="number" name="phone" id="phone" class="form-control" value="{{ old('phone', $user->profile->phone ?? '') }}">
        </div>
        
        <div class="form-group">
            <label for="avatar" class="form-label">Avatar</label>
            <input type="file" accept="image/*" name="avatar" id="avatar" class="form-control">
            @if(isset($user->profile->avatar) && $user->profile->avatar)
            <div class="current-banners row">                                                    
                <div class="banner col-xl-2 col-md-3 col-sm-4 pr">
                    <img src="{{ asset($user->profile->avatar) }}" alt="Banner Image" style="height: auto;">
                </div>
            </div>    
            @endif
        </div>
        

        <div class="form-group">
            <label for="address" class="form-label">Address</label>
            <textarea name="address" id="address" class="form-control">{{ old('address', $user->profile->address ?? '') }}</textarea>
        </div>

        <button type="submit" class="green-btn">Update User</button>
    </form>
</div>
@endsection