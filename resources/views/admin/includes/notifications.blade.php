@foreach ($notifications as $notification)
    <div class="media">
        <div class="media-left align-self-center">
            <i class="ft-plus-square icon-bg-circle bg-cyan"></i>
        </div>

        <div class="media-body">
            <a href="{{ route('debts.edit', $notification->id) }}">
                <h6 class="media-heading">
                    @lang('translate.debt_title'): {{ $notification->title }}
                </h6>
            </a>
        </div>
    </div>
@endforeach
