@if ($paginator->hasPages())
    <style>
        .admin-pagination { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; padding: 14px 18px; border-top: 1px solid #e2e8f0; }
        .admin-pagination-info { color: #64748b; font-size: 12px; }
        .admin-pagination-pages { display: flex; align-items: center; gap: 4px; margin: 0; padding: 0; list-style: none; }
        .admin-pagination-link { display: inline-flex; min-width: 30px; min-height: 30px; align-items: center; justify-content: center; padding: 0 10px; border: 1px solid #e2e8f0; border-radius: 6px; background: #fff; color: #1e3a8a; font-size: 12px; font-weight: 600; text-decoration: none; }
        .admin-pagination-link:hover { border-color: #1e3a8a; background: #f1f5f9; color: #1e3a8a; }
        .admin-pagination-link.is-active { border-color: #1e3a8a; background: #1e3a8a; color: #fff; }
        .admin-pagination-link.is-disabled { border-color: #e2e8f0; background: #f8fafc; color: #cbd5e1; }
        @media (max-width: 600px) { .admin-pagination { justify-content: center; } }
    </style>
    @php
        $startPage = max(1, $paginator->currentPage() - 2);
        $endPage = min($paginator->lastPage(), $paginator->currentPage() + 2);
    @endphp
    <nav class="admin-pagination" aria-label="Pagination">
        <div class="admin-pagination-info">Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} results</div>
        <ul class="admin-pagination-pages">
            @if ($paginator->onFirstPage())
                <li><span class="admin-pagination-link is-disabled">&laquo; Prev</span></li>
            @else
                <li><a class="admin-pagination-link" href="{{ $paginator->previousPageUrl() }}">&laquo; Prev</a></li>
            @endif

            @if ($startPage > 1)
                <li><a class="admin-pagination-link" href="{{ $paginator->url(1) }}">1</a></li>
                @if ($startPage > 2)
                    <li><span class="admin-pagination-link is-disabled" aria-hidden="true">&hellip;</span></li>
                @endif
            @endif

            @foreach ($paginator->getUrlRange($startPage, $endPage) as $page => $url)
                <li>
                    @if ($page === $paginator->currentPage())
                        <span class="admin-pagination-link is-active" aria-current="page">{{ $page }}</span>
                    @else
                        <a class="admin-pagination-link" href="{{ $url }}">{{ $page }}</a>
                    @endif
                </li>
            @endforeach

            @if ($endPage < $paginator->lastPage())
                @if ($endPage < $paginator->lastPage() - 1)
                    <li><span class="admin-pagination-link is-disabled" aria-hidden="true">&hellip;</span></li>
                @endif
                <li><a class="admin-pagination-link" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>
            @endif

            @if ($paginator->hasMorePages())
                <li><a class="admin-pagination-link" href="{{ $paginator->nextPageUrl() }}">Next &raquo;</a></li>
            @else
                <li><span class="admin-pagination-link is-disabled">Next &raquo;</span></li>
            @endif
        </ul>
    </nav>
@endif