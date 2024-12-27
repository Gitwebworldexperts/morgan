@extends('admin.adminLayout')
@section('title', 'Create User')
@section('content')
<div class="container home_section">
    <p class="heading_for_admin_section">Create User</p>
    <form class="row-container-section" action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" oninput="autoFillConfirmation()" class="form-control" required>
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group d-none">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation"  class="form-control" required>
        </div>
        <button type="submit" class="green-btn">Create User</button>
    </form>
</div>
@endsection
@section('scripts')
<script>
    function autoFillConfirmation() {
        const password = document.getElementById('password').value;
        document.getElementById('password_confirmation').value = password;
    }
</script>
@endsection