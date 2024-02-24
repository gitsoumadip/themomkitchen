<!-- header section starts  -->
{{-- <header class="header">
    <a href="#" class="logo">
        <!-- <img src="Image/logo1.jpg" alt="" class="img-log"> -->
        Mom's Kitchen
        <!-- <i class="fas fa-utensils"></i> -->
    </a>
    <nav class="navbar">
        <a class="active" href="{{ route('home') }}">Home</a>
        <a href="{{ route('menu') }}">Menu</a>
        <a href="#contact us">Contact Us</a>
    </nav>

    <div class="icons">
        <a href="tel:1234567890"><i class="fa fa-phone"></i></a>
        <a href="#"><i class="fa-brands fa-instagram"></i></a>
        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="{{ route('cart') }}"><i class="fas fa-shopping-cart" id="shopping-cart"></i></a>
        @if (isset(auth()->user()->id))
            <a href="{{ route('logout') }}">Logout</a>
            <a href="{{ route('user.dashboard.home') }}">Profile</a>
        @else
            <a href="{{ route('login') }}"><i class="fas fa-user" id="user"></i></a>
        @endif
    </div>
</header> --}}


<header class="main-nav">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-3 col-6">
                <div class="logo">
                    <a href=""> <img src="{{ asset('assets/images/weblogo.png') }}" class="img-fluid" alt=""
                            width="250px" height="180px"></a>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-6 mb-2">
                {{-- <div class="row-6">
                    <div class="header-left">
                        <div class="stellarnav_icon">
                            <ul>
                                <a href="tel:1234567890"><i class="fa fa-phone"></i></a>
                                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                               
                            </ul>
                        </div>
                    </div>
                </div> --}}
                {{-- <hr> --}}
                <div class="row-6">
                    <div class="header-left">
                        <div class="stellarnav">
                            <ul>
                                <li class="active"><a href="{{ route('home') }}"><i
                                            class="fa-solid fa-house-user"></i>Home </a></li>
                                <li><a href="{{ route('menu') }}"><i class="fa-solid fa-bars"></i>Menu</a></li>

                                <li> <a href="{{ route('cart') }}"><i class="fas fa-shopping-cart"
                                        id="shopping-cart"></i>Cart</a></li>
                                @if (isset(auth()->user()->id))
                                    <li><a href="{{ route('logout') }}">Logout</a></li>
                                    <li><a href="{{ route('user.dashboard.home') }}">Profile</a></li>
                                @else
                                    <li><a href="{{ route('user.login') }}"><i class="fas fa-user"
                                            id="user"></i>Login</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
