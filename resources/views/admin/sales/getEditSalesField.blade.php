@php
$product_name = explode("\n", $sale->product_name);
$quantity = explode("\n", $sale->quantity);
$once_price = explode("\n", $sale->once_price);
@endphp

@for ($i = 0; $i < count($product_name); $i++) <div class="sale-fields row" id="{{ $i+1 }}">
    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('translate.product_name')</label>
            <select class="form-control" name="product_name[]" onchange="changeOncePrice(this, {{ $i+1 }})">
                @foreach ($products as $product)
                <option value="{{ $product->name }}" product-price="{{ $product->price }}" @if ($product->name ==
                    $product_name[$i]) selected @endif>
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
            <input type="text" value="{{ $quantity[$i] ?? old('quantity') }}" class="quantity-{{ $i+1 }} form-control"
                placeholder="@lang('translate.quantity_placeholder')" name="quantity[]" maxlength="4"
                onkeyup="getTotalPrice({{ $i+1 }})">
            <span class="quantity-error-{{ $i+1 }} text-danger" hidden>@lang('translate.quantity_error')</span>
            @error('quantity')
            <span class="text-danger">@lang('translate.'.$message)</span>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('translate.once_price')</label>
            <input type="text" value="{{ $once_price[$i] ?? $products[0]->price }}"
                class="once-price-{{ $i+1 }} form-control" name="once_price[]" readonly>
            @error('once_price')
            <span class="text-danger">@lang('translate.'.$message)</span>
            @enderror
        </div>
    </div>
    </div>
    @endfor
