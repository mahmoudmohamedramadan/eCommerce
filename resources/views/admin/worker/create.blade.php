@extends('layouts.admin')

@section('title', __('translate.create_worker'))

@push('script')
<script>
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

        $('#store_id').change(function() {
            if ($(this).val() != 0 && $('#worker_permission').val() == 0) {
                $('button[type=submit]').attr('disabled', true);
            } else {
                $('button[type=submit]').attr('disabled', false);
            }
        });

        $('#worker_permission').change(function() {
            if ($(this).val() != 0 && $('#store_id').val() == 0) {
                $('button[type=submit]').attr('disabled', true);
            } else if ($(this).val() == 0 && $('#store_id').val() != 0) {
                $('button[type=submit]').attr('disabled', true);
            } else {
                $('button[type=submit]').attr('disabled', false);
            }
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
                                <a href="{{ route('dashboard') }}">
                                    @lang('translate.dashboard')
                                </a>
                            </li>
                            <li class="breadcrumb-item active">@lang('translate.create_worker')</li>
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
                                <h4 class="card-title" id="basic-layout-form">@lang('translate.create_worker')
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
                                    <form action="{{ route('workers.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-body">
                                            <h4 class="form-section"><i
                                                    class="ft-home"></i>@lang('translate.worker_data')</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>@lang('translate.worker_name')</label>
                                                        <input type="text" value="{{ old('name') }}"
                                                            class="form-control"
                                                            placeholder="@lang('translate.worker_name_placeholder')"
                                                            name="name" minlength="3" maxlength="25">
                                                        @error('name')
                                                        <span class="text-danger">@lang('translate.'.$message)</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>@lang('translate.worker_age')</label>
                                                        <input type="text" value="{{ old('age') }}" class="form-control"
                                                            placeholder="@lang('translate.worker_age_placeholder')"
                                                            name="age" minlength="2" maxlength="2">
                                                        @error('age')
                                                        <span class="text-danger">@lang('translate.'.$message)</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>@lang('translate.national_id')</label>
                                                        <input type="text" value="{{ old('national_id') }}"
                                                            class="form-control"
                                                            placeholder="@lang('translate.national_id_placeholder')"
                                                            name="national_id" minlength="14" maxlength="14">
                                                        @error('national_id')
                                                        <span class="text-danger">@lang('translate.'.$message)</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>@lang('translate.worker_phone')</label>
                                                        <input type="text" value="{{ old('phone') }}"
                                                            class="form-control"
                                                            placeholder="@lang('translate.worker_phone_placeholder')"
                                                            name="phone" minlength="11" maxlength="11">
                                                        @error('phone')
                                                        <span class="text-danger">@lang('translate.'.$message)</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>@lang('translate.worker_address')</label>
                                                        <input type="text" value="{{ old('address') }}"
                                                            class="form-control"
                                                            placeholder="@lang('translate.worker_address_placeholder')"
                                                            name="address" minlength="3" maxlength="225">
                                                        @error('address')
                                                        <span class="text-danger">@lang('translate.'.$message)</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>@lang('translate.worker_salary')</label>
                                                        <input type="text" value="{{ old('salary') }}"
                                                            class="form-control"
                                                            placeholder="@lang('translate.worker_salary_placeholder')"
                                                            name="salary" minlength="2" maxlength="6">
                                                        @error('salary')
                                                        <span class="text-danger">@lang('translate.'.$message)</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>@lang('translate.worker_per')</label>
                                                        <select class="form-control" name="per">
                                                            <option value="1">Week</option>
                                                            <option value="2">Month</option>
                                                            <option value="3">Year</option>
                                                        </select>
                                                        @error('per')
                                                        <span class="text-danger">@lang('translate.'.$message)</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>@lang('translate.store_name')</label>
                                                        <select class="form-control" name="store_id" id="store_id">
                                                            <option value="0"></option>
                                                            @foreach ($stores as $store)
                                                            <option value="{{ $store->id }}">
                                                                {{ $store->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                        @error('store_id')
                                                        <span class="text-danger">@lang('translate.'.$message)</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>@lang('translate.worker_permission')</label><select
                                                            class="form-control" name="worker_permission"
                                                            id="worker_permission">
                                                            <option value="0"></option>
                                                            <option value="1">@lang('translate.manager')</option>
                                                            <option value="2">@lang('translate.worker')</option>
                                                        </select>
                                                        @error('worker_permission')
                                                        <span class="text-danger">@lang('translate.'.$message)</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>@lang('translate.worker_photo')</label>
                                                        <label id="projectinput7" class="file center-block">
                                                            <input type="file" id="imgInp" name="photo">
                                                            <span class="file-custom"></span>
                                                        </label>
                                                        @error('photo')
                                                        <div class="text-danger">@lang('translate.'.$message)</div>
                                                        @enderror
                                                        <div class="row-12 mt-2">
                                                            <img src="http://www.placehold.it/100/100"
                                                                alt="@lang('translate.worker_photo')" id="photo"
                                                                width="100" height="100">
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
