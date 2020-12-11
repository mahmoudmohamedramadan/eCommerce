@extends('layouts.admin')
<title>@lang('translate.edit_company') | eCommerce</title>

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
                                <li class="breadcrumb-item active">@lang('translate.edit_company')
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
                                    <h4 class="card-title" id="basic-layout-form">@lang('translate.edit_company')
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
                                        <form action="{{ route('companies.update', $company->id) }}" method="POST">
                                            @csrf
                                            @method('put')

                                            <div class="form-body">
                                                <h4 class="form-section"><i
                                                        class="ft-home"></i>@lang('translate.company_data')</h4>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <input type="hidden" name="id" value="{{ $company->id }}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label
                                                                for="projectinput1">@lang('translate.company_name')</label>
                                                            <input type="text" value="{{ $company->name ?? old('name') }}"
                                                                class="form-control"
                                                                placeholder="@lang('translate.company_name_placeholder')"
                                                                name="name">
                                                            @error('name')
                                                                <span class="text-danger">@lang('translate.'.$message)</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label
                                                                for="projectinput1">@lang('translate.company_phone')</label>
                                                            <input type="text" value="{{ $company->phone ?? old('phone') }}"
                                                                class="form-control"
                                                                placeholder="@lang('translate.company_phone_placeholder')"
                                                                name="phone" maxlength="11">
                                                            @error('phone')
                                                                <span class="text-danger">@lang('translate.'.$message)</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>


                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label
                                                                for="projectinput1">@lang('translate.company_address')</label>
                                                            <input type="text"
                                                                value="{{ $company->address ?? old('address') }}"
                                                                class="form-control"
                                                                placeholder="@lang('translate.company_address_placeholder')"
                                                                name="address">
                                                            @error('address')
                                                                <span class="text-danger">@lang('translate.'.$message)</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label
                                                                for="projectinput1">@lang('translate.company_manager')</label>
                                                            <input type="text"
                                                                value="{{ $company->manager ?? old('manager') }}"
                                                                class="form-control"
                                                                placeholder="@lang('translate.company_manager_placeholder')"
                                                                name="manager">
                                                            @error('manager')
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
