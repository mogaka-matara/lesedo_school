@extends('admin.layouts.master')
@section('title', 'All Borrowed Books')

@section('content')


    <div class="page-wrapper">
        <div class="content">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between mb-3">
                <div class="my-auto mb-2">
                    <h3 class="page-title mb-1">Borrowed Books</h3>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="index.html">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">Classes </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Books Borrowed</li>
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
                </div>
            </div>
            <!-- /Page Header -->



            {{ $dataTable->table() }}


        </div>
    </div>

    <div class="modal fade" id="return_book">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex align-items-center">
                        <h4 class="modal-title">Assign Book</h4>
                        <span class="badge badge-sm bg-primary ms-2"></span>
                    </div>
                    <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <form action="{{ route('library.return', $borrowedBook->id ) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">
                        <!-- Student Name (Read-Only) -->
                        <div class="mb-3">
                            <label for="studentId" class="form-label">Student Name</label>
                            <select class="select form-control" name="student_id" id="studentId" readonly>
                                <option value="{{ $borrowedBook->student->id }}" selected>
                                    {{ $borrowedBook->student->first_name }} {{ $borrowedBook->student->last_name }}
                                </option>
                            </select>
                        </div>

                        <!-- Book Name (Read-Only) -->
                        <div class="mb-3">
                            <label for="bookId" class="form-label">Book Name</label>
                            <select class="select form-control" name="book_id" id="bookId" readonly>
                                <option value="{{ $borrowedBook->book->id }}" selected>
                                    {{ $borrowedBook->book->book_name }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Confirm Return Book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection


@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}


    <script>
        $('#return_book').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);

            var bookId = button.data('book-id');
            var studentId = button.data('student-id');


            $('#bookId').val(bookId);
            $('#studentId').val(studentId);

        });
    </script>
@endpush

