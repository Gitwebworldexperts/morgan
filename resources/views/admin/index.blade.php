@extends('admin.adminLayout')
@section('title', 'Home Page')
@section('content')
    @php 
        $headerSections = getHeaderSection();
        $first_button_name= $first_button_url= $second_button_name= $second_button_url = null;
    @endphp
    <section>
        <p class="heading_for_admin_section">Header Section</p>
        <div class="section_content">
            <form action="{{ route('header_sections.store') }}" method="POST" enctype="multipart/form-data"
                class=" mt-4">
                @csrf
                <div class="mb-3">
                    <label for="logo" class="form-label"><strong>Upload Logo :</strong></label>
                    @if (isset($headerSections) && !empty($headerSections))
                        <img class="uploaded_logo" src="{{ asset($headerSections->logo_url) }}">
                    @endif
                    <input type="file" id="logo" name="logo" class="form-control" accept="image/*">
                    @if ($errors->has('logo'))
                        <div class="text-danger backend_error">
                            {{ $errors->first('logo') }}
                        </div>
                    @endif
                </div>

                @if (isset($headerSections) && !empty($headerSections))
                    @php
                        $headerSections = json_decode($headerSections->navigation_links, true);

                        if (isset($headerSections['buttons'])) {
                            $first_button_name = $headerSections['buttons']['first_button_name'];
                            $first_button_url = $headerSections['buttons']['first_button_url'];
                            $second_button_name = $headerSections['buttons']['second_button_name'];
                            $second_button_url = $headerSections['buttons']['second_button_url'];
                        }
                        $countNum = count($headerSections);
                    @endphp
                    <div class="mb-3 pr">
                        <label for="logo" class="form-label"><strong>Menus :</strong></label>
                        <div id="row-container">
                            @if (isset($headerSections['urls']) && !empty($headerSections['urls']))
                                @foreach ($headerSections['urls'] as $url => $name)
                                    <div class="mb-3 row align-items-center">
                                        <div class="col-md-5">
                                            <input class="form-control" type="text" placeholder="Nav Title"
                                                value="{{ $name }}" required name="nav_name[]">
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control" type="text" placeholder="Link Url"
                                                value="{{ $url }}" required name="nav_url[]">
                                        </div>
                                        <div class="col-md-1">
                                            <span class="remove-row ml-2"><i class="fas fa-trash-alt"></i></span>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            
                            
                        </div>
                        <button id="add-row-btn" type="button" class="clone_button border-btn ml-auto">Add new row</button>
                            @if ($errors->has('nav_name') || $errors->has('nav_url'))
                                <div class="text-danger backend_error">
                                    Navigation part is required
                                </div>
                            @endif
                       
                    </div>
                @else
                    <div class="mb-3 pr">
                        <label for="logo" class="form-label"><strong>Menus :</strong></label>
                        <div id="row-container">
                            <div class="mb-3 row align-items-center">
                                <div class="col-md-5">
                                    <input class="form-control" type="text" placeholder="Nav Title" required
                                        name="nav_name[]">
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" placeholder="Link Url" required
                                        name="nav_url[]">
                                </div>
                                <div class="col-md-1">
                                    <span class="remove-row ml-2"><i class="fas fa-trash-alt"></i></span>
                                </div>
                            </div>
                            
                        </div>
                        <button id="add-row-btn" type="button" class="clone_button border-btn">Add new row</button>
                        @if ($errors->has('nav_name') || $errors->has('nav_url'))
                            <div class="text-danger backend_error">
                                Navigation part is required
                            </div>
                        @endif
                        
                    </div>

                @endif

                @if (isset($headerSections) &&
                        !empty($headerSections) &&
                        isset($headerSections['dropdown_urls']) &&
                        !empty($headerSections['dropdown_urls']))
                    <div class="mb-3 pr">
                        <label for="logo" class="form-label"><strong>Dropdown Menus :</strong></label>
                        <div id="new-row-container">
                            @if (isset($headerSections['dropdown_urls']) && !empty($headerSections['dropdown_urls']))
                                @foreach ($headerSections['dropdown_urls'] as $url => $name)
                                    <div class="mb-3 row align-items-center">
                                        <div class="col-md-5">
                                            <input class="form-control" type="text" placeholder="Nav Title"
                                                value="{{ $name }}" required name="new_nav_name[]">
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control" type="text" placeholder="Link Url"
                                                value="{{ $url }}" required name="new_nav_url[]">
                                        </div>
                                        <div class="col-md-1">
                                            <span class="new-remove-row ml-2"><i class="fas fa-trash-alt"></i></span>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            
                              
                        </div>
                        <button id="new-add-row-btn" type="button" class="clone_button border-btn">Add new row</button>
                            @if ($errors->has('nav_name') || $errors->has('nav_url'))
                                <div class="text-danger backend_error">
                                    Navigation part is required
                                </div>
                            @endif
                        
                    </div>
                @else
                    <div class="mb-3 pr">
                        <label for="logo" class="form-label"><strong>Menus :</strong></label>
                        <div id="new-row-container">
                            <div class="mb-3 row align-items-center">
                                <div class="col-md-5">
                                    <input class="form-control" type="text" placeholder="Nav Title" required
                                        name="new_nav_name[]">
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" placeholder="Link Url" required
                                        name="new_nav_url[]">
                                </div>
                                <div class="col-md-1">
                                    <span class="new-remove-row ml-2"><i class="fas fa-trash-alt"></i></span>
                                </div>
                            </div>
                            <button id="new-add-row-btn" type="button" class="clone_button">Add new row</button>
                            @if ($errors->has('nav_name') || $errors->has('nav_url'))
                                <div class="text-danger backend_error">
                                    Navigation part is required
                                </div>
                            @endif
                        </div>
                        
                    </div>
                @endif

                <div class="mb-3">
                    <label for="logo" class="form-label"><strong>Buttons :</strong></label>
                    <div class="row-container">
                        <div class="row align-items-center">
                            <div class="col-md-1 text-center">
                                <img class="small_icon" src="{{ asset('img/home.svg') }}">
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="first_button_name"
                                    placeholder="Button Name" value="{{ $first_button_name ? $first_button_name : '' }}">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="first_button_url"
                                    placeholder="Button Url" value="{{ $first_button_url ? $first_button_url : '' }}">
                            </div>
                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="col-md-1 text-center">
                                <img class="small_icon" src="{{ asset('img/user.svg') }}">
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="second_button_name"
                                    placeholder="Button Name"
                                    value="{{ $second_button_name ? $second_button_name : '' }}">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="second_button_url"
                                    placeholder="Button Url" value="{{ $second_button_url ? $second_button_url : '' }}">
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="green-btn">Save</button>
            </form>

        </div>
    </section>

    <script type="text/javascript">
        jQuery(document).ready(function() {
            // Function to clone the row
            function cloneRow() {
                var newRow = $('#row-container .row:first').clone();
                newRow.find('input').val(''); // Clear input values in the cloned row
                newRow.find('.remove-row').show(); // Show the delete icon in the cloned row
                $('#row-container').append(newRow);
            }

            // Event handler for "Add More" button
            $('#add-row-btn').click(function() {
                cloneRow();
            });

            // Event delegation for dynamically created "Delete" buttons
            $('#row-container').on('click', '.remove-row', function() {
                // Check the number of .row elements inside #row-container
                if ($('#row-container .row').length > 1) {
                    // If there is more than one .row, remove the closest .row to the clicked .remove-row
                    $(this).closest('.row').remove();
                } else {
                    // Optionally, you can alert the user or handle the case where there's only one row
                    alert('You cannot remove the last row.');
                }
            });


            // Second Section
            // Function to clone the row
            function newCloneRow() {
                var newRow = $('#new-row-container .row:first').clone();
                newRow.find('input').val(''); // Clear input values in the cloned row
                newRow.find('.new-remove-row').show(); // Show the delete icon in the cloned row
                $('#new-row-container').append(newRow);
            }

            // Event handler for "Add More" button
            $('#new-add-row-btn').click(function() {
                newCloneRow();
            });

            // Event delegation for dynamically created "Delete" buttons
            $('#new-row-container').on('click', '.new-remove-row', function() {
                // Check the number of .row elements inside #row-container
                if ($('#new-row-container .row').length > 1) {
                    // If there is more than one .row, remove the closest .row to the clicked .remove-row
                    $(this).closest('.row').remove();
                } else {
                    // Optionally, you can alert the user or handle the case where there's only one row
                    alert('You cannot remove the last row.');
                }
            });

            // Initially hide the delete icon for the first row (optional)
            // $('#row-container .remove-row').hide();
        });
        $(document).ready(function() {
            $("#row-container").sortable({
                items: ".mb-3.row",
                cursor: "move",
                placeholder: "ui-state-highlight",
                update: function(event, ui) {
                    // Optional: Handle the reordering and save the new order if necessary
                }
            });
            $("#row-container").disableSelection();
            $("#new-row-container").sortable({
                items: ".mb-3.row",
                cursor: "move",
                placeholder: "ui-state-highlight",
                update: function(event, ui) {
                    // Optional: Handle the reordering and save the new order if necessary
                }
            });
            $("#new-row-container").disableSelection();
        });
    </script>
@endsection
