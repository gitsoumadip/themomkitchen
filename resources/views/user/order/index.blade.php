@extends('user.layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])
@section('dashboard', 'active')
@section('content')
    <div class="dashboard_mainsec">
        <!-- statistical information -->
        <h3 class="heading_title">My Order</h3>
        <div class="stats_box row">
            <h2>My Order</h2>
            <table>
                <thead>
                    <th>Order No</th>
                    <th>type</th>
                    <th>delivery_addresses</th>
                    <th>qty</th>
                    <th>delivery_charge</th>
                    <th>gst_restaurant_charge</th>
                    <th>user_id</th>
                    <th>packing_charge</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($fetchOrder as $key => $value)
                        @if ($value->created_at->format('Y-m-d') == \Carbon\Carbon::now()->format('Y-m-d'))
                            <tr>
                                <td> {{ $value->order_no }}</d>
                                <td> {{ $value->type_id }}</d>
                                <td>{{ $value->delivery_addresses_id }}</td>
                                <td>{{ $value->qty }}</td>
                                <td>{{ $value->delivery_charge }}</td>
                                <td>{{ $value->gst_restaurant_charge }}</td>
                                <td>{{ $value->user_id }}</td>
                                <td>{{ $value->packing_charge }}</td>
                                <td>{{ $value->total_price }}</td>
                                <td></td>
                            </tr>
                        @endif
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
