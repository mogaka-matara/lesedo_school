@extends('admin.layouts.master')
@section('title', 'All Students')

@section('content')

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between mb-3">
                <div class="my-auto mb-2">
                    <h3 class="page-title mb-1">Books</h3>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{'dashboard'}}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Books</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
                    <div class="mb-2">

                        <a href="#" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal"
                           data-bs-target="#add_library_book"><i class="ti ti-square-rounded-plus me-2"></i>Add
                            Book</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Students List -->
            {{ $dataTable->table() }}

            <!-- /Students List -->

        </div>
    </div>
    <!-- /Page Wrapper -->

    <!-- Add Book -->
    <div class="modal fade" id="add_library_book">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Book</h4>
                    <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal"
                            aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <form action="{{route('library.store')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Book Name</label>
                                    <input type="text" name="book_name"  class="form-control">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Grade</label>
                                            <select name="grade_id" id="" class="select">
                                                <option value="">Select</option>
                                                @foreach($grades as $grade)
                                                    <option value="{{$grade->id}}">{{ $grade->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Subject</label>
                                            <select name="subject_id" id="" class="select">
                                                <option value="">Select</option>
                                                @foreach($subjects as $subject)
                                                    <option value="{{$subject->id}}">{{ $subject->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Book No</label>
                                            <input type="text" name="book_no" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Author</label>
                                            <input type="text" name="author" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Publisher</label>
                                    <input type="text" name="publisher" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Qty</label>
                                    <input type="text" name="qty" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="library-books.html#" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</a>
                        <button type="submit" class="btn btn-primary">Add Book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Book -->

    <div class="modal fade" id="assign_book">
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
                <form action="{{ route('library.borrow-store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="book_id" id="bookId" value="">

                    <div class="modal-body">
                        <!-- Amount -->
                        <div class="mb-3">
                            <label for="" class="form-label">Student</label>
                            <select class="select2 form-control"  name="student_id" id="">
                                <option value="">Select</option>
                                @foreach($students as $student)
                                    <option value="{{$student->id}}">{{ $student->first_name }} {{ $student->last_name }}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Assign Book</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection


@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

        <script>
            $('#assign_book').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);

                var bookId = button.data('book-id');

                $('#bookId').val(bookId);
            });
        </script>



@endpush

