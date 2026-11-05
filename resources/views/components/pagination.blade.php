@if ($paginator->hasPages())
    <nav class="pagination" aria-label="Navigasi halaman">
        @if ($paginator->onFirstPage())
            <span class="page-link disabled"><x-icon name="chevron-left" size="16" /></span>
        @else
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"><x-icon name="chevron-left" size="16" /></a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="page-link disabled">{{ $element }}</span>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="page-link active">{{ $page }}</span>
                    @else
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"><x-icon name="chevron-right" size="16" /></a>
        @else
            <span class="page-link disabled"><x-icon name="chevron-right" size="16" /></span>
        @endif
    </nav>
@endif
