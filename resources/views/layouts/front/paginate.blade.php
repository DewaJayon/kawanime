@if ($paginator->hasPages())
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <a aria-disabled="true"><i class="fa fa-angle-double-left"></i></a>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fa fa-angle-double-left"></i></a>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <a class="current-page" aria-current="page">{{ $page }}</a>
                @else
                    <a href="{{ $url }}" class="rounded" aria-current="page">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}"rel="next"><i class="fa fa-angle-double-right"></i></a>
    @else
        <a aria-disabled="true"><i class="fa fa-angle-double-right"></i></a>
    @endif
@endif
