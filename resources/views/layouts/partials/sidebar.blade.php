<div class="app-sidebar sidebar-shadow">
    <!-- side bar logo  -->
    <div class="app-header__logo">
        <div class="collaspe_logo">
            <img src="{{ asset('admin_assets/images/collaspe_logo.svg') }}" class="img-fluid" alt="" />
        </div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="scrollbar-sidebar">
        <!-- admin name -->
        <div class="adminname_box">
            <div class="adminb_head">
                <img src="{{ asset('admin_assets/images/dash-logo.png') }}" class="img-fluid" alt=""
                    title="Cloud Queue" />
            </div>
            <div class="adminb_title">
                <p>Hello,<span class="firstName">{{ auth()->user()->name }}</span></p>
                <p class="designation_txt">{{ auth()->user()->roles->first()->name ?? '' }}</p>
            </div>
        </div>
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading mm-@yield('dashboard')">
                    <a href="{{ route('admin.dashboard.dashboard') }}">
                        <div class="menuitem_box">
                            <div class="menuitem_name">
                                <span>
                                    <img src="{{ asset('admin_assets/images/iwwa_dashboard.png') }}" class="img-fluid"
                                        alt="" />
                                </span>
                                Dashboard
                            </div>
                        </div>
                    </a>
                </li>
                @if (auth()->user()->hasRole('super-admin'))
                    <li class="app-sidebar__heading mm-@yield('category')">
                        <a href="{{ route('admin.category.list') }}">
                            <div class="menuitem_box">
                                <div class="menuitem_name">
                                    <span>
                                        <img src="{{ asset('admin_assets/images/icon_money.png') }}" class="img-fluid"
                                            alt="" />
                                    </span>
                                    Category
                                </div>
                            </div>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->hasRole('super-admin'))
                    <li class="app-sidebar__heading mm-@yield('category')">
                        <a href="{{ route('admin.type.list') }}">
                            <div class="menuitem_box">
                                <div class="menuitem_name">
                                    <span>
                                        <img src="{{ asset('admin_assets/images/icon_money.png') }}" class="img-fluid"
                                            alt="" />
                                    </span>
                                    Type
                                </div>
                            </div>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->hasRole('super-admin'))
                    <li class="app-sidebar__heading mm-@yield('category')">
                        <a href="{{ route('admin.item.list') }}">
                            <div class="menuitem_box">
                                <div class="menuitem_name">
                                    <span>
                                        <img src="{{ asset('admin_assets/images/icon_money.png') }}" class="img-fluid"
                                            alt="" />
                                    </span>
                                    Item
                                </div>
                            </div>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->hasRole('super-admin'))
                    <li class="app-sidebar__heading mm-@yield('category')">
                        <a href="{{ route('admin.menu.list') }}">
                            <div class="menuitem_box">
                                <div class="menuitem_name">
                                    <span>
                                        <img src="{{ asset('admin_assets/images/icon_money.png') }}" class="img-fluid"
                                            alt="" />
                                    </span>
                                    Menu
                                </div>
                            </div>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->hasRole('super-admin'))
                    <li class="app-sidebar__heading mm-@yield('category')">
                        <a href="{{ route('admin.location.list') }}">
                            <div class="menuitem_box">
                                <div class="menuitem_name">
                                    <span>
                                        <img src="{{ asset('admin_assets/images/icon_money.png') }}" class="img-fluid"
                                            alt="" />
                                    </span>
                                    Location
                                </div>
                            </div>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->hasRole('super-admin'))
                    <li class="app-sidebar__heading mm-@yield('category')">
                        <a href="{{ route('admin.order.list') }}">
                            <div class="menuitem_box">
                                <div class="menuitem_name">
                                    <span>
                                        <img src="{{ asset('admin_assets/images/icon_money.png') }}" class="img-fluid"
                                            alt="" />
                                    </span>
                                    Order Item
                                </div>
                            </div>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->hasRole('super-admin', 'clinic', 'doctor'))
                    <li class="app-sidebar__heading mm-@yield('user-permission') ?? mm-@yield('role-permission')">
                        <a href="#">
                            <div class="menuitem_box">
                                <div class="menuitem_name">
                                    <span>
                                        <img src="{{ asset('admin_assets/images/menu-items/nucleus.svg') }}"
                                            class="img-fluid" alt="">
                                    </span>
                                    Customers
                                </div>
                                <span class="sub_drop">
                                    <i class="fa-solid fa-angle-down"></i>
                                </span>
                            </div>
                        </a>
                        <ul>
                            <li class="app-sidebar__heading mm-@yield('user-permission')">
                                <a href="{{ route('admin.customer.list') }}">
                                    <div class="menuitem_box">
                                        <div class="menuitem_name">
                                            <span>
                                                <img src="{{ asset('admin_assets/images/menu-items/grant.svg') }}"
                                                    class="img-fluid" alt="">
                                            </span>
                                            Customer
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="app-sidebar__heading mm-@yield('role-permission')">
                                <a href="{{ route('admin.role-permission.list') }}">
                                    <div class="menuitem_box">
                                        <div class="menuitem_name">
                                            <span>
                                                <img src="{{ asset('admin_assets/images/menu-items/fund.svg') }}"
                                                    class="img-fluid" alt="">
                                            </span>
                                            Customer Reports
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                {{-- @if (auth()->user()->hasRole('super-admin', 'clinic', 'doctor'))
                    <li class="app-sidebar__heading mm-@yield('user-permission') ?? mm-@yield('role-permission')">
                        <a href="#">
                            <div class="menuitem_box">
                                <div class="menuitem_name">
                                    <span>
                                        <img src="{{ asset('admin_assets/images/menu-items/nucleus.svg') }}"
                                            class="img-fluid" alt="">
                                    </span>
                                 Role Permission
                                </div>
                                <span class="sub_drop">
                                    <i class="fa-solid fa-angle-down"></i>
                                </span>
                            </div>
                        </a>
                        <ul>
                            <li class="app-sidebar__heading mm-@yield('user-permission')">
                                <a href="{{ route('admin.user-permission.list') }}">
                                    <div class="menuitem_box">
                                        <div class="menuitem_name">
                                            <span>
                                                <img src="{{ asset('admin_assets/images/menu-items/grant.svg') }}"
                                                    class="img-fluid" alt="">
                                            </span>
                                            Customer Details
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="app-sidebar__heading mm-@yield('role-permission')">
                                <a href="{{ route('admin.role-permission.list') }}">
                                    <div class="menuitem_box">
                                        <div class="menuitem_name">
                                            <span>
                                                <img src="{{ asset('admin_assets/images/menu-items/fund.svg') }}"
                                                    class="img-fluid" alt="">
                                            </span>
                                            Customer Reports
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif --}}

                {{-- @if (auth()->user()->hasRole('super-admin', 'clinic', 'doctor'))
                    <li class="app-sidebar__heading mm-@yield('user-permission') ?? mm-@yield('role-permission')">
                        <a href="#">
                            <div class="menuitem_box">
                                <div class="menuitem_name">
                                    <span>
                                        <img src="{{ asset('admin_assets/images/menu-items/nucleus.svg') }}"
                                            class="img-fluid" alt="">
                                    </span>
                                    User Management
                                </div>
                                <span class="sub_drop">
                                    <i class="fa-solid fa-angle-down"></i>
                                </span>
                            </div>
                        </a>
                        <ul>
                            <li class="app-sidebar__heading mm-@yield('user-permission')">
                                <a href="{{ route('admin.user-permission.list') }}">
                                    <div class="menuitem_box">
                                        <div class="menuitem_name">
                                            <span>
                                                <img src="{{ asset('admin_assets/images/menu-items/grant.svg') }}"
                                                    class="img-fluid" alt="">
                                            </span>
                                            Admin User
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="app-sidebar__heading mm-@yield('role-permission')">
                                <a href="{{ route('admin.role-permission.list') }}">
                                    <div class="menuitem_box">
                                        <div class="menuitem_name">
                                            <span>
                                                <img src="{{ asset('admin_assets/images/menu-items/fund.svg') }}"
                                                    class="img-fluid" alt="">
                                            </span>
                                            Role & Permission
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif --}}

                {{-- @if (auth()->user()->hasRole('super-admin', 'doctor', 'clinic'))
                <li class="app-sidebar__heading mm-@yield('setting')">
                    <a href="#">
                        <div class="menuitem_box">
                            <div class="menuitem_name">
                                <span>
                                    <img src="{{ asset('admin_assets/images/settings.png') }}" class="img-fluid" alt="" />
                                </span>
                                Settings
                            </div>
                        </div>
                    </a>
                </li>
                @endif --}}

                @if (auth()->user()->hasRole('super-admin'))
                <li class="app-sidebar__heading mm-@yield('setting')">
                    <a href="{{ route('admin.setting.checkout.list') }}">
                        <div class="menuitem_box">
                            <div class="menuitem_name">
                                <span>
                                    <img src="{{ asset('admin_assets/images/icon_money.png') }}" class="img-fluid"
                                        alt="" />
                                </span>
                               Setting
                            </div>
                        </div>
                    </a>
                </li>
            @endif
                <li class="app-sidebar__heading mm-@yield('logout')">
                    <a href="{{ route('admin.logout') }}">
                        <div class="menuitem_box">
                            <div class="menuitem_name">
                                <span>
                                    <img src="{{ asset('admin_assets/images/logout.png') }}" class="img-fluid"
                                        alt="" />
                                </span>
                                Logout
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
