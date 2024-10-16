<!-- if ($paginator->hasMorePages()) -->
<div class="pagination-main">
    <div class="row">
        <div class="col-12">
            <div class="pagination-container">
                <ul>
                    @if ($paginator->onFirstPage())
                        <li class="prev disabled"><span>Prev</span></li>
                    @else
                        <li class="prev"><a href="{{ $paginator->previousPageUrl() }}">Prev</a></li>
                    @endif

                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <!-- Three Dots Separator -->
                            <li class="disabled"><span>{{ $element }}</span></li>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="active"><span>{{ $page }}</span></li>
                                @else
                                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    @if ($paginator->hasMorePages())
                        <li class="next"><a href="{{ $paginator->nextPageUrl() }}">Next</a></li>
                    @else
                        <li class="next disabled"><span>Next</span></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- endif -->
