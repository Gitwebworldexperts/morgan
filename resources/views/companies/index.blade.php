@extends('admin.adminLayout')
@section('title', 'Pages: Companies Page')
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
        <p class="heading_for_admin_section">Companies</p>
        <a href="{{ route('companies.create') }}" class="add_new_button m-0">Add New Company</a>
        <div class="section_content">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Details</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($companies as $company)
                        <tr>
                            <td>{{ $company->id }}</td>
                            <td>{{ $company->company_name }}</td>
                            <td>{{ $company->company_detail }}</td>
                            <td>
                                <a class="edit_button" target="_blank" href="{{ route('companies.edit', $company->id) }}">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>
                                <form action="{{ route('companies.destroy', $company->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="faq_delete_button" onclick="return confirm('Are you sure you want to delete this company?');">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
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
