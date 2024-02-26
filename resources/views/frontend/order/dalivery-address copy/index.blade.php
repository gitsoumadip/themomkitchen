@extends('frontend.layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])

@section('dashboard', 'active')

@section('content')
    <section class="menus section-p1" id="menu">
        <h2>Add Delivery Address</h2>
        <p>Your Mom's touch in every bite</p>
        <div class="menu-container">
            {{-- Your delivery address form or content goes here --}}
        </div>
    </section>

    <section>
        <a href="{{ route('order.dalivery-address.add-edit') }}"> Add Delivery Address</a>
        <form action="{{ route('item.order') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                {{-- Displaying available shipping addresses --}}
                <div class="col">
                    @foreach ($isFetch as $data)
                        <div>
                            <input type="radio" name="shippingAddress" id="shippingAddress_{{ $data->id }}"
                                value="{{ $data->id }}">
                            <label for="shippingAddress_{{ $data->id }}">
                                <p>Name</p>{{ $data->name }}
                                <p>Address</p>{{ $data->address }}
                                <p>Phone</p>{{ $data->phone }}
                                <p>Pincode</p>{{ $data->pincode }}
                                <p>City</p>{{ $data->city }}
                            </label>
                        </div>
                    @endforeach
                </div>

                {{-- Displaying items in the cart for order --}}
                <div class="col">
                    {{-- @dd($fetchCartItem) --}}
                    @foreach ($fetchCartItem as $data)
                        <div class="menu-pro item" data-id="{{ $data->id }}">
                            <img src="{{ $data->img ? asset('uploads/' . $data->img) : asset('assets/Image/chhola.jpg') }}"
                                alt="" width="100px" height="100px">
                            <div class="des">
                                <h5>{{ $data->types->name }}</h5>
                                @foreach ($data->types->items as $val)
                                    <p>{{ $val->name }}</p>
                                @endforeach
                                <div class="star"></div>
                                <button class="decrease">-</button>
                                <input type="hidden" name="categoryType[]" value="{{ $data->types->categorys->id }}">
                                <input type="hidden" name="itemType[]" value="{{ $data->types->id }}">
                                <input type="text" name="itemQty[]" id="itemQty_{{ $data->qty }}" class="itemQty"
                                    value="{{ $data->qty ?? '' }}">
                                <button class="increase">+</button>
                                <h4>Rs {{ $data->qty }}</h4>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <h4><button type="submit">Submit</button></h4>
        </form>
    </section>
@endsection

@push('scripts')
    {{-- Include any additional scripts if required --}}
@endpush
