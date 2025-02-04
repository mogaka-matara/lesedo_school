@extends('admin.auth.master')
@section('title', 'Login')
@section('content')

<div class="main-wrapper">

    <div class="container-fuild">
        <div class="w-100 overflow-hidden position-relative flex-wrap d-block vh-100">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login-background position-relative d-lg-flex align-items-center justify-content-center d-lg-block d-none flex-wrap vh-100 overflowy-auto">
                        <div>
                            <img src="{{asset('backend/assets/img/authentication/authentication-04.jpg')}}" alt="Img">
                        </div>
                        <div class="authen-overlay-item  w-100 p-4">
                            <h4 class="text-white mb-3">What's New on Preskool !!!</h4>
                            <div
                                class="d-flex align-items-center flex-row mb-3 justify-content-between p-3 br-5 gap-3 card">
                                <div>
                                    <h6>Summer Vacation Holiday Homework</h6>
                                    <p class="mb-0 text-truncate">The school will remain closed from April 20th to June...</p>
                                </div>
                                <a href="javascript:void(0);"><i class="ti ti-chevrons-right"></i></a>
                            </div>
                            <div
                                class="d-flex align-items-center flex-row mb-3 justify-content-between p-3 br-5 gap-3 card">
                                <div>
                                    <h6>New Academic Session Admission Start(2024-25)</h6>
                                    <p class="mb-0 text-truncate">An academic term is a portion of an academic year, the time ....
                                    </p>
                                </div>
                                <a href="javascript:void(0);"><i class="ti ti-chevrons-right"></i></a>
                            </div>
                            <div
                                class="d-flex align-items-center flex-row mb-3 justify-content-between p-3 br-5 gap-3 card">
                                <div>
                                    <h6>Date sheet Final Exam Nursery to Sr.Kg</h6>
                                    <p class="mb-0 text-truncate">Dear Parents, As the final examination for the session 2024-25
                                        is ...</p>
                                </div>
                                <a href="javascript:void(0);"><i class="ti ti-chevrons-right"></i></a>
                            </div>
                            <div
                                class="d-flex align-items-center flex-row mb-3 justify-content-between p-3 br-5 gap-3 card">
                                <div>
                                    <h6>Annual Day Function</h6>
                                    <p class="mb-0 text-truncate">Annual functions provide a platform for students to showcase
                                        their...</p>
                                </div>
                                <a href="javascript:void(0);"><i class="ti ti-chevrons-right"></i></a>
                            </div>
                            <div
                                class="d-flex align-items-center flex-row mb-0 justify-content-between p-3 br-5 gap-3 card">
                                <div>
                                    <h6>Summer Vacation Holiday Homework</h6>
                                    <p class="mb-0 text-truncate">The school will remain closed from April 20th to June 15th for
                                        summer...</p>
                                </div>
                                <a href="javascript:void(0);"><i class="ti ti-chevrons-right"></i></a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="row justify-content-center align-items-center vh-100 overflow-auto flex-wrap ">
                        <div class="col-md-8 mx-auto p-4">
                            <form action="{{route('login')}}" method="POST">
                                <div>
                                    <div class=" mx-auto mb-5 text-center">
                                        <img src="{{asset('backend/assets/img/authentication/authentication-logo.svg')}}"
                                             class="img-fluid" alt="Logo">
                                    </div>
                                    <div class="card">
                                        <div class="card-body p-4">
                                            <div class=" mb-4">
                                                <h2 class="mb-2">Welcome</h2>
                                                <p class="mb-0">Please enter your details to sign in</p>
                                            </div>
                                                @csrf
                                            <div class="mb-3 ">
                                                <label class="form-label">Email Address</label>
                                                <div class="input-icon mb-3 position-relative">
														<span class="input-icon-addon"><i class="ti ti-mail"></i></span>
                                                    <input type="email" name="email" id="email"  value="{{old('email')}}" class="form-control" required autofocus autocomplete="email">
                                                </div>
                                                <label class="form-label">Password</label>
                                                <div class="pass-group">
                                                    <input type="password" name="password" id="password" class="pass-input form-control" required autocomplete="current-password">
                                                    <span class="ti toggle-password ti-eye-off"></span>
                                                </div>
                                            </div>
                                            <div class="form-wrap form-wrap-checkbox mb-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="form-check form-check-md mb-0">
                                                        <input class="form-check-input mt-0" type="checkbox">
                                                    </div>
                                                    <p class="ms-1 mb-0 ">Remember Me</p>
                                                </div>
                                                <div class="text-end ">
                                                    @if (Route::has('password.request'))
                                                    <a href="{{ route('password.request') }}" class="link-danger">Forgot Password?</a>
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-primary w-100">Sign In</button>
                                            </div>
                                            <div class="text-center">
                                                <h6 class="fw-normal text-dark mb-0">Don’t have an account? <a
                                                        href="{{route('register')}}" class="hover-a "> Create Account</a>
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
