@extends('admin.adminLayout')
@section('title', 'Pages: Agents')
@section('content')
<div class="container">
    <p class="heading_for_admin_section">Agents</p>
    <a href="{{ route('agents.create') }}" class="green-btn mb-4">Create Agent</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($agents as $agent)
                <tr>
                    <td>{{ $agent->name }}</td>
                    <td>{{ $agent->username }}</td>
                    <td>{{ $agent->email }}</td>
                    <td>{{ $agent->mobile }}</td>
                    <td>{{ $agent->status ? 'Active' : 'Inactive' }}</td>
                    <td>
                        <a href="{{ route('agents.edit', $agent) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('agents.destroy', $agent) }}" method="POST" style="display:inline;">
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
@endsection