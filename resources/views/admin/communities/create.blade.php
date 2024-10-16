@extends('admin.adminLayout')
@section('title', 'Pages: Home Page')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        {!! implode('', $errors->all('<div>:message</div>')) !!}
    @endif

    <section>
        <p class="heading_for_admin_section">Communities Detail</p>
        <div class="section_content">
            <form id="image-upload-form" action="{{ route('community.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="heading">Heading <span class="mandatory">*</span></label>
                    <input type="text" class="form-control" name="heading" id="heading"
                        value="{{ old('heading', $community_detail->heading) }}" required>
                    @error('heading')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="images">Choose Header Background Image </label>
                    <input type="file" name="bg_image" id="images" class="form-control">
                    @error('images.*')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div id="image-preview" class="mt-3">
                        @if ($community_detail->bg_image)
                            <img src="{{ asset($community_detail->bg_image) }}" alt="Banner Image" style="height: auto;">
                        @endif
                    </div>
                </div>
                <hr>
                @php
                    if (isset($community_detail->second_section) && !empty($community_detail->second_section)) {
                        $second_section = json_decode($community_detail->second_section);
                    }
                @endphp
                <div id="row-container">
                    @if (isset($second_section) && !empty($second_section))
                        @foreach ($second_section as $key => $value)
                            <div class="row bottom_line">
                                <div class="col-12">
                                    <div class="mb-1">
                                        <label class="form-label"><strong>BG Image :</strong></label>
                                        <input type="file" name="bg_images[]" required id="images"
                                            accept="image/png, image/jpeg" class="form-control">
                                        @error('images.*')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <div id="image-preview" class="mt-3">
                                            @if (isset($value->image_url) && !empty($value->image_url) && $value->image_url)
                                                <img src="{{ asset('images/' . $value->image_url) }}" alt="Banner Image"
                                                    style="height: auto;">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-2 section_description">
                                        <label class="form-label"><strong>Section Description</strong></label>
                                        <textarea class="form-control" name="Description[]">{{ isset($value->description) ? $value->description : '' }}</textarea>
                                    </div>
                                    <div class="mb-2">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label>Button I</label>
                                                <input type="text" class="form-control" name="first_section_button[]"
                                                    id="first_section_button"
                                                    value="{{ isset($value->button_1) ? $value->button_1 : '' }}"
                                                    placeholder="Button Name">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Url I</label>
                                                <input type="text" class="form-control" name="first_button_url[]"
                                                    id="first_button_url"
                                                    value="{{ isset($value->url_1) ? $value->url_1 : '' }}"
                                                    placeholder="Button Url">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Button II</label>
                                                <input type="text" class="form-control" name="button_2[]"
                                                    value="{{ isset($value->button_2) ? $value->button_2 : '' }}"
                                                    id="second_button" placeholder="Button Name">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Url II</label>
                                                <input type="text" class="form-control" name="url_2[]"
                                                    id="second_button_2"
                                                    value="{{ isset($value->url_2) ? $value->url_2 : '' }}"
                                                    placeholder="Button Url">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-right">
                                    <span class="trash_button remove-row ml-2"><i class="fas fa-trash-alt"></i></span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <div class="row bottom_line">
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label"><strong>BG Image :</strong></label>
                                <input type="file" name="bg_images[]" required id="images"
                                    accept="image/png, image/jpeg" class="form-control">
                                @error('images.*')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div id="image-preview" class="mt-3"></div>
                            </div>

                            <div class="mb-2 section_description">
                                <label class="form-label"><strong>Section Description</strong></label>
                                <textarea class="form-control" name="Description[]"></textarea>
                            </div>
                            <div class="mb-2">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Button I</label>
                                        <input type="text" class="form-control" name="first_section_button[]"
                                            id="first_section_button" placeholder="Button Name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Url I</label>
                                        <input type="text" class="form-control" name="first_button_url[]"
                                            id="first_button_url" value="#" placeholder="Button Url">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Button II</label>
                                        <input type="text" class="form-control" name="button_2[]" id="second_button"
                                            placeholder="Button Name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Url II</label>
                                        <input type="text" class="form-control" name="url_2[]" id="second_button_2"
                                            value="#" placeholder="Button Url">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-right">
                            <span class="trash_button remove-row ml-2"><i class="fas fa-trash-alt"></i></span>
                        </div>
                    </div>
                    
                </div>
                <button id="add-row-btn" type="button" class="custom_clone_button clone_button border-btn">Add
                    More</button>
                
                
                    <hr>

                <div class="row  pl-2 pr-2 pb-3">
                    <div class="form-group col-md-6">
                        <label for="tenth_heading">Heading </label>
                        <input type="text" class="form-control" name="tenth_heading" id="tenth_heading"
                            value="{{ old('tenth_heading') }}">
                        @error('tenth_heading')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label d-block">Header Image</label>
                        {!! getImage('tenth_section_image', 'tenth_section_image', 'tenth_section_image') !!}
                    </div>
                    <div class="form-group col-md-12">
                        <label>Description </label>
                        <textarea class="form-control" name="tenth_description" id="tenth_description" rows="3">{{ old('tenth_description') }}</textarea>
                        @error('tenth_description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        {!! getButtonUrl('tenth_section_button', old('tenth_section_button'), old('tenth_section_button_2')) !!}
                    </div>
                </div>


                <button type="submit" class="green-btn">Submit</button>
            </form>
        </div>
    </section>
@endsection
@section('scripts')
    <script type="text/javascript">
        document.querySelectorAll('input[type="file"]').forEach(input => {
            attachFileChangeListener(input);
        });

        function attachFileChangeListener(input) {
            input.addEventListener('change', function() {
                const previewContainer = this.nextElementSibling; // Assuming the preview div is next to the input
                previewContainer.innerHTML = ''; // Clear previous previews

                for (const file of this.files) {
                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    img.classList.add('img-thumbnail', 'mr-2');
                    img.style.maxHeight = '150px';
                    previewContainer.appendChild(img);
                }
            });
        }

        jQuery(document).ready(function() {
            let rowCount = 1; // Initialize a counter for rows

            function cloneRow() {
                rowCount++;
                var newRow = $('#row-container .row:first').clone();

                // Reset inputs and textareas
                newRow.find('input').each(function() {
                    const name = $(this).attr('name');
                    $(this).attr('name', name.replace(/\[\d+\]/,
                        `[${rowCount}]`)); // Update the name attribute
                    $(this).val(''); // Clear input values
                });

                newRow.find('.section_description').remove();
                var insertslideID = $('#row-container .row').length;
                newRow.find('.mb-1').after(
                    '<div class="mb-2 section_description"><label class="form-label"><strong>Section Description</strong></label><textarea name="Description[]" id="mydiv' +
                    insertslideID + '"></textarea></div>');

                newRow.find('.remove-row').show();
                newRow.find('#image-preview').empty();
                $('#row-container').append(newRow);
                // Initialize TinyMCE on the newly added textarea
                initTinyMCE();
            }

            // Event handler for "Add More" button
            $('#add-row-btn').click(function() {
                cloneRow();
            });

            // Event delegation for dynamically created "Delete" buttons
            $('#row-container').on('click', '.remove-row', function() {
                if ($('#row-container .row').length > 1) {
                    $(this).closest('.row').remove();
                } else {
                    alert('You cannot remove the last row.');
                }
            });
        });
    </script>

@endsection
