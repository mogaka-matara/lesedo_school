@extends('admin.layouts.master')
@section('title', 'All Grades')

@section('content')


    <div class="page-wrapper">
        <div class="content">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between mb-3">
                <div class="my-auto mb-2">
                    <h3 class="page-title mb-1">Edit Academic Year</h3>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">Years </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Academic Year</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
                    <div class="mb-2">
                        <a href="{{route('grade.index')}}" class="btn btn-primary"><i class="fa fa-arrow-alt-circle-left"></i> Back To Academic Year</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Guardians List -->
                    <div class="row">
                        <div class=" d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <h5 class="card-title">Update Academic Year</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{route('grade.update', $academicYear->id)}}" method="POST">

                                        @csrf
                                        @method('PUT')
                                        <div class="row mb-3">
                                            <label class=" form-label">Term Name</label>
                                            <div class="">
                                                <input type="text" name="name" id="name" value="{{$academicYear->name}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Start Date</label>
                                            <div class="input-icon position-relative">
                                                <span class="input-icon-addon"><i class="ti ti-calendar"></i></span>
                                                <input type="date" name="start_date" class="form-control" required value="{{$academicYear->start_date}}">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Start Date</label>
                                            <div class="input-icon position-relative">
                                                <span class="input-icon-addon"><i class="ti ti-calendar"></i></span>
                                                <input type="date" name="end_date" class="form-control" required value="{{$academicYear->end_date}}">
                                            </div>
                                        </div>
                                        <div class="text-start">
                                            <button type="submit" class="btn btn-primary">Update Year</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
    <!-- /Page Wrapper -->

    <!-- Add Classes -->


@endsection



