@extends('admin.layouts.master')
@section('title', 'Edit Student Details')

@section('content')



    <div class="page-wrapper">
        <div class="content">
            <div class="row">

                <!-- Page Header -->
                <div class="col-md-12">
                    <div class="d-md-flex d-block align-items-center justify-content-between mb-3">
                        <div class="my-auto mb-2">
                            <h3 class="page-title mb-1">Student Details</h3>
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{route('student.index')}}">All Student</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Student Details</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="d-flex my-xl-auto right-content align-items-center  flex-wrap">
                            <a href="{{route('student.edit', $student->id)}}" class="btn btn-primary d-flex align-items-center mb-2"><i class="ti ti-edit-circle me-2"></i>Edit Student</a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

            </div>

            <div class="row">

                <!-- Student Information -->
                <div class="col-xxl-3 col-xl-4 theiaStickySidebar">
                    <div class="card border-white">
                        <div class="card-header">
                            <div class="d-flex align-items-center flex-wrap row-gap-3">
                                <div class="d-flex align-items-center justify-content-center avatar avatar-xxl border border-dashed me-2 flex-shrink-0 text-dark frames">
                                    <img src="assets/img/students/student-01.jpg" class="img-fluid" alt="img">
                                </div>
                                <div class="overflow-hidden">
                                    <span class="badge badge-soft-success d-inline-flex align-items-center mb-1"><i class="ti ti-circle-filled fs-5 me-1"></i>Active</span>
                                    <h5 class="mb-1 text-truncate">{{$student->first_name}} {{$student->last_name}}</h5>
                                    <p class="text-primary">{{$student->admission_no}}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Basic Information -->
                        <div class="card-body">
                            <h5 class="mb-3">Basic Information</h5>
                            <dl class="row mb-0">
                                <dt class="col-6 fw-medium text-dark mb-3">Grade</dt>
                                <dd class="col-6 mb-3">{{$student->grade->name}}</dd>
                                <dt class="col-6 fw-medium text-dark mb-3">Gender</dt>
                                <dd class="col-6 mb-3">{{$student->gender}}</dd>
                                <dt class="col-6 fw-medium text-dark mb-3">Date Of Birth</dt>
                                <dd class="col-6 mb-3">{{$student->date_of_birth}}</dd>
                                <dt class="col-6 fw-medium text-dark mb-3">Blood Group</dt>
                                <dd class="col-6 mb-3">Red</dd>
                                <dt class="col-6 fw-medium text-dark mb-3">Address</dt>
                                <dd class="col-6 mb-3">{{$student->address}}</dd>
                                <dt class="col-6 fw-medium text-dark mb-3">Caste</dt>
                                <dd class="col-6 mb-3">Catholic</dd>
                                <dt class="col-6 fw-medium text-dark mb-3">Category</dt>
                                <dd class="col-6 mb-3">OBC</dd>
                                <dt class="col-6 fw-medium text-dark mb-3">Mother tongue</dt>
                                <dd class="col-6 mb-3">English</dd>
                                <dt class="col-6 fw-medium text-dark mb-3">Language</dt>
                                <dd class="col-6 mb-3"><span class="badge badge-light text-dark me-2">English</span><span class="badge badge-light text-dark">Spanish</span></dd>
                            </dl>
                            <a href="student-details.html#" data-bs-toggle="modal" data-bs-target="#add_fees_collect"  class="btn btn-primary btn-sm w-100">Add Fees</a>
                        </div>
                        <!-- /Basic Information -->

                    </div>

                    <!-- Primary Contact Info -->
                    <div class="card border-white">
                        <div class="card-body">
                            <h5 class="mb-3">Primary Contact Info</h5>
                            <div class="d-flex align-items-center mb-3">
                                <span class="avatar avatar-md bg-light-300 rounded me-2 flex-shrink-0 text-default"><i class="ti ti-phone"></i></span>
                                <div>
                                    <span class="text-dark fw-medium mb-1">Phone Number</span>
                                    <p>{{$student->parent_contact}}</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="avatar avatar-md bg-light-300 rounded me-2 flex-shrink-0 text-default"><i class="ti ti-mail"></i></span>
                                <div>
                                    <span class="text-dark fw-medium mb-1">Email Address</span>
                                    <p>{{$student->parent_email}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Primary Contact Info -->


                    <!-- Transport Information -->
                    <div class="card border-white">
                        <div class="card-body pb-1">
                            <ul class="nav nav-tabs nav-tabs-bottom mb-3">
                                <li class="nav-item"><a class="nav-link active" href="student-details.html#hostel" data-bs-toggle="tab">Hostel</a></li>
                                <li class="nav-item"><a class="nav-link" href="student-details.html#transport" data-bs-toggle="tab">Transportation</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="hostel">
                                    <div class="d-flex align-items-center mb-3">
                                        <span class="avatar avatar-md bg-light-300 rounded me-2 flex-shrink-0 text-default"><i class="ti ti-building-fortress fs-16"></i></span>
                                        <div>
                                            <h6 class="fs-14 mb-1">HI-Hostel, Floor</h6>
                                            <p class="text-primary">Room No : 25</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="transport">
                                    <div class="d-flex align-items-center mb-3">
                                        <span class="avatar avatar-md bg-light-300 rounded me-2 flex-shrink-0 text-default"><i class="ti ti-bus fs-16"></i></span>
                                        <div>
                                            <span class="fs-12 mb-1">Route</span>
                                            <p class="text-dark">Newyork</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <span class="fs-12 mb-1">Bus Number</span>
                                                <p class="text-dark">AM 54548</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <span class="fs-12 mb-1">Pickup Point</span>
                                                <p class="text-dark">Cincinatti</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Transport Information -->

                </div>
                <!-- /Student Information -->

                <div class="col-xxl-9 col-xl-8">
                    <div class="row">
                        <div class="col-md-12">

                            <!-- List -->
                            <ul class="nav nav-tabs nav-tabs-bottom mb-4">
                                <li>
                                    <a href="student-details.html" class="nav-link active"><i class="ti ti-school me-2"></i>Student Details</a>
                                </li>

                                <li>
                                    <a href="student-fees.html" class="nav-link"><i class="ti ti-report-money me-2"></i>Fees</a>
                                </li>
                                <li>
                                    <a href="student-library.html" class="nav-link"><i class="ti ti-books me-2"></i>Library</a>
                                </li>
                            </ul>
                            <!-- /List -->

                            <!-- Parents Information -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>Parents/Guardian Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="border rounded p-3 pb-0 mb-3">
                                        <div class="row">
                                            <div class="col-sm-6 col-lg-4">
                                                <div class="d-flex align-items-center mb-3">
														<span class="avatar avatar-lg flex-shrink-0">
															<img src="assets/img/parents/parent-13.jpg" class="img-fluid rounded"  alt="img">
														</span>
                                                    <div class="ms-2 overflow-hidden">
                                                        <h6 class="text-truncate">{{$student->parent_name}}</h6>
                                                        <p class="text-primary">Father</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-lg-4">
                                                <div class="mb-3">
                                                    <p class="text-dark fw-medium mb-1">Phone</p>
                                                    <p>{{$student->parent_contact}}</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-lg-4">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="mb-3 overflow-hidden me-3">
                                                        <p class="text-dark fw-medium mb-1">Email</p>
                                                        <p class="text-truncate">{{$student->parent_email}}<</p>
                                                    </div>
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Print" data-bs-original-title="Reset Password" class="btn btn-dark btn-icon btn-sm mb-3"><i class="ti ti-lock-x"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border rounded p-3 pb-0">
                                        <div class="row">
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="d-flex align-items-center mb-3">
														<span class="avatar avatar-lg flex-shrink-0">
															<img src="assets/img/parents/parent-13.jpg" class="img-fluid rounded"  alt="img">
														</span>
                                                    <div class="ms-2 overflow-hidden">
                                                        <h6 class="text-truncate">{{$student->guardian_name}}<</h6>
                                                        <p class="text-primary">Gaurdian (Father)</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="mb-3">
                                                    <p class="text-dark fw-medium mb-1">Phone</p>
                                                    <p>{{$student->guardian_contact}}</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="mb-3 overflow-hidden me-3">
                                                        <p class="text-dark fw-medium mb-1">Email</p>
                                                        <p class="text-truncate">{{$student->email}}</p>
                                                    </div>
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Print" data-bs-original-title="Reset Password" class="btn btn-dark btn-icon btn-sm mb-3"><i class="ti ti-lock-x"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Parents Information -->

                        </div>

                        <!-- Documents -->
                        <div class="col-xxl-6 d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <h5>Documents</h5>
                                </div>
                                <div class="card-body">
                                    <div class="bg-light-300 border rounded d-flex align-items-center justify-content-between mb-3 p-2">
                                        <div class="d-flex align-items-center overflow-hidden">
                                            <span class="avatar avatar-md bg-white rounded flex-shrink-0 text-default"><i class="ti ti-pdf fs-15"></i></span>
                                            <div class="ms-2">
                                                <p class="text-truncate fw-medium text-dark">BirthCertificate.pdf</p>
                                            </div>
                                        </div>
                                        <a href="student-details.html#" class="btn btn-dark btn-icon btn-sm"><i class="ti ti-download"></i></a>
                                    </div>
                                    <div class="bg-light-300 border rounded d-flex align-items-center justify-content-between p-2">
                                        <div class="d-flex align-items-center overflow-hidden">
                                            <span class="avatar avatar-md bg-white rounded flex-shrink-0 text-default"><i class="ti ti-pdf fs-15"></i></span>
                                            <div class="ms-2">
                                                <p class="text-truncate fw-medium text-dark">Transfer Certificate.pdf</p>
                                            </div>
                                        </div>
                                        <a href="student-details.html#" class="btn btn-dark btn-icon btn-sm"><i class="ti ti-download"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Documents -->

                        <!-- Address -->
                        <div class="col-xxl-6 d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <h5>Address</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <span class="avatar avatar-md bg-light-300 rounded me-2 flex-shrink-0 text-default"><i class="ti ti-map-pin-up"></i></span>
                                        <div>
                                            <p class="text-dark fw-medium mb-1">Current Address</p>
                                            <p>3495 Red Hawk Road, Buffalo Lake, MN 55314</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-md bg-light-300 rounded me-2 flex-shrink-0 text-default"><i class="ti ti-map-pins"></i></span>
                                        <div>
                                            <p class="text-dark fw-medium mb-1">Permanent Address</p>
                                            <p>3495 Red Hawk Road, Buffalo Lake, MN 55314</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Address -->

                        <!-- Medical History -->
                        <div class="col-xxl-6 d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <h5>Medical History</h5>
                                </div>
                                <div class="card-body pb-1">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <p class="text-dark fw-medium mb-1">Known Allergies</p>
                                                <span class="badge bg-light text-dark">{{$student->medical_condition}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <p class="text-dark fw-medium mb-1">Medications</p>
                                                <p>-</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Medical History -->

                        <!-- Other Info -->
                        <div class="col-xxl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Other Info</h5>
                                </div>
                                <div class="card-body">
                                    <p>Depending on the specific needs of your organization or system, additional information may be collected or tracked. It's important to ensure that any data collected complies with privacy regulations and policies to protect students' sensitive information.</p>
                                </div>
                            </div>
                        </div>
                        <!-- /Other Info -->

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Add Fees Collect -->
    <div class="modal fade" id="add_fees_collect">
        <div class="modal-dialog modal-dialog-centered  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex align-items-center">
                        <h4 class="modal-title">Collect Fees</h4>
                        <spa class="badge badge-sm bg-primary ms-2">AD124556</span>
                    </div>
                    <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <form action="collect-fees.html">
                    <div class="modal-body">
                        <div class="bg-light-300 p-3 pb-0 rounded mb-4">
                            <div class="row align-items-center">
                                <div class="col-lg-3 col-md-6">
                                    <div class="d-flex align-items-center mb-3">
                                        <a href="student-details.html" class="avatar avatar-md me-2">
                                            <img src="assets/img/students/student-01.jpg" alt="img">
                                        </a>
                                        <a href="student-details.html" class="d-flex flex-column"><span class="text-dark">Janet</span>III, A</a>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="mb-3">
                                        <span class="fs-12 mb-1">Total Outstanding</span>
                                        <p class="text-dark">2000</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="mb-3">
                                        <span class="fs-12 mb-1">Last Date</span>
                                        <p class="text-dark">25 May 2024</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="mb-3">
											<span class="badge badge-soft-danger"><i
                                                    class="ti ti-circle-filled me-2"></i>Unpaid</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Fees Group</label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Class 1 General</option>
                                        <option>Monthly Fees</option>
                                        <option>Admission-Fees</option>
                                        <option>Class 1- I Installment</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Fees Type</label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Tuition Fees</option>
                                        <option>Monthly Fees</option>
                                        <option>Admission Fees</option>
                                        <option>Bus Fees</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Amount</label>
                                    <input type="text" class="form-control" placeholder="Enter Amout">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Collection Date</label>
                                    <div class="date-pic">
                                        <input type="text" class="form-control datetimepicker"
                                               placeholder="Select">
                                        <span class="cal-icon"><i class="ti ti-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Payment Type</label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Paytm</option>
                                        <option>Cash On Delivery</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Payment Reference No</label>
                                    <input type="text" class="form-control" placeholder="Enter Payment Reference No">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="status-title">
                                        <h5>Status</h5>
                                        <p>Change the Status by toggle </p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="switch-sm2">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-0">
                                    <label class="form-label">Notes</label>
                                    <textarea rows="4" class="form-control" placeholder="Add Notes"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="student-details.html#" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</a>
                        <button type="submit" class="btn btn-primary">Pay Fees</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Fees Collect -->

@endsection




