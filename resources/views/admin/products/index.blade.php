@extends('layouts.admin')

@section('title', __('translate.products'))

@push('script')
<script>
    $(document).ready(function() {
            $('#tblData').DataTable({
                "scrollX": true
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
                                                <th>@lang('translate.product_price')</th>
                                                <th>@lang('translate.store_name')</th>
                                                <th>@lang('translate.company_name')</th>
                                                <th>@lang('translate.total_quantity')</th>
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
                                                <td>{{ $product->price }}</td>
                                                <td>
                                                    @if ($product->store)
                                                    {{ $product->store->name }}
                                                    @endif
                                                </td>
                                                <td>{{ $product->company->name }}</td>
                                                <td>{{ $product->total_quantity }}</td>
                                                <td>{{ $product->used_quantity }}</td>
                                                <td>{{ $product->stored_quantity }}</td>
                                                <td>{{ $product->minimum_used }}</td>
                                                <td>{{ $product->minimum_stored }}</td>
                                                <td>
                                                    @if ($product->photo)
                                                    <img src="{{ asset('assets/images/product/' . $product->photo) }}"
                                                        alt="@lang('translate.product_photo')" width="90" height="90">
                                                    @else
                                                    <img src="http://www.placehold.it/100/100"
                                                        alt="@lang('translate.product_photo')" width="90" height="90">
                                                    @endif
                                                </td>
                                                <td>
                                                    @include('admin.includes.formMeasures', ['editRouting' =>
                                                    'products.edit', 'destroyRouting' => 'products.destroy',
                                                    'idValue' => $product->id])
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
@endsection
