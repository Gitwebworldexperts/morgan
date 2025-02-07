@extends('admin.adminLayout')
@section('title', 'Pages: Properties Page')
@section('content')
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
    <section>
    <div class="container">
        <p class="heading_for_admin_section">Careers</p>
        <a href="{{ route('careers.create') }}" class="add_new_button m-0">Create New Career</a>
        <div class="section_content">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Job Name</th>
                    <th>Job Type</th>
                    <th>Status</th>
                    <th>Location</th>
                    <th>Applied jobs</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($careers as $career)
                    <tr>
                        <td>{{ $career->job_name }}</td>
                        <td>{{ $career->job_type }}</td>
                        <td>{{ ucfirst($career->status) }}</td>
                        <td>{{ $career->job_location }}</td>
                        <td>
                            <a  target="_blank" href="{{ route('applied.job', base64_encode($career->id)) }}">
                                List
                            </a>
                        </td>
                        <td>
                            <!-- <a class="edit_button" target="_blank" href="{{ route('detail.career', base64_encode($career->id)) }}"><i class="fa-solid fa-eye"></i></a> -->
                            <a class="edit_button" target="_blank" href="{{ route('detail.career', $career->id) }}"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('careers.edit', $career->id) }}" class="edit_button"><i class="fa-solid fa-pencil"></i></a>
                            <form action="{{ route('careers.destroy', $career->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="faq_delete_button" type="submit" onclick="return confirm('Are you sure you want to delete this property?');"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    </section>

@endsection
@section('scripts')    
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.bootstrap5.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            new DataTable('#example');
        });
    </script>
@endsection
