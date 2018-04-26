@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            {{--<li class="paginate_button page-item previous disabled"><span class="pagination-link"><i class="fas fa-angle-double-left"></i> Précédent</span></li>--}}
        @else
            <li class="page-paginate_button"><a class="pagination-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fas fa-angle-double-left"></i> Précédent</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled"><span class="pagination-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="paginate_button page-item active" style="background-color: red;"><a class="pagination-link">{{ $page }}</a></li>
                    @else
                        <li class="paginate_button page-item"><a class="pagination-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="paginate_button page-item next"><a class="pagination-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Suivant <i class="fas fa-angle-double-right"></i></a></li>
        @else
            {{--<li class="page-item disabled"><a class="pagination-link">Suivant <i class="fas fa-angle-double-right"></i> </a></li>--}}
        @endif
    </ul>
@endif
