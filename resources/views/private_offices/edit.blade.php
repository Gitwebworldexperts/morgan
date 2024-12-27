<!-- resources/views/private_offices/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Private Office Page</h1>

        <form action="{{ route('private_offices.update', $privateOffice->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $privateOffice->name) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" required>{{ old('description', $privateOffice->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="expert_image">Expert Image</label>
                <input type="file" class="form-control" name="expert_image" id="expert_image">
                @if($privateOffice->expert_image)
                
                    <p>Current Image: <img src="{{ Storage::url($privateOffice->expert_image) }}" alt="Expert Image" width="100"></p>
                @endif
            </div>

            <div class="form-group">
                <label for="expert_name">Expert Name</label>
                <input type="text" class="form-control" name="expert_name" id="expert_name" value="{{ old('expert_name', $privateOffice->expert_name) }}" required>
            </div>

            <div class="form-group">
                <label for="expert_post">Expert Post</label>
                <input type="text" class="form-control" name="expert_post" id="expert_post" value="{{ old('expert_post', $privateOffice->expert_post) }}" required>
            </div>

            <div class="form-group">
                <label for="contact_link">Contact Link</label>
                <input type="url" class="form-control" name="contact_link" id="contact_link" value="{{ old('contact_link', $privateOffice->contact_link) }}">
            </div>

            <div class="form-group">
                <label for="section_2_heading">Section 2 Heading</label>
                <input type="text" class="form-control" name="section_2_heading" id="section_2_heading" value="{{ old('section_2_heading', $privateOffice->section_2_heading) }}" required>
            </div>

            <div class="form-group">
                <label for="expert_description">Expert Description</label>
                <textarea class="form-control" name="expert_description" id="expert_description" required>{{ old('expert_description', $privateOffice->expert_description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="mastery_description">Mastery Description</label>
                <textarea class="form-control" name="mastery_description" id="mastery_description" required>{{ old('mastery_description', $privateOffice->mastery_description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="result_description">Result Description</label>
                <textarea class="form-control" name="result_description" id="result_description" required>{{ old('result_description', $privateOffice->result_description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="access_description">Access Description</label>
                <textarea class="form-control" name="access_description" id="access_description" required>{{ old('access_description', $privateOffice->access_description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="confidentiality_description">Confidentiality Description</label>
                <textarea class="form-control" name="confidentiality_description" id="confidentiality_description" required>{{ old('confidentiality_description', $privateOffice->confidentiality_description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="legal_description">Legal Description</label>
                <textarea class="form-control" name="legal_description" id="legal_description" required>{{ old('legal_description', $privateOffice->legal_description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="section_3_heading">Section 3 Heading</label>
                <input type="text" class="form-control" name="section_3_heading" id="section_3_heading" value="{{ old('section_3_heading', $privateOffice->section_3_heading) }}" required>
            </div>

            <div class="form-group">
                <label for="input_fields">Input Fields (JSON format)</label>
                <textarea class="form-control" name="input_fields" id="input_fields">{{ old('input_fields', json_encode($privateOffice->input_fields)) }}</textarea>
                <small class="form-text text-muted">Provide input fields in JSON format, e.g., [{"label": "Field 1", "type": "text"}, ...]</small>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
