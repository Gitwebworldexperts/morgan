@extends('admin.adminLayout')
@section('title', 'Pages: Home Page')
@section('content')
@if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
@if($errors->any())
    {!! implode('', $errors->all('<div>:message</div>')) !!}
@endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <section>
        <form action="{{ route('home.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <p class="heading_for_admin_section">Home Page</p>
            <div class="section_con tent">
                <div class="container">
                    <div class="row">
                        <div class="col-12 home_section">
                            <div class="section_breaker pr"><label class="section_name"><input type="checkbox" name="section_1" value="1" {{ old('section_1', $home->section_1) ? 'checked' : '' }} 
                                        > Banner With Search Form</label> <span class="end_section_name">Section
                                    1</span>
                            </div>
                            <div class="row row-container-section pl-2 pr-2">
                                <div class="form-group col-md-6">
                                    <label for="address">Heading </label>
                                    <input type="text" class="form-control" name="first_section_heading"
                                        id="first_section_heading" value="{{ old('first_section_heading',$home->first_section_heading) }}">
                                    @error('first_section_heading')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label d-block">Header Image</label>
                                    {!! getImage('first_section_image', 'section_1', 'image_section',$home->first_section_image) !!}
                                </div>
                                <div class="col-12 form-group">
                                    <label>Show Search</label>
                                    <div class="row">
                                    @if(!empty($home->list_property))
                                        @php
                                            $list_property = json_decode($home->list_property, true); // true for associative array
                                            if (json_last_error() !== JSON_ERROR_NONE) {
                                                echo "JSON Decode Error: " . json_last_error_msg();
                                            }
                                        @endphp 

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="toggle_rent" id="toggle_rent" {{ ($list_property['rent'] == 1) ? 'checked':''  }} value="1">
                                                    <label class="form-check-label" for="toggle_rent">Show/Hide Rent</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="toggle_project" id="toggle_project" value="1" {{ ($list_property['project'] == 1) ? 'checked':''  }}>
                                                    <label class="form-check-label" for="toggle_project">Show/Hide Project</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="toggle_private" id="toggle_private" {{ ($list_property['private'] == 1) ? 'checked':''  }} value="1" >
                                                    <label class="form-check-label" for="toggle_private">Show/Hide Private</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="toggle_international" id="toggle_international" value="1" {{ ($list_property['international'] == 1) ? 'checked':''  }}>
                                                    <label class="form-check-label" for="toggle_international">Show/Hide International</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="toggle_buy" id="toggle_buy" value="1" {{ ($list_property['buy'] == 1) ? 'checked':''  }}>
                                                    <label class="form-check-label" for="toggle_buy">Show/Hide Buy</label>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    </div>
                                </div>
                            </div>


                            <div class="section_breaker pr"><label class="section_name"><input type="checkbox"
                                        name="section_2" value="1" {{ old('section_2',$home->section_2) ? 'checked' : '' }}> Information Section</label> <span
                                    class="end_section_name">Section 2</span>
                            </div>
                            <div class="row row-container-section pl-2 pr-2">
                                <div class="form-group col-md-6">
                                    <label for="address">Heading </label>
                                    <input type="text" class="form-control" name="second_heading" id="second_heading"
                                        value="{{ old('second_heading',$home->second_heading) }}">
                                    @error('second_heading')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12">
                                    <label>Description </label>
                                    <textarea class="form-control" name="second_description" id="second_description" rows="3">{{ old('second_description',$home->second_description) }}</textarea>
                                    @error('second_description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    {!! getButtonUrl('second_section_button', old('second_section_button'), old('second_section_button_2'),$home->second_section_button) !!}
                                </div>
                            </div>


                            <div class="section_breaker pr"><label class="section_name"><input type="checkbox"
                                        name="section_3" value="1" {{ old('section_3',$home->section_3) ? 'checked' : '' }}> Featured Properties Section</label> <span
                                    class="end_section_name">Section 3</span>
                            </div>
                            <div class="row row-container-section pl-2 pr-2">
                                <div class="col-12 d-none">
                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="toggle_featured_property"
                                                id="toggle_featured_property" value="1"
                                                {{ old('toggle_featured_property',$home->toggle_featured_property) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="toggle_featured_property">Show/Hide Fetured
                                                List</label>
                                        </div>
                                        @error('toggle_featured_property')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    {!! getButtonUrl('third_section_button', old('third_section_button'), old('third_section_button_2'),$home->third_section_button) !!}
                                </div>
                            </div>

                            <div class="section_breaker pr"><label class="section_name"><input type="checkbox"
                                        name="section_4" value="1" {{ old('section_4',$home->section_4) ? 'checked' : '' }}> Private Office</label> <span
                                    class="end_section_name">Section 4</span>
                            </div>
                            <div class="row row-container-section align-items-end pl-2 pr-2">
                                <div class="form-group col-md-6">
                                    <label for="address">Heading </label>
                                    <input type="text" class="form-control" name="fourth_heading" id="fourth_heading"
                                        value="{{ old('fourth_heading',$home->fourth_heading) }}">
                                    @error('fourth_heading')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="toggle_private_property"
                                                id="toggle_private_property" value="1"
                                                {{ old('toggle_private_property',$home->toggle_private_property) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="toggle_private_property">Show/Hide Private
                                                Property</label>
                                        </div>
                                        @error('toggle_private_property')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Description </label>
                                    <textarea class="form-control" name="fourth_description" id="fourth_description" rows="3">{{ old('fourth_description',$home->fourth_description) }}</textarea>
                                    @error('fourth_description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    {!! getButtonUrl('fourth_section_button', old('fourth_section_button'), old('fourth_section_button_2'),$home->fourth_section_button) !!}
                                </div>
                            </div>

                            <div class="section_breaker pr"><label class="section_name"><input type="checkbox"
                                        name="section_5" value="1" {{ old('section_5',$home->section_5) ? 'checked' : '' }}> International Properties Section</label> <span
                                    class="end_section_name">Section 5</span>
                            </div>
                            <div class="row row-container-section pl-2 pr-2">
                                <div class="form-group col-md-6">
                                    <label for="address">Heading </label>
                                    <input type="text" class="form-control" name="fifth_heading" id="fifth_heading"
                                        value="{{ old('fifth_heading',$home->fifth_heading) }}">
                                    @error('fifth_heading')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label d-block">Header Image</label>
                                    {!! getImage('fifth_section_image', 'fifth_section_image', 'fifth_section_image',$home->fifth_section_image) !!}
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox"
                                                name="toggle_international_property" id="toggle_international_property"
                                                value="1"
                                                {{ old('toggle_international_property',$home->toggle_international_property) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="toggle_international_property">Show/Hide
                                                International Property</label>
                                        </div>
                                        @error('toggle_international_property')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    {!! getButtonUrl('fifth_section_button', old('fifth_section_button'), old('fifth_section_button_2'),$home->fifth_section_button) !!}
                                </div>
                            </div>


                            <div class="section_breaker pr"><label class="section_name"><input type="checkbox"
                                        name="section_6" value="1" {{ old('section_6',$home->section_6) ? 'checked' : '' }}> New Devlopment Properties Section</label> <span
                                    class="end_section_name">Section 6</span>
                            </div>
                            <div class="row row-container-section pl-2 pr-2">
                                <div class="form-group col-md-6">
                                    <label for="address">Heading </label>
                                    <input type="text" class="form-control" name="sixth_heading" id="sixth_heading"
                                        value="{{ old('sixth_heading',$home->sixth_heading) }}">
                                    @error('sixth_heading')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox"
                                                name="toggle_development_property" id="toggle_development_property"
                                                value="1" {{ old('toggle_development_property',$home->toggle_development_property) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="toggle_development_property">Show/Hide
                                                Development Property</label>
                                        </div>
                                        @error('toggle_development_property')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    {!! getButtonUrl('sixth_section_button', old('sixth_section_button'), old('sixth_section_button_2'),$home->sixth_section_button) !!}
                                </div>
                            </div>


                            <div class="section_breaker pr"><label class="section_name"><input type="checkbox" name="section_7" value="1" {{ old('section_7',$home->section_7) ? 'checked' : '' }}> Media Section</label> <span
                                    class="end_section_name">Section 7</span>
                            </div>
                            <div class="row row-container-section pl-2 pr-2">
                                <div class="form-group col-md-6">
                                    <label for="address">Heading </label>
                                    <input type="text" class="form-control" name="seventh_heading"
                                        id="seventh_heading" value="{{ old('seventh_heading',$home->seventh_heading) }}">
                                    @error('seventh_heading')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="section_breaker pr"><label class="section_name"><input type="checkbox"
                                        name="section_8" value="1" {{ old('section_8',$home->section_8) ? 'checked' : '' }}> Book an evaluation Section</label> <span
                                    class="end_section_name">Section 8</span>
                            </div>
                            <div class="row row-container-section pl-2 pr-2">
                                <div class="form-group col-md-6">
                                    <label for="address">Heading </label>
                                    <input type="text" class="form-control" name="eighth_heading" id="eighth_heading"
                                        value="{{ old('eighth_heading',$home->eighth_heading) }}">
                                    @error('eighth_heading')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Description </label>
                                    <textarea class="form-control" name="eighth_description" id="eighth_description" rows="3">{{ old('eighth_description',$home->eighth_description) }}</textarea>
                                    @error('eighth_description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    {!! getButtonUrl('eighth_section_button', old('eighth_section_button'), old('eighth_section_button_2'),$home->eighth_section_button) !!}
                                </div>
                                <div class="col-12">
                                    {!! getButtonUrl('eighth_section_button_3', old('eighth_section_button_3'), old('eighth_section_button_3_2'),$home->eighth_section_button,1) !!}
                                </div>
                            </div>


                            <div class="section_breaker pr"><label class="section_name"><input type="checkbox" 
                                        name="section_9" value="1" {{ old('section_9',$home->section_9) ? 'checked' : '' }}> Blog Section</label> <span
                                    class="end_section_name">Section 9</span>
                            </div>
                            <div class="row row-container-section align-items-end pl-2 pr-2">
                                <div class="form-group col-md-6">
                                    <label for="address">Heading </label>
                                    <input type="text" class="form-control" name="ninth_heading" id="ninth_heading"
                                        value="{{ old('ninth_heading',$home->ninth_heading) }}">
                                    @error('ninth_heading')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="toggle_blog_list"
                                                id="toggle_blog_list" value="1"
                                                {{ old('toggle_blog_list',$home->toggle_blog_list) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="toggle_blog_list">Show/Hide Development
                                                Property</label>
                                        </div>
                                        @error('toggle_blog_list')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="section_breaker pr"><label class="section_name"><input type="checkbox"
                                        name="section_10" value="1" {{ old('section_10',$home->section_10) ? 'checked' : '' }}> Info Section</label> <span
                                    class="end_section_name">Section 10</span>
                            </div>
                            <div class="row row-container-section pl-2 pr-2">
                                <div class="form-group col-md-6">
                                    <label for="tenth_heading">Heading </label>
                                    <input type="text" class="form-control" name="tenth_heading" id="tenth_heading"
                                        value="{{ old('tenth_heading',$home->tenth_heading) }}">
                                    @error('tenth_heading')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label d-block">Header Image</label>
                                    {!! getImage('tenth_section_image', 'tenth_section_image', 'tenth_section_image',$home->tenth_section_image) !!}
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Description </label>
                                    <textarea class="form-control" name="tenth_description" id="tenth_description" rows="3">{{ old('tenth_description',$home->tenth_description) }}</textarea>
                                    @error('tenth_description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    {!! getButtonUrl('tenth_section_button', old('tenth_section_button'), old('tenth_section_button_2'), $home->tenth_section_button) !!}
                                </div>
                            </div>
                            <div class="row row-container-section pl-2 pr-2">
                                <div class="col-12 form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection

@section('scripts')
    <script type="text/javascript">
        function previewImage(event, input) {
            const file = input.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                const img = input.nextElementSibling.querySelector('img');
                img.src = e.target.result;
                img.style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
