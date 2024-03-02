<div class="app-header header-shadow">
    <!-- mobile toggle -->
    <div class="app-header__logo">
        <div class="collaspe_logo">
            <img src="{{ asset('admin_assets/images/collaspe_logo.svg') }}" class="img-fluid" alt="" />
        </div>
        <div class="header__pane">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                    data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <!-- mobile toggle/ -->
    <div class="app-header__content">
        <div class="app-header-left">
            <!-- top ar heading -->
            <div class="top_barhead">
                <h3>Dashboard</h3>
            </div>
        </div>
        <div class="app-header-right">
            <div class="header-btn-lg pr-0">
                <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left widget_noti">
                            <div class="btn-group">
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-2 btn">
                                    <div class="topbar_icon"><i class="fa-solid fa-user-doctor fa-2xl"></i></div>
                                </a>
                                <div tabindex="-1" role="menu" aria-hidden="true"
                                    class="dropdown-menu dropdown-menu-right">

                                    <a href="#" class="dropdown-item">
                                        <i class="fa-solid fa-user-doctor fa-lg"></i> User Account
                                    </a>
                                    <a href="{{ route('admin.profile.view') }}" class="dropdown-item">
                                        Update Profile
                                    </a>
                                    <a href="{{ route('admin.password.chenge') }}" class="dropdown-item">
                                        Update Password
                                    </a>
                                    <hr>
                                    <a href="{{ route('admin.logout') }}" class="dropdown-item">
                                        Logout
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>