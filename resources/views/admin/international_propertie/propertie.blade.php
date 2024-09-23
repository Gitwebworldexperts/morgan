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
        <p class="heading_for_admin_section">Add Properties 
            <a class="add_new_button m-0" href="{{ route('international_properties.create') }}">+ Add New Property</a>
            <a class="add_new_button  m-0" href="{{ route('property-type.create','international') }}">+ Add Property Type</a></p>
        <div class="section_content">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Property</th>
                    <th>Price</th>
                    <th>Sale Price</th>
                    <!-- <th>Country</th> -->
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($propertie) && !empty($propertie) && count($propertie))
                    @foreach($propertie as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->sale_price }}</td>
                        <!-- <td>{{ $item->country_id }}</td> You may want to show the country name instead of the ID -->
                        <td>{{ isset($item->propertyType->type_name)? $item->propertyType->type_name : '' }}</td> <!-- Same as above, consider showing the category name -->
                        <td>
                            <a class="edit_button" href="{{ route('international_properties.edit', $item) }}">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                            <form action="{{ route('international_properties.destroy', $item) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="faq_delete_button" type="submit" onclick="return confirm('Are you sure you want to delete this property?');">
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
                    <th>Property</th>
                    <th>Price</th>
                    <th>Sale Price</th>
                    <!-- <th>Country</th> -->
                    <th>Category</th>
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
@endsection
