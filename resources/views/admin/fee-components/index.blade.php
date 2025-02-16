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
                        <a href="classes.html#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_class"><i
                                class="ti ti-square-rounded-plus-filled me-2"></i>Add Term</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Guardians List -->
            <div class="card">
                <div class="card-body p-0 py-3">

                    {{ $dataTable->table() }}

                </div>
            </div>
            <!-- /Guardians List -->

        </div>
    </div>
    <!-- /Page Wrapper -->

    <!-- Add Classes -->
    <div class="modal fade" id="add_class">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Term</h4>
                    <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal"
                            aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <form action="{{route('fee-component.store')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Select Grade</label>
                                    <select name="grade_id" id="grade_id" class="form-control">
                                        <option value="">Select</option>
                                    @foreach($grades as $grade)
                                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Select Term</label>
                                    <select name="term_id" id="term_id" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($terms as $term)
                                            <option value="{{ $term->id }}">{{ $term->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tuition Fee</label>
                                    <input type="text" name="tuition_fee" id="tuition_fee" class="form-control" >
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Lunch Fee</label>
                                    <input type="text" name="lunch_fee" id="lunch_fee" class="form-control" >
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tea Fee</label>
                                    <input type="text" name="tea_fee" id="tea_fee" class="form-control">
                                </div>

                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</a>
                        <button type="submit" class="btn btn-primary">Add Term</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Add Classes -->

    <!-- View Classes -->
    <div class="modal fade" id="view_class">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex align-items-center">
                        <h4 class="modal-title">Class Details</h4>
                        <span class="badge badge-soft-success ms-2"><i class="ti ti-circle-filled me-1 fs-5"></i>Active</span>
                    </div>
                    <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal"
                            aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <form action="classes.html">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="class-detail-info">
                                    <p>Class Name</p>
                                    <span>III</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="class-detail-info">
                                    <p>Section</p>
                                    <span>A</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="class-detail-info">
                                    <p>No of Subjects</p>
                                    <span>05</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="class-detail-info">
                                    <p>No of Students</p>
                                    <span>25</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /View Classes -->


@endsection


@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

