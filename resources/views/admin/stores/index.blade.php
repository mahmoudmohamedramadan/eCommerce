@extends('layouts.admin')
<title>@lang('translate.stores') | eCommerce</title>

@push('script')
    <script>
        $(document).ready(function() {
            $('#tblData').DataTable();
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
                                <li class="breadcrumb-item active">@lang('translate.stores')</li>
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
                                    <h4 class="card-title">@lang('translate.stores')</h4>
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
                                                    <th>@lang('translate.store_name')</th>
                                                    <th>@lang('translate.store_phone')</th>
                                                    <th>@lang('translate.store_address')</th>
                                                    <th>@lang('translate.measures')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($stores as $store)
                                                    <tr>
                                                        <td>{{ $store->name }}</td>
                                                        <td>{{ $store->phone }}</td>
                                                        <td>{{ $store->address }}</td>
                                                        <td>
                                                            @include('admin.includes.formMeasures', ['editRouting' =>
                                                            'stores.edit', 'destroyRouting' =>
                                                            'stores.destroy','showWorkers' => 'stores.workers.index',
                                                            'showProducts' => 'stores.products.index',
                                                            'idValue' => $store->id])
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
