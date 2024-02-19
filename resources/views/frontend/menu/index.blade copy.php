@extends('frontend.layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])
@section('dashboard', 'active')
@section('content')
    <section class="menus .section-p1 " id="menu">
        <h2>Our Menus</h2>
        <p>Your Mom's touch in every bite</p>
        <div class="menu-container">

            @foreach ($fetchTypeList as $key => $data)
                {{-- @dd($data->toArray()) --}}
                <div class="menu-pro">
                    {{-- <img src="{{ asset('uploads/' . $data->img) }}" alt="" width="100px" height="100px"> --}}
                    <img src="{{ $data->img ? asset('uploads/' . $data->img) : asset('assets/Image/chhola.jpg') }}"
                        alt="" >
                    <div class="des">
                        <span>{{ $data->name }}</span>
                        <h5>{{ $data->description }}</h5>
                        <div class="star">
                        </div>
                        <h4>Rs{{ $data->price }}</h4>
                    </div>
                    {{-- <a href="{{ route('user.cart.add', $data->id) }}"><i class="fas fa-shopping-cart cart"></i></a> --}}
                    {{ auth()->user()->id ?? '' }}
                    @if (!empty(auth()->user()->id))
                        <a href="{{ route('cart') }}"class="addToCart" data-id="{{ $data->id }}"><i
                                class="fas fa-shopping-cart cart"></i></a>
                    @else
                        <a href="{{ route('login') }}"class="addToCart"><i class="fas fa-shopping-cart cart"></i></a>
                    @endif
                </div>
            @endforeach
        </div>
    </section>

    @if ($fetchAdditionalTypeList)
        <section class="menus .section-p1" id="menu">
            <h2>Additional Menus</h2>
            <div class="menu-container">
                @foreach ($fetchTypeList as $key => $data)
                    <div class="menu-pro">
                        <img src="{{ $data->img ? asset('uploads/' . $data->img) : asset('assets/Image/chhola.jpg') }}"
                            alt="">
                        <div class="des">
                            <span>{{ $data->name }}</span>
                            <h5>{{ $data->description }}</h5>
                            <div class="star">
                            </div>
                            <h4>Rs{{ $data->price }}</h4>
                        </div>
                        {{-- {{ auth()->user()->id }} --}}
                        @if (!empty(auth()->user()->id))
                            <a href="#"class="addToCart" data-id="{{ $data->id }}"><i
                                    class="fas fa-shopping-cart cart"></i></a>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>
    @endif
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
