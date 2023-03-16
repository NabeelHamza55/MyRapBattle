@extends('layouts.main')
@section('title', 'Forget Password')
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
                    {{-- <div class="d-flex flex-center mb-15">
                        <a href="#">
                            <strong>
                                <h1>{{ config('app.name') }}</h1>
                            </strong>
                             <img src="{{ asset('assets/media/logos/logo-letter-13.png') }}" class="max-h-75px"
                                alt="" />
                        </a>
                    </div> --}}
                    <!--end::Login Header-->


                    <!--begin::Login forgot password form-->
                    <div class="login-forgot">
                        <div class="mb-20">
                            <h3>Reset Your Password</h3>
                            <div class="text-muted font-weight-bold">Enter your new password</div>
                        </div>
                        <form class="form" id="kt_login_forgot_form" method="post"
                            action="{{ route('password.update') }}">
                            @csrf
                            <div class="form-group mb-10">
                                <input class="form-control form-control-solid h-auto py-4 px-8" type="hidden" name="token"
                                    value="{{ $token }}">
                                <br>
                                <input
                                    class="form-control @error('email') is-invalid @enderror form-control-solid h-auto py-4 px-8"
                                    type="hidden" placeholder="Email" name="email" autocomplete="off"
                                    value="{{ $email ?? old('email') }}" />
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
                            <div class="form-group mb-10">
                                <input
                                    class="form-control @error('password') is-invalid @enderror form-control-solid h-auto py-4 px-8"
                                    type="password" placeholder="Password" name="password" autocomplete="off" />
                                @if ($errors->has('password'))
                                    <div class="fv-plugins-message-container">
                                        <div data-field="password" data-validator="notEmpty" class="fv-help-block">
                                            @error('password')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group mb-10">
                                <input
                                    class="form-control @error('password_confirmation') is-invalid @enderror form-control-solid h-auto py-4 px-8"
                                    type="password" placeholder="Confirm Password" name="password_confirmation"
                                    autocomplete="off" />
                                @if ($errors->has('password_confirmation'))
                                    <div class="fv-plugins-message-container">
                                        <div data-field="password_confirmation" data-validator="notEmpty"
                                            class="fv-help-block">
                                            @error('password_confirmation')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group d-flex flex-wrap flex-center mt-10">
                                <button id="kt_login_forgot_submit"
                                    class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">Submit</button>
                                <a href="{{ route('login') }}" id="kt_login_forgot_cancel"
                                    class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-2">Cancel</a>
                            </div>
                        </form>
                    </div>
                    <!--end::Login forgot password form-->

                </div>
            </div>
        </div>
        <!--end::Login-->
    </div>
@endsection
{{-- @section('Scripts')
    <script src="{{ asset('assets/js/pages/custom/login/login-general.js') }}"></script>
@endsection --}}
