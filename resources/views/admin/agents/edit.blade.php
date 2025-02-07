@extends('admin.adminLayout')
@section('title', 'Pages: Edit Agents')
@section('content')
 
<div class="container section_content">
    <p class="heading_for_admin_section">Edit Agent</p>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('agents.update', $agent) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name: <span class="mandatory">*</span></label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $agent->name) }}" required>
        </div>

        <div class="form-group">
            <label for="detail">Designation:</label>
            <textarea class="form-control @error('detail') is-invalid @enderror" name="detail" id="detail">{{ old('detail',$agent->detail) }}</textarea>
            @error('detail')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Detail:</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description">{{ old('detail',$agent->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- <div class="form-group">
            <label for="username">Username (Email):</label>
            <input type="email" class="form-control" id="username" name="username" value="{{ old('username', $agent->username) }}" required>
        </div> -->

        <div class="form-group">
            <label for="email">Email: <span class="mandatory">*</span></label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $agent->email) }}" required>
        </div>

        <div class="form-group">
            <label for="linkedin">Linkedin:</label>
            <input type="text" class="form-control @error('linkedin') is-invalid @enderror" id="linkedin" name="linkedin" value="{{ old('linkedin',$agent->linkedin) }}" >
            @error('linkedin')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="mobile">Mobile: <span class="mandatory">*</span></label>
            <input type="text" class="form-control" id="mobile" name="mobile" value="{{ old('mobile', $agent->mobile) }}" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $agent->phone) }}">
        </div>

        <div class="form-group">
            <label for="photo">Photo:</label>
            <input type="file" accept="image/*" class="form-control-file" id="photo" name="photo">
            @if ($agent->photo)
                <div class="mt-3">
                    <img src="{{ asset($agent->photo) }}" alt="Current Photo" class="img-thumbnail" style="max-height: 150px;">
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control" id="status" name="status">
                <option value="1" {{ old('status', $agent->status) ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('status', !$agent->status) ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="green-btn">Update Agent</button>
    </form>
</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        document.getElementById('photo').addEventListener('change', function() {
            const previewContainer = document.getElementById('image-preview');
            previewContainer.innerHTML = ''; // Clear previous previews

            for (const file of this.files) {
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.classList.add('img-thumbnail', 'mr-2');
                img.style.maxHeight = '150px';
                previewContainer.appendChild(img);
            }
        });
    </script>
@endsection
