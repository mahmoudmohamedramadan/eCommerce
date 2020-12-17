@foreach ($notifications as $notification)
    <div class="media">
        <div class="media-left align-self-center">
            <i class="ft-plus-square icon-bg-circle bg-cyan"></i>
        </div>

        <div class="media-body">
            <a
                href="{{ route('debts.show', ['debt' => $notification['data']['id'], 'notification_id' => $notification->id]) }}">
                <h6 class="media-heading">
                    @lang('translate.debt_title'): {{ $notification['data']['title'] }}
                </h6>
            </a>
        </div>
    </div>
@endforeach
