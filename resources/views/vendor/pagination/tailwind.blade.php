@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="font-montserrat">

        {{-- Mobile: Prev / Next only --}}
        <div class="flex gap-2 items-center justify-between sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="btn btn-sm btn-disabled">{{ __('pagination.previous') }}</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="btn btn-sm btn-outline">{{ __('pagination.previous') }}</a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="btn btn-sm btn-outline">{{ __('pagination.next') }}</a>
            @else
                <span class="btn btn-sm btn-disabled">{{ __('pagination.next') }}</span>
            @endif
        </div>

        {{-- Desktop: full pagination --}}
        <div class="hidden sm:flex sm:flex-col sm:items-center gap-3">

            {{-- Result summary --}}
            <p class="text-sm text-base-content/60">
                Menampilkan
                @if ($paginator->firstItem())
                    <span class="font-semibold text-base-content">{{ $paginator->firstItem() }}</span>
                    &ndash;
                    <span class="font-semibold text-base-content">{{ $paginator->lastItem() }}</span>
                @else
                    {{ $paginator->count() }}
                @endif
                dari
                <span class="font-semibold text-base-content">{{ $paginator->total() }}</span>
                hasil
            </p>

            {{-- Page buttons --}}
            <div class="join gap-2 rtl:join-reverse">

                {{-- Previous --}}
                @if ($paginator->onFirstPage())
                    <button class="join-item btn btn-sm btn-disabled rounded-sm" aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                    </button>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="join-item btn btn-sm btn-outline rounded-sm" aria-label="{{ __('pagination.previous') }}">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                    </a>
                @endif

                {{-- Page numbers --}}
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <button class="join-item btn btn-sm btn-disabled rounded-sm" aria-disabled="true">{{ $element }}</button>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <button class="join-item btn btn-sm btn-primary rounded-sm" aria-current="page" aria-disabled="true">{{ $page }}</button>
                            @else
                                <a href="{{ $url }}" class="join-item btn btn-sm btn-outline rounded-sm" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="join-item btn btn-sm btn-outline rounded-sm" aria-label="{{ __('pagination.next') }}">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                    </a>
                @else
                    <button class="join-item btn btn-sm btn-disabled rounded-sm" aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                    </button>
                @endif

            </div>
        </div>

    </nav>
@endif
