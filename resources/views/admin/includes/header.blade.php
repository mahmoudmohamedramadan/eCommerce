<nav
    class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light bg-primary navbar-shadow float-right">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto">
                    <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                            class="ft-menu font-large-1"></i></a>
                </li>

                <li class="nav-item">
                    <a class="navbar-brand" href="{{ route('dashboard') }}">
                        <img class="brand-logo" alt="modern admin logo"
                            src="{{ asset('assets/admin/images/logo/logo.png') }}">
                        <h3 class="brand-text">@lang('translate.admin_panel')</h3>
                    </a>
                </li>

                <li class="nav-item d-md-none">
                    <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i
                            class="la la-ellipsis-v"></i></a>
                </li>
            </ul>
        </div>

        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                            href="#"><i class="ft-menu"></i></a></li>
                </ul>

                <ul class="nav navbar-nav">
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <span class="mr-1">
                                <span class="user-name text-bold-700">{{ auth()->user()->name }}</span>
                                @lang('translate.welcome')
                            </span>
                            <span class="avatar avatar-online"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-left">
                            <a class="dropdown-item" href="{{ route('admin.edit', auth()->user()->id) }}">
                                <i class="ft-user"></i>@lang('translate.edit_profile')</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}">
                                <i class="ft-power"></i>@lang('translate.logout')</a>
                        </div>
                    </li>

                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <span class="mr-1">
                                <span class="user-name text-bold-700">@lang('translate.languages')</span>
                            </span>
                            <span class="avatar avatar-online"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-left">
                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a class="dropdown-item" hreflang="{{ $localeCode }}"
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}
                            </a>
                            @endforeach
                        </div>
                    </li>

                    <li class="dropdown dropdown-notification nav-item mr-5">
                        <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-bell"></i>
                            <span class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow"
                                id="notifications_count">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <h6 class="dropdown-header m-0">
                                    <span class="grey darken-2">@lang('translate.notifications')</span>
                                </h6>
                                <span class="notification-tag badge badge-default badge-danger float-right m-0"
                                    id="notifications_count_new">
                                    {{ auth()->user()->unreadNotifications->count() }} New</span>
                            </li>

                            <li class="scrollable-container media-list w-100"></li>

                            <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center"
                                    href="{{ route('readAllNotifications') }}"
                                    id="read-all-notifications">@lang('translate.read_notifications')</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
