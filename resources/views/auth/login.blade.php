@extends('layouts.main')
@section('title', 'Login')
@section('Styles')
    <!--begin::Page Custom Styles(used by this page)-->
    <link href="{{ asset('assets/css/pages/login/classic/login-4.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('SideMenu')
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
            <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat"
                style="background-image: url({{ asset('assets/media/bg/bg-3.jpg') }});">
                <div class="login-form text-center p-7 position-relative overflow-hidden">
                    <!--begin::Login Header-->
                    <div class="d-flex flex-center mb-15">
                        <a href="#">
                            <img src="{{ asset('assets/media/logos/battle-rap-logo.png') }}" class="max-h-75px"
                                alt="" />
                        </a>
                    </div>
                    <!--end::Login Header-->
                    <!--begin::Login Sign in form-->
                    <div class="login-signin">
                        <div class="mb-20">
                            <h3>Sign In To Admin</h3>
                            <div class="text-muted font-weight-bold">Enter your details to login to your account:</div>
                        </div>
                        <form method="POST" action="{{ route('login') }}" class="form" id="kt_login_signin_form">
                            @csrf
                            <div class="form-group mb-5">
                                <input
                                    class="form-control @error('email') is-invalid @enderror h-auto form-control-solid py-4 px-8"
                                    type="text" placeholder="Email" name="email" autocomplete="off" />
                                @if ($errors->has('email'))
                                    <div class="fv-plugins-message-container">
                                        <div data-field="email" data-validator="notEmpty" class="fv-help-block">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group mb-5">
                                <input
                                    class="form-control  @error('password') is-invalid @enderror h-auto form-control-solid py-4 px-8"
                                    type="password" placeholder="Password" name="password" />
                                @if ($errors->has('password'))
                                    @error('password')
                                        <div class="fv-plugins-message-container">
                                            <div data-field="password" data-validator="notEmpty" class="fv-help-block">
                                                {{ $message }}
                                            </div>
                                        </div>
                                    @enderror
                                @endif
                            </div>
                            <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
                                <div class="checkbox-inline">
                                    <label class="checkbox m-0 text-muted">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} />
                                        <span></span>Remember me</label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" id="kt_login_forgot"
                                        class="text-muted text-hover-primary">Forget
                                        Password ?</a>
                                @endif
                            </div>
                            <button type="submit" id="kt_login_signin_submit"
                                class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">Sign In</button>
                        </form>
                        <div class="mt-10">
                            <span class="opacity-70 mr-4">Don't have an account yet?</span>
                            <a href="{{ route('register') }}" id="kt_login_signup"
                                class="text-muted text-hover-primary font-weight-bold">Sign Up!</a>
                        </div>
                    </div>
                    <!--end::Login Sign in form-->

                </div>
            </div>
        </div>
        <!--end::Login-->
    </div>
@endsection
{{-- @section('Scripts')
    <script src="{{ asset('assets/js/pages/custom/login/login-general.js') }}"></script>
@endsection --}}
