@extends('layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])
@section('category', 'active')
@section('content')
    <div class="dashboard_mainsec">
        <!-- company Details -->
        <div class="companydetails_head">
            <h3 class="heading_title">
                Menu
            </h3>
            <div class="backwardright">
                <a href="{{ route('admin.setting.checkout.list') }}"><i class="fa fa-backward"></i></a>
            </div>
        </div>
        <div class="company_profiles card-body">
            <form action="{{ route('admin.setting.checkout.add') }}" method="post" enctype="multipart/form-data">
                @csrf
                {{-- <input type="hidden" name="uuid" id="uuid" value="{{ $data->id ?? '' }}"> --}}
                <div class="row">
                    <div class="col-lg-12 col-md-12 ">
                        <div class="doctor-details-style clinicsheading_title">
                            Menu
                        </div>
                    </div>
                    <div class="col-md-4 adfilter-single">
                        <label for="gst_restaurant">GST And Restaurant Charge</label>
                        <input type="text" class="form-control" name="gst_restaurant" id="gst_restaurant"
                            placeholder="Enter Type Name." value="{{ old('gst_restaurant', $data->gst_restaurant ?? '') }}">
                        @error('gst_restaurant')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 adfilter-single">
                        <label for="delivery_patner_km">Delivery KM</label>
                        <input type="text" class="form-control" name="delivery_patner_km" id="delivery_patner_km"
                            placeholder="Enter Type Name."
                            value="{{ old('delivery_patner_km', $data->delivery_patner_km ?? '') }}">
                        @error('delivery_patner_km')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 adfilter-single">
                        <label for="delivery_patner_fee">Delivery Partner fee</label>
                        <input type="text" class="form-control" name="delivery_patner_fee"
                            id="delivery_patner_fee"delivery_patner_fee placeholder="Enter Type Name."
                            value="{{ old('delivery_patner_fee', $data->delivery_patner_fee ?? '') }}">
                        @error('delivery_patner_fee')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4 adfilter-single">
                        <label for="packing_charge">Packing Charge</label>
                        <input type="text" class="form-control" name="packing_charge" id="packing_charge"
                            placeholder="Enter Type Name." value="{{ old('packing_charge', $data->packing_charge ?? '') }}">
                        @error('packing_charge')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-book" value="submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#itemId').multiselect({
                includeSelectAllOption: true,
            });
        });
    </script>
@endpush
