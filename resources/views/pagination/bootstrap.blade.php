@if ($paginator->hasPages())
    <nav aria-label="Page navigation" style="float: right">
        <ul class="pagination" style="font-family: math">
            {{-- Liên kết trang trước --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">&laquo; Trước</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo; Trước</a>
                </li>
            @endif

            {{-- Hiển thị các trang cụ thể --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Liên kết trang tiếp theo --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Tiếp &raquo;</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">Tiếp &raquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
