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
        Reports Management 
        <a class="add_new_button m-0" href="{{ route('report_inidividual.create') }}">+ Add New Report</a>
    </p>
    <div class="section_content">
        <table id="reportsTable" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Heading</th>
                    <!-- <th>Subheading</th> -->
                    <th>Download</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($reports) && !empty($reports) && $reports->count() > 0)
                    @foreach($reports as $report)
                        <tr>
                            <td>{!! Str::words($report->heading, 8, '...') !!}</td>
                            <!-- <td>{!! Str::words($report->subheading ?? 'N/A', 5, '...') !!}</td> -->
                            <td><span class="download_count">{{ $report->report_forms_count }}</span></td>
                            <td>{{ ucfirst($report->status) }}</td>
                            <td>{{ $report->created_at->format('d-m-Y') }}</td>
                            <td>
                                <div class="faq-actions">
                                    <!-- View Report -->
                                    <a class="edit_button" href="{{ route('reportform.data', $report->id) }}">
                                    <i class="fa-solid fa-bars-progress"></i> Data
                                    </a>
                                    <a class="edit_button" href="{{ route('report_inidividual.shows', $report->slug) }}">
                                        <i class="fa-solid fa-eye"></i> View
                                    </a>
                                    <!-- Edit Report -->
                                    <a class="edit_button" href="{{ route('report_inidividual.edit', $report->id) }}">
                                        <i class="fa-solid fa-pencil"></i>
                                    </a>
                                    <!-- Delete Report -->
                                    <form action="{{ route('report_inidividual.destroy', $report->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="faq_delete_button" type="submit" onclick="return confirm('Are you sure you want to delete this report?');">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
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
            new DataTable('#reportsTable', {
                order: [] // Disable default sorting
            });
        });
    </script>
@endsection
