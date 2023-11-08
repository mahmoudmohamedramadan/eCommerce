@extends('layouts.admin')

@section('title', __('translate.edit_product'))

@push('script')
<script>
    $('input[name=total_quantity]').keyup(function() {
            //check if total quantity is valid number
            if (parseFloat($(this).val()) > 0) {
                $('button[type=submit]').prop('disabled', false);
                $('#total_quantity_error').attr('hidden', true);
            } else {
                $('button[type=submit]').prop('disabled', true);
                $('#total_quantity_error').attr('hidden', false);
            }
        });

        $('input[name=used_quantity]').focusout(function() {
            //check if stored quantity is valid number
            const totalInputValue = $('input[name=total_quantity]').val();
            const storedValue = parseFloat(totalInputValue) - parseFloat($(this).val());

            if ($(this).val() == '' || !$.isNumeric($(this).val())) {
                $('button[type=submit]').prop('disabled', true);
                $('#used-quantity-error').attr('hidden', false);
            } else if (storedValue > 0) {
                $('input[name=stored_quantity]').val(storedValue);
                $('button[type=submit]').prop('disabled', false);
                $('#stored_quantity_error').attr('hidden', true);
                $('#used_quantity_error').attr('hidden', true);
                $('#storeModal').modal('toggle');
            } else if (storedValue == 0) {
                $('input[name=stored_quantity]').val(storedValue);
                $('#store_field').empty();
            } else if (storedValue < 0) {
                $('button[type=submit]').prop('disabled', true);
                $('#stored_quantity_error').attr('hidden', false);
                $('#used_quantity_error').attr('hidden', false);
                $('#store_field').empty();
            }
        });

        $('#storeModal').on('hidden.bs.modal', function() {
            const storedValue = parseFloat($('input[name=stored_quantity]').val());
            const minmumValue = $('input[name=minimum_stored]').val();

            if ($('#store-id option:selected').text() == '') {
                $('button[type=submit]').attr('disabled', true);
            } else if (isNaN(minmumValue)) {
                $('button[type=submit]').attr('disabled', true);
            } else if (storedValue - minmumValue <= 0) {
                $('button[type=submit]').attr('disabled', true);
            } else {
                $('button[type=submit]').attr('disabled', false);
            }
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#photo').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function() {
            readURL(this);
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
                            <li class="breadcrumb-item"><a
                                    href="{{ route('dashboard') }}">@lang('translate.dashboard')</a>
                            </li>
                            <li class="breadcrumb-item active">@lang('translate.edit_product')
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
                                <h4 class="card-title" id="basic-layout-form">@lang('translate.edit_product')
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
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    @include('admin.products.getStoreModal', ['product' => $product,'stores' =>
                                    $stores])
                                    <form action="{{ route('products.update', $product->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('patch')

                                        <div class="form-body">
                                            <h4 class="form-section"><i
                                                    class="ft-home"></i>@lang('translate.product_data')
                                            </h4>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>@lang('translate.product_name')</label>
                                                        <input type="text" value="{{ $product->name ?? old('name') }}"
                                                            class="form-control"
                                                            placeholder="@lang('translate.Product_name_placeholder')"
                                                            name="name" minlength="3" maxlength="25">
                                                        @error('name')
                                                        <span class="text-danger">@lang('translate.'.$message)</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>@lang('translate.product_price')</label>
                                                        <input type="text" value="{{ $product->price ?? old('price') }}"
                                                            class="form-control"
                                                            placeholder="@lang('translate.product_price_placeholder')"
                                                            name="price" minlength="1" maxlength="6">
                                                        @error('price')
                                                        <span class="text-danger">@lang('translate.'.$message)</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>@lang('translate.total_quantity')</label>
                                                        <input type="text"
                                                            value="{{ $product->total_quantity ?? old('total_quantity') }}"
                                                            class="form-control"
                                                            placeholder="@lang('translate.total_quantity_placeholder')"
                                                            name="total_quantity" minlength="2" maxlength="6">
                                                        <span class="text-danger" id="total_quantity_error"
                                                            hidden>@lang('translate.total_quantity_error')</span>
                                                        @error('total_quantity')
                                                        <span class="text-danger">@lang('translate.'.$message)</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>@lang('translate.used_quantity')</label>
                                                        <input type="text"
                                                            value="{{ $product->used_quantity ?? old('used_quantity') }}"
                                                            class="form-control"
                                                            placeholder="@lang('translate.used_quantity_placeholder')"
                                                            name="used_quantity" minlength="2" maxlength="6">
                                                        <span class="text-danger" id="used_quantity_error"
                                                            hidden>@lang('translate.used_quantity_error')</span>
                                                        @error('used_quantity')
                                                        <span class="text-danger">@lang('translate.'.$message)</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>@lang('translate.stored_quantity')</label>
                                                        <input type="text"
                                                            value="{{ $product->stored_quantity ?? old('stored_quantity') }}"
                                                            class="form-control" name="stored_quantity" readonly>
                                                        <span class="text-danger" id="stored_quantity_error"
                                                            hidden>@lang('translate.stored_quantity_error')</span>
                                                        @error('stored_quantity')
                                                        <span class="text-danger">@lang('translate.'.$message)</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>@lang('translate.minimum_used')</label>
                                                        <input type="text"
                                                            value="{{ $product->minimum_used ?? old('minimum_used') }}"
                                                            class="form-control"
                                                            placeholder="@lang('translate.minimum_used_placeholder')"
                                                            name="minimum_used" minlength="2" maxlength="6">
                                                        @error('minimum_used')
                                                        <span class="text-danger">@lang('translate.'.$message)</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group" id="company_field">
                                                        <label for="Select2">@lang('translate.company_name')</label>
                                                        <select class="form-control" id="Select2" name="company_id">
                                                            @foreach ($companies as $company)
                                                            <option value="{{ $company->id }}" @if ($product->company_id
                                                                == $company->id)
                                                                selected
                                                                @endif>
                                                                {{ $company->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                        @error('company_id')
                                                        <span class="text-danger">@lang('translate.'.$message)</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>@lang('translate.product_photo')</label>
                                                        <label id="projectinput7" class="file center-block">
                                                            <input type="file" id="imgInp" name="photo">
                                                            <span class="file-custom"></span>
                                                        </label>
                                                        @error('photo')
                                                        <span class="text-danger">@lang('translate.'.$message)</span>
                                                        @enderror
                                                        <div class="row-12 mt-2">
                                                            @if ($product->photo)
                                                            <img src="{{ asset('storage/images/products/' . $product->photo) }}"
                                                                alt="@lang('translate.product_photo')" id="photo"
                                                                width="100" height="100">
                                                            @else
                                                            <img src="{{ asset('http://www.placehold.it/100/100') }}"
                                                                alt="@lang('translate.product_photo')" id="photo"
                                                                width="100" height="100">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                    onclick="history.back();">
                                                    <i class="ft-x"></i> @lang('translate.cancel')
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> @lang('translate.edit')
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
