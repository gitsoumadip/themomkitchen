@extends('user.layouts.app', ['isSidebar' => true, 'isNavbar' => true, 'isFooter' => true])
@section('dashboard', 'active')
@section('content')
    <div class="dashboard_mainsec">
        <!-- statistical information -->
        <h3 class="heading_title">Statistical Information</h3>
        <div class="stats_box row">
            {{-- <div class="col-lg-4 col-md-4 col-12">
                <div class="statsb_single">
                    <div class="statright_box">
                        <img src="{{ asset('assets/images/statistical_clinicsicon.png') }}" class="img-fluid" alt="" />
                    </div>
                    <div class="statmain_box">
                        <h3>Clinics</h3>
                        <div class="weekbox">
                            <p>100 +</p>
                            <h6 class="text-success">
                                <span><img src="{{ asset('assets/images/up-green.svg') }}" alt="" /></span>45%
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <div class="statsb_single">
                    <div class="statright_box">
                        <img src="{{ asset('assets/images/healthicons_doctor-icon.png') }}" class="img-fluid"
                            alt="" />
                    </div>
                    <div class="statmain_box">
                        <h3>Doctors</h3>
                        <div class="weekbox">
                            <p>100 +</p>
                            <h6 class="text-success">
                                <span><img src="{{ asset('assets/images/up-green.svg') }}" alt="" /></span>45%
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <div class="statsb_single">
                    <div class="statright_box">
                        <img src="{{ asset('assets/images/mingcute_user-icon.png') }}" class="img-fluid" alt="" />
                    </div>
                    <div class="statmain_box">
                        <h3>App Users</h3>
                        <div class="weekbox">
                            <p>100 +</p>
                            <h6 class="text-danger">
                                <span><img src="{{ asset('assets/images/up-green.svg') }}" alt="" /></span>45%
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <div class="statsb_single">
                    <div class="statright_box">
                        <img src="{{ asset('assets/images/guidance_care-staff-area.png') }}" class="img-fluid"
                            alt="" />
                    </div>
                    <div class="statmain_box">
                        <h3>Staffs</h3>
                        <div class="weekbox">
                            <p>100 +</p>
                            <h6 class="text-success">
                                <span><img src="{{ asset('assets/images/up-green.svg') }}" alt="" /></span>45%
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <div class="statsb_single">
                    <div class="statright_box">
                        <img src="{{ asset('assets/images/Bookings_icon.png') }}" class="img-fluid" alt="" />
                    </div>
                    <div class="statmain_box">
                        <h3>Bookings</h3>
                        <div class="weekbox">
                            <p>100 +</p>
                            <h6 class="text-success">
                                <span><img src="{{ asset('assets/images/up-green.svg') }}" alt="" /></span>45%
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <div class="statsb_single">
                    <div class="statright_box">
                        <img src="{{ asset('assets/images/grommet-icons_transaction.png') }}" class="img-fluid"
                            alt="" />
                    </div>
                    <div class="statmain_box">
                        <h3>Transactions</h3>
                        <div class="weekbox">
                            <p>100 +</p>
                            <h6 class="text-success">
                                <span><img src="{{ asset('assets/images/up-green.svg') }}" alt="" /></span>45%
                            </h6>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
