@props(['paginator'])

<div class="custom-pagination-wrapper">
    <div class="custom-pagination-info">
        @if ($paginator->count())
            Menampilkan {{ $paginator->firstItem() }} sampai {{ $paginator->lastItem() }} dari {{ $paginator->total() }} data
        @else
            Menampilkan 0 data
        @endif
    </div>

    @if ($paginator->hasPages())
        <div class="custom-pagination-nav">
            @if ($paginator->onFirstPage())
                <span class="custom-pagination-btn disabled">
                    <i class="bi bi-chevron-left"></i>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="custom-pagination-btn">
                    <i class="bi bi-chevron-left"></i>
                </a>
            @endif

            @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="custom-pagination-page active">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="custom-pagination-page">{{ $page }}</a>
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="custom-pagination-btn">
                    <i class="bi bi-chevron-right"></i>
                </a>
            @else
                <span class="custom-pagination-btn disabled">
                    <i class="bi bi-chevron-right"></i>
                </span>
            @endif
        </div>
    @endif
</div>