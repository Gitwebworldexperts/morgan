@extends('admin.adminLayout')
@section('title', 'Pages: Regions List')
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
        <p class="heading_for_admin_section">Regions</p>
        <a href="{{ route('regions.create') }}" class="add_new_button m-0">Create New Region</a>
        <div class="section_content">
            <table id="regionsTable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Region Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($regions as $region)
                        <tr>
                            <td>{{ $region->name }}</td>
                            <td>{!! Str::limit($region->description, 20) !!}</td>
                            <td>
                                <img src="{{ asset($region->image_url) }}"  style="width: 50px; height: 50px;">
                            </td>
                            <td>
                                <a class="edit_button" href="{{ route('regions.edit', $region->id) }}">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>
                                <form action="{{ route('regions.destroy', $region->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="faq_delete_button" onclick="return confirm('Are you sure you want to delete this region?');">
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
            new DataTable('#regionsTable');
        });
    </script>
@endsection
