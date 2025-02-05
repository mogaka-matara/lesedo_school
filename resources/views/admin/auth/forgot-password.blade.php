@extends('admin.auth.master')
@section('title', 'Forgot Password')
@section('content')

    <div class="main-wrapper">

        <div class="container-fuild">
            <div class="login-wrapper w-100 overflow-hidden position-relative flex-wrap d-block vh-100">
                <div class="row">
                    <div class="col-lg-6">
                        <div
                            class="login-background position-relative d-lg-flex align-items-center justify-content-center d-lg-block d-none flex-wrap vh-100 overflowy-auto">
                            <div>
                                <img src="assets/img/authentication/authentication-03.jpg" alt="Img">
                            </div>
                            <div class="authen-overlay-item  w-100 p-4">
                                @include('admin.layouts.clock')

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="row justify-content-center align-items-center vh-100 overflow-auto flex-wrap ">
                            <div class="col-md-8 mx-auto p-4">
                                <form action="{{route('password.email')}}" method="POST">
                                    @csrf
                                    <div>
                                        <div class=" mx-auto mb-5 text-center">
                                            <img src="{{asset('backend/assets/img/authentication/authentication-logo.svg')}}"
                                                 class="img-fluid" alt="Logo">
                                        </div>
                                        <div class="card">
                                            <div class="card-body p-4">
                                                <div class=" mb-4">
                                                    <h2 class="mb-2">Forgot Password?</h2>
                                                    <p class="mb-0">If you forgot your password, well, then we’ll email you instructions to reset your password.</p>
                                                </div>
                                                @if(session('status'))
                                                    <div class="alert alert-success" id="successMessage">
                                                        {{ session('status') }}
                                                    </div>
                                                @endif
                                                <div class="mb-3 ">
                                                    <label class="form-label">Email Address</label>
                                                    <div class="input-icon mb-3 position-relative">
														<span class="input-icon-addon"><i class="ti ti-mail"></i></span>
                                                        <input type="email" name="email" id="email" value="" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <button type="submit" class="btn btn-primary w-100">Email Password Reset Link</button>
                                                </div>
                                                <div class="text-center">
                                                    <h6 class="fw-normal text-dark mb-0">Return to <a href="{{route('login')}}" class="hover-a "> Login</a>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-5 text-center">
                                            <p class="mb-0 ">Copyright &copy; 2024 - Preskool</p>
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

@push('scripts')
    <script>
        setTimeout(function() {
            let successMessage = document.getElementById('successMessage');
            if (successMessage) {
                successMessage.style.transition = "opacity 0.5s ease";
                successMessage.style.opacity = "0";
                setTimeout(() => successMessage.remove(), 500);
            }
        }, 5000);
    </script>
@endpush
