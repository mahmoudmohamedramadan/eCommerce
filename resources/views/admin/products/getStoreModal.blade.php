<script src="{{ asset('jquery/jquery.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#modalForm').on('submit', function(e) {
            var formDataValue = new FormData($(this)[0]);
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: $(this).attr('action'),
                dataType: 'json',
                processData: false,
                contentType: false,
                cache: false,
                data: formDataValue,
                success: function(data) {
                    if (!data.success) {
                        $('#error-store-msg').empty().html(data.error_store_msg);
                        $('#error-min-msg').empty().html(data.error_min_msg);
                    } else {
                        $('#error-store-msg').empty();
                        $('#error-min-msg').empty();
                        $('#storeModal').modal('toggle');
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    });

</script>

<div class="modal" tabindex="-1" id="storeModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('translate.product_data')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('getModalValue') }}" method="POST" id="modalForm">
                    @csrf

                    <div class="form-group">
                        <label>@lang('translate.store_id')</label>
                        <select class="form-control" name="store_id" id="store-id">
                            @foreach ($stores as $store)
                            <option value="{{ $store->id }}" @if (isset($product)) @if ($product->store_id ==
                                $store->id)selected
                                @endif
                                @endif>
                                {{ $store->name }}
                            </option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="error-store-msg"></span>
                    </div>

                    <div class="form-group">
                        <label>@lang('translate.minimum_stored')</label>
                        <input type="text" value="{{ $product->minimum_stored ?? session()->get('minimum_stored') }}"
                            class="form-control" placeholder="@lang('translate.minimum_stored_placeholder')"
                            name="minimum_stored" minlength="1" maxlength="6">
                        <span class="text-danger" id="error-min-msg"></span>
                    </div>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <i class="ft-x"></i> @lang('translate.cancel')
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="la la-check-square-o"></i> @lang('translate.save')
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
