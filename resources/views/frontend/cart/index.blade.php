@extends('frontend.layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])
@section('dashboard', 'active')
@section('content')
    <section class="menu_sec">
        <div class="container">
            <div class="heading_box">
                <div class="menu-icon">
                    <div class="mt-5">
                       <div class="cart_item_img">
                        <img src="{{ asset('assets/images/cart.png') }}" class="img-fluid" alt="" >
                       </div>
                    </div>
                </div>
                <h2><u>Cart</u></h2>
            </div>
            <div class="row">
                <div class="col-12">
                    @if (isset($fetchCartItem) && count($fetchCartItem) > 0)
                        @php
                            $totalItemPrice = 0; // Initialize totalItemPrice here
                        @endphp
                        @foreach ($fetchCartItem as $key => $data)
                            {{-- @dd( $data) --}}
                            <div class="cart_item item" data-id="{{ $data->id }}">
                                <div class="cartitem_box">
                                    <div class="menusm_name">
                                        <h4>{{ $data->types->name }}</h4>
                                        <input type="hidden" class="itemPrice" value="{{ $data->types->price }}">
                                        <div>
                                            <i class="fa-solid fa-indian-rupee-sign"></i>
                                            <span class="item_price">
                                                {{ $data->types->price }}
                                            </span>
                                        </div>
                                        <div class="menus_right_incriment">
                                            <button class="decrease decrease_qty">-</button>
                                            <input type="hidden" name="categoryType[]"
                                                value="{{ $data->types->categorys->id }}">
                                            <input type="hidden" name="itemType[]" value="{{ $data->id }}">
                                            <button type="text" name="itemQty[]" class="itemQty btn btn-info"
                                                value="{{ $data->qty ?? '' }}">{{ $data->qty ?? '' }}</button>
                                            <button class="increase increase_qty">+</button>
                                        </div>
                                        <div>
                                            <i class="fa-solid fa-indian-rupee-sign"></i>
                                            <span class="item_price">
                                                {{ $data->total_price ?? $data->types->price }}
                                            </span>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0)" data-uuid="{{ $data->id }}" data-table="carts"
                                                class=" deleteData"><i class="fa-regular fa-trash-can"
                                                    aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        {{-- <div class="price_sec">
                                            <div class="total_price">
                                                <h6>Total Price:
                                                    {{ $data->total_price ?? $data->types->price }}
                                                </h6>
                                            </div>
                                            <div class="menus_right_button d-flex justify-content-end">
                                                <a href="{{ route('order.dalivery-address.list') }}">
                                                    <button type="button" class="place_order">Place
                                                        Order</button>
                                                </a>
                                            </div>
                                        </div> --}}
                                        @php
                                            $totalItemPrice += $data->total_price ?? $data->types->price;
                                        @endphp
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="price_sec">
                            <div class="total_price">
                            </div>
                            <div class="menus_right_button d-flex justify-content-end">
                                <a href="{{ route('order.dalivery-address.list') }}">
                                    <button type="button" class="place_order">Place
                                        Order</button>
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="col-8 cart_empty_item">
                            <p class="item_empty">!Your Cart Is Empty</p>
                        </div>
                    @endif
    </section>
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
