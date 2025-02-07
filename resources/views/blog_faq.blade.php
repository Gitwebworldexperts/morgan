@php $count = 0;
    if(isset($page_name) && $page_name == "mortgage"){
        $faqs = getFaqs($page_name);
    }else{
        $faqs = getFaqs();
    }
@endphp
@if(isset($faqs) && !empty($faqs))
<div class="blog-faqs">
                                <h4 class="text-left">{{ getOption('faq_heading') }}</h4>
                                <div class="accordion" id="accordionExample">
                                

                            @foreach ($faqs as $key => $question)
                            @if('blogs/view/'.$question->page == request()->path())
                                    @php $count = $count+1; @endphp
                                <div class="card">
                                    <div class="card-header" id="headingOne{{$count}}"> <a class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOne{{$count}}" aria-expanded="{{ ($count != 1) ? 'false':'true' }}" aria-controls="collapseOne{{$count}}"> {{$question->question}} </a> </div>
                                    <div id="collapseOne{{$count}}" class="collapse" aria-labelledby="headingOne{{$count}}" data-parent="#accordionExample">
                                        <div class="card-body"> {!! $question->answer !!} </div>
                                    </div>
                                </div>
                                @elseif(isset($page_name) && $page_name == "mortgage")
                                    @php $count = $count+1; @endphp
                                <div class="card">
                                    <div class="card-header" id="headingOne{{$count}}"> <a class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOne{{$count}}" aria-expanded="{{ ($count != 1) ? 'false':'true' }}" aria-controls="collapseOne{{$count}}"> {{$question->question}} </a> </div>
                                    <div id="collapseOne{{$count}}" class="collapse" aria-labelledby="headingOne{{$count}}" data-parent="#accordionExample">
                                        <div class="card-body"> {!! $question->answer !!} </div>
                                    </div>
                                </div>

                                @endif
                            
                                @endforeach

                            




                                </div>
                       
								
							</div>
                            @endif