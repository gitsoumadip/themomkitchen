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

                                    {{-- @dd($data) --}}
                                    <div class="col-md-4">
                                        <div class="menu_singlebox ">
                                            @if (isset($fetchCartItem) && count($fetchCartItem) > 0)
                                                @forelse ($fetchCartItem as $key => $data)
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
                                                @empty
                                                    <p>!Your Cart Is Empty</p>
                                                @endforelse
                                            @else
                                                <p>!Your Cart Is Empty</p>
                                            @endif
                                        </div>
                                    </div>

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
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $(".increase, .decrease").click(function() {
                var itemContainer = $(this).closest('.item');
                // alert(itemContainer)
                
                var itemId = itemContainer.data('id');
                var change = $(this).hasClass('increase') ? 1 : -1;
                updateQuantity(itemId, change, itemContainer);
            });

            function updateQuantity(itemId, change, itemContainer) {
                var currentVal = parseInt(itemContainer.find(".itemQty").val());
                alert(currentVal)
                if (!isNaN(currentVal)) {
                    var newQty = currentVal + change;

                    // Update the UI
                    itemContainer.find(".itemQty").val(newQty);

                    // alert(newQty)
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



        $(document).ready(function() {
            $(".itemQty").on('change', function() {
                calculateTotalPrice();
            });

            function calculateTotalPrice() {
                var totalPrice = 0;
                $('.item').each(function() {
                    var quantity = $(this).find(".itemQty").val();
                    var price = $(this).find(".item_price").text();
                    totalPrice += parseInt(quantity) * parseFloat(price);
                });
                $("#totalPrice").text(totalPrice.toFixed(2)); // Update total price in the UI
            }

            // Initial calculation when the page loads
            calculateTotalPrice();
        });
    </script>
@endpush
