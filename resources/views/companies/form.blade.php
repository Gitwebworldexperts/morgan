@extends('admin.adminLayout')
@section('title', isset($company) ? 'Edit Company' : 'Add Company')
@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container">
    <p class="heading_for_admin_section">{{ isset($company) ? 'Edit Company' : 'Add Company' }}</p>
    <form class="home_section" id="company-form" action="{{ isset($company) ? route('companies.update', $company->id) : route('companies.store') }}" method="POST">
        @csrf
        @if (isset($company))
            @method('PUT')
        @endif

        <div class="row row-container-section pl-2 pr-2">
            <div class="col-12">
                <div class="form-group">
                    <label for="company_name">Company Name</label>
                    <input type="text" name="company_name" id="company_name" class="form-control" value="{{ $company->company_name ?? '' }}" required>
                </div>

                <div class="form-group">
                    <label for="company_detail">Company Detail</label>
                    <textarea name="company_detail" id="company_detail" class="form-control" rows="3" required>{{ $company->company_detail ?? '' }}</textarea>
                </div>

                <div id="track-record-section">
                    <p class="heading_for_admin_section">Track Record</p>
                    <div class="track-records">
                        @if (isset($company) && $company->track_record)
                            @foreach (json_decode($company->track_record)->data as $record)
                                <div class="track-record-item mb-2">
                                    <input type="text" name="track_record[tr_id][]" value="{{ $record->tr_id }}" placeholder="Track Record ID" class="form-control mb-1" required>
                                    <input type="text" name="track_record[tr_name][]" value="{{ $record->tr_name }}" placeholder="Track Record Name" class="form-control mb-1" required>
                                    <button type="button" class="btn btn-danger remove-track-record">Remove</button>
                                </div>
                            @endforeach
                        @else
                            <div class="track-record-item mb-2">
                                <input type="text" name="track_record[tr_id][]" placeholder="Track Record ID" class="form-control mb-1" required>
                                <input type="text" name="track_record[tr_name][]" placeholder="Track Record Name" class="form-control mb-1" required>
                                <button type="button" class="btn btn-danger remove-track-record">Remove</button>
                            </div>
                        @endif
                    </div>
                    <button type="button" class="btn btn-primary mt-2" id="add-track-record">Add More</button>
                </div>

                <button type="submit" class="green-btn mt-3">{{ isset($company) ? 'Update Company' : 'Add Company' }}</button>
            </div>
        </div>
    </form>
</div>

<script>
    document.getElementById('add-track-record').addEventListener('click', () => {
        const container = document.querySelector('.track-records');
        const newItem = `
            <div class="track-record-item mb-2">
                <input type="text" name="track_record[tr_id][]" placeholder="Track Record ID" class="form-control mb-1" required>
                <input type="text" name="track_record[tr_name][]" placeholder="Track Record Name" class="form-control mb-1" required>
                <button type="button" class="btn btn-danger remove-track-record">Remove</button>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', newItem);
    });

    document.addEventListener('click', (e) => {
        if (e.target.classList.contains('remove-track-record')) {
            e.target.closest('.track-record-item').remove();
        }
    });
</script>

@endsection
