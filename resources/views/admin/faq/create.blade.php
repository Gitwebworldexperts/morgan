@extends('admin.adminLayout')
@section('title', "Faq's Create Page")
@section('content')
    
    <section>
        <p class="heading_for_admin_section">Faq's Section</p>
        <div class="section_content">
            <form action="{{ route('faq.store') }}" method="POST" enctype="multipart/form-data"
                class="mt-4">
                @csrf
                <div id="row-container" class="faq-create-row">
                    <div class="row bottom_line">
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label"><strong>Question :</strong></label>
                                <input type="text" name="question[]" required class="form-control">
                            </div>
                            <div class="mb-2">
                                <label class="form-label"><strong>Answer :</strong></label>
                                <textarea class="form-control" required name="answer[]"></textarea>
                            </div>        
                            <div class="mb-2">
                                <label class="form-label"><strong>Linked Page :</strong></label>
                                <select class="form-control" name="linked_page[]">
                                    <option value=""> Select Linked Page </option>
                                    <option value="home"> Home </option>
                                </select>
                            </div>                        
                        </div>
                        <div class="col-12 text-right">
                            <span class="trash_button remove-row ml-2"><i class="fas fa-trash-alt"></i></span>
                        </div>                        
                    </div>

                </div>
                <div class="btn-grp d-flex">
                        <button type="submit" class="green-btn">Save</button>
                        <button id="add-row-btn" type="button" class="custom_clone_button clone_button border-btn">Add new</button>
                        <a href="{{ route('faq.index') }}" class="border-btn">Back</a>
                    </div>
                
               
                
            </form>

        </div>
    </section>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            function cloneRow() {
                var newRow = $('#row-container .row:first').clone();~
                newRow.find('input').val(''); // Clear input values in the cloned row
                newRow.find('textarea').val(''); // Clear input values in the cloned row
                newRow.find('select').val(''); // Clear input values in the cloned row
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
        });
    </script>
@endsection
