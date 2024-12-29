<ul class="pagination pagination-rounded">
    <li class="paginate_button page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
        <a href="{{ $paginator->previousPageUrl() }}" class="page-link">
            <i class="mdi mdi-chevron-left"></i>
        </a>
    </li>
    @foreach ($elements as $element)
        @if (is_string($element))
            <li class="paginate_button page-item disabled"><span class="page-link">{{ $element }}</span></li>
        @endif
        @if (is_array($element))
            @foreach ($element as $page => $url)
                <li class="paginate_button page-item {{ $page == $paginator->currentPage() ? 'active' : '' }}">
                    <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                </li>
            @endforeach
        @endif
    @endforeach
    <li class="paginate_button page-item {{ $paginator->hasMorePages() ? '' : 'disabled' }}">
        <a href="{{ $paginator->nextPageUrl() }}" class="page-link">
            <i class="mdi mdi-chevron-right"></i>
        </a>
    </li>
</ul>
