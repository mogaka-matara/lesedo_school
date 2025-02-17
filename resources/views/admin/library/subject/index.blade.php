@extends('admin.layouts.master')
@section('title', 'All Subjects')

@section('content')


    <div class="page-wrapper">
        <div class="content">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between mb-3">
                <div class="my-auto mb-2">
                    <h3 class="page-title mb-1">Subject List</h3>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">Subjects </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Subjects</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
                    <div class="mb-2">
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_class"><i
                                class="ti ti-square-rounded-plus-filled me-2"></i>Add Subject</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Guardians List -->


            {{ $dataTable->table() }}


            <!-- /Guardians List -->

        </div>
    </div>
    <!-- /Page Wrapper -->

    <!-- Add Classes -->
    <div class="modal fade" id="add_class">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Subject</h4>
                    <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal"
                            aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <form action="{{route('store.subject')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Subject Name</label>
                                    <input type="text" name="name" id="name" class="form-control" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</a>
                        <button type="submit" class="btn btn-primary">Add Subject</button>
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

