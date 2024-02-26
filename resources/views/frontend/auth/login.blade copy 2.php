@extends('frontend.layouts.app')
@push('styles')
@endpush
@section('content')
    <section class="login-sec">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-md-6">
                    <div class="login-secleft">
                        <div class="loginleft_logo">
                            <img src="assets/images/logo.svg" class="img-fluid" alt="">
                        </div>
                        <div class="loginleft_img">
                            <img src="assets/images/login-leftimg.svg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="login-secright">
                        <div class="login-rightbox">
                            <h3>Login User</h3>
                            <div class="line-around-flex"></div>
                            <form id="formAuthentication" class="mb-3" action="{{ route('user.login') }}" method="POST">
                                @csrf
                                <div class="single-login">
                                    <label class="login-label">Enter Phone Number</label>
                                    <input class="form-control" type="text" name="mobile_number" id="mobile_number"
                                        placeholder="Enter Phone Number">
                                    @error('mobile_number')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                {{-- <div class="single-login">
                                    <label class="login-label"> Username / Email ID</label>
                                    <input class="form-control" type="text" name="email" id="email"
                                        placeholder="Enter User Name or Email ID">
                                    @error('email')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="single-login">
                                    <label class="login-label"> Password</label>
                                    <input id="password-eye" type="password" placeholder="Password" class="form-control"
                                        name="password" value="">
                                    <span toggle="#password-eye" class="fa fa-fw fa-eye eye-icon toggle-eye"></span>
                                    @error('password')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div> --}}

                                <button class="btn btn-primary btn-effect btn-effect-arrow mt-4">
                                    Login
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        // login page password
        $(".toggle-eye").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
@endpush
