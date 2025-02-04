<div class="header">

    <!-- Logo -->
    <div class="header-left active">
        <a href="{{route('dashboard')}}" class="logo logo-normal">
            <img src="{{asset('backend/assets/img/logo.svg')}}" alt="Logo">
        </a>
        <a href="{{route('dashboard')}}" class="logo-small">
            <img src="a{{asset('backend/ssets/img/logo-small.svg')}}" alt="Logo">
        </a>
        <a href="{{route('dashboard')}}" class="dark-logo">
            <img src="{{asset('backend/assets/img/logo-dark.svg')}}" alt="Logo">
        </a>
        <a id="toggle_btn" href="javascript:void(0);">
            <i class="ti ti-menu-deep"></i>
        </a>
    </div>
    <!-- /Logo -->

    <a id="mobile_btn" class="mobile_btn" href="{{route('dashboard')}}">
				<span class="bar-icon">
					<span></span>
					<span></span>
					<span></span>
				</span>
    </a>

    <div class="header-user">
        <div class="nav user-menu">

            <!-- Search -->
            <div class="nav-item nav-search-inputs me-auto">
                <div class="top-nav-search">
                    <a href="javascript:void(0);" class="responsive-search">
                        <i class="fa fa-search"></i>
                    </a>
                    <form action="index.html#" class="dropdown">
                        <div class="searchinputs" id="dropdownMenuClickable">
                            <input type="text" placeholder="Search">
                            <div class="search-addon">
                                <button type="submit"><i class="ti ti-command"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /Search -->

            <div class="d-flex align-items-center">
                <div class="dropdown me-2">
                    <a href="index.html#" class="btn btn-outline-light fw-normal bg-white d-flex align-items-center p-2"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ti ti-calendar-due me-1"></i>Academic Year : 2024 / 2025
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">
                            Academic Year : 2023 / 2024
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">
                            Academic Year : 2022 / 2023
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">
                            Academic Year : 2021 / 2022
                        </a>
                    </div>
                </div>
                <div class="pe-1">
                    <div class="dropdown">
                        <a href="index.html#" class="btn btn-outline-light bg-white btn-icon me-1"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-square-rounded-plus"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right border shadow-sm dropdown-md">
                            <div class="p-3 border-bottom">
                                <h5>Add New</h5>
                            </div>
                            <div class="p-3 pb-0">
                                <div class="row gx-2">
                                    <div class="col-12">
                                        <a href="#"
                                           class="d-block bg-primary-transparent ronded p-2 text-center mb-3 class-hover">
                                            <div class="avatar avatar-lg mb-2">
														<span
                                                            class="d-inline-flex align-items-center justify-content-center w-100 h-100 bg-primary rounded-circle"><i
                                                                class="ti ti-school"></i></span>
                                            </div>
                                            <p class="text-dark">Students</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
{{--                <div class="pe-1">--}}
{{--                    <a href="index.html#" id="dark-mode-toggle"--}}
{{--                       class="dark-mode-toggle activate btn btn-outline-light bg-white btn-icon me-1">--}}
{{--                        <i class="ti ti-moon"></i>--}}
{{--                    </a>--}}
{{--                    <a href="index.html#" id="light-mode-toggle"--}}
{{--                       class="dark-mode-toggle btn btn-outline-light bg-white btn-icon me-1">--}}
{{--                        <i class="ti ti-brightness-up"></i>--}}
{{--                    </a>--}}
{{--                </div>--}}

                <div class="dropdown ms-1">
                    <a href="javascript:void(0);" class="dropdown-toggle d-flex align-items-center"
                       data-bs-toggle="dropdown">
								<span class="avatar avatar-md rounded">
									<img src="{{asset('backend/assets/img/profiles/avatar-27.jpg')}}" alt="Img" class="img-fluid">
								</span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="d-block">
                            <div class="d-flex align-items-center p-2">
										<span class="avatar avatar-md me-2 online avatar-rounded">
											<img src="{{asset('backend/assets/img/profiles/avatar-27.jpg')}}" alt="img">
										</span>
                                <div>
                                    <h6 class="">{{auth()->user()->name}}</h6>
                                    <p class="text-primary mb-0">Administrator</p>
                                </div>
                            </div>
                            <hr class="m-0">
                            <a class="dropdown-item d-inline-flex align-items-center p-2" href="profile.html">
                                <i class="ti ti-user-circle me-2"></i>My Profile</a>
                            <a class="dropdown-item d-inline-flex align-items-center p-2"
                               href="profile-settings.html"><i class="ti ti-settings me-2"></i>Settings</a>
                            <hr class="m-0">
                            <form action="{{route('logout')}}" method="POST">
                                @csrf
                            <a class="dropdown-item d-inline-flex align-items-center p-2" href="javascript:void(0)" onclick="event.preventDefault(); this.closest('form').submit();"><i
                                    class="ti ti-login me-2"></i>Logout</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="dropdown mobile-user-menu">
        <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
           aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-end">
            <a class="dropdown-item" href="profile.html">My Profile</a>
            <a class="dropdown-item" href="profile-settings.html">Settings</a>
            <form action="{{route('logout')}}" method="POST" >
                @csrf
                <a class="dropdown-item" href="javascript:void(0)" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
            </form>
        </div>
    </div>
    <!-- /Mobile Menu -->

</div>
