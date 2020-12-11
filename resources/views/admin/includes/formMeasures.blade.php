<button class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1"
    onclick="location.href='{{ route($editRouting, $idValue) }}'">@lang('translate.edit')</button>
<form action="{{ route($destroyRouting, $idValue) }}" method="POST">
    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">
        @lang('translate.delete')
    </button>
</form>
