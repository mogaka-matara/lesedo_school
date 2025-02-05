<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li>
                    <a href="javascript:void(0);"
                       class="d-flex align-items-center border bg-white rounded p-2 mb-4">
                        <img src="{{asset('backend/assets/img/icons/global-img.svg')}}" class="avatar avatar-md img-fluid rounded"
                             alt="Profile">
                        <span class="text-dark ms-2 fw-normal">Lesedi Academy</span>
                    </a>
                </li>
            </ul>
            <ul>
                <li>
                    <h6 class="submenu-hdr"><span>Main</span></h6>
                    <ul>
                        <li class="submenu"><a href="{{route('dashboard')}}" class=" active"><i class="ti ti-layout-dashboard"></i><span>Dashboard</span></a>
                        </li>
                    </ul>
                </li>


                <li>
                    <h6 class="submenu-hdr"><span>Academic</span></h6>
                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i class="ti ti-school-bell"></i><span>Classes</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{route('grade.index')}}">All Classes</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
