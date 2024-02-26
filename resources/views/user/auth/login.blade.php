@extends('layouts.auth')
@push('styles')
@endpush
@section('content')
    <section class="menu_sec">
        <div class="container">
            <div class="heading_box">
                <div class="menu-icon"><img src="{{ asset('assets/images/cart.png') }}" class="img-fluid" alt=""
                        width="180px" height="150px"></div>
                <h2><u>Cart</u></h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-starters" role="tabpanel"
                            aria-labelledby="pills-starters-tab">
                            <div class="menutab_con">
                                {{-- <div class="row">
                                    @if (isset($fetchCartItem) && count($fetchCartItem) > 0)
                                        @forelse ($fetchCartItem as $key => $data)
                                            <div class="col-md-8">
                                                <div class="menu_singlebox item" data-id="{{ $data->id }}">
                                                    <div class="menus_left">
                                                        <img src="assets/images/food1.jpg" class="img-fluid" alt="">
                                                    </div>
                                                    <div class="menus_middle">
                                                        <h4>{{ $data->types->name }}</h4>
                                                        @foreach ($data->types->items as $val)
                                                            <p>{{ $val->name }}</p>
                                                        @endforeach
                                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                                            Expedita,
                                                            atque.</p>
                                                    </div>
                                                    <div class="menus_right_incriment">
                                                        <button class="decrease decrease_qty">-</button>
                                                        <input type="hidden" name="categoryType[]"
                                                            value="{{ $data->types->categorys->id }}">
                                                        <input type="hidden" name="itemType[]" value="{{ $data->id }}">
                                                        <input type="text" name="itemQty[]"
                                                            id="itemQty_{{ $data->id }}" class="itemQty"
                                                            value="{{ $data->qty ?? '' }}">
                                                        <button class="increase increase_qty">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <p>!Your Cart Is Empty</p>
                                        @endforelse
                                    @else
                                        <p>!Your Cart Is Empty</p>
                                    @endif
                                    <div class="col-8">
                                        <div class="menus_right_button d-flex justify-content-end">
                                            @if (isset($fetchCartItem) && count($fetchCartItem) > 0)
                                                <a href="{{ route('order.dalivery-address.list') }}"> <button type="button"
                                                        class="place_order">Place Order</button></a>
                                            @else
                                                <a href="{{ route('menu') }}"> <button type="button"
                                                        class="place_order">Place Order</button></a>
                                            @endif
                                        </div>
                                    </div>

                                </div> --}}
                            </div>
                        </div>

                    </div>

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
