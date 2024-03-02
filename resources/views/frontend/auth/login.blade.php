@extends('frontend.layouts.app')
@push('styles')
<style>
.wrapper-login {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    /* background: #fff; */
    /* background: #041e42; */
    background: #48494b;
}

.form.login {
    background: #373434;
    position: absolute;
    left: 50%;
    bottom: -86%;
    transform: translateX(-50%);
    padding: 20px 140px;
    border-radius: 50%;
    width: calc(100% + 220px);
    height: 100%;
    transition: all 0.6s ease;

}

.wrapper-login.active .form.login {
    bottom: -9%;
    border-radius: 35%;
    box-shadow: 0 -5px 10px rgba(0, 0, 0, 0.1);
}


.box {
    height: 650px;
    position: relative;
    max-width: 450px;
    width: 100%;
    padding: 20px 30px 120px;
    border-radius: 12px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    background: #1f2127;
    overflow: hidden;
    margin-top: 110px;
}

.form h5 {
    font-size: 25px;
    text-align: center;
    color: #f6a204;
    font-weight: 600;
    cursor: pointer;

}

.form.login h5 {
    color: #f6a204;
    opacity: 1;

}

.box form {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-top: 80px;
}

form input {
    height: 60px;
    outline: none;
    border: none;
    padding: 0 15px;
    font-size: 16px;
    font-weight: 400;
    /* color: #333; */
    color: hsl(60, 11%, 98%);
    border-radius: 8px;
    background: #2f2f2e;
    border-color: #ffa800;
}

form .checkbox {
    display: flex;
    align-items: center;
    gap: 10px;
}

.form.login input {
    border: 1px solid #aaa;
}

.form.login input:focus {
    border: 0 1px 0 #ddd;
}

.checkbox input[type="checkbox"] {
    height: 16px;
    width: 16px;
    accent-color: #fff;
    cursor: pointer;

}

form a {
    color: #333;
    font-size: 10px;
    text-decoration: none;
}

form a:hover {


    text-decoration: underline;
}

form .checkbox label {
    cursor: pointer;
    color: #fff;
}

form input[type="submit"] {
    padding: none;
    font-size: 18px;
    font-weight: 400;
    cursor: pointer;
    margin-top: 15px;

}

.form.login input[type="submit"] {
    background: #050c1e;
    color: #fff;
    border: none;
}
</style>
@endpush
@section('content')
<section class="wrapper-login">
    <div class="box">
        <div class="form signup">
            <h5>Login</h5>
            <form id="formAuthentication" class="mb-3" action="{{ route('user.login') }}" method="POST">
                @csrf
                <input type="text" placeholder="Enter Your Phone Numbere" name="phone" id="phone" required />
                @error('phone')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <input type="password" placeholder="Password" name="password" id="password" required />
                @error('password')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <button class="btn btn-primary btn-effect btn-effect-arrow mt-4">
                    Login
                </button>
            </form>
        </div>
        <div class="form  login ">
            <h5>Signup</h5>
            <form id="formAuthentication" class="mb-3" action="{{ route('user.signup') }}" method="POST">
                @csrf
                <input type="text" placeholder="Full name" required name="name" id="name" />
                @error('name')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <input type="number" placeholder="Phone Number" required name="phone" id="phone" />
                @error('phone')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <input type="email" placeholder="Email address" required name="email" id="email" />
                @error('email')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <input type="password" placeholder="Password" required name="password" id="password" />
                @error('password')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                {{-- <div class="checkbox">
                        <input type="checkbox" id="signupCheck">
                        <label for="signupCheck">I accept all terms & conditions</label>
                    </div> --}}
                <button class="btn btn-primary btn-effect btn-effect-arrow mt-4">
                    Signup
                </button>
            </form>
        </div>


    </div>
</section>
@endsection
@push('scripts')
{{-- <script>
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
    </script> --}}
<script>
const wrapper = document.querySelector(".wrapper-login");
const signupHeader = document.querySelector(".signup h5");
const loginHeader = document.querySelector(".login h5");

loginHeader.addEventListener("click", () => {
    wrapper.classList.add("active");
});

signupHeader.addEventListener("click", () => {
    wrapper.classList.remove("active");
});
</script>
@endpush