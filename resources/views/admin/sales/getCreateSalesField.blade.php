<div class="row" id="{{ $id }}">
    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('translate.product_name')</label>
            <select class="form-control" name="product_name[]" onchange="changeOncePrice(this, {{ $id }})">
                @foreach ($products as $product)
                    <option value="{{ $product->name }}" product-price="{{ $product->price }}">
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
            @error('name')
                <span class="text-danger">@lang('translate.'.$message)</span>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('translate.quantity')</label>
            <input type="text" value="{{ old('quantity') }}" class="quantity-{{ $id }} form-control"
                placeholder="@lang('translate.quantity_placeholder')" name="quantity[]" maxlength="4"
                onkeyup="getTotalPrice({{ $id }})">
            <span class="quantity-error-{{ $id }} text-danger" hidden>@lang('translate.quantity_error')</span>
            @error('quantity')
                <span class="text-danger">@lang('translate.'.$message)</span>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('translate.once_price')</label>
            <input type="text" value="{{ $products[0]->price }}" class="once-price-{{ $id }} form-control"
                name="once_price[]" readonly>
            @error('once_price')
                <span class="text-danger">@lang('translate.'.$message)</span>
            @enderror
        </div>
    </div>

    @if ($id != 1)
        <div class="col-md-3">
            <div class="form-group">
                <button type="button" class="btn btn-danger mr-1" style="width: 225px;margin-top: 24px"
                    onclick="removeRowAndGetSum({{ $id }})">
                    <i class="la la-trash-o"></i> @lang('translate.delete')
                </button>
            </div>
        </div>
    @endif
</div>
