@extends('admin.adminLayout')
@section('title', "Faq's Page")
@section('content')
    
    <section>
        <p class="heading_for_admin_section">Faq's Section <a class="add_new_button" href="{{ route('faq.create') }}">+ Add New</a></p>
        <div class="section_content container">
            <div class="row">
                <div class="col-12">
                        <div class="accordion" id="accordionExample">
                        @if(isset($faqs) && !empty($faqs))
                        @php $count = 0; @endphp
                        @foreach ($faqs as $key => $question)
                        @php $count = $count+1; @endphp
                          <div class="accordion-item">
                            <h2 class="accordion-header">
                                <a class="faq_edit_button" href="{{ route('faq.edit', $question) }}"><i class="fa-solid fa-pencil"></i> Edit</a>
                              <div class="accordion-button {{ ($count != 1) ? 'collapsed':'' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$key}}" aria-expanded="true" aria-controls="collapseOne{{$key}}">
                                {{ $count }}. {{ $question->question}}
                                    
                                    <form action="{{ route('faq.destroy', $question) }}" class="faq_delete_form" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="faq_delete_button" type="submit"><i class="fa-solid fa-trash"></i> Delete</button>
                                    </form>
                                    {!! !empty($question->page) ? "<span class='linked_page_title'>".$question->page."</span>" : ""  !!}
                              </div>
                            </h2>
                            <div id="collapseOne{{$key}}" class="accordion-collapse collapse {{ ($count == 1) ? 'show':'' }}" data-bs-parent="#accordionExample">
                              <div class="accordion-body custom_accordian_body">
                                    {{ $question->answer }}
                              </div>
                            </div>
                          </div>
                        @endforeach
                        @endif
                        </div>
                </div>
            </div>
        </div>
    </section>
@endsection
