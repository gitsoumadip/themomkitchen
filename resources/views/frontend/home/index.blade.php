@extends('frontend.layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])
@section('dashboard', 'active')
@section('content')

    <div class="banner">
        <!-- Swiper -->
        <div class="hero_img">
            <div swiper_scale_active class="swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="{{ asset('assets/images/hero01.jpg') }}" class="img-fluid" />

                        <!-- <a href="#" id="form">Link</a> -->
                    </div>
                    <div class="swiper-slide">
                        <div>
                            <img src="{{ asset('assets/images/hero02.jpg') }}" class="img-fluid" />
                            <!-- <a href="#">Link 2</a> -->
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('assets/images/hero03.jpg') }}" class="img-fluid" />

                        <!-- <a href="#">Link 3</a> -->
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('assets/images/hero04.jpg') }}" class="img-fluid" />
                        <!-- <a href="#">Link 4</a> -->
                    </div>

                </div>
            </div>
            <div class="heroi_con">
                <h3>Dinner With us <span class="header-sub-title" id="word"></span> <span
                        class="header-sub-title blink">|</span></h3>
                <p>We are an Indian food store that produces tasty, delectable, appetizing, mouth-watering food. We deliver
                    the
                    best, delicious</p>
            </div>
        </div>
    </div>

    <!-- contact us button -->
    <div class="contactus">
        <a href="{{ route('menu') }}">
            <button>Order Now</button></a>
    </div>


    <div class="go-top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></div>

    <div id="preloader">
        <div class="ripple_effect">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>











@endsection
@push('scripts')
@endpush
