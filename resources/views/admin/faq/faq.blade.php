@extends('admin.adminLayout')
@section('title', "Faq's Page")
@section('content')
    
    <section>
        <p class="heading_for_admin_section">Faq's Section <a class="add_new_button" href="{{ route('faq.create') }}">+ Add New</a> <a class="add_new_button" href="{{ route('faq.settings') }}">FAQ Setting</a></p>
        <div class="section_content">
            <div class="row">
              <div  class="col-12">
              @if(isset($faqs) && !empty($faqs))


              <table id="example" class="table table-striped" style="width:100%">
                  <thead>
                      <tr>
                          <th>Question</th>
                          <th>Answer</th>
                          <th>Linked Page</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                        @php $count = 0; @endphp
                        @foreach ($faqs as $key => $question)
                        @php $count = $count+1; @endphp
                          <tr>
                              <td> {!! Str::words($question->question, 15, '...') !!}</td>
                              <td>{!! Str::words($question->answer, 20, '...') !!}</td>
                              <td>
                                
                              <select class="form-control" disabled name="linked_page">
                                    <option value=""> Not Selected </option>
                                    <option value="home" {{ ($question->page == "home") ? "selected": ''; }}> Home </option>
                                    <option value="sales" {{ ($question->page == "buy" || $question->page == "sales") ? "selected": ''; }}> Buy </option>
                                    <option value="rent" {{ ($question->page == "rent") ? "selected": ''; }}> Rent </option>
                                    <option value="private" {{ ($question->page == "private") ? "selected": ''; }}> Private </option>
                                    <option value="investment" {{ ($question->page == "investment") ? "selected": ''; }}> Investment </option>
                                    <option value="international" {{ ($question->page == "international") ? "selected": ''; }}> International </option>
                                    <option value="project" {{ ($question->page == "project") ? "selected": ''; }}> Development </option>
                                    <option value="branded" {{ ($question->page == "branded") ? "selected": ''; }}> Branded Residences </option>
                                    <option value="mortgage" {{ ($question->page == "mortgage") ? "selected": ''; }}> Mortgage Calculator </option>
                                    <option value="report" {{ ($question->page == "report") ? "selected": ''; }}> Report </option>
                                    <option value="career" {{ ($question->page == "career") ? "selected": ''; }}> Career </option>
                                    <option value="propertyManagement" {{ ($question->page == "propertyManagement") ? "selected": ''; }}> PropertyManagement </option>
                                    <option value="communities" {{ ($question->page == "communities") ? "selected": ''; }}> Communities </option>
                                    @php
                                    if (isset($blogs) && !empty($blogs)) {
                                        foreach ($blogs as $key => $value) {
                                            echo '<option ' . ($question->page == $value->slug ? 'selected' : '') . ' value="' . $value->slug . '"> Blog : ' . $value->name . '</option>'; 
                                        }
                                    }
                                    @endphp                                      
                                </select>  
                              

                            
                            </td>
                              
                              <td>
                                  <div class="faq-actions">

                                  <a class="edit_button" href="{{ route('faq.edit', $question) }}">
                                      <i class="fa-solid fa-pencil"></i>
                                  </a>
                                      <form action="{{ route('faq.destroy', $question) }}" method="POST" style="display:inline;">
                                          @csrf
                                          @method('DELETE')
                                          <button class="faq_delete_button" type="submit" onclick="return confirm('Are you sure you want to delete this property?');">
                                              <i class="fa-solid fa-trash"></i> Delete
                                          </button>
                                      </form>
                                  </div>
                              </td>
                          </tr>
                          @endforeach
                  </tbody>
              </table>

              @endif

              </div>
               
            </div>
        </div>
    </section>
@endsection
@section('scripts')    
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.bootstrap5.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            new DataTable('#example');
        });
    </script>
@endsection