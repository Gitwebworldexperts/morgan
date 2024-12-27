@extends('admin.adminLayout')
@section('title', 'Pages: Tag Page')
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
        <p class="heading_for_admin_section">Tags
        <a class="add_new_button m-0" href="{{ route('tags.create') }}">+ Add Tag</a>
        <a class="add_new_button m-0" href="{{ route('posts.index') }}">Blog List</a>

        </p>
        <div class="section_content">
            <table id="tagsTable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tags as $tag)
                        <tr>
                            <td>{{ $tag->name }}</td>
                            <td>
                                <div class="faq-actions">
                                    <a class="edit_button" href="{{ route('tags.edit', $tag->id) }}">
                                        <i class="fa-solid fa-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="faq_delete_button" type="submit" onclick="return confirm('Are you sure you want to delete this tag?');">
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <!-- <tfoot>
                    <tr>
                        <th>Name</th>
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
            new DataTable('#tagsTable');
        });
    </script>
@endsection
