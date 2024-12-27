@extends('admin.adminLayout')
@section('title', "Edit Career Page")
@section('content')

<section>
    <p class="heading_for_admin_section">Edit Career Page</p>
    <div class="section_content">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('career.update') }}" method="POST" enctype="multipart/form-data" class="mt-4">
            @csrf
            @method('PUT')

            <div id="row-container">
                <div class="row bottom_line">
                    <div class="col-12">
                        <div class="mb-1">
                            <label class="form-label"><strong>Heading:</strong></label>
                            <input type="text" name="heading" id="heading" class="form-control" value="{{ $careerPage['heading'] ?? '' }}">
                        </div>

                        <div class="mb-2">
                            <label class="form-label"><strong>Description:</strong></label>
                            <textarea name="description" id="description" class="form-control" rows="5">{{ $careerPage['description'] ?? '' }}</textarea>
                        </div>

                        <div class="mb-2">
                            <label class="form-label"><strong>Button Link:</strong></label>
                            <input type="text" name="button_link" id="button_link" class="form-control" value="{{ $careerPage['button_link'] ?? '' }}">
                        </div>

                        <div class="mb-2">
                            <label class="form-label"><strong>Section 2 Heading:</strong></label>
                            <input type="text" name="section2_heading" id="section2_heading" class="form-control" value="{{ $careerPage['section2_heading'] ?? '' }}">
                        </div>

                        <div class="mb-2">
                            <label class="form-label"><strong>Upload Video:</strong></label>
                            <input type="file" name="video" id="video" class="form-control" accept="video/*,image/gif">

                        </div>

                        @if(!empty($careerPage['video_path']))
                            <div class="mb-2">
                                <p>Current Video: <a href="{{ asset( $careerPage['video_path']) }}" target="_blank">View Video</a></p>
                            </div>
                        @endif

                        <div class="mb-2">
                            <label class="form-label"><strong>Upload Images:</strong></label>
                            <input type="file" name="images[]" id="images" class="form-control" multiple>
                        </div>


                        @if(!empty($images))
                            <div class="mb-3">
                                <h5>Existing Images:</h5>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($images as $image)
                                        <div class="position-relative">
                                            <img src="{{ asset($image->image_path) }}" alt="Image" class="img-thumbnail" style="width: 150px; height: auto;">
                                            <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 delete-image" data-id="{{ $image->id }}">X</button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="btn-grp d-flex">
                    <button type="submit" class="green-btn">Save Changes</button>
                    
                </div>
            </div>
        </form>
    </div>
</section>

<script>
    document.querySelectorAll('.delete-image').forEach(button => {
        button.addEventListener('click', function () {
            const imageId = this.dataset.id;
            fetch("{{ route('career.deleteImage') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ id: imageId })
            }).then(response => {
                if (response.ok) {
                    this.parentElement.remove();
                }
            });
        });
    });
</script>
@endsection
