@extends('admin.adminLayout')
@section('title', "Mortgage Data  – Morgan’s International Realty")
@section('content')
    
    <section>
        <p class="heading_for_admin_section">Mortgage Data </p>
        <div class="section_content">
            <div class="row">
                <div class="col-12">
                       @if(isset($contact) && $contact->count())
						    <table id="contactsTable" class="display table table-bordered">
						        <thead>
						            <tr>
						                <th>S.No.</th>
						                <th>Property Price</th>
						                <th>Down Payment</th>
						                <th>Loan Duration</th>
						                <th>Interest Rate</th>
										<th>Monthely Payment</th>
										<th>Email</th>
						            </tr>
						        </thead>
						        <tbody>
						        	@php $count = 0; @endphp
						            @foreach ($contact as $item)
						            @php $count = $count+1;
									@endphp
						                <tr>
						                	<td>{{ $count }}</td>
						                    <td>{{ $item->property_price }}</td>
						                    <td>{{ $item->down_payment }}</td>
						                    <td>{{ $item->loan_duration }}</td>
						                    <td>{{ $item->interest_rate }}</td>
											<td>{{ $item->monthely_payment }}</td>
											<td><a href="mailto:{{ $item->email }}">{{ $item->email }}</a></td>
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



