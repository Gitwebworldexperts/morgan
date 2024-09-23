<form action="{{ route('header_sections.update', $headerSection->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div>
        <label for="logo">Update Logo</label>
        <input type="file" id="logo" name="logo">
        @if ($headerSection->logo_url)
            <img src="{{ Storage::url($headerSection->logo_url) }}" alt="Current Logo" style="max-width: 200px;">
        @endif
    </div>
    <div>
        <label for="navigation_links">Navigation Links (JSON format)</label>
        <textarea id="navigation_links" name="navigation_links" rows="5">{{ old('navigation_links', $headerSection->navigation_links) }}</textarea>
    </div>
    <button type="submit">Update</button>
</form>
