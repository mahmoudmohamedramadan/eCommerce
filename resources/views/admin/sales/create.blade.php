@extends('layouts.admin')

@section('title', __('translate.create_sale'))

@push('script')
<script>
    function getTotalPrice() {
             var totalPriceValue = 0;
             var divRowCount = document.getElementsByClassName('sale-fields');
             for (var i = 0; i <= divRowCount.length - 1; i++) {
                 var currentRowId = divRowCount[i].getAttribute('id');
                 var quantityValue = parseFloat($(`.quantity-${currentRowId}`).val());
                 if (quantityValue > 0 && !isNaN(quantityValue)) {
                     var oncePriceValue = parseFloat($(`.once-price-${currentRowId}`).val());
                     totalPriceValue += quantityValue * oncePriceValue;
                     $('input[name=total_price]').val(totalPriceValue);
                     $('button[type=submit]').prop('disabled', false);
                     $(`.quantity-error-${currentRowId}`).attr('hidden', true);
                 } else {
                     $('button[type=submit]').prop('disabled', true);
                     $(`.quantity-error-${currentRowId}`).attr('hidden', false);
                 }
             }
         }

         function checkProductQuanity(Id) {
             var totalQuantity = 0;
             var divRowCount = document.getElementsByClassName('sale-fields');
             for (var i = 1; i <= divRowCount.length; i++) {
                 if ($(`.product-name-${i} option:selected`).val() == $(`.product-name-${Id} option:selected`)
                     .val()) {
                     totalQuantity += parseFloat($(`.quantity-${i}`).val());
                 }
             }

             $.ajax({
                 type: 'get',
                 url: '{{ route("checkProductQuantity") }}',
                 dataType: 'json',
                 data: {
                     'product_name': $(`.product-name-${Id} option:selected`).val(),
                     'quantity': totalQuantity,
                 },
                 success: function(data) {
                     if (!data.success) {
                         $('.sale-field-error').attr('hidden', false);
                         $('.sale-field-error').text(data.message);
                         $('button[type=submit]').prop('disabled', true);
                         setInterval(() => {
                             $('.sale-field-error').attr('hidden', true);
                         }, 10000);
                     } else {
                         $('button[type=submit]').prop('disabled', false);
                     }
                 },
                 error: function(data) {
                     console.log(data);
                 }
             });
         }

         function changeOncePrice(selectTag, rowCount) {
             var product_price = $('option:selected', selectTag).attr('product-price');
             $(`.once-price-${rowCount}`).val(product_price);
             getTotalPrice();
         }

         function removeRowAndGetSum(rowCount) {
             $(`#${rowCount}`).remove();
             getTotalPrice();
         }

         $('#add-product').click(function() {
             $.ajax({
                 type: 'get',
                 url: $(this).attr('buttonRoute'),
                 dataType: 'json',
                 data: {
                     'rowCount': parseInt($('#new-product').children().last().attr('id')) + 1
                 },
                 success: function(data) {
                     $('#new-product').append(data.salesFieldsView);
                 },
                 error: function(data) {
                     console.log(data);
                 }
             });
         });

         $('form').submit(function(e) {
             var formData = new FormData($(this)[0]);
             e.preventDefault();
             $.ajax({
                 type: 'post',
                 url: $(this).attr('action'),
                 dataType: 'json',
                 processData: false,
                 contentType: false,
                 cache: false,
                 data: formData,
                 success: function() {
                     window.location.reload(true);
                 },
                 error: function(data) {
                     console.log(data);
                 }
             });
         });

</script>
@endpush

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">@lang('translate.dashboard')</a>
                            </li>
                            <li class="breadcrumb-item active">@lang('translate.create_sale')
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form">@lang('translate.create_sale')
                                </h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            @include('admin.includes.alerts.success')
                            @include('admin.includes.alerts.errors')
                            <div class="row mr-3 ml-3">
                                <div class="col-md-12">
                                    <div class="sale-field-error alert alert-danger text-center mb-3" hidden></div>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <form action="{{ route('sales.store') }}" method="POST">
                                        @csrf

                                        <div class="form-body">
                                            <h4 class="form-section"><i class="ft-home"></i>@lang('translate.sale_data')
                                            </h4>
                                            <div id="new-product">
                                                @if (count($products) > 0)
                                                @include('admin.sales.getCreateSalesField',
                                                ['products' => $products, 'id' => 1])
                                                @else
                                                <div class="row mr-3 ml-3">
                                                    <div class="col-md-12">
                                                        <div class="alert alert-danger text-center">
                                                            @lang('translate.add_product_first')</div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>

                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label>@lang('translate.total_price')</label>
                                                        <input type="text" value="{{ old('total_price') }}"
                                                            class="form-control" name="total_price" readonly>
                                                        <span class="text-danger" id="total-price-error"
                                                            hidden>@lang('translate.total_price_error')</span>
                                                        @error('total_price')
                                                        <span class="text-danger">@lang('translate.'.$message)</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <button type="button" class="btn btn-secondary"
                                                        style="margin-top: 25px;width:310px" id="add-product"
                                                        buttonRoute="{{ route('getSalesField') }}" @if (count($products)
                                                        < 1) disabled @endif>
                                                        <i class="la la-cart-plus"></i> @lang('translate.add_product')
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                    onclick="history.back();">
                                                    <i class="ft-x"></i> @lang('translate.cancel')
                                                </button>
                                                <button type="submit" class="btn btn-primary" @if (count($products) < 1)
                                                    disabled @endif>
                                                    <i class="la la-check-square-o"></i> @lang('translate.save')
                                                </button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection
