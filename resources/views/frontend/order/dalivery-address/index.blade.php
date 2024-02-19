@extends('frontend.layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])
@section('dashboard', 'active')
@section('content')
    <section class="menu_sec">
        <div class="container">
            <div class="heading_box">
                {{-- <div class="menu-icon"><img src="{{ asset('assets/images/cart.png') }}" class="img-fluid" alt=""
                        width="180px" height="150px">
                </div> --}}
                <h2><u>Shipping</u></h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-starters" role="tabpanel"
                            aria-labelledby="pills-starters-tab">
                            <div class="menutab_con">
                                <div class="row">
                                    {{-- @dd($isFetch) --}}
                                    <form action="{{ route('item.order') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @if (isset($isFetch) && count($isFetch) > 0)
                                            @forelse ($isFetch as $key => $data)
                                                <div class="col-md-8">
                                                    <div class="menu_singlebox item" data-id="{{ $data->id }}">
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
                                                <p>!Your Cart Is Empty</p>
                                            @endforelse

                                            @forelse ($fetchCartItem as $key => $item)
                                                <div class="col-md-8">
                                                    <div class="menu_singlebox item" data-id="{{ $item->id }}">
                                                        <div class="menus_left">
                                                            <img src="assets/images/food1.jpg" class="img-fluid"
                                                                alt="">
                                                        </div>
                                                        <div class="menus_middle">
                                                            <h4>{{ $item->types->name }}</h4>
                                                            @foreach ($item->types->items as $val)
                                                                {{ $val->name }},
                                                            @endforeach
                                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                                                Expedita,
                                                                atque.</p>
                                                        </div>
                                                        <div class="menus_right_incriment">
                                                            <button class="decrease decrease_qty">-</button>
                                                            <input type="hidden" name="categoryType[]"
                                                                value="{{ $item->types->categorys->id }}">
                                                            <input type="hidden" name="itemType[]"
                                                                value="{{ $item->types->id }}">
                                                            <input type="text" name="itemQty[]"
                                                                id="itemQty_{{ $item->id }}" class="itemQty"
                                                                value="{{ $item->qty ?? '' }}">
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
                                                @if (isset($isFetch) && count($isFetch) > 0)
                                                    <button type="submit" class="place_order">Place Order</button></a>
                                                @else
                                                    <a href="{{ route('menu') }}"> <button type="button"
                                                            class="place_order">Place Order</button></a>
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
                // alert(itemContainer)
                var itemId = itemContainer.data('id');
                var change = $(this).hasClass('increase') ? 1 : -1;
                updateQuantity(itemId, change, itemContainer);
            });

            function updateQuantity(itemId, change, itemContainer) {
                var currentVal = parseInt(itemContainer.find(".itemQty").val());
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
    </script>
@endpush
