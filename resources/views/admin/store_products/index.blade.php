@extends('layouts.admin')

@section('title', __('translate.products'))

@push('script')
<script>
    $(document).ready(function() {
            $('#tblData').DataTable({
                'scrollX': true
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
                            <li class="breadcrumb-item"><a
                                    href="{{ route('dashboard') }}">@lang('translate.dashboard')</a>
                            </li>
                            <li class="breadcrumb-item active">@lang('translate.products')</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="dom">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">@lang('translate.products')</h4>
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
                                <div class="card-body card-dashboard">
                                    <table id="tblData">
                                        <thead>
                                            <tr>
                                                <th>@lang('translate.product_name')</th>
                                                <th>@lang('translate.used_quantity')</th>
                                                <th>@lang('translate.stored_quantity')</th>
                                                <th>@lang('translate.minimum_used')</th>
                                                <th>@lang('translate.minimum_stored')</th>
                                                <th>@lang('translate.product_photo')</th>
                                                <th>@lang('translate.measures')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->used_quantity }}</td>
                                                <td>{{ $product->stored_quantity }}</td>
                                                <td>{{ $product->minimum_used }}</td>
                                                <td>{{ $product->minimum_stored }}</td>
                                                <td>
                                                    @if ($product->photo)
                                                    <img src="{{ asset('assets/images/product/' . $product->photo) }}"
                                                        alt="@lang('translate.products_photo')" width="90" height="90">
                                                    @else
                                                    <img src="http://www.placehold.it/100/100"
                                                        alt="@lang('translate.products_photo')" width="90" height="90">
                                                    @endif
                                                </td>
                                                <td>
                                                    <button type="button"
                                                        class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1"
                                                        data-toggle="modal" data-target="#productModal"
                                                        onclick="document.getElementById('formModal').action = `{{ route('stores.products.update', ['store' => $store_id, 'product' => $product->id]) }}`;document.getElementsByName('stored_quantity')[0].setAttribute('old-stored-quantity', {{ $product->stored_quantity }})">
                                                        @lang('translate.edit')
                                                    </button>
                                                    <form
                                                        action="{{ route('stores.products.destroy', ['store' => $store_id, 'product' => $product->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit"
                                                            class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">
                                                            @lang('translate.delete')
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<div class="row">
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">@lang('translate.edit_confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" id="formModal">
                    @csrf
                    @method('patch')

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>@lang('translate.stored_quantity')</label>
                                    <input type="text" value="" class="form-control"
                                        placeholder="@lang('translate.stored_quantity_placeholder')"
                                        name="stored_quantity" minlength="1" maxlength="6" old-stored-quantity="">
                                    <span class="stored-quantity-error-msg text-danger"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>@lang('translate.minimum_stored')</label>
                                    <input type="text" value="" class="form-control"
                                        placeholder="@lang('translate.minimum_stored_placeholder')"
                                        name="minimum_stored" minlength="1" maxlength="6" disabled>
                                    <span class="minimum-stored-error-msg text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning mr-1" data-dismiss="modal">
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
@endsection

@push('script')
<script>
    $('input[name=stored_quantity]').keyup(function() {
            if ($(this).val() == '') {
                $('input[name=minimum_stored]').attr('disabled', true);
            } else {
                $('input[name=minimum_stored]').attr('disabled', false);
            }

            $.ajax({
                type: 'get',
                url: `{{ route('stores.products.checkQuantity') }}`,
                dataType: 'json',
                data: {
                    'old_stored_quantity': $(this).attr('old-stored-quantity'),
                    'new_stored_quantity': $(this).val()
                },
                success: function(data) {
                    if (!data.success) {
                        $('.stored-quantity-error-msg').empty().html(data.error_stored_msg);
                        $('button[type=submit]').attr('disabled', true);
                    } else {
                        $('.stored-quantity-error-msg').empty();
                        $('button[type=submit]').attr('disabled', false);
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });

        $('input[name=minimum_stored]').keyup(function() {
            $.ajax({
                type: 'get',
                url: `{{ route('stores.products.checkQuantity') }}`,
                dataType: 'json',
                data: {
                    'new_stored_quantity': $('input[name=stored_quantity]').val(),
                    'new_minimum_stored': $(this).val()
                },
                success: function(data) {
                    if (!data.success) {
                        $('.minimum-stored-error-msg').empty().html(data.error_stored_msg);
                        $('button[type=submit]').attr('disabled', true);
                    } else {
                        $('.minimum-stored-error-msg').empty();
                        $('button[type=submit]').attr('disabled', false);
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });

</script>
@endpush
