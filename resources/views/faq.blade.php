        <section class="faq-sec  space bg-grey pr">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 mx-auto">
                        <div class="heading-pnel text-center">
                            <h2>Frequently Asked Questions</h2>
                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae</p>
                        </div>


                        <div class="accordion" id="accordionExample">
                            @php $count = 0;
                            $faqs = getFaqs('home');
                            @endphp
                            @if(isset($faqs) && !empty($faqs))
                            @foreach ($faqs as $key => $question)
                            @php $count = $count+1; @endphp
                                <div class="card">
                                    <div class="card-header" id="headingOne{{$count}}"> <a class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOne{{$count}}" aria-expanded="{{ ($count != 1) ? 'false':'true' }}" aria-controls="collapseOne{{$count}}"> {{$question->question}} </a> </div>
                                    <div id="collapseOne{{$count}}" class="collapse" aria-labelledby="headingOne{{$count}}" data-parent="#accordionExample">
                                        <div class="card-body"> {{$question->answer}} </div>
                                    </div>
                                </div>
                            @endforeach
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </section> 