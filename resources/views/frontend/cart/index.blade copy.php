@extends('frontend.layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])
@section('dashboard', 'active')
@section('content')
    <section class="menus .section-p1" id="menu">
        <h6>Cart</h6>

    </section>

    <!-- Custom js file link -->

    {{-- <form action="{{ route('item.order') }}" method="post" enctype="multipart/form-data">
        @csrf --}}
    @if (isset($fetchCartItem) && count($fetchCartItem) > 0)
        {{-- @dd($fetchCartItem) --}}
        <section class="menus .section-p1 " id="menu">
            <h2>Our Menus</h2>
            <p>Your Mom's touch in every bite</p>
            <div class="menu-container">
                @forelse ($fetchCartItem as $key => $data)
                    <div class="menu-pro item" data-id="{{ $data->id }}">
                        <img src="{{ $data->img ? asset('uploads/' . $data->img) : asset('assets/Image/chhola.jpg') }}"
                            alt="">
                        <div class="des">
                            <h5>{{ $data->types->name }}</h5>
                            @foreach ($data->types->items as $val)
                                <p>{{ $val->name }}</p>
                            @endforeach
                            <div class="star">
                            </div>
                            <button class="decrease">-</button>
                            <input type="hidden" name="categoryType[]" value="{{ $data->types->categorys->id }}">
                            <input type="hidden" name="itemType[]" value="{{ $data->id }}">
                                <input type="text" name="itemQty[]" id="itemQty_{{ $data->id }}" class="itemQty"
                                    value="{{ $data->qty ?? '' }}">
                            <button class="increase">+</button>
                            <h4>Rs{{ $data->qty }}</h4>
                        </div>
                    </div>
                @empty
                    <p>!Your Cart Is Empty</p>
                @endforelse
            </div>
        </section>
        <h2><a href="{{ route('order.dalivery-address.list') }}">Place Order</a></h2>
    @else
        <p>!Your Cart Is Empty</p>
    @endif
   
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $(".increase, .decrease").click(function() {
                var itemContainer = $(this).closest('.item');
                var itemId = itemContainer.data('id');
                var change = $(this).hasClass('increase') ? 1 : -1;
                updateQuantity(itemId, change, itemContainer);
                //     if(change!=0){
                // }else{
                //         window.location.reload();
                //     }

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
