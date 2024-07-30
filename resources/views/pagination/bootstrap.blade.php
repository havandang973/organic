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

            {{-- Các phần tử phân trang --}}
            @foreach ($elements as $element)
                {{-- Dấu ba chấm --}}
                @if (is_string($element))
                    <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Mảng các liên kết --}}
                @if (is_array($element))
                    @php
                        $firstPage = 1;
                        $lastPage = $paginator->lastPage();
                        $currentPage = $paginator->currentPage();
                        $pageWindow = 2; // Số trang muốn hiển thị xung quanh trang hiện tại
                    @endphp

                    {{-- Hiển thị trang đầu tiên và "..." nếu cần --}}
                    @if ($currentPage > $pageWindow + 1)
                        <li class="page-item"><a class="page-link" href="{{ $paginator->url($firstPage) }}">{{ $firstPage }}</a></li>
                        @if ($currentPage > $pageWindow + 2)
                            <li class="page-item disabled"><span class="page-link">...</span></li>
                        @endif
                    @endif

                    {{-- Hiển thị trang xung quanh trang hiện tại --}}
                    @foreach (range(max($firstPage, $currentPage - $pageWindow), min($lastPage, $currentPage + $pageWindow)) as $page)
                        @if ($page == $currentPage)
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $paginator->url($page) }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    {{-- Hiển thị trang cuối cùng và "..." nếu cần --}}
                    @if ($currentPage < $lastPage - $pageWindow)
                        @if ($currentPage < $lastPage - $pageWindow - 1)
                            <li class="page-item disabled"><span class="page-link">...</span></li>
                        @endif
                        <li class="page-item"><a class="page-link" href="{{ $paginator->url($lastPage) }}">{{ $lastPage }}</a></li>
                    @endif
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
