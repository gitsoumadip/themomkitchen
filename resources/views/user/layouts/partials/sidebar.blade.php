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
                <img src="{{ asset('admin_assets/image/user-icon.jpg') }}" class="img-fluid" alt=""
                    title="Cloud Queue"  height="200px" width="250px"/>
            </div>
            <div class="adminb_title">
                <p>Hello,<span class="firstName">{{ auth()->user()->name }}</span></p>
                <p class="designation_txt">{{ auth()->user()->roles->first()->name ?? '' }}</p>
            </div>
        </div>
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading mm-@yield('dashboard')">
                    <a href="{{ route('user.dashboard.home') }}">
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
                <li class="app-sidebar__heading mm-@yield('category')">
                    <a href="{{ route('user.dashboard.myOrder') }}">
                        <div class="menuitem_box">
                            <div class="menuitem_name">
                                <span>
                                    <img src="{{ asset('admin_assets/images/icon_money.png') }}" class="img-fluid"
                                        alt="" />
                                </span>
                                MY ORDER
                            </div>
                        </div>
                    </a>
                </li>

                @if (auth()->user()->hasRole('user'))
                    <li class="app-sidebar__heading mm-@yield('category')">
                        <a href="{{ route('user.dashboard.profile') }}">
                            <div class="menuitem_box">
                                <div class="menuitem_name">
                                    <span>
                                        <img src="{{ asset('admin_assets/images/icon_money.png') }}" class="img-fluid"
                                            alt="" />
                                    </span>
                                    ACCOUNT SETTINGS
                                </div>
                            </div>
                        </a>
                    </li>
                @endif

                <li class="app-sidebar__heading mm-@yield('logout')">
                    <a href="{{ route('logout') }}">
                        <div class="menuitem_box">
                            <div class="menuitem_name">
                                <span>
                                    <img src="{{ asset('admin_assets/images/logout.png') }}" class="img-fluid"
                                        alt="" />
                                </span>
                                LOGOUT
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
