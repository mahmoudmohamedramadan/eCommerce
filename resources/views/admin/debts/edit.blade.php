@extends('layouts.admin')

@section('title', __('translate.edit_debt'))

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
                            <li class="breadcrumb-item active">@lang('translate.edit_debt')
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
                                <h4 class="card-title" id="basic-layout-form">@lang('translate.edit_debt')
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
                                    <form action="{{ route('debts.update', $debt->id) }}" method="POST">
                                        @csrf
                                        @method('patch')

                                        <div class="form-body">
                                            <h4 class="form-section"><i class="ft-home"></i>@lang('translate.debt_data')
                                            </h4>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="hidden" name="id" value="{{ $debt->id }}">
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>@lang('translate.debt_title')</label>
                                                        <input type="text" value="{{ $debt->title ?? old('title') }}"
                                                            class="form-control"
                                                            placeholder="@lang('translate.debt_title_placeholder')"
                                                            name="title">
                                                        @error('name')
                                                        <span class="text-danger">@lang('translate.'.$message)</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>@lang('translate.debt_details')</label>
                                                        <textarea value="{{ old('details') }}" class="form-control"
                                                            placeholder="@lang('translate.debt_details_placeholder')"
                                                            name="details" maxlength="255"
                                                            style="height: 100px;min-height: 100;max-height: 150">{{ $debt->details }}</textarea>
                                                        @error('details')
                                                        <span class="text-danger">@lang('translate.'.$message)</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>@lang('translate.pay_date')</label>
                                                        <input type="date"
                                                            value="{{ $debt->pay_date ?? old('pay_date') }}"
                                                            class="form-control" name="pay_date">
                                                        @error('pay_date')
                                                        <span class="text-danger">@lang('translate.'.$message)</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>@lang('translate.remember_date')</label>
                                                        <input type="date"
                                                            value="{{ $debt->remember_date ?? old('remember_date') }}"
                                                            class="form-control" name="remember_date">
                                                        @error('remember_date')
                                                        <span class="text-danger">@lang('translate.'.$message)</span>
                                                        @enderror
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
