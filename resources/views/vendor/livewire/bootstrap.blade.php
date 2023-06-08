<div class="d-flex">
    <div class="mr-auto p-2">
        {{-- @if ($paginator->hasPages()) --}}
        @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ?
        $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ :
        $this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1)

        <nav class="ml-auto p-2">
            <ul class="pagination justify-content-left d-inline-flex ">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">Previous</span>
                </li>
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">First</span>
                </li>
                @else
                <li class="page-item">
                    <button type="button"
                            dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                            class="page-link" wire:click="previousPage('{{ $paginator->getPageName() }}')"
                            wire:loading.attr="disabled" rel="prev"
                            aria-label="@lang('pagination.previous')">Previous</button>
                </li>
                <li class="page-item">
                    <button type="button"
                            dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                            class="page-link" wire:click="gotoPage('{{ 1 }}')"
                            wire:loading.attr="disabled" rel="prev"
                            aria-label="@lang('pagination.previous')">First</button>
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
                <li class="page-item active"
                    wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page-{{ $page }}"
                    aria-current="page"><span class="page-link">{{ $page }}</span></li>
                @else
                <li class="page-item"
                    wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page-{{ $page }}">
                    <button type="button" class="page-link"
                            wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')">{{ $page }}</button>
                </li>
                @endif
                @endforeach
                @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                <li class="page-item">
                    <button type="button"
                            dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                            class="page-link" wire:click="nextPage('{{ $paginator->getPageName() }}')"
                            wire:loading.attr="disabled" rel="next"
                            aria-label="@lang('pagination.next')">Next</button>
                </li>
                <li class="page-item">
                    <button type="button"
                            dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                            class="page-link"
                            wire:click="gotoPage('{{ ceil($paginator->total()/$paginator->perPage() )}}')"
                            wire:loading.attr="disabled" rel="next"
                            aria-label="@lang('pagination.next')">Last</button>
                    {{-- {{ count($element)}} equal to ceil($paginator->total()/$paginator->perPage()--}}
                </li>
                @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">Next</span>
                </li>
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">Last</span>
                </li>
                @endif

            </ul>
        </nav>
    </div>

    <div class="mr-auto p-2 mt-3">
        <p class="text-sm text-gray-700 leading-5">
            <span>{!! __('Showing') !!}</span>
            <span class="font-medium">{{ $paginator->firstItem() }}</span>
            <span>{!! __('to') !!}</span>
            <span class="font-medium">{{ $paginator->lastItem() }}</span>
            <span>{!! __('of') !!}</span>
            <span class="font-medium">{{ $paginator->total() }}</span>
            <span>{!! __('results') !!}</span>
        </p>

    </div>
    
    <div class="p-2 d-flex">
        <div class="mr-auto p-2 mt-2">
            Results Per Page :
        </div>

        <div class="mr-auto p-2 mt-1">
            <select wire:model="resultPerPage" class="form-select form-select-sm"
                    aria-label=".form-select-sm example">
                <option wire:click="search" value="5">5</option>
                <option wire:click="search" value="10">10</option>
                <option wire:click="search" value="20">20</option>
                <option wire:click="search" value="30">30</option>
                <option wire:click="search" value="50">50</option>
                <option wire:click="search" value="100">100</option>
            </select>
        </div>
    </div>
</div>

{{-- @endif --}}