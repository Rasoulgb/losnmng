<nav aria-label="Page navigation example">
    @if ($paginator->hasPages())
    <ul class="pagination justify-content-center">
        @if ($paginator->onFirstPage())
        <li class="page-item disabled">
            <a class="page-link" tabindex="-1" aria-disabled="true">Previous</a>
        </li>
        @else
        <li class="page-item ">
            <a wire:click="previousPage" wire:loading.attr="disabled" rel="prev"  class="page-link"
               tabindex="-1" href="">Previous</a>
        </li>
        @endif
        {{-- <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li> --}}

        @if ($paginator->hasMorePages())
        <li class="page-item">
            <a wire:click="nextPage" wire:loading.attr="disabled" rel="next" href="" class="page-link">Next</a>
        </li>
        @else
        <li class="page-item disabled">

            <a class="page-link" tabindex="-1" aria-disabled="true">Next</a>
        </li>
        @endif
    </ul>
    @endif
</nav>