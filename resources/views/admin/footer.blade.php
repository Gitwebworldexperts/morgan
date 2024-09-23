@extends('admin.adminLayout')
@section('title', 'Home Page')
@section('content')
    
    <section>
        <p class="heading_for_admin_section">Footer Section</p>
        <div class="section_content">
            <form action="{{ route('footer_sections.store') }}" method="POST" enctype="multipart/form-data"
                class="container mt-4">
                @csrf
                <div class="mb-3">
                    <label for="logo" class="form-label"><strong>Upload Footer Logo :</strong></label>
                    @if (isset($footerSections) && !empty($footerSections))
                        <img class="uploaded_logo" src="{{ asset($footerSections->logo_url) }}">
                    @endif
                    <input type="file" id="logo" name="logo" class="form-control" accept="image/*">
                    @if ($errors->has('logo'))
                        <div class="text-danger backend_error">
                            {{ $errors->first('logo') }}
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label"><strong>Address :</strong></label>                    
                    <textarea name="address" class="form-control" id="address" >{{$footerSections->address}}</textarea>
                    @if ($errors->has('address'))
                        <div class="text-danger backend_error">
                            {{ $errors->first('address') }}
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label"><strong>Email ID :</strong></label>                    
                    <input type="email" name="email" placeholder="Email ID" value="{{$footerSections->email}}" class="form-control">
                    @if ($errors->has('email'))
                        <div class="text-danger backend_error">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label"><strong>Phone Number :</strong></label>                    
                    <input type="text" name="phone" class="form-control" value="{{$footerSections->phone}}">
                    @if ($errors->has('phone'))
                        <div class="text-danger backend_error">
                            {{ $errors->first('phone') }}
                        </div>
                    @endif
                </div>

                @if (isset($footerSections) && !empty($footerSections))
                    @php
                        $footerSection = json_decode($footerSections->navigation_menus, true);
                        $countNum = count($footerSection);
                    @endphp
                    <div class="mb-3 pr">
                        <label for="logo" class="form-label"><strong>Menus :</strong></label>
                        <div id="row-container">
                            @if (isset($footerSection['urls']) && !empty($footerSection['urls']))
                                @foreach ($footerSection['urls'] as $url => $name)
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
                        <button id="add-row-btn" type="button" class="clone_button"><i
                                class="fa-solid fa-square-plus"></i></button>
                        @if ($errors->has('nav_name') || $errors->has('nav_url'))
                            <div class="text-danger backend_error">
                                Navigation part is required
                            </div>
                        @endif
                    </div>
                @else
                    <div class="mb-3 pr">
                        <label for="logo" class="form-label"><strong>First Menu :</strong></label>
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
                        <button id="add-row-btn" type="button" class="clone_button"><i
                                class="fa-solid fa-square-plus"></i></button>
                        @if ($errors->has('nav_name') || $errors->has('nav_url'))
                            <div class="text-danger backend_error">
                                Navigation part is required
                            </div>
                        @endif
                    </div>

                @endif

                @if (isset($footerSection) &&
                        !empty($footerSection) &&
                        isset($footerSection['dropdown_urls']) &&
                        !empty($footerSection['dropdown_urls']))
                    <div class="mb-3 pr">
                        <label for="logo" class="form-label"><strong>Dropdown Menus :</strong></label>
                        <div id="new-row-container">
                            @if (isset($footerSection['dropdown_urls']) && !empty($footerSection['dropdown_urls']))
                                @foreach ($footerSection['dropdown_urls'] as $url => $name)
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
                        <button id="new-add-row-btn" type="button" class="clone_button"><i
                                class="fa-solid fa-square-plus"></i></button>
                        @if ($errors->has('nav_name') || $errors->has('nav_url'))
                            <div class="text-danger backend_error">
                                Navigation part is required
                            </div>
                        @endif
                    </div>
                @else
                    <div class="mb-3 pr">
                        <label for="logo" class="form-label"><strong>Second Menu :</strong></label>
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
                        </div>
                        <button id="new-add-row-btn" type="button" class="clone_button"><i
                                class="fa-solid fa-square-plus"></i></button>
                        @if ($errors->has('nav_name') || $errors->has('nav_url'))
                            <div class="text-danger backend_error">
                                Navigation part is required
                            </div>
                        @endif
                    </div>
                @endif
                @php

                if(isset($footerSections->social_media_links) && !empty($footerSections->social_media_links)){
                    $footerLogoSection = json_decode($footerSections->social_media_links, true);                    
                }else{
                    $footerLogoSection = [];
                }
                @endphp
                    @if (isset($footerLogoSection) && !empty($footerLogoSection))
    
                        <div class="mb-3 pr">
                            <label for="logo" class="form-label"><strong>Social Media :</strong> 
                                <div class="custom_tooltip"><span class="trigger_part">i</span>
                                    <span class="tooltiptext"><a href="https://fontawesome.com/search" target="_blank">Click Here</a> for Icons</span>
                                </div>
                            </label>
                            <div id="news-row-container">
                                @foreach ($footerLogoSection as $url => $name)
                                <div class="mb-3 row align-items-center">
                                    <div class="col-md-5">
                                        <input class="form-control" type="text" placeholder="Icon Short Code" required
                                            value="{{ $name }}" name="icon[]">
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" placeholder="Icon Url" required
                                            value="{{ $url }}" name="icon_url[]">
                                    </div>
                                    <div class="col-md-1">
                                        <span class="news-remove-row ml-2"><i class="fas fa-trash-alt"></i></span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <button id="news-add-row-btn" type="button" class="clone_button"><i
                                    class="fa-solid fa-square-plus"></i></button>
                        </div>
                    @else
                        <div class="mb-3 pr">
                            <label for="logo" class="form-label"><strong>Social Media :</strong></label>
                            <div id="news-row-container">
                                <div class="mb-3 row align-items-center">
                                    <div class="col-md-5">
                                        <input class="form-control" type="text" placeholder="Icon Short Code" required
                                            name="icon[]">
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" placeholder="Icon Url" required
                                            name="icon_url[]">
                                    </div>
                                    <div class="col-md-1">
                                        <span class="news-remove-row ml-2"><i class="fas fa-trash-alt"></i></span>
                                    </div>
                                </div>
                            </div>
                            <button id="news-add-row-btn" type="button" class="clone_button"><i
                                    class="fa-solid fa-square-plus"></i></button>
                        </div>
                    @endif


                

                <div class="mb-3">
                    <label for="newslatter" class="form-label"><strong>News Letter :</strong></label>                    
                    <textarea name="newslatter" class="form-control" id="newslatter" >{{$footerSections->newsletter_section}}</textarea>
                    @if ($errors->has('newslatter'))
                        <div class="text-danger backend_error">
                            {{ $errors->first('newslatter') }}
                        </div>
                    @endif
                </div>
                
                <div class="mb-3">
                    <label for="address" class="form-label"><strong>Copyright :</strong></label>                    
                    <textarea name="copyright" class="form-control" id="copyright" >{{$footerSections->copyright}}</textarea>
                    @if ($errors->has('copyright'))
                        <div class="text-danger backend_error">
                            {{ $errors->first('copyright') }}
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
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

            // newslatter
            // Function to clone the row
            function newsCloneRow() {
                var newRow = $('#news-row-container .row:first').clone();
                newRow.find('input').val(''); // Clear input values in the cloned row
                newRow.find('.news-remove-row').show(); // Show the delete icon in the cloned row
                $('#news-row-container').append(newRow);
            }

            // Event handler for "Add More" button
            $('#news-add-row-btn').click(function() {
                newsCloneRow();
            });

            // Event delegation for dynamically created "Delete" buttons
            $('#news-row-container').on('click', '.news-remove-row', function() {
                // Check the number of .row elements inside #row-container
                if ($('#news-row-container .row').length > 1) {
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
