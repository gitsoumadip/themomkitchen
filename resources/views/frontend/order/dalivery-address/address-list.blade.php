@extends('frontend.layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])
@section('dashboard', 'active')
@section('content')
<section class="menu_sec">
    <div class="container">
        <div class="heading_box">

        </div>
        <div class="row">
            <div class="col-12">

                <div class="menutab_con">
                    <div class="row">

                        <div class="col-8">
                            <div class="menus_right_button d-flex justify-content-end">
                                <a href="{{ route('order.dalivery-address.add-edit') }}"> <button type="button"
                                        class="place_order">Add Delivery Address</button></a>
                            </div>
                        </div>
                        <form action="{{ route('order.dalivery-address.address-list') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @if (isset($isFetch) && count($isFetch) > 0)
                            @forelse($isFetch as $data)
                            <div class="col-md-8">
                                <div class="menu_singlebox item" data-id="{{ $data->id }}">
                                    {{-- <div class="col"> --}}
                                    <input type="radio" name="shippingAddress" id="shippingAddress_{{ $data->id }}"
                                        value="{{ $data->id }}">
                                    <label for="shippingAddress_{{ $data->id }}">
                                        <p>name={{ $data->name }},
                                            Address={{ $data->address }},
                                            Phone={{ $data->phone }},
                                            Pincode={{ $data->pincode }},
                                            City={{ $data->city }}</p>
                                    </label>
                                    {{-- </div> --}}
                                    {{-- @endforeach --}}
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
                                    {{-- @if (isset($fetchCartItem) && count($fetchCartItem) > 0) --}}
                                    {{-- <a href="{{ route('order.dalivery-address.list') }}"> <button type="button"
                                        class="place_order">Delivery Here</button></a>
                                    @else --}}
                                    <button type="submit" class="place_order">Delivery Here</button>
                                    {{-- @endif --}}
                                </div>
                            </div>
                        </form>
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