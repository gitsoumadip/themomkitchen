@extends('frontend.layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])
@section('dashboard', 'active')
@section('content')
<section class="menu_sec">
    <div class="container">
        <div class="heading_box">

            <h2><u>Shipping</u></h2>
        </div>
        @php
        $totalItemPrice = 0;
        $totalPrice = 0;
        @endphp
        <div class="row">
            <div class="col-12">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-starters" role="tabpanel"
                        aria-labelledby="pills-starters-tab">
                        <div class="menutab_con">
                            <form action="{{ route('item.order') }}" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-7">
                                        @csrf
                                        @forelse ($isFetch as $key => $data)
                                        <div class="menu_singlebox deliveryadd_box" data-id="{{ $data->id }}">
                                            <div class="menus_middle">
                                                <h4>Deliver to:</h4>
                                                <input type="hidden" name="shippingAddress"
                                                    id="shippingAddress_{{ $data->id }}" value="{{ $data->id }}">
                                                <label for="shippingAddress_{{ $data->id }}">
                                                    <p>name={{ $data->name }},
                                                        Address={{ $data->address }},Phone={{ $data->phone }},Pincode={{ $data->pincode }},
                                                        City={{ $data->city }}</p>

                                                </label>
                                            </div>
                                            <div class="menus_right_button d-flex justify-content-end">
                                                <a href="{{ route('order.dalivery-address.address-list') }}"><button
                                                        type="button" class="place_order">Change</button></a>
                                            </div>
                                        </div>

                                        @empty
                                        <div class="menus_right_button d-flex justify-content-end">
                                            <a href="{{ route('order.dalivery-address.address-list') }}"><button
                                                    type="button" class="place_order">Add Address</button></a>
                                        </div>
                                        @endforelse


                                        <div class="menu_singlebox">
                                            @forelse ($fetchCartItem as $key => $item)
                                            @php
                                            $i = 1;
                                            $totalItemPrice = $totalItemPrice + $item->total_price;
                                            @endphp
                                            <div class="row">
                                                <div class="menus_middle">
                                                    <input type="hidden" name="price[]" class="price"
                                                        value="{{ $item->types->price }}">
                                                    <input type="hidden" name="categoryType[]"
                                                        value="{{ $item->types->categorys->id }}">
                                                    <input type="hidden" name="itemType[]"
                                                        value="{{ $item->types->id }}">
                                                    <input type="hidden" name="cartId[]" value="{{ $item->id }}">
                                                    <input type="hidden" name="itemQty[]" class="itemQty"
                                                        value="{{ $item->qty ?? '' }}">
                                                    <h4>{{ $item->types->name }}</h4>
                                                    @foreach ($item->types->items as $val)
                                                    {{ $val->name }},
                                                    @endforeach
                                                    <p>{{ $item->types->price }}</p>
                                                    <p>{{ $item->qty }}</p>
                                                    <p> {{ $item->total_price }}</p>
                                                </div>
                                            </div>
                                            @php
                                            $i++;
                                            @endphp
                                            @empty
                                            <p>Check Your Order</p>
                                            @endforelse
                                        </div>
                                    </div>
                                    {{-- @dd($isFetchDeliveryPrice) --}}

                                    @if (isset($fetchCartItem) && count($fetchCartItem) > 0)
                                    <div class="col-md-5">
                                        <div class="pricedetails_box">
                                            <p> Price Details</p>
                                            <div class="row">
                                                @php
                                                $packaging = $isFetchDeliveryPrice->packing_charge * $i;
                                                $distanceCharge = $isFetchDeliveryPrice->delivery_patner_km *
                                                $isFetchDeliveryPrice->delivery_patner_fee;
                                                $totalPrice = $totalItemPrice + $packaging + $distanceCharge;
                                                @endphp
                                                <input type="hidden" name="packaging" value="{{$packaging??''}}">
                                                <input type="hidden" name="distanceCharge"
                                                    value="{{$distanceCharge??''}}">
                                                <input type="hidden" name="totalPrice" value="{{$totalPrice??''}}">
                                                <input type="hidden" name="gst_resturant"
                                                    value="{{ $isFetchDeliveryPrice->gst_restaurant ?? '' }}">
                                                <input type="hidden" name="totalitemQty" value="{{$i??''}}">
                                                <div class="col-lg-8 d-flex gap-5 m-2">
                                                    <div class="">Item Total</div>
                                                    <div class=""> {{ $totalItemPrice }} </div>
                                                </div>
                                                <div class="col-lg-8 d-flex gap-5 m-2">
                                                    <div class="">GST And Restaurant Charge <br> <span>GST And
                                                            Restaurant </span></div>
                                                    <div class="">
                                                        {{ $isFetchDeliveryPrice->gst_restaurant ?? '' }} </div>
                                                </div>
                                                <div class="col-lg-8 d-flex gap-5 m-2">
                                                    <div class="">Delivery Partner fee for
                                                        {{ $isFetchDeliveryPrice->delivery_patner_km ?? '' }}km
                                                        <br>
                                                        <span>Per
                                                            km
                                                            Rs-{{ $isFetchDeliveryPrice->delivery_patner_fee ?? '' }}</span>
                                                    </div>
                                                    <div class="">{{ $distanceCharge ?? '' }}</div>
                                                </div>
                                                <div class="col-lg-8 d-flex gap-5">
                                                    <div class="">Packing Charge Per Item -Rs
                                                        {{ $isFetchDeliveryPrice->packing_charge ?? '' }}</div>
                                                    <div class="">{{ $packaging }}</div>
                                                </div>
                                                <div class="col-lg-8 d-flex gap-5 m-2">
                                                    <div>Total</div>
                                                    <div>{{ $totalPrice ?? '' }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-7">
                                        <div class="menus_right_button d-flex justify-content-end">
                                            @if (isset($fetchCartItem) && count($fetchCartItem) > 0)
                                            <button type="submit" class="place_order">Checkout</button></a>
                                            @else
                                            <a href="{{ route('menu') }}" class=" btn place_order">GoTo Menu</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
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
<script>
$(document).ready(function() {
    $(".increase, .decrease").click(function() {
        var itemContainer = $(this).closest('.item');
        let item_price = $('.item_price').text();
        var itemId = itemContainer.data('id');
        var change = $(this).hasClass('increase') ? 1 : -1;
        updateQuantity(itemId, change, itemContainer, item_price);
    });

    function updateQuantity(itemId, change, itemContainer, item_price) {
        var currentVal = parseInt(itemContainer.find(".itemQty").val());
        if (!isNaN(currentVal)) {
            var newQty = currentVal + change;
            var pes = newQty * item_price;
            itemContainer.find(".itemQty").val(newQty);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Update the database using AJAX
            $.ajax({
                type: 'POST',
                url: "{{ route('cart.updateQuantity') }}", // Update this with your Laravel route
                data: {
                    typeId: itemId,
                    newQty: newQty
                },
                success: function(response) {
                    window.location.reload();
                },
                error: function(error) {
                    console.error(error); // Log any errors
                }
            });
        }
    }


});
</script>
@endpush