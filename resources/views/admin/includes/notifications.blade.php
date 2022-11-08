@foreach ($notifications as $notification)
    <div class="media" style="margin-bottom: 5px;background-color:@if($notification->read()) #FFF @else rgba(233, 229, 229, 0.836) @endif">
        <div class="media-left align-self-center">
            <i class="ft-plus-square icon-bg-circle bg-cyan"></i>
        </div>

        @if (array_key_exists('debt_id', $notification['data']))
            <div class="media-body">
                <a
                    href="{{ route('debts.show', ['debt' => $notification['data']['debt_id'], 'notification_id' => $notification->id]) }}">
                    <h6 class="media-heading">
                        @lang('translate.debt_title'): {{ $notification['data']['debt_title'] }}
                    </h6>
                </a>
            </div>
        @else
            <div class="media-body">
                <a
                    href="{{ route('products.show', ['product' => $notification['data']['product_id'], 'notification_id' => $notification->id]) }}">
                    <h6 class="media-heading">
                        @lang('translate.has_reached_its_minimum') {{ $notification['data']['product_title'] }}
                    </h6>
                </a>
            </div>
        @endif
    </div>
@endforeach
