@extends('admin.adminLayout')
@section('title', 'Pages: Create Agents')
@section('content')
<div class="container section_content">
    <p class="heading_for_admin_section">Create Agent</p>
    <form action="{{ route('agents.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="detail">Designation:</label>
            <textarea class="form-control @error('detail') is-invalid @enderror" name="detail" id="detail">{{ old('detail') }}</textarea>
            @error('detail')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Detail:</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description">{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- <div class="form-group">
            <label for="username">Username (Email):</label>
            <input type="email" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" required>
            @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div> -->

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="linkedin">Linkedin:</label>
            <input type="linkedin" class="form-control @error('linkedin') is-invalid @enderror" id="linkedin" name="linkedin" value="{{ old('linkedin') }}" >
            @error('linkedin')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        

        <div class="form-group">
            <label for="mobile">Mobile:</label>
            <input type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile" value="{{ old('mobile') }}" required>
            @error('mobile')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="photo">Photo:</label>
            <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo">
            @error('photo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div id="image-preview" class="mt-3"></div>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="green-btn">Create Agent</button>
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
