@if ($paginator->hasPages())

    <ul>
        {{-- First Page Link --}}
        @if ($paginator->currentPage() > 1)
            <li>
                <span><a href="{{ $paginator->url(1) }}">首页</a></span>
            </li>
        @endif
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li>
                <span><a href="javascript:;" disabled>上一页</a></span>
            </li>
        @else
            <li>
                <span><a href="{{ $paginator->previousPageUrl() }}">上一页</a></span>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li>
                            <a href="{{ $url }}" class="active" >{{ $page }}</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li>
                <span><a href="{{ $paginator->nextPageUrl() }}">下一页</a></span>
            </li>
        @else
            <li>
                <span><a href="javascript:;" disabled>下一页</a></span>
            </li>
        @endif
        {{-- Last Page Link --}}
            <li>
                <span><a href="{{ $paginator->url($paginator->lastPage())}}">尾页</a></span>
            </li>
    </ul>
@endif
