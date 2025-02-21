@extends('admin.layouts.master')
@section('title', 'All Grades')

@section('content')



    <div class="page-wrapper">
        <div class="content content-two">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between mb-3">
                <div class="my-auto mb-2">
                    <h3 class="mb-1">Issue Uniform</h3>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="students.html">All Issued Uniforms</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Issue Uniform </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">

                <div class="col-md-12">

                    <form action="{{route('issue-uniform.store')}}" method="POST">
                        @csrf

                        <!-- Personal Information -->
                        <div class="card">
                            <div class="card-header bg-light">
                                <div class="d-flex align-items-center">
										<span class="bg-white avatar avatar-sm me-2 text-gray-7 flex-shrink-0">
											<i class="ti ti-info-square-rounded fs-16"></i>
										</span>
                                    <h4 class="text-dark">Uniform Issue Details </h4>
                                </div>
                            </div>
                            <div class="card-body pb-1">
                                <div class="row">

                                    <div class=" col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Student Name</label>
                                            <select class="select" name="student_id">
                                                <option>Select</option>
                                                @foreach($students as $student)
                                                    <option value="{{$student->id}}">{{ $student->first_name }} {{ $student->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class=" col-md-6">
                                        @foreach ($uniformComponents as $component)
                                            <div class="mb-3">
                                                <label class="form-label">{{ $component->name }} (Price: Ksh: {{ $component->price }}, Stock: {{ $component->quantity }})</label>
                                                <input type="number" name="components[{{ $component->id }}]" class="form-control" min="0" value="0">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Personal Information -->
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




