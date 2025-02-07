@extends('admin.adminLayout')
@section('title', "Faq's Create Page")
@section('content')
    
    <section>
        <p class="heading_for_admin_section">Faq Header </p>
        <div class="section_content">
        <form action="{{ route('faq.settings') }}" method="POST" enctype="multipart/form-data"
                class="mt-4">
                @csrf
                  <div class="mb-1">
                      <label class="form-label"><strong>Heading :</strong></label>
                      <input type="text" name="heading" required class="form-control" value="{{ getOption('faq_heading') }}">
                  </div>
                  <div class="mb-2">
                      <label class="form-label"><strong>Subheading :</strong></label>
                      <textarea class="form-control"  name="subheading">{!! getOption('faq_sub_heading'); !!}</textarea>
                  </div>
                  <button type="submit" class="green-btn">Save</button>
                </form>   
        </div>
    </section>

@endsection
