@extends('frontend.layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])
@section('dashboard', 'active')
@section('content')
<section class="menu_sec">
    <div class="container">
        {{-- <div class="heading_box">
                <div class="menu-icon"><img src="{{ asset('assets/images/cart.png') }}" class="img-fluid" alt=""
        width="180px" height="150px">
    </div>
    <h2><u>Shipping</u></h2>
    </div> --}}
    <div class="row">
        <div class="col-12">

            <div class="menutab_con order_details">
                <form action="{{ route('order.dalivery-address.add-edit') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">

                                <input class="form-control" type="text" name="name" id="name" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">

                                <input class="form-control" type="text" class="" name="phone" required="" maxlength="10"
                                    autocomplete="tel" tabindex="2" value="" placeholder="10-digit mobile number">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">

                                <input class="form-control" type="text" name="pincode" id="pincode" maxlength="6"
                                    placeholder="Pincode">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">

                                <input class="form-control" type="text" name="locality" id="locality"
                                    placeholder="Locality">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">

                                <input class="form-control" type="text" name="address" id="address"
                                    placeholder="address">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">

                                <input class="form-control" type="text" name="city" id="city" placeholder="city">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">

                                <input class="form-control" type="text" name="state" id="state" placeholder="state">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">

                                <input class="form-control" type="text" name="landmark" id="landmark"
                                    placeholder="landmark">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">

                                <input class="form-control" type="text" name="alter_phone" id="alter_phone"
                                    placeholder="alter phone">
                            </div>
                        </div>
                        <div class="col-md-4 option_box">
                            <div class="form-group ">

                                <label for="">Home</label>
                                <input type="radio" name="type" id="type" value="home">
                            </div>

                            <div class="form-group">

                                <label for="">Office</label>
                                <input type="radio" name="type" id="type" value="office">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="menus_right_button d-flex justify-content-end">
                            <a href="{{ route('order.dalivery-address.address-list') }}"><button type="button"
                                    class="place_order">Back
                                </button></a>
                            <button type="submit" class="place_order placeorderbtn">Place
                                Order</button>

                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>
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