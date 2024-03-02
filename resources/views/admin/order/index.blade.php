@extends('layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])
@section('category', 'active')
@push('styles')
@endpush
@section('content')
    <div class="dashboard_mainsec">
        <!-- company Details -->
        <div class="companydetails_head">
            <h3 class="heading_title">
                Order
            </h3>
            <div class="comdehead_right">
                {{-- <div class="search_box">
                <form action="">
                    <input type="search" name="" class="form-control" placeholder="Search">
                    <button class="search_btn">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div> --}}
                <a href="{{ route('admin.menu.add') }}" class="btn btn-primary">Add Menu </a>
            </div>
        </div>
    </div>
    @php
        $toDate = date('Y-m-d');
    @endphp
    {{-- {{ $toDate }} --}}
    <!-- company details -->
    <div class="company_profiles card-body">
        <div class="table-responsive adminbio_table">
            {{-- <table class="table table-hover dataTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"> Types</th>
                        <th scope="col"> Item</th>
                        <th scope="col"> Item</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($fetchOrder as $key => $data)
                        @if ($toDate == createAt($data->created_at, 'date'))
                        @dd($data->toArray())
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $data->order_no }}</td>
                                <td>{{ $data->total_price }}</td>
                                <td>{{ $data->order_details }}</td>
                                <td>{{ $data->order_details->pulak }}</td>
                            </tr>
                        @endif
                    @empty
                    @endforelse
                </tbody>
            </table> --}}
            <table border="1">
                <thead>
                    <tr>
                        <th>Order No</th>
                        <th>User ID</th>
                        <th>Quantity</th>
                        <th>GST Restaurant Charge</th>
                        <th>Delivery Charge</th>
                        <th>Packing Charge</th>
                        <th>Total Price</th>
                        <th>Is Active</th>
                        <th>Order Details</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($fetchOrder as $key => $data)
                        @if ($toDate == createAt($data->created_at, 'date'))
                            <tr>
                                <td>{{ $data['order_no'] }}</td>
                                <td>{{ $data->users->name }}</td>
                                <td>{{ $data['qty'] }}</td>
                                <td>{{ $data['gst_restaurant_charge'] }}</td>
                                <td>{{ $data['delivery_charge'] }}</td>
                                <td>{{ $data['packing_charge'] }}</td>
                                <td>{{ $data['total_price'] }}</td>
                                {{-- <td>{{ $data['is_active'] }}</td> --}}
                                <td>
                                    <select name="status" id="status" class="orderstatusChange status"
                                        data-uid={{ $data['id'] }}>
                                        <option value="">---Status---</option>
                                        <option value="0" {{ $data->is_active == 0 ? 'selected' : '' }}>pending
                                        </option>
                                        <option value="1" {{ $data->is_active == 1 ? 'selected' : '' }}>approve
                                        </option>
                                        <option value="2" {{ $data->is_active == 2 ? 'selected' : '' }}>cancel
                                        </option>
                                        <option value="3" {{ $data->is_active == 3 ? 'selected' : '' }}>process
                                        </option>
                                        <option value="4" {{ $data->is_active == 4 ? 'selected' : '' }}>shipment
                                        </option>
                                        <option value="5" {{ $data->is_active == 5 ? 'selected' : '' }}>complete
                                        </option>
                                    </select>

                                </td>
                                {{-- 0:pending,1:aprove,2:cancel,3:process,4:shipment,5:complet	 --}}
                                <td>
                                    @if (isset($data->orderDetails) && count($data->orderDetails) > 0)
                                        <table border="1">
                                            <thead>
                                                <tr>
                                                    {{-- <th>Order ID</th> --}}
                                                    <th>Category</th>
                                                    <th>Type ID</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Total Price</th>
                                                    {{-- <th>Is Active</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data->orderDetails as $orderDetail)
                                                    <tr>
                                                        <td>{{ $orderDetail->types->categorys->name }}</td>
                                                        <td>{{ $orderDetail->types->name }}</td>
                                                        <td>{{ $orderDetail['qty'] }}</td>
                                                        <td>{{ $orderDetail['price'] }}</td>
                                                        <td>{{ $orderDetail['total_price'] }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection
@push('scripts')
    <!-- Include SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">

    <!-- Include SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        var baseUrl = APP_URL + "/";
        $(document).ready(function() {
            $('.orderstatusChange').on('change', function() {
                var $this = $(this);
                var status = $this.val();
                var userid = $this.data('uid');
                // alert(status)

                Swal.fire({
                    title: "Are you sure you want to change the status?",
                    text: "The status will be changed to " + status,
                    icon: "warning",
                    allowOutsideClick: false,
                    showCancelButton: true,
                    confirmButtonColor: "#1D9300",
                    cancelButtonColor: "#F90F0F",
                    confirmButtonText: "Yes, change it!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url: baseUrl + 'ajax/update/order-status',
                            type: 'POST',
                            data: {
                                status: status,
                                userid: userid
                            },
                            dataType: 'json',
                            success: function(response) {
                                var successMessage = response.status ?
                                    "Status Updated!" :
                                    "We are facing some technical issue now.";
                                var icon = response.status ? "success" : "error";

                                Swal.fire({
                                    icon: icon,
                                    title: successMessage,
                                    showConfirmButton: false,
                                    timer: 1500,
                                });

                                // Toggle classes and visibility based on parent structure
                                var $parent = $this.closest($this.parent().hasClass(
                                        "inTable") ? "tr.manage-enable" :
                                    "div.manage-data");
                                var divRight = $parent.find("div.dot-right");

                                $parent.toggleClass("block-disable", response.status);
                                divRight.toggleClass("pe-none", response.status);

                                if (!response.status) {
                                    $this.prop("checked", !$this.prop("checked"));
                                }
                            },
                            error: function(response) {
                                Swal.fire({
                                    icon: "error",
                                    title: "We are facing some technical issue now. Please try again after some time",
                                    showConfirmButton: false,
                                    timer: 1500,
                                });
                                $this.prop("checked", !$this.prop("checked"));
                            },
                        });
                    } else {
                        $this.prop("checked", !$this.prop("checked"));
                    }
                });
            });

        });
    </script>
@endpush


{{-- 
0 => array:15 [▼
"id" => 10
"order_no" => "ORD65dbb3df8d58a"
"delivery_addresses_id" => 1
"user_id" => 4
"qty" => "2"
"gst_restaurant_charge" => 5
"delivery_charge" => 275
"packing_charge" => 10
"total_price" => 296
"is_active" => 0
"created_at" => "2024-02-25T21:40:47.000000Z"
"updated_at" => "2024-02-25T21:40:47.000000Z"
"types" => null
"users" => array:21 [▶]
"order_details" => array:2 [▼
  0 => array:10 [▼
    "id" => 6
    "order_id" => 10
    "user_id" => 4
    "type_id" => 2
    "qty" => "32"
    "price" => 5
    "total_price" => 5
    "is_active" => 0
    "created_at" => "2024-02-25T21:40:47.000000Z"
    "updated_at" => "2024-02-29T21:26:15.000000Z"
  ]
  1 => array:10 [▼
    "id" => 7
    "order_id" => 10
    "user_id" => 4
    "type_id" => 3
    "qty" => "23"
    "price" => 3
    "total_price" => 6
    "is_active" => 0
    "created_at" => "2024-02-25T21:40:47.000000Z"
    "updated_at" => "2024-02-29T21:26:15.000000Z"
  ]
]
] --}}
