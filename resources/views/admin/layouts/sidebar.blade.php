<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li>
                    <a href="javascript:void(0);" class="d-flex align-items-center border bg-white rounded p-2 mb-4">
                        <img src="{{asset('backend/assets/img/icons/global-img.svg')}}" class="avatar avatar-md img-fluid rounded" alt="Profile">
                        <span class="text-dark ms-2 fw-normal">Lesedi Academy</span>
                    </a>
                </li>
            </ul>
            <ul>
                <li>
                    <h6 class="submenu-hdr"><span>Main</span></h6>
                    <ul>
                        <li class=""><a href="{{route('dashboard')}}" {{ setActive(['dashboard']) }}"><i class="ti ti-layout-dashboard"></i><span>Dashboard</span></a></li>

                    </ul>
                </li>

                <li>
                    <h6 class="submenu-hdr"><span>Academic</span></h6>
                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);" class="submenu-title {{ setActive(['grade']) }}">
                                <i class="ti ti-school"></i><span>Classes</span><span class="menu-arrow"></span>
                            </a>
                            <ul class="submenu-list" style="{{ isSubmenuOpen(['grade']) ? 'display: block;' : 'display: none;' }}">
                                <li><a href="{{route('grade.index')}}" class="menu-item {{ setActive(['grade']) }}">All Classes</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);" class="submenu-title {{ setActive(['term']) }}">
                                <i class="ti ti-school-bell"></i><span>School Terms</span><span class="menu-arrow"></span>
                            </a>
                            <ul class="submenu-list" style="{{ isSubmenuOpen(['term']) ? 'display: block;' : 'display: none;' }}">
                                <li><a href="{{route('term.index')}}" class="menu-item {{ setActive(['term']) }}">All Terms</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);" class="submenu-title {{ setActive(['academic-year']) }}">
                                <i class="ti ti-calendar"></i><span>Academic Year</span><span class="menu-arrow"></span>
                            </a>
                            <ul class="submenu-list" style="{{ isSubmenuOpen(['academic-year']) ? 'display: block;' : 'display: none;' }}">
                                <li><a href="{{route('academic-year.index')}}" class="menu-item {{ setActive(['academic-year']) }}">All Academic Years</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li>
                    <h6 class="submenu-hdr"><span>Peoples</span></h6>
                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);" class="submenu-title {{ setActive(['student', 'promotion']) }}">
                                <i class="ti ti-school"></i><span>Students</span><span class="menu-arrow"></span>
                            </a>
                            <ul class="submenu-list" style="{{ isSubmenuOpen(['student', 'promotion']) ? 'display: block;' : 'display: none;' }}">
                                <li><a href="{{ route('student.index') }}" class="menu-item {{ setActive(['student']) }}">All Students</a></li>
                                <li><a href="#" class="menu-item">Student List</a></li>
                                <li><a href="#" class="menu-item">Student Details</a></li>
                                <li><a href="{{ route('promotion.index') }}" class="menu-item {{ setActive(['promotion']) }}">Student Promotion</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li>
                    <h6 class="submenu-hdr"><span>Accounts</span></h6>
                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);" class="submenu-title {{ setActive(['fee-component', 'fees']) }}">
                                <i class="ti ti-school"></i><span>School Fees</span><span class="menu-arrow"></span>
                            </a>
                            <ul class="submenu-list" style="{{ isSubmenuOpen(['fee-component', 'fees']) ? 'display: block;' : 'display: none;' }}">
                                <li><a href="{{route('fee-component.index')}}" class="menu-item {{ setActive(['fee-component']) }}">All Fee Components</a></li>
                                <li><a href="{{route('fees.index')}}" class="menu-item {{ setActive(['fees']) }}">Fee Collection</a></li>
                                <li><a href="student-promotion.html" class="menu-item">Student Promotion</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li>
                    <h6 class="submenu-hdr"><span>Management</span></h6>
                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);" class="submenu-title {{ setActive(['library']) }}">
                                <i class="ti ti-school"></i><span>Library</span><span class="menu-arrow"></span>
                            </a>
                            <ul class="submenu-list" style="{{ isSubmenuOpen(['library']) ? 'display: block;' : 'display: none;' }}">
                                <li><a href="{{route('library.index')}}" class="menu-item {{ setActive(['library']) }}">All Books</a></li>
                                <li><a href="" class="menu-item {{ setActive(['']) }}">Add Book</a></li>
                                <li><a href="{{route('all.subjects')}}" class="menu-item {{ setActive(['all.subjects']) }}">All Book Subjects</a></li>
                                <li><a href="{{route('borrowedBooks')}}" class="menu-item {{ setActive(['borrowedBooks']) }}">All Borrowed Books</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
