@extends('admin.adminLayout')
@section('title', 'Reports: Add Report')
@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops! Something went wrong.</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section>
        <p class="heading_for_admin_section">New Report</p>
        <div class="section_content">
            <form action="{{ route('report_inidividual.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Heading -->
                <div class="form-group">
                    <label for="heading">Heading <span class="mandatory">*</span></label>
                    <input type="text" class="form-control" name="heading" id="heading" value="{{ old('heading') }}" required>
                    @error('heading')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="testimonial_description">Select Report Type</label>
                    <select class="form-control" name="report_type"  id="report_type" required>
                        <option value="" > Select Report Type</option>
                        <option value="1" >Dubai Real Estate Market Reports</option>
                        <option value="2" >Branded Residences Market Reports</option>
                        <option value="3" >Quarterly Community Reports</option>
                    </select>
                    @error('report_type')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Subheading -->
                <div class="form-group">
                    <label for="subheading">Subheading</label>
                    <input type="text" class="form-control" name="subheading" id="subheading" value="{{ old('subheading') }}">
                    @error('subheading')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- File Upload -->
                <div class="form-group">
                    <label for="file_upload">File Upload</label>
                    <input type="file" class="form-control" name="file_upload" id="file_upload">
                    @error('file_upload')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="file_upload">Featured Image</label>
                    <input type="file" class="form-control" name="featured_image" >
                    @error('featured_image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Background Image -->
                <div class="form-group">
                    <label for="background_image">Background Image</label>
                    <input type="file" class="form-control" name="background_image" id="background_image">
                    @error('background_image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Section 2 -->
                <h5>Section 2</h5>
                <div class="form-group">
                    <label for="section2_heading">Section 2 Heading</label>
                    <input type="text" class="form-control" name="section2_heading" id="section2_heading" value="{{ old('section2_heading') }}">
                    @error('section2_heading')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    &nbsp
                <div class="w-100">
                    <label for="section_ii_background_image">Section 2 Background Image</label>
                    <input type="file" class="form-control" name="section_ii_background_image" id="section_ii_background_image">
                    @error('section_ii_background_image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                </div>



                <div class="form-group">
                    <label for="section_ii_background_image">FAQs</label>
                    <div id="section2-container">
                        <div class="form-row">
                            <input type="text" name="section2_content[question][]" class="form-control mb-2" placeholder="Question">
                            <input type="text" name="section2_content[answer][]" class="form-control mb-2" placeholder="Answer">
                        </div>

                    </div>
                </div>
                

                <div class="row">
                    <button type="button" class="btn w-auto border-btn mr-2" onclick="addSection2Row()">Add More</button>
                    &nbsp<span class="trash_button remove-row ml-2" onclick="removeSection2Row()"><i class="fas fa-trash-alt"></i></span>
                </div> 
                <!-- Section 3 -->
                <h5>Section Snippet</h5>

                <div class="form-group">
                    <label for="meta_description">Html Code</label>
                    <textarea class="normal-textbox" name="html_code" id="html_code" rows="3">{{ old('html_code') }}</textarea>
                    @error('html_code')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <h5>Section 3</h5>
                <div class="form-group">
                    <label for="section3_heading">Section 3 Heading</label>
                    <input type="text" class="form-control" name="section3_heading" id="section3_heading" value="{{ old('section3_heading') }}">
                    @error('section3_heading')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group" id="testimonial_description_box">
                    <label for="testimonial_description">Select Testimonial</label>
                    <select class="form-control select2" data-placeholder="Select Testimonial" name="testimonial_description[]" multiple id="testimonial_description">
                        <option value="" disabled> Select Testimonial</option>
                        @if(isset($testimonials) && !empty($testimonials))
                            @foreach($testimonials as $item)
                            <option value="{{ $item->id }}" > {{ $item->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('testimonial_description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                
                <div class="form-group">
                    <label for="footer_image">Footer Image (For Branded Residences Market Reports)</label>
                    <input type="file" class="form-control" name="footer_image" >
                    @error('footer_image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- SEO -->
                <h5>SEO</h5>
                <div class="form-group">
                    <label for="meta_title">Meta Title</label>
                    <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{ old('meta_title') }}">
                    @error('meta_title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="meta_description">Meta Description</label>
                    <textarea class="form-control" name="meta_description" id="meta_description" rows="3">{{ old('meta_description') }}</textarea>
                    @error('meta_description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="seo_heading">SEO Heading</label>
                    <input type="text" class="form-control" name="seo_heading" id="seo_heading" value="{{ old('seo_heading') }}">
                    @error('seo_heading')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="seo_description">SEO Description</label>
                    <textarea class="form-control" name="seo_description" id="seo_description" rows="3">{{ old('seo_description') }}</textarea>
                    @error('seo_description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="green-btn">Submit</button>
            </form>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    function addSection2Row() {
        
        var newRow = $('#section2-container .form-row:first').clone();~
        newRow.find('input').val(''); 
        newRow.find('textarea').val('');
        newRow.find('select').val(''); 
        $('#section2-container').append(newRow);
    }

    function removeSection2Row(){
        if ($('#section2-container .form-row').length > 1) {
            $('#section2-container .form-row:last').remove();
        } else {
            alert('You cannot remove the last row.');
        }
    }
    // $('#section2-container').on('click', '.remove-row', function() {
    //     if ($('#section2-container .form-row').length > 1) {
    //         $(this).closest('.form-row').remove();
    //     } else {
    //         alert('You cannot remove the last row.');
    //     }
    // });

</script>
@endsection
