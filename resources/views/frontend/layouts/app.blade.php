

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="./assets/" data-template="vertical-menu-template">
@include('frontend.layouts.partials.header')

<body>
    @include('frontend.layouts.partials.navbar')

    @yield('content')

    @include('frontend.layouts.partials.footer')
    @include('frontend.layouts.partials._footer')
</body>

</html>
