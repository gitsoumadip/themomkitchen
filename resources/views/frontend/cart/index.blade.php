@extends('frontend.layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])
@section('dashboard', 'active')
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
                                <div class="row">
                                    @if (isset($fetchCartItem) && count($fetchCartItem) > 0)
                                        @forelse ($fetchCartItem as $key => $data)
                                            <div class="col-md-8">
                                                <div class="row item" data-id="{{ $data->id }}">
                                                    <div class="menus_middle">
                                                        <h4>{{ $data->types->name }}</h4>
                                                        <input type="hidden" class="itemPrice"
                                                            value="{{ $data->types->price }}">
                                                        <i class="fa-solid fa-indian-rupee-sign"></i>
                                                        <span class="item_price">
                                                            {{ $data->types->price }}
                                                        </span>
                                                        <div class="menus_right_incriment">
                                                            <button class="decrease decrease_qty">-</button>
                                                            <input type="hidden" name="categoryType[]"
                                                                value="{{ $data->types->categorys->id }}">
                                                            <input type="hidden" name="itemType[]"
                                                                value="{{ $data->id }}">
                                                            <input type="text" name="itemQty[]" class="itemQty"
                                                                value="{{ $data->qty ?? '' }}">
                                                            <button class="increase increase_qty">+</button>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                </div>
                                                {{-- <div class="menu_singlebox item" data-id="{{ $data->id }}">
                                                    <div class="menus_left">
                                                        <img src="assets/images/food1.jpg" class="img-fluid" alt="">
                                                    </div>
                                                    <div class="menus_middle">
                                                        <h4>{{ $data->types->name }}</h4>
                                                        @foreach ($data->types->items as $val)
                                                            {{ $val->name }},
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
                                                </div> --}}
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

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
    {{-- 
    <div class="go-top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></div>

    <div id="preloader">
        <div class="ripple_effect">

            <span></span>
            <span></span>
            <span></span>
        </div>
    </div> --}}
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
                    // alert(item_price)
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
                            //console.log(response);
                            // alert(response)
                            window.location.reload();

                            // if (response == 1) {
                            // alert(response)
                            // }
                            // console.log(response); // Log the server response
                        },
                        error: function(error) {
                            // console.error(error); // Log any errors
                        }
                    });
                }
            }
        });

        // JavaScript with jQuery
        // $(document).ready(function() {
        //     $(".increase").click(function() {
        //         $getId=
        //         updateQuantity(1);
        //     });

        //     $(".decrease").click(function() {
        //         $getId=
        //         updateQuantity(-1);
        //     });

        //     function updateQuantity(change) {
        //         var currentVal = parseInt($(".itemQty").val());
        //         if (!isNaN(currentVal)) {
        //             var newQty = currentVal + change;

        //             // Update the UI
        //             $(".itemQty").val(newQty);
        //             alert(newQty)

        //             // Update the database using AJAX
        //             $.ajax({
        //                 type: 'POST',
        //                 url: '/update-quantity', // Update this with your Laravel route
        //                 data: {
        //                     itemId: {{ $data->id ?? 0 }},
        //                     newQty: newQty
        //                 },
        //                 success: function(response) {
        //                     console.log(response); // Log the server response
        //                 },
        //                 error: function(error) {
        //                     console.error(error); // Log any errors
        //                 }
        //             });
        //         }
        //     }
        // });
    </script>
@endpush
