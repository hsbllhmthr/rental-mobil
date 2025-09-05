@if ($paginator->hasPages())
    <div class="pagination">
        {{-- Tombol Previous --}}
        @if ($paginator->onFirstPage())
            <a href="#" class="disabled">Previous</a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}">Previous</a>
        @endif

        {{-- Angka Halaman --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <a href="#" class="disabled">{{ $element }}</a>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a href="#" class="active">{{ $page }}</a>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Tombol Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}">Next</a>
        @else
            <a href="#" class="disabled">Next</a>
        @endif
    </div>
@endif