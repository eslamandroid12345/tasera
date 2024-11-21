<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('/') }}" class="brand-link">
        {{--        <img src="{{asset("logo.png")}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        <span class="brand-text font-weight-light">@lang('dashboard.Tasera')</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ auth()->user()->image? asset(auth()->user()->image) :asset('img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{route('settings.edit',auth()->id())}}" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item  {{ in_array(request()->route()->getName(),['/'])? 'menu-open': '' }}">
                    <a href="{{ url('/') }}" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            @lang('dashboard.Home')
                        </p>
                    </a>
                </li>
                @permission('countries-read')
                <li class="nav-item  {{ in_array(request()->route()->getName(),['countries.index'])? 'menu-open': '' }}">
                    <a href="{{ route('countries.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            @lang('dashboard.countries')
                        </p>
                    </a>
                </li>
                @endpermission
                @permission('fields-read')
                <li class="nav-item  {{ in_array(request()->route()->getName(),['fields.index'])? 'menu-open': '' }}">
                    <a href="{{ route('fields.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            @lang('dashboard.fields')
                        </p>
                    </a>
                </li>
                @endpermission
                @permission('taxes-read')
                <li class="nav-item  {{ in_array(request()->route()->getName(),['taxes.index'])? 'menu-open': '' }}">
                    <a href="{{ route('taxes.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            @lang('dashboard.taxes')
                        </p>
                    </a>
                </li>
                @endpermission
                @permission('taxes-read')
                <li class="nav-item  {{ in_array(request()->route()->getName(),['unit-types.index'])? 'menu-open': '' }}">
                    <a href="{{ route('unit-types.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            @lang('dashboard.unit_types')
                        </p>
                    </a>
                </li>
                @endpermission
                @permission('companies-read')
                <li class="nav-item  {{ in_array(request()->route()->getName(),['companies.suppliers'])? 'menu-open': '' }}">
                    <a href="{{ route('companies.suppliers') }}" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            @lang('dashboard.suppliers')
                        </p>
                    </a>
                </li>
                @endpermission
                @permission('companies-read')
                <li class="nav-item  {{ in_array(request()->route()->getName(),['companies.buyers'])? 'menu-open': '' }}">
                    <a href="{{ route('companies.buyers') }}" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            @lang('dashboard.buyers')
                        </p>
                    </a>
                </li>
                @endpermission
                @permission('purchase-orders-read')
                <li class="nav-item  {{ in_array(request()->route()->getName(),['purchase-orders.index'])? 'menu-open': '' }}">
                    <a href="{{ route('purchase-orders.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            @lang('dashboard.purchase_orders')
                        </p>
                    </a>
                </li>
                @endpermission
                @permission('purchase-orders-offers-read')
                <li class="nav-item  {{ in_array(request()->route()->getName(),['offers.index'])? 'menu-open': '' }}">
                    <a href="{{ route('offers.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            @lang('dashboard.unapproved_purchase_order_offers')
                        </p>
                    </a>
                </li>
                @endpermission
                @permission('purchase-orders-inquiries-read')
                <li class="nav-item  {{ in_array(request()->route()->getName(),['inquiries.index'])? 'menu-open': '' }}">
                    <a href="{{ route('inquiries.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            @lang('dashboard.unapproved_purchase_order_inquiries')
                        </p>
                    </a>
                </li>
                @endpermission
                @permission('packages-read')
                <li class="nav-item  {{ in_array(request()->route()->getName(),['packages.index'])? 'menu-open': '' }}">
                    <a href="{{ route('packages.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            @lang('dashboard.packages')
                        </p>
                    </a>
                </li>
                @endpermission
                @permission('payments-read')
                <li class="nav-item  {{ in_array(request()->route()->getName(),['payments.index'])? 'menu-open': '' }}">
                    <a href="{{ route('payments.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            @lang('dashboard.payments')
                        </p>
                    </a>
                </li>
                @endpermission
                @permission('subscriptions-read')
                <li class="nav-item  {{ in_array(request()->route()->getName(),['subscriptions.index'])? 'menu-open': '' }}">
                    <a href="{{ route('subscriptions.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            @lang('dashboard.subscriptions')
                        </p>
                    </a>
                </li>
                @endpermission
                @permission('loyalty-points-read')
                <li class="nav-item  {{ in_array(request()->route()->getName(),['loyalty-points.index'])? 'menu-open': '' }}">
                    <a href="{{ route('loyalty-points.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            @lang('dashboard.loyalty_points')
                        </p>
                    </a>
                </li>
                @endpermission
               @permission('loyalty-points-settings-read')
                <li class="nav-item  {{ in_array(request()->route()->getName(),['loyalty-points-settings.index'])? 'menu-open': '' }}">
                    <a href="{{ route('loyalty-points-settings.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            @lang('dashboard.loyalty_points_settings')
                        </p>
                    </a>
                </li>
                @endpermission
                @permission('roles-read')
                    <li class="nav-item  {{ in_array(request()->route()->getName(),['roles.index','roles.create','roles.edit','roles.mangers','managers.create','managers.edit'])? 'menu-open': '' }}">
                        <a href="{{ route('roles.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                @lang('dashboard.roles_and_permissions')
                            </p>
                        </a>
                    </li>
                @endpermission

                <li class="nav-item  {{ in_array(request()->route()->getName(),['home-content.index','faqs-content.index','terms-and-conditions-content.index', 'about-content.index', 'explanation-of-use-content.index', 'explanation-of-use-buyer-content.index', 'explanation-of-use-supplier-content.index', 'packages-content.index', 'infos.index', ])? 'menu-open': '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            @lang('dashboard.info_control')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('home-content.index') }}"
                               class="nav-link {{ in_array(request()->route()->getName(),['home-content.index'])? 'active': '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('dashboard.home_page')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('about-content.index') }}"
                               class="nav-link {{ in_array(request()->route()->getName(),['about-content.index'])? 'active': '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('dashboard.about_page')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('explanation-of-use-content.index') }}"
                               class="nav-link {{ in_array(request()->route()->getName(),['explanation-of-use-content.index'])? 'active': '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('dashboard.explanation-of-use_page')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('explanation-of-use-buyer-content.index') }}"
                               class="nav-link {{ in_array(request()->route()->getName(),['explanation-of-use-buyer-content.index'])? 'active': '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('dashboard.explanation-of-use-buyer_page')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('explanation-of-use-supplier-content.index') }}"
                               class="nav-link {{ in_array(request()->route()->getName(),['explanation-of-use-supplier-content.index'])? 'active': '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('dashboard.explanation-of-use-supplier_page')</p>
                            </a>
                        </li>
                        <li
                            class="nav-item">
                            <a href="{{ route('faqs-content.index') }}" class="nav-link {{ in_array(request()->route()->getName(),['faqs-content.index'])? 'active': '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('dashboard.faqs')</p>
                            </a>
                        </li>
                        <li
                            class="nav-item">
                            <a href="{{ route('terms-and-conditions-content.index') }}" class="nav-link {{ in_array(request()->route()->getName(),['terms-and-conditions-content.index'])? 'active': '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('dashboard.terms')</p>
                            </a>
                        </li>
                        <li
                            class="nav-item">
                            <a href="{{ route('infos.index') }}" class="nav-link {{ in_array(request()->route()->getName(),['infos.index'])? 'active': '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('dashboard.infos')</p>
                            </a>
                        </li>
                        <li
                            class="nav-item">
                            <a href="{{ route('packages-content.index') }}" class="nav-link {{ in_array(request()->route()->getName(),['packages-content.index'])? 'active': '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('dashboard.packages')</p>
                            </a>
                        </li>
                    </ul>

                <li class="nav-item  {{ in_array(request()->route()->getName(),['complaints.index', 'complaints.show'])? 'menu-open': '' }}">
                    <a href="{{ route('complaints.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            @lang('dashboard.complaints')
                        </p>
                    </a>
                </li>
                <li class="nav-item  {{ in_array(request()->route()->getName(),['contact-us.index', 'contact-us.show'])? 'menu-open': '' }}">
                    <a href="{{ route('contact-us.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            @lang('dashboard.contact-us')
                        </p>
                    </a>
                </li>
                <li
                    class="nav-item  {{ in_array(request()->route()->getName(),['settings.edit'])? 'menu-open': '' }} {{ Route::currentRouteName()=='settings.edit'?'activeNav':'' }}">
                    <a href="{{ route('settings.edit', auth()->user()->id) }}" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            @lang('dashboard.Settings')
                        </p>
                    </a>
                </li>
                {{--                <li--}}
                {{--                    class="nav-item  {{ in_array(request()->route()->getName(),['settings.edit'])? 'menu-open': '' }} {{ Route::currentRouteName()=='settings.edit'?'activeNav':'' }}">--}}
                {{--                    <a href="{{ route('settings.edit', auth()->user()->id) }}" class="nav-link">--}}
                {{--                        <i class="nav-icon fas fa-cogs"></i>--}}
                {{--                        <p>--}}
                {{--                            @lang('dashboard.Settings')--}}
                {{--                        </p>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
