{{-- @if ($paginator->hasPages()) --}}
<nav class="d-flex justify-items-center justify-content-between">

    <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">

        <div>
            <ul class="pagination">


                {{-- First Page Link --}}
                @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;&lsaquo;</span>
                </li>
                @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url(1) }}" rel="prev"
                       aria-label="@lang('pagination.previous')">&lsaquo;&lsaquo;</a>
                </li>
                @endif


                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>
                @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                       aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
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
                <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                @else
                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
                @endforeach
                @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                       aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
                @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li>
                @endif


                {{-- Last Page Link --}}
                @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url(  $paginator->lastPage()) }}" rel="next"
                       aria-label="@lang('pagination.next')">&rsaquo;&rsaquo;</a>
                </li>
                @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&rsaquo;&rsaquo;</span>
                </li>
                @endif

            </ul>
        </div>
        <div>
            <p class="small text-muted">
                {!! __('Showing') !!}
                <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
                {!! __('to') !!}
                <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
                {!! __('of') !!}
                <span class="fw-semibold">{{ $paginator->total() }}</span>
                {!! __('results') !!}
            </p>
        </div>

        <div class="p-2 d-flex">
            <div class="mr-auto p-2 mt-2">
                <p class="small text-muted">Results Per Page :
            </div>

            <div class="mr-auto p-2 mt-1">
                <form action="{{route('loan.index')}}" method="post" id="myform">
                    @method('get')
                    <select class="form-select form-select-sm" name="perpage"
                            aria-label=".form-select-sm example"
                            onchange="document.getElementById('myform').submit(); ">


                        @if ($paginator->perPage()==1)
                        <option selected value="1">1</option>
                        @else
                        <option value="1">1</option>
                        @endif

                        @if ($paginator->perPage()==5)
                        <option selected value="5">5</option>
                        @else
                        <option value="5">5</option>
                        @endif

                        @if ($paginator->perPage()==10)
                        <option selected value="10">10</option>
                        @else
                        <option value="10">10</option>
                        @endif

                        @if ($paginator->perPage()==20)
                        <option selected value="20">20</option>
                        @else
                        <option value="20">20</option>
                        @endif

                        @if ($paginator->perPage()==30)
                        <option selected value="30">30</option>
                        @else
                        <option value="30">30</option>
                        @endif

                        @if ($paginator->perPage()==50)
                        <option selected value="50">50</option>
                        @else
                        <option value="50">50</option>
                        @endif

                        @if ($paginator->perPage()==10)
                        <option selected value="100">100</option>
                        @else
                        <option value="100">100</option>
                        @endif


                    </select>
                </form>

            </div>
        </div>

    </div>
</nav>
{{-- @endif --}}