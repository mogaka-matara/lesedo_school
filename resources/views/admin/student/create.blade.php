@extends('admin.layouts.master')
@section('title', 'All Grades')

@section('content')



    <div class="page-wrapper">
        <div class="content content-two">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between mb-3">
                <div class="my-auto mb-2">
                    <h3 class="mb-1">Add Student</h3>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="index.html">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="students.html">Students</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Add Student</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">

                <div class="col-md-12">

                    <form action="{{route('student.store')}}" method="POST">
                        @csrf

                        <!-- Personal Information -->
                        <div class="card">
                            <div class="card-header bg-light">
                                <div class="d-flex align-items-center">
										<span class="bg-white avatar avatar-sm me-2 text-gray-7 flex-shrink-0">
											<i class="ti ti-info-square-rounded fs-16"></i>
										</span>
                                    <h4 class="text-dark">Student Information</h4>
                                </div>
                            </div>
                            <div class="card-body pb-1">
                                <div class="row">

                                    <div class=" col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">First Name</label>
                                            <input type="text" name="first_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class=" col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Middle Name</label>
                                            <input type="text" name="middle_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class=" col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Last Name</label>
                                            <input type="text" name="last_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class=" col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Grade/Class</label>
                                            <select class="select" name="grade_id">
                                                <option>Select</option>
                                                @foreach($grades as $grade)
                                                <option value="{{$grade->id}}">{{ $grade->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class=" col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Term</label>
                                            <select class="select" name="term_id">
                                                <option>Select</option>
                                                @foreach($terms as $term)
                                                    <option value="{{$term->id}}">{{ $term->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class=" col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Gender</label>
                                            <select class="select" name="gender">
                                                <option>Select</option>
                                                @foreach($genders as $gender)
                                                    <option value="{{ $gender->value }}">{{ $gender->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class=" col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Medical Condition</label>
                                            <select class="select" name="medical_condition">
                                                <option>Select</option>
                                                    <option value="1">YES</option>
                                                    <option value="2">NO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class=" col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Date of Birth</label>
                                            <div class="input-icon position-relative">
													<span class="input-icon-addon"><i class="ti ti-calendar"></i></span>
                                                <input type="text" name="date_of_birth" class="form-control datetimepicker">
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">address</label>
                                            <input type="text" name="address" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Fee Status</label>
                                            <select class="select" name="status" disabled>
                                                <option value="Pending" selected>Pending</option>
                                                <option value="Full Paid" disabled>Full Paid</option>
                                            </select>
                                            <small class="text-muted">The status will automatically update to "Full Paid" when all fees are paid.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Personal Information -->

                        <!-- Parents & Guardian Information -->
                        <div class="card">
                            <div class="card-header bg-light">
                                <div class="d-flex align-items-center">
										<span class="bg-white avatar avatar-sm me-2 text-gray-7 flex-shrink-0">
											<i class="ti ti-user-shield fs-16"></i>
										</span>
                                    <h4 class="text-dark">Meals Package Optional Fields</h4>
                                </div>
                            </div>
                            <div class="card-body pb-0">
                                <div class="border-bottom mb-3">
                                    <div class="row">
                                        <div class=" col-md-6">
                                            <div class="mb-3">
                                                <input type="checkbox" name="opt_in_tea" class="form-check-input" id="optInTea">
                                                <label class="form-check-label" for="optInTea">Opt into Tea Fee ({{ $selectedTerm->tea_fee ?? 'N/A' }})</label>
                                            </div>
                                        </div>
                                        <div class=" col-md-6">
                                            <div class="mb-3">
                                                <input type="checkbox" name="opt_in_lunch" class="form-check-input" id="optInLunch">
                                                <label class="form-check-label" for="optInLunch">Opt into Lunch Fee ({{ $selectedTerm->lunch_fee ?? 'N/A' }})</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /Parents & Guardian Information -->

                        <!-- Parents & Guardian Information -->
                        <div class="card">
                            <div class="card-header bg-light">
                                <div class="d-flex align-items-center">
										<span class="bg-white avatar avatar-sm me-2 text-gray-7 flex-shrink-0">
											<i class="ti ti-user-shield fs-16"></i>
										</span>
                                    <h4 class="text-dark">Parents & Guardian Information</h4>
                                </div>
                            </div>
                            <div class="card-body pb-0">
                                <div class="border-bottom mb-3">
                                    <h5 class="mb-3">Information</h5>
                                    <div class="row">
                                        <div class=" col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Parent Name</label>
                                                <input type="text" name="parent_name" class="form-control">
                                            </div>
                                        </div>
                                        <div class=" col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="text" name="parent_email" class="form-control">
                                            </div>
                                        </div>
                                        <div class=" col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Phone Number</label>
                                                <input type="text" name="parent_contact" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /Parents & Guardian Information -->

                        <!-- Parents & Guardian Information -->
                        <div class="card">
                            <div class="card-header bg-light">
                                <div class="d-flex align-items-center">
										<span class="bg-white avatar avatar-sm me-2 text-gray-7 flex-shrink-0">
											<i class="ti ti-user-shield fs-16"></i>
										</span>
                                    <h4 class="text-dark"> Guardian Information</h4>
                                </div>
                            </div>
                            <div class="card-body pb-0">
                                <div class="border-bottom mb-3">
                                    <h5 class="mb-3">Information</h5>
                                    <div class="row">
                                        <div class=" col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Guardian Name</label>
                                                <input type="text" name="guardian_name" class="form-control">
                                            </div>
                                        </div>
                                        <div class=" col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="text" name="guardian_email" class="form-control">
                                            </div>
                                        </div>
                                        <div class=" col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Phone Number</label>
                                                <input type="text" name="guardian_contact" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /Parents & Guardian Information -->




                        <div class="text-end">
                            <button type="button" class="btn btn-light me-3">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add Student</button>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>


@endsection




