@extends('admin.adminLayout')
@section('title', "Faq's Create Page")
@section('content')
    
    <section>
        <p class="heading_for_admin_section">Faq's Section</p>
        <div class="section_content">
            <form action="{{ route('faq.update', $faq) }}" method="POST" enctype="multipart/form-data"
                class="mt-4">
                @csrf
                @method('PUT')
                <div id="row-container">
                    <div class="row bottom_line">
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label"><strong>Question :</strong></label>
                                <input type="text" name="question" required value="{{$faq->question}}" class="form-control">
                            </div>
                            <div class="mb-2">
                                <label class="form-label"><strong>Answer :</strong></label>
                                <textarea class="form-control"  name="answer" >{{$faq->answer}}</textarea>
                            </div>        
                            <div class="mb-2">
                                <label class="form-label"><strong>Linked Page :</strong></label>
                                <select class="form-control" name="linked_page">
                                    <option value=""> Select Linked Page </option>
                                    <option value="home" {{ ($faq->page == "home") ? "selected": ''; }}> Home </option>
                                    <option value="sales" {{ ($faq->page == "buy") ? "selected": ''; }}> Buy </option>
                                    <option value="rent" {{ ($faq->page == "rent") ? "selected": ''; }}> Rent </option>
                                    <option value="private" {{ ($faq->page == "private") ? "selected": ''; }}> Private </option>
                                    <option value="investment" {{ ($faq->page == "investment") ? "selected": ''; }}> Investment </option>
                                    <option value="international" {{ ($faq->page == "international") ? "selected": ''; }}> International </option>
                                    <option value="project" {{ ($faq->page == "development") ? "selected": ''; }}> Development </option>
                                    <option value="branded" {{ ($faq->page == "branded") ? "selected": ''; }}> Branded Redidency </option>
                                    <option value="mortgage" {{ ($faq->page == "mortgage") ? "selected": ''; }}> Mortgage Calculator </option>
                                    <option value="report" {{ ($faq->page == "report") ? "selected": ''; }}> Report </option>
                                    <option value="career" {{ ($faq->page == "career") ? "selected": ''; }}> Career </option>
                                    <option value="communities" {{ ($faq->page == "communities") ? "selected": ''; }}> Communities </option>
                                    @php
                                    if (isset($blogs) && !empty($blogs)) {
                                        foreach ($blogs as $key => $value) {
                                            echo '<option ' . ($faq->page == $value->slug ? 'selected' : '') . ' value="' . $value->slug . '"> Blog : ' . $value->name . '</option>'; 
                                        }
                                    }
                                    @endphp                                      
                                </select>
                            </div>                        
                        </div>                        
                    </div>
                    <div class="btn-grp d-flex">
                    <button type="submit" class="green-btn">Update</button>
                    <a href="{{ route('faq.index') }}" class="border-btn">Back</a>
                </div>
                </div>
               
              
            </form>

        </div>
    </section>
@endsection
