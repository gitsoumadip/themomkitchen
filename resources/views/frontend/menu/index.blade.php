@extends('frontend.layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])
@section('dashboard', 'active')
@section('content')
<!-- menu sec -->
<section class="menu_sec">
    <div class="container">
        <div class="heading_box">
            <div class="menu-icon"><img src="{{ asset('assets/images/our-menu.png') }}" class="img-fluid" alt=""
                    width="200px" height="180px"></div>
            <h2><U>Our Menu</U></h2>
            {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis iure eos, magnam doloremque modi
                    reprehenderit porro. Ratione earum sequi dolor!</p> --}}
        </div>
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-starters-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-starters" type="button" role="tab" aria-controls="pills-starters"
                            aria-selected="true">Lunch <span><img src="{{ asset('assets/images/starters.png') }}"
                                    class="img-fluid" alt=""></span></button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-maindish-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-maindish" type="button" role="tab" aria-controls="pills-maindish"
                            aria-selected="false">Dinner <span><img src="{{ asset('assets/images/main.png') }}"
                                    class="img-fluid" alt=""></span></button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-starters" role="tabpanel"
                        aria-labelledby="pills-starters-tab">
                        <div class="menutab_con">
                            <div class="row">
                                @foreach ($fetchTypeList as $key => $data)
                                @if ($data->categorys->slug == 'lunch')
                                <div class="col-md-6">
                                    <div class="menu_singlebox">
                                        <div class="menus_left">
                                            <img src="{{ asset('uploads/' . $data->img) }}" class="img-fluid" alt="">
                                        </div>
                                        <div class="menus_middle">
                                            <h4>{{ $data->name }}</h4>
                                            <p>
                                                @foreach ($data->items as $item)
                                                {{ $item->name }},
                                                @endforeach
                                            </p>
                                            <p>{{ $data->description }}</p>
                                            <span class="item_price"> <i class="fa-solid fa-indian-rupee-sign">
                                                    {{ $data->price }}</i></span>
                                        </div>
                                        <div class="menus_right">
                                            @if (!empty(auth()->user()->id))
                                            <a href="#" class="addToCart add_cart" data-id="{{ $data->id }}"><i
                                                    class="fa-solid fa-cart-plus" style="color: #ffa800;"></i>Add To
                                                Cart</a>
                                            @else
                                            <a href="{{ route('user.login') }}" class="addToCart add_cart"><i
                                                    class="fa-solid fa-cart-plus" style="color: #ffa800;"></i>Add To
                                                Cart</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pills-maindish" role="tabpanel" aria-labelledby="pills-maindish-tab">
                        <div class="menutab_con">
                            <div class="row">
                                @foreach ($fetchTypeList as $key => $data)
                                @if ($data->categorys->slug == 'dinner')
                                <div class="col-md-6">
                                    <div class="menu_singlebox">
                                        <div class="menus_left">
                                            <img src="{{ asset('uploads/' . $data->img) }}" class="img-fluid" alt="">
                                        </div>
                                        <div class="menus_middle">
                                            <h4>{{ $data->name }}</h4>
                                            <p>
                                                @foreach ($data->items as $item)
                                                {{ $item->name }},
                                                @endforeach
                                            </p>
                                            <p>{{ $data->description }}</p>
                                            <span class="item_price"> <i class="fa-solid fa-indian-rupee-sign">
                                                    {{ $data->price }}</i></span>
                                        </div>
                                        <div class="menus_right">
                                            @if (!empty(auth()->user()->id))
                                            <a href="#" class="addToCart " data-id="{{ $data->id }}"><i
                                                    class="fa-solid fa-cart-plus" style="color: #ffa800;"></i></a>
                                            @else
                                            <a href="{{ route('user.login') }}" class="addToCart add_cart"><i
                                                    class="fa-solid fa-cart-plus" style="color: #ffa800;"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
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
$(document).on('click', '.addToCart', function() {
    let addtocart = $(this).attr('data-id');
    // alert(addtocart);
    // Example using jQuery
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{ route('cart.addToCart') }}",
        type: 'POST',
        data: {
            id: addtocart
        },
        success: function(response) {
            console.log(response);
            // alert('kjhgfdsdfghj');
        },
        error: function(xhr) {
            console.log(xhr.responseText);
        }
    });
})
</script>
@endpush