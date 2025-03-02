@extends('admin.auth.master')
@section('title', 'Mail Verification')
@section('content')

    <div class="main-wrapper">

        <div class="container-fuild">
            <div class="login-wrapper w-100 overflow-hidden position-relative flex-wrap d-block vh-100">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="login-background position-relative d-lg-flex align-items-center justify-content-center d-lg-block d-none flex-wrap vh-100 overflowy-auto">
                            <div>
                                <img src="{{asset('backend/assets/img/authentication/authentication-04.jpg')}}" alt="Img">
                            </div>
                            <div class="authen-overlay-item  w-100 p-4">
                                @include('admin.layouts.clock')


                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="row justify-content-center align-items-center vh-100 overflow-auto flex-wrap ">
                            <div class="col-md-9 mx-auto p-4">
                                    <div>
                                        <div class=" mx-auto mb-5 text-center">
                                            <img src="{{asset('backend/assets/img/authentication/authentication-logo.svg')}}"
                                                 class="img-fluid" alt="Logo">
                                        </div>
                                        <div class="card">
                                            <div class="card-body p-4">
                                                <div class=" mb-3">
                                                    <h2 class="mb-2 text-center">Verify your Email</h2>
                                                    <p class="mb-0 text-center">We've sent a link to your  email <a href="{{auth()->user()->email}}" class="__cf_email__"></a>. Please follow the link inside to continue</p>
                                                </div>
                                                @if (session('status') == 'verification-link-sent')
                                                    <div class="alert alert-success" id="successMessage">
                                                        {{ session('status') }}
                                                    </div>
                                                @endif
                                                <div class="text-center mb-3">
                                                    <form method="POST" action="{{ route('logout') }}">
                                                        @csrf
                                                    <h6 class="fw-normal text-dark mb-0">Didn’t receive an email?
                                                        <button type="submit" class="hover-a "> Logout</button>
                                                    </h6>
                                                    </form>
                                                </div>
                                                <form method="POST" action="{{ route('verification.send') }}">
                                                    @csrf
                                                <button type="submit" class="btn btn-primary w-100">Resend The Link</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="mt-5 text-center">
                                            <p class="mb-0 ">Copyright &copy; {{date('Y')}} - Lesedi School</p>
                                        </div>
                                    </div>
                            </div>

                        </div>
                    </div>
                </div>



            </div>
        </div>

    </div>

@endsection
