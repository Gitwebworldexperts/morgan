@extends('admin.adminLayout')
@section('title', 'Pages: Blog Page')
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
        <p class="heading_for_admin_section">The Market
            <a class="add_new_button m-0" href="{{ route('posts.create') }}">+ Add Blog</a>
            <a class="add_new_button  m-0" href="{{ route('tags.index') }}">Tag List</a></p>
        <div class="section_content">
    
        
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Tags</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($posts) && !empty($posts) && count($posts))
                    @foreach($posts as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>  
                            @foreach($item->tags as $tag)
                                {{ $tag->name }},
                            @endforeach
                        </td>
                        <td>
                            <div class="faq-actions">
                                @if(isset($item->slug) && !empty($item->slug))
                                <a class="edit_button" target="_blank" href="{{ route('blog', ['slug' => $item->slug]) }}">
                                    <i class="fa-solid fa-eye"></i> View
                                </a>
                                @endif
                            <a class="edit_button" href="{{ route('posts.edit', $item->id) }}">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                            <form action="{{ route('posts.destroy', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="faq_delete_button" type="submit" onclick="return confirm('Are you sure you want to delete ?');">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>
                            </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
            <tfoot>
                <tr style="display: none;">
                    <th>Name</th>
                    <th>Tags</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</section>


@endsection
@section('scripts')    
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.bootstrap5.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            new DataTable('#example', {
                ordering: false // Disable sorting
            });
        });

    </script>
@endsection