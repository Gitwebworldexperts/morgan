@extends('admin.adminLayout')
@section('title', 'Pages: List Page')
@section('content')
    <section>
    <div class="container">
        <p class="heading_for_admin_section">Applied Jobs</p>

        <div class="section_content">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Experience</th>
                    <th>Contact Number</th>
                    <th>Attachment</th>
                </tr>
            </thead>
            <tbody>
                @foreach($list as $item)
                    <tr>
                        <td>{{ $item->full_name }}</td>
                        <td>
                            <a target="_blank" href="mailto:{{ $item->email }}">
                                {{ $item->email }}
                            </a>                            
                        </td>
                        <td>{{ $item->experience }}</td>
                        <td>
                            <a target="_blank" href="tel:{{ $item->contact_number }}">
                            {{ $item->contact_number }}
                            </a>
                        </td>
                        <td>
                            <a download href="{{ asset($item->resume_path) }}">
                                Download 
                            </a>
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
            new DataTable('#example', {
                "ordering": false // Disable sorting
            });
        });
    </script>
@endsection
