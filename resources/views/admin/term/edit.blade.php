@extends('admin.layouts.master')
@section('title', 'All Grades')

@section('content')


    <div class="page-wrapper">
        <div class="content">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between mb-3">
                <div class="my-auto mb-2">
                    <h3 class="page-title mb-1">Classes List</h3>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="index.html">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">Classes </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Classes</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
                    <div class="pe-1 mb-2">
                        <a href="classes.html#" class="btn btn-outline-light bg-white btn-icon me-1" data-bs-toggle="tooltip"
                           data-bs-placement="top" aria-label="Refresh" data-bs-original-title="Refresh">
                            <i class="ti ti-refresh"></i>
                        </a>
                    </div>
                    <div class="pe-1 mb-2">
                        <button type="button" class="btn btn-outline-light bg-white btn-icon me-1"
                                data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Print"
                                data-bs-original-title="Print">
                            <i class="ti ti-printer"></i>
                        </button>
                    </div>
                    <div class="dropdown me-2 mb-2">
                        <a href="javascript:void(0);"
                           class="dropdown-toggle btn btn-light fw-medium d-inline-flex align-items-center"
                           data-bs-toggle="dropdown">
                            <i class="ti ti-file-export me-2"></i>Export
                        </a>
                        <ul class="dropdown-menu  dropdown-menu-end p-3">
                            <li>
                                <a href="javascript:void(0);" class="dropdown-item rounded-1"><i
                                        class="ti ti-file-type-pdf me-1"></i>Export as PDF</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="dropdown-item rounded-1"><i
                                        class="ti ti-file-type-xls me-1"></i>Export as Excel </a>
                            </li>
                        </ul>
                    </div>
                    <div class="mb-2">
                        <a href="{{route('grade.index')}}" class="btn btn-primary"><i class="fa fa-arrow-alt-circle-left"></i> Back All Grades</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Guardians List -->
                    <div class="row">
                        <div class=" d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <h5 class="card-title">Update Term</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{route('term.update', $term->id)}}" method="POST">

                                        @csrf
                                        @method('PUT')
                                        <div class="row mb-3">
                                            <label class=" form-label">Term Name</label>
                                            <div class="">
                                                <input type="text" name="name" id="name" value="{{$term->name}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Start Date</label>
                                            <div class="input-icon position-relative">
                                                <span class="input-icon-addon"><i class="ti ti-calendar"></i></span>
                                                <input type="date" name="start_date" class="form-control" required value="{{$term->start_date}}">
                                            </div>
                                            <small class="text-muted">Only the month and day (MM-DD) will be stored.</small>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Start Date</label>
                                            <div class="input-icon position-relative">
                                                <span class="input-icon-addon"><i class="ti ti-calendar"></i></span>
                                                <input type="date" name="end_date" class="form-control" required value="{{$term->end_date}}">
                                            </div>
                                            <small class="text-muted">Only the month and day (MM-DD) will be stored.</small>
                                        </div>
                                        <div class="text-start">
                                            <button type="submit" class="btn btn-primary">Update Term</button>
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



