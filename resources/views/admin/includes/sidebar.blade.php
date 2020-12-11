<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item active"><a href=""><i class="la la-mouse-pointer"></i><span class="menu-title"
                        data-i18n="nav.add_on_drag_drop.main">@lang('translate.main')</span></a>
            </li>

            <li class="nav-item"><a href=""><i class="la la-cubes"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">@lang('translate.stores')</span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{ \App\Models\Store::count() }}</span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route('stores.create') }}" data-i18n="nav.dash.crypto"><i
                                class="la la-pencil"></i> @lang('translate.create_store')</a>
                    </li>
                    <li class="inactive"><a class="menu-item" href="{{ route('stores.index') }}"
                            data-i18n="nav.dash.ecommerce"><i class="la la-table"></i> @lang('translate.show_all')</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href=""><i class="la la-building"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">@lang('translate.companies')</span>
                    <span
                        class="badge badge badge-warning badge-pill float-right mr-2">{{ \App\Models\Company::count() }}</span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route('companies.create') }}" data-i18n="nav.dash.crypto"><i
                                class="la la-pencil"></i> @lang('translate.create_company')</a>
                    </li>
                    <li class="inactive"><a class="menu-item" href="{{ route('companies.index') }}"
                            data-i18n="nav.dash.ecommerce"><i class="la la-table"></i> @lang('translate.show_all')</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href=""><i class="la la-cart-plus"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">@lang('translate.products')</span>
                    <span
                        class="badge badge badge-success badge-pill float-right mr-2">{{ \App\Models\Product::count() }}</span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route('products.create') }}" data-i18n="nav.dash.crypto"><i
                                class="la la-pencil"></i> @lang('translate.create_product')</a>
                    </li>
                    <li class="inactive"><a class="menu-item" href="{{ route('products.index') }}"
                            data-i18n="nav.dash.ecommerce"><i class="la la-table"></i> @lang('translate.show_all')</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href=""><i class="la la-dollar"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">@lang('translate.sales')</span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{ \App\Models\Sale::count() }}</span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route('sales.create') }}" data-i18n="nav.dash.crypto"><i
                                class="la la-pencil"></i> @lang('translate.create_sale')</a>
                    </li>
                    <li class="inactive"><a class="menu-item" href="{{ route('sales.index') }}"
                            data-i18n="nav.dash.ecommerce"><i class="la la-table"></i> @lang('translate.show_all')</a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</div>
