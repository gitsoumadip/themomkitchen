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
                                <div class="row">
                                    <form action="{{ route('item.order') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @forelse ($isFetch as $key => $data)
                                            <div class="col-md-8">
                                                <div class="menu_singlebox" data-id="{{ $data->id }}">
                                                    <div class="menus_middle">
                                                        <h4>Deliver to:</h4>
                                                        <input type="hidden" name="shippingAddress"
                                                            id="shippingAddress_{{ $data->id }}"
                                                            value="{{ $data->id }}">
                                                        <label for="shippingAddress_{{ $data->id }}">
                                                            <p>name={{ $data->name }},
                                                                Address={{ $data->address }},
                                                                Phone={{ $data->phone }},
                                                                Pincode={{ $data->pincode }},
                                                                City={{ $data->city }}</p>
                                                        </label>
                                                    </div>
                                                    <div class="menus_right_button d-flex justify-content-end">
                                                        <a href="{{ route('order.dalivery-address.address-list') }}"><button
                                                                type="button" class="place_order">Change</button></a>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="menus_right_button d-flex justify-content-end">
                                                <a href="{{ route('order.dalivery-address.address-list') }}"><button
                                                        type="button" class="place_order">Add Address</button></a>
                                            </div>
                                        @endforelse

                                        <div class="col-md-8">
                                            <div class="menu_singlebox">
                                                @forelse ($fetchCartItem as $key => $item)
                                                    @php
                                                        $i = 1;
                                                        $totalItemPrice = $totalItemPrice + $item->total_price;
                                                    @endphp
                                                    <div class="row">
                                                        <div class="menus_middle">
                                                            <input type="hidden"name="price[]" class="price"
                                                                value="{{ $item->types->price }}">
                                                            <input type="hidden" name="categoryType[]"
                                                                value="{{ $item->types->categorys->id }}">
                                                            <input type="hidden" name="itemType[]"
                                                                value="{{ $item->types->id }}">
                                                            <input type="hidden" name="cartId[]"
                                                                value="{{ $item->id }}">
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
                                                    <p>!Your Cart Is Empty</p>
                                                @endforelse
                                            </div>
                                        </div>
                                        <hr>
                                        @if (isset($fetchCartItem) && count($fetchCartItem) > 0)
                                            <div class="col-md-6">
                                                <div class="">
                                                    <p> Price Details</p>
                                                    <div class="row">
                                                        @php
                                                            $totalPrice = $totalItemPrice + 3;
                                                            $packaging = 20 * $i;
                                                        @endphp
                                                        <div class="col-lg-8 d-flex gap-5 m-2">
                                                            <div class="">Item Total</div>
                                                            <div class=""> {{ $totalItemPrice }} </div>
                                                        </div>
                                                        <div class="col-lg-8 d-flex gap-5 m-2">
                                                            <div class="">GST And Restaurant Charge <br> <span>GST And
                                                                    Restaurant </span></div>
                                                            <div class=""> 0 </div>
                                                        </div>
                                                        <div class="col-lg-8 d-flex gap-5 m-2">
                                                            <div class="">Delivery Partner fee for 2km <br> <span>Per
                                                                    km
                                                                    Rs-10</span> </div>
                                                            <div class="">10 </div>
                                                        </div>
                                                        <div class="col-lg-8 d-flex gap-5">
                                                            <div class="">Packing Charge Per Item -Rs 20</div>
                                                            <div class="">{{ $packaging }}</div>
                                                        </div>
                                                        <div class="col-lg-8 d-flex gap-5 m-2">
                                                            <div>Total</div>
                                                            <div>{{ $totalPrice }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-8">
                                            <div class="menus_right_button d-flex justify-content-end">
                                                @if (isset($isFetch) && count($isFetch) > 0)
                                                    <button type="submit" class="place_order">Checkout</button></a>
                                                @else
                                                    <a href="{{ route('menu') }}"> <button type="submit"
                                                            class="place_order">GoTo Menu</button></a>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                </div>
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
