@extends('admin.adminLayout')
@section('title', "Contact List")
@section('content')
    
    <section>
        <p class="heading_for_admin_section">Contact Us </p>
        <div class="section_content">
            <div class="row">
                <div class="col-12">
                       @if(isset($contact) && $contact->count())
						    <table id="contactsTable" class="display table table-bordered">
						        <thead>
						            <tr>
						                <th>S.No.</th>
						                <th>First Name</th>
						                <th>Last Name</th>
						                <th>Email</th>
						                <th>Phone</th>
						                <th>Message</th>
						            </tr>
						        </thead>
						        <tbody>
						        	@php $count = 0; @endphp
						            @foreach ($contact as $item)
						            @php $count = $count+1; @endphp
						                <tr>
						                	<td>{{ $count }}</td>
						                    <td>{{ $item->first_name }}</td>
						                    <td>{{ $item->last_name }}</td>
						                    <td>{{ $item->email }}</td>
						                    <td>{{ $item->phone }}</td>
						                    <td>{{ $item->message }}</td>
						                </tr>
						            @endforeach
						        </tbody>
						    </table>

						    <!-- Pagination Links -->
						    <div class="pagination">
						    	{{ $contact->links('vendor.pagination.custom-pagination') }}
						        
						    </div>
						@else
						    <p>No contacts found.</p>
						@endif

                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')    
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.bootstrap5.js"></script>
    <script>
    $(document).ready(function() {
        $('#contactsTable').DataTable({
            "paging": false,
            "searching": true,
            "ordering": true
        });
    });
	</script>
@endsection



