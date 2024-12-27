@extends('admin.adminLayout')
@section('title', 'Pages: Private Office Create')
@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <section>
        <div class="container">
            <p class="heading_for_admin_section">Create Private Office</p>

            <form class="home_section" id="private-office-form" action="{{ route('private_offices.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row row-container-section pl-2 pr-2">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{ old('name', $privateOffice->name) }}" id="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" required>{!! old('description', $privateOffice->description) !!}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="expert_image">Expert Image</label>
                            <input type="file" name="expert_image" id="expert_image" class="form-control">
                            @if($privateOffice->expert_image)
                            <div id="image-preview" class="mt-3">
                                <img src="{{ asset($privateOffice->expert_image) }}" class="img-thumbnail mr-2" style="max-height: 150px;">
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="expert_name">Expert Name</label>
                            <input type="text" name="expert_name" id="expert_name" value="{{ old('expert_name', $privateOffice->expert_name) }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="expert_post">Expert Post</label>
                            <input type="text" name="expert_post" id="expert_post" class="form-control" value="{{ old('expert_post', $privateOffice->expert_post) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="contact_link">Contact Link</label>
                            <input type="text" name="contact_link" id="contact_link" class="form-control" value="{{ old('contact_link', $privateOffice->contact_link) }}">
                        </div>

                        <div class="form-group">
                            <label for="section_2_heading">Section 2 Heading</label>
                            <input type="text" name="section_2_heading" id="section_2_heading" class="form-control" value="{{ old('section_2_heading', $privateOffice->section_2_heading) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="expert_description">Expert Description</label>
                            <textarea name="expert_description" id="expert_description" class="form-control" required>{!! old('expert_description', $privateOffice->expert_description) !!}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="mastery_description">Mastery Description</label>
                            <textarea name="mastery_description" id="mastery_description" class="form-control" required>{!! old('mastery_description', $privateOffice->mastery_description) !!}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="result_description">Result Description</label>
                            <textarea name="result_description" id="result_description" class="form-control" required>{!! old('result_description', $privateOffice->result_description) !!}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="access_description">Access Description</label>
                            <textarea name="access_description" id="access_description" class="form-control" required>{!! old('access_description', $privateOffice->access_description) !!}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="confidentiality_description">Confidentiality Description</label>
                            <textarea name="confidentiality_description" id="confidentiality_description" class="form-control" required>{!! old('confidentiality_description', $privateOffice->confidentiality_description) !!}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="legal_description">Legal Description</label>
                            <textarea name="legal_description" id="legal_description" class="form-control" required>{!! old('legal_description', $privateOffice->legal_description) !!}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="section_3_heading">Section 3 Heading</label>
                            <input type="text" name="section_3_heading" id="section_3_heading" value="{{ old('section_3_heading', $privateOffice->section_3_heading) }}" class="form-control" required>
                        </div>

                        @php
                            if($privateOffice->input_fields){
                                $json = json_decode($privateOffice->input_fields,1);
                            }                        
                        @endphp

                        <div class="row">
                            
                            @if(isset($json) && !empty($json))
                                @foreach($json as $item)
                                    @foreach($item as $key => $value)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Percentage</label>
                                                <input type="text" value="{{ $key }}" name="percentage[]" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Percentage Heading</label>
                                                <input type="text" name="percentage_heading[]" value="{{ $value }}" class="form-control" required>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            @else
                            

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Percentage</label>
                                    <input type="text" value="{{ isset($json[0]) && !empty($json[0]) ? key($json[0]) : '' }}" name="percentage[]" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Percentage Heading</label>
                                    <input type="text" name="percentage_heading[]" value="{{ isset($json[0]) && !empty($json[0]) ? $json[0][key($json[0])] : '' }}" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Percentage</label>
                                    <input type="text" value="{{ isset($json[1]) && !empty($json[1]) ? key($json[1]) : '' }}" name="percentage[]" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Percentage Heading</label>
                                    <input type="text" name="percentage_heading[]" value="{{ isset($json[1]) && !empty($json[1]) ? $json[1][key($json[0])] : '' }}" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Percentage</label>
                                    <input type="text" name="percentage[]" value="{{ isset($json[2]) && !empty($json[2]) ? key($json[2]) : '' }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Percentage Heading</label>
                                    <input type="text" name="percentage_heading[]" value="{{ isset($json[2]) && !empty($json[2]) ? $json[2][key($json[0])] : '' }}" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Percentage</label>
                                    <input type="text" name="percentage[]" value="{{ isset($json[3]) && !empty($json[3]) ? key($json[3]) : '' }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Percentage Heading</label>
                                    <input type="text" name="percentage_heading[]" value="{{ isset($json[3]) && !empty($json[3]) ? $json[3][key($json[0])] : '' }}" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Percentage</label>
                                    <input type="text" name="percentage[]" value="{{ isset($json[4]) && !empty($json[4]) ? key($json[4]) : '' }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Percentage Heading</label>
                                    <input type="text" name="percentage_heading[]" value="{{ isset($json[3]) && !empty($json[3]) ? $json[3][key($json[0])] : '' }}" class="form-control" required>
                                </div>
                            </div>
                            @endif
                        </div>


                        <button type="submit" class="green-btn">Save Private Office</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection

@section('scripts')
    <!-- Optional JS for form validation or additional features -->
@endsection
