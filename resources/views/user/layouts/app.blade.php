<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="./admin_assets/" data-template="vertical-menu-template">
@include('user.layouts.partials.header')
<body>
    <section class="dashboard_sec">
        <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
            <div class="app-main">
                <!-- dashboard side bar -->
                @include('user.layouts.flash')
                @include('user.layouts.partials.sidebar')
                <!-- dashboard main body -->
                <div class="app-main__outer">
                    <!-- dahboard top bar -->
                    @include('user.layouts.partials.navbar')
                    <div class="app-main__inner card">
                        <!-- dashboard biome -->
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- preloader -->
    @include('user.layouts.partials.footer')
    @include('user.layouts.partials._footer')
</body>
</html>
