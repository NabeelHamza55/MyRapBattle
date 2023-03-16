@extends('layouts.main')
@section('title', 'Signup')
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
                    <!--begin::Login Sign up form-->
                    <div class="login-signup">
                        <div class="mb-20">
                            <h3>Sign Up</h3>
                            <div class="text-muted font-weight-bold">Enter your details to create your account</div>
                        </div>
                        <form method="POST" action="{{ route('register') }}" class="form">
                            @csrf
                            <div class="form-group mb-5">
                                <input
                                    class="form-control @error('name') is-invalid @enderror h-auto form-control-solid py-4 px-8"
                                    type="text" placeholder="Fullname" name="name" />
                                @if ($errors->has('name'))
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                            <div class="form-group mb-5">
                                <input
                                    class="form-control @error('email') is-invalid @enderror h-auto form-control-solid py-4 px-8"
                                    type="text" placeholder="Email" name="email" autocomplete="off" />
                                @if ($errors->has('email'))
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                            <div class="form-group mb-5">
                                <input
                                    class="form-control @error('password') is-invalid @enderror h-auto form-control-solid py-4 px-8"
                                    type="password" placeholder="Password" name="password" />
                                @if ($errors->has('password'))
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                            <div class="form-group mb-5">
                                <input
                                    class="form-control @error('password_confirmation') is-invalid @enderror h-auto form-control-solid py-4 px-8"
                                    type="password" placeholder="Confirm Password" name="password_confirmation" />
                                @if ($errors->has('password_confirmation'))
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                            <div class="form-group mb-5 text-left">
                                <div class="checkbox-inline">
                                    <label class="checkbox m-0">
                                        <input type="checkbox" class="@error('agree') is-invalid @enderror" name="agree" />
                                        <span></span>I Agree the
                                        <a href="#" class="font-weight-bold ml-1">terms and conditions</a>.</label>
                                </div>
                                @if ($errors->has('agree'))
                                    @error('agree')
                                        <div class="fv-plugins-message-container">
                                            <div data-field="agree" data-validator="notEmpty" class="fv-help-block">
                                                {{ $message }}
                                            </div>
                                        </div>
                                    @enderror
                                @endif
                                <div class="form-text text-muted text-center"></div>
                            </div>
                            <div class="form-group d-flex flex-wrap flex-center mt-10">
                                <button type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">Sign
                                    Up</button>
                                <a href="{{ route('login') }}"
                                    class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-2">Cancel</a>
                            </div>
                        </form>
                    </div>
                    <!--end::Login Sign up form-->

                </div>
            </div>
        </div>
        <!--end::Login-->
    </div>
@endsection
{{-- @section('Scripts')
    <script src="{{ asset('assets/js/pages/custom/login/login-general.js') }}"></script>
@endsection --}}
