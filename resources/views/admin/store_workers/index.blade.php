@extends('layouts.admin')

@section('title', __('translate.workers'))

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
                            <li class="breadcrumb-item active">@lang('translate.workers')</li>
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
                                <h4 class="card-title">@lang('translate.workers')</h4>
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
                                                <th>@lang('translate.worker_name')</th>
                                                <th>@lang('translate.national_id')</th>
                                                <th>@lang('translate.worker_phone')</th>
                                                <th>@lang('translate.worker_permission')</th>
                                                <th>@lang('translate.worker_photo')</th>
                                                <th>@lang('translate.measures')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($workers as $worker)
                                            <tr>
                                                <td>{{ $worker->name }}</td>
                                                <td>{{ $worker->national_id }}</td>
                                                <td>{{ $worker->phone }}</td>
                                                <td>
                                                    @if ($worker->worker_permission == 1)
                                                    Manager
                                                    @elseif ($worker->worker_permission == 2)
                                                    Worker
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($worker->photo)
                                                    <img src="{{ asset('assets/images/worker/' . $worker->photo) }}"
                                                        alt="@lang('translate.worker_photo')" width="90" height="90">
                                                    @else
                                                    <img src="http://www.placehold.it/100/100"
                                                        alt="@lang('translate.worker_photo')" width="90" height="90">
                                                    @endif
                                                </td>
                                                <td>
                                                    <button type="button"
                                                        class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1"
                                                        data-toggle="modal" data-target="#workerModal"
                                                        onclick="document.getElementById('formModal').action = `{{ route('stores.workers.update', ['store' => $store_id, 'worker' => $worker->id]) }}`">
                                                        @lang('translate.move')
                                                    </button>
                                                    <form
                                                        action="{{ route('stores.workers.destroy', ['store' => $store_id, 'worker' => $worker->id]) }}"
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
    <div class="modal fade" id="workerModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">@lang('translate.move_confirmation')</h5>
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
                                    <label for="Select2">@lang('translate.store_name')</label>
                                    <select class="form-control" name="store_id">
                                        <option value="0"></option>
                                        @foreach ($stores as $store)
                                        <option value="{{ $store->id }}" @if ($store->id == $store_id) disabled
                                            @endif>
                                            {{ $store->name }}
                                        </option>
                                        @endforeach
                                    </select>
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
