@extends('admin.auth.master')
@section('title', 'Register')
@section('content')

    <div class="main-wrapper">

        <div class="container-fuild">
            <div class="login-wrapper w-100 overflow-hidden position-relative flex-wrap d-block vh-100">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="login-background position-relative d-lg-flex align-items-center justify-content-center d-lg-block d-none flex-wrap vh-100 overflowy-auto">
                            <div>
                                <img src="assets/img/authentication/authentication-01.jpg" alt="Img">
                            </div>
                            <div class="authen-overlay-item  w-100 p-4">
                                @include('admin.layouts.clock')


                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="row justify-content-center align-items-center vh-100 overflow-auto flex-wrap ">
                            <div class="col-md-8 mx-auto p-4">
                                <form action="{{route('register')}}" method="POST">
                                    @csrf
                                    <div>
                                        <div class=" mx-auto mb-5 text-center">
                                            <img src="{{asset('backend/assets/img/authentication/authentication-logo.svg')}}"
                                                 class="img-fluid" alt="Logo">
                                        </div>
                                        <div class="card">
                                            <div class="card-body p-4">
                                                <div class=" mb-4">
                                                    <h2 class="mb-2">Register</h2>
                                                    <p class="mb-0">Please enter your details to sign up</p>
                                                </div>
                                                <div class="mt-4">
                                                    <div class="mb-3 ">
                                                        <label class="form-label">Name</label>
                                                        <div class="input-icon mb-3 position-relative"><span class="input-icon-addon"><i class="ti ti-user"></i></span>
                                                            <input type="text" name="name" id="name"  value="{{old('name')}}" class="form-control">
                                                        </div>
                                                        <label class="form-label">Email Address</label>
                                                        <div class="input-icon mb-3 position-relative"><span class="input-icon-addon"><i class="ti ti-mail"></i></span>
                                                            <input type="email" id="email" name="email" value="{{old('email')}}" class="form-control">
                                                        </div>
                                                        <label class="form-label">Password</label>
                                                        <div class="pass-group mb-3">
                                                            <input type="password" name="password" id="password" class="pass-input form-control">
                                                            <span class="ti toggle-password ti-eye-off"></span>
                                                        </div>
                                                        <label class="form-label">Confirm Password</label>
                                                        <div class="pass-group">
                                                            <input type="password" name="password_confirmation" id="password_confirmation" class="pass-input form-control">
                                                            <span class="ti toggle-password ti-eye-off"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                                                </div>
                                                <div class="text-center">
                                                    <h6 class="fw-normal text-dark mb-0">Already have an account?<a  href="{{route('login')}}" class="hover-a "> Sign In</a>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-5 text-center">
                                            <p class="mb-0 ">Copyright &copy; {{date('Y')}} - Lesedi Academy</p>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>



            </div>
        </div>

    </div>

@endsection
