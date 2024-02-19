@extends('frontend.layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])
@section('dashboard', 'active')
@section('content')
    <section class="menus .section-p1 " id="menu">
        <h2>Add Delivery</h2>
        <p>Your Mom's touch in every bite</p>
        <div class="menu-container">
        </div>
    </section>

    <form action="{{ route('order.dalivery-address.add-edit') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="card">
                <div class="row">
                    <div class="col-12">
                        <div class="col-ml-4">
                            {{-- <label for="phone" class="">Name</label> --}}
                            <input type="text" name="name" id="name" placeholder="Name">
                        </div>
                        <div class="col-ml-4">
                            {{-- <label for="phone" class="">10-digit mobile number</label> --}}
                            <input type="text" class="" name="phone" required="" maxlength="10"
                                autocomplete="tel" tabindex="2" value="" placeholder="10-digit mobile number">
                        </div>
                        <div class="col-ml-4">
                            <input type="text" name="pincode" id="pincode" placeholder="Pincode">
                        </div>
                        <div class="col-ml-4">
                            <input type="text" name="locality" id="locality" placeholder="Locality">
                        </div>
                        <div class="col-ml-4">
                            <input type="text" name="address" id="address" placeholder="address">
                        </div>
                        <div class="col-ml-4">
                            <input type="text" name="city" id="city" placeholder="city">
                        </div>
                        <div class="col-ml-4">
                            <input type="text" name="state" id="state" placeholder="state">
                        </div>
                        <div class="col-ml-4">
                            <input type="text" name="landmark" id="landmark" placeholder="landmark">
                        </div>
                        <div class="col-ml-4">
                            <input type="text" name="alter_phone" id="alter_phone" placeholder="alter phone">
                        </div>
                        <div class="col-ml-4">
                            <label for="">Home</label>
                            <input type="radio" name="type" id="type" value="home">
                        </div>
                        <div class="col-ml-4">
                            <label for="">Office</label>
                            <input type="radio" name="type" id="type" value="office">
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit">Submit</button>
        </div>
    </form>
@endsection
@push('scripts')
@endpush
