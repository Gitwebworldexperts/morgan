@extends('admin.adminLayout')
@section('title', 'Reports: Reports List')
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
    <p class="heading_for_admin_section">
        Reports Form Data         <a href="javascript:void(0);" class="add_new_button m-0">{{ count($report_form_data) }} Downloads</a>
    </p>
    <div class="section_content">
        <p><strong> Report Name ( {!! Str::words($report_detail->heading, 8, '...') !!} )</strong></p>
        <table id="reportsTable" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Checkbox</th>
                    <th>mobile</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($report_form_data) && !empty($report_form_data) && $report_form_data->count() > 0)
                    @foreach($report_form_data as $report)
                        <tr>
                            <td>{{ $report->first_name }}</td>
                            <td>{{ $report->last_name }}</td>
                            <td>{{ $report->email }}</td>
                            <td>{{ $report->newsletter ? "Checked" : ""}}</td>
                            <td>{{ $report->mobile }}</td>
                            <td>{{ $report->created_at->format('d-m-Y') }}</td>
                        </tr>
                    @endforeach
                @else
                    <!-- <tr>
                        <td colspan="5" class="text-center">No reports found</td>
                    </tr> -->
                @endif
            </tbody>
        </table>
    </div>
</section>
@endsection

@section('scripts')    
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.bootstrap5.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            new DataTable('#reportsTable');
        });
    </script>
@endsection
