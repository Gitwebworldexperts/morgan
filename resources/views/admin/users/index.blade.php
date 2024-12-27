@extends('admin.adminLayout')
@section('title', 'User Listing')
@section('content')
<div class="container">
    <h1>Users</h1>
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
    <a href="{{ route('admin.users.create') }}" class="green-btn mb-3">Create New User</a>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning"><i class="fa-solid fa-pencil"></i></a>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash-can"></i></button>
                        </form>
                        <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn {{ $user->is_active === 0 ? 'btn-secondary' : 'btn-success' }}">
                                {{ $user->is_active === 0 ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        
    </table>
<!--     <div class="row">
        <div class="col-md-1">S.No.</div>
        <div class="col-md-5">Role</div>
        <div class="col-md-6">Action</div>
    </div>
    <div class="row">
        <div class="col-md-1">1.</div>
        <div class="col-md-5">Add Property</div>
        <div class="col-md-6"><input type="checkbox"></div>
    </div>
    <div class="row">
        <div class="col-md-1">2.</div>
        <div class="col-md-5">Contact Us</div>
        <div class="col-md-6"><input type="checkbox"></div>
    </div> -->
</div>
@endsection