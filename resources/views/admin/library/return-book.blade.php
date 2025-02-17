@extends('admin.layouts.master')
@section('title', 'All Borrowed Books')

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
                                <a href="students.html">Borrowed Books</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Return</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Personal Information -->
            <form action="{{route('library.return-update', $borrowedBook->id)}}" method="POST">
                @csrf
                @method('PUT')
            <div class="card">
                <div class="card-header bg-light">
                    <div class="d-flex align-items-center">
										<span class="bg-white avatar avatar-sm me-2 text-gray-7 flex-shrink-0">
											<i class="ti ti-info-square-rounded fs-16"></i>
										</span>
                        <h4 class="text-dark">Borrowed Book Information</h4>
                    </div>
                </div>
                <div class="card-body pb-1">
                    <div class="row">




                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Book Name</label>
                                <select class="form-select" name="book_id">
                                    <option value="{{ $borrowedBook->book_id }}" selected>
                                        {{$borrowedBook->book->book_name}}
                                    </option>
                                </select>
                            </div>
                        </div>



                        <div class=" col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Borrowed Date</label>
                                <input type="text" name="borrow_date" class="form-control" disabled readonly value="{{$borrowedBook->borrow_date}}">
                            </div>
                        </div>

                        <div class=" col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Returned Date</label>
                                <input type="text" name="return_date" class="form-control" disabled readonly value="{{$borrowedBook->returned_date}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Student Name</label>
                                <select class="form-select" name="student_id" >
                                    <option value="{{ $borrowedBook->student_id }}" selected>
                                        {{$borrowedBook->student->first_name}} {{$borrowedBook->student->last_name}}
                                    </option>
                                </select>
                            </div>
                        </div>


                        <div class=" col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Author</label>
                                <input type="text" name="author" class="form-control" disabled readonly value="{{$borrowedBook->book->author}}">
                            </div>
                        </div>

                        <div class=" col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Book Publisher</label>
                                <input type="text" name="publisher" class="form-control" disabled readonly value="{{$borrowedBook->book->publisher}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Book Grade Name</label>
                                <select class="form-select" name="grade_id" disabled>
                                    <option value="{{ $borrowedBook->book->grade_id }}" selected>
                                        {{ $borrowedBook->book->grade->name }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Book Subject</label>
                                <select class="form-select" name="subject_id" disabled>
                                    <option value="{{ $borrowedBook->book->subject_id }}" selected>
                                        {{ $borrowedBook->book->subject->name }}
                                    </option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


                <div class="text-end">
                    <button type="button" class="btn btn-light me-3">Cancel</button>
                    <button type="submit" class="btn btn-primary">Return Book</button>
                </div>
            </form>
            <!-- /Personal Information -->
        </div>
    </div>


@endsection




