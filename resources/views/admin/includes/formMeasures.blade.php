<button type="button" class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1"
    onclick="location.href='{{ route($editRouting, $idValue) }}'">@lang('translate.edit')</button>
@if (request()->routeIs('stores.index'))
    <button type="button" class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1"
        onclick="location.href='{{ route($showWorkers, $idValue) }}'">
        @lang('translate.show_workers')
    </button>
@endif
<form action="{{ route($destroyRouting, $idValue) }}" method="POST">
    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">
        @lang('translate.delete')
    </button>
    @if (request()->routeIs('stores.index'))
        <button type="button" class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1"
            onclick="location.href='{{ route($showProducts, $idValue) }}'">
            @lang('translate.show_products')
        </button>
    @endif
</form>
