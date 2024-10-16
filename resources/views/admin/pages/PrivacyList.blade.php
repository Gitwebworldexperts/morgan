@extends('admin.adminLayout')
@section('title', 'Privacy Policy')
@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@if($errors->any())
{!! implode('', $errors->all('<div>:message</div>')) !!}
@endif
@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<section>
    <p class="heading_for_admin_section">Add Privacy Policy
        <a class="add_new_button m-0" href="{{ route('contents.privacy') }}">+ Add Privacy Policy</a>
        
    <div class="section_content">
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Heading</th>
                <th>Slug</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($list) && !empty($list) && count($list))
                @foreach($list as $item)
                <tr>
                    <td>{{ $item->heading }}</td>
                    <td>{{ $item->slug }}</td>
                    
                    <td>
                        <a class="edit_button" target="_blank" href="{{ route('privacy.policy', $item->slug) }}">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a class="edit_button" href="{{ route('edit.policy', $item) }}">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                        <form action="{{ route('privacy.destroy', base64_encode($item->id)) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="faq_delete_button" type="submit" onclick="return confirm('Are you sure you want to delete this privacy policy?');">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr>
                <th>Heading</th>
                <th>Slug</th>
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
            new DataTable('#example');
        });
    </script>   
</script>@endsection