@extends('layouts.admin')
<title>@lang('translate.companies') | eCommerce</title>

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
                                <li class="breadcrumb-item active">@lang('translate.companies')</li>
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
                                    <h4 class="card-title">@lang('translate.companies')</h4>
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
                                                    <th>@lang('translate.company_name')</th>
                                                    <th>@lang('translate.company_phone')</th>
                                                    <th>@lang('translate.company_address')</th>
                                                    <th>@lang('translate.company_manager')</th>
                                                    <th>@lang('translate.measures')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($companies as $company)
                                                    <tr>
                                                        <td>{{ $company->name }}</td>
                                                        <td>{{ $company->phone }}</td>
                                                        <td>{{ $company->address }}</td>
                                                        <td>{{ $company->manager }}</td>
                                                        <td>
                                                            @include('admin.includes.formMeasures', ['editRouting' =>
                                                            'companies.edit', 'destroyRouting' => 'companies.destroy',
                                                            'idValue' => $company->id])
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
