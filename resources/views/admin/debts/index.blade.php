@extends('layouts.admin')

@section('title', __('translate.debts'))

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
                            <li class="breadcrumb-item active">@lang('translate.debts')</li>
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
                                <h4 class="card-title">@lang('translate.debts')</h4>
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
                                                <th>@lang('translate.debt_title')</th>
                                                <th>@lang('translate.debt_details')</th>
                                                <th>@lang('translate.pay_date')</th>
                                                <th>@lang('translate.remember_date')</th>
                                                <th>@lang('translate.measures')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($debts as $debt)
                                            <tr>
                                                <td>{{ $debt->title }}</td>
                                                <td>{{ $debt->details }}</td>
                                                <td>{{ $debt->pay_date }}</td>
                                                <td>{{ $debt->remember_date }}</td>
                                                <td>
                                                    @include('admin.includes.formMeasures', ['editRouting' =>
                                                    'debts.edit', 'destroyRouting' => 'debts.destroy',
                                                    'idValue' => $debt->id])
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
