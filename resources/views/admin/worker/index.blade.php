@extends('layouts.admin')

@section('title', __('translate.workers'))

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
                                                <th>@lang('translate.worker_age')</th>
                                                <th>@lang('translate.worker_phone')</th>
                                                <th>@lang('translate.worker_address')</th>
                                                <th>@lang('translate.worker_salary')</th>
                                                <th>@lang('translate.worker_per')</th>
                                                <th>@lang('translate.store_name')</th>
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
                                                <td>{{ $worker->age }}</td>
                                                <td>{{ $worker->phone }}</td>
                                                <td>{{ $worker->address }}</td>
                                                <td>{{ $worker->salary }}</td>
                                                <td>
                                                    @if ($worker->per == 1)
                                                    Week
                                                    @elseif($worker->per == 2)
                                                    Month
                                                    @else
                                                    Year
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($worker->store_id != 0)
                                                    {{ $worker->store->name }}
                                                    @endif
                                                </td>
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
                                                    @include('admin.includes.formMeasures', ['editRouting' =>
                                                    'workers.edit', 'destroyRouting' => 'workers.destroy',
                                                    'idValue' => $worker->id])
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
