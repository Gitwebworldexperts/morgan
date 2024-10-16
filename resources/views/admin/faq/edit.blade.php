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
                                <textarea class="form-control" required name="answer" >{{$faq->answer}}</textarea>
                            </div>        
                            <div class="mb-2">
                                <label class="form-label"><strong>Linked Page :</strong></label>
                                <select class="form-control" name="linked_page">
                                    <option value=""> Select Linked Page </option>
                                    <option value="home" {{ ($faq->page == "home") ? "selected": ''; }}> Home </option>
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
