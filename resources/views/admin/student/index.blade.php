@extends('admin.layouts.master')
@section('title', 'All Students')

@section('content')

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between mb-3">
                <div class="my-auto mb-2">
                    <h3 class="page-title mb-1">Students List</h3>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="index.html">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                Students
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Students</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
                    <div class="pe-1 mb-2">
                        <a href="students.html#" class="btn btn-outline-light bg-white btn-icon me-1" data-bs-toggle="tooltip"
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
                                        class="ti ti-file-type-pdf me-2"></i>Export as PDF</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="dropdown-item rounded-1"><i
                                        class="ti ti-file-type-xls me-2"></i>Export as Excel </a>
                            </li>
                        </ul>
                    </div>
                    <div class="mb-2">
                        <a href="{{route('student.create')}}" class="btn btn-primary d-flex align-items-center"><i
                                class="ti ti-square-rounded-plus me-2"></i>Add Student</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Students List -->
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap pb-0">
                    <h4 class="mb-3">Students List</h4>
                </div>

                {{ $dataTable->table() }}

            </div>
            <!-- /Students List -->

        </div>
    </div>
    <!-- /Page Wrapper -->

    <!-- Add Fees Collect -->
    <div class="modal fade" id="add_fees_collect">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex align-items-center">
                        <h4 class="modal-title">Collect Fees</h4>
                        <span class="badge badge-sm bg-primary ms-2">AD124556</span>
                    </div>
                    <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <form action="{{ route('fees.store') }}" method="POST">
                    @csrf

                    <!-- Hidden Field for Student ID -->
                    <input type="hidden" name="student_id" id="studentId" value="">

                    <input type="hidden" name="term_id" id="termId" value="">

                    <div class="modal-body">
                        <!-- Amount -->
                        <div class="mb-3">
                            <label class="form-label">Amount</label>
                            <input type="number" name="amount" class="form-control" placeholder="Enter Amount" step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Payment Mode</label>
                            <input type="text" name="payment_mode" class="form-control" placeholder="Enter Amount" step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Receipt Number</label>
                            <input type="text" name="receipt_number" class="form-control" placeholder="Enter Amount" step="0.01" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Pay Fees</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        $('#add_fees_collect').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);

            var studentId = button.data('student-id');
            var termId = button.data('term-id');

            $('#studentId').val(studentId);
            $('#termId').val(termId);
        });
    </script>

@endpush

