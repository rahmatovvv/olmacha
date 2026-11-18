@if ($paginator->hasPages())
    <nav class="pagination">
        @if ($paginator->onFirstPage())
            <span class="page-link is-disabled">Oldingi</span>
        @else
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Oldingi</a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="page-link is-disabled">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="page-link is-current">{{ $page }}</span>
                    @else
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Keyingi</a>
        @else
            <span class="page-link is-disabled">Keyingi</span>
        @endif
    </nav>
@endif
