@extends('admin.adminLayout')
@section('title', 'Pages: Listing')
@section('content')
<div class="container">
    <p class="heading_for_admin_section">Listing</p>
    <!--<a href="{{ route('listing.create') }}" class="green-btn mb-4">Create Listing</a>-->
    <table class="table table-bordered">
        <thead>
            <tr>
            <th>S.No.</th>
            <th>Page Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($listing) && !empty($listing))
            @php
                $count = 0;
            @endphp
            @foreach ($listing as $list)
            @php
                $count++;
            @endphp    
                <tr>
                    <td>{{ $count }} </td>
                    <td>{{ $list->page_name }}</td>
                    <td>
                        <a href="{{ route('listing.edit', $list) }}" class="btn btn-warning btn-sm">Edit</a>
                        <!-- <a href="#" class="btn btn-warning btn-sm">View</a> -->
                    </td>
                </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection