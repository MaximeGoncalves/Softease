@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="paginate_button page-item previous disabled"><span class="page-link">&lsaquo;</span></li>
        @else
            <li class="page-paginate_button"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&lsaquo;</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="paginate_button page-item active" style="background-color: red;"><a class="page-link">{{ $page }}</a></li>
                    @else
                        <li class="paginate_button page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="paginate_button page-item next"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">&rsaquo;</a></li>
        @else
            <li class="page-item disabled"><a class="page-link">&rsaquo;</a></li>
        @endif
    </ul>
@endif
