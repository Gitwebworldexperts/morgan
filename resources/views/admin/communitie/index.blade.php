@extends('admin.adminLayout')
@section('title', 'Pages: Communities Page')
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
        <p class="heading_for_admin_section">Communities
            <a class="add_new_button m-0" href="{{ route('communities.create') }}">+ Add New Community</a>
        </p>
        <div class="section_content">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Community Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($communities as $community)
                    <tr>
                        <td>{{ $community->community_name }}</td>
                        <td>{{ $community->status }}</td>
                        <td>
                            <div class="faq-actions">
                                <a class="edit_button" href="{{ route('communities.edit', $community->id) }}">
                                    <i class="fa-solid fa-pencil"></i> Edit
                                </a>
                                <a class="edit_button" href="{{ route('detail.communitie', base64_encode($community->id)) }}">
                                    <i class="fa-solid  fa-eye"></i> 
                                </a>
                                <form action="{{ route('communities.destroy', $community->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="faq_delete_button" type="submit" onclick="return confirm('Are you sure you want to delete this community?');">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
<!--             <tfoot>
                <tr>
                    <th>Community Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </tfoot> -->
        </table>
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
