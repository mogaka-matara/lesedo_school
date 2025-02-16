@extends('admin.layouts.master')
@section('title', 'All Grades')

@section('content')



    <div class="page-wrapper">
        <div class="content content-two">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between mb-3">
                <div class="my-auto mb-2">
                    <h3 class="mb-1">Edit Book</h3>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="index.html">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="students.html">All Books</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Book</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">

                <div class="col-md-12">

                    <form action="{{route('library.update', $book->id)}}" method="POST">
                        @csrf

                        @method('PUT')

                        <!-- Personal Information -->
                        <div class="card">
                            <div class="card-header bg-light">
                                <div class="d-flex align-items-center">
										<span class="bg-white avatar avatar-sm me-2 text-gray-7 flex-shrink-0">
											<i class="ti ti-info-square-rounded fs-16"></i>
										</span>
                                    <h4 class="text-dark">Book Information</h4>
                                </div>
                            </div>
                            <div class="card-body pb-1">
                                <div class="row">

                                    <div class=" col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Book Name</label>
                                            <input type="text" name="book_name" class="form-control" value="{{$book->book_name}}">
                                        </div>
                                    </div>
                                    <div class=" col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Book No</label>
                                            <input type="text" name="book_no" class="form-control"  value="{{$book->book_no}}">
                                        </div>
                                    </div>
                                    <div class=" col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Grade</label>
                                            <select name="grade_id" id="" class="select">
                                                <option value="">Select</option>
                                                @foreach($grades as $grade)
                                                    <option {{$grade->id == $book->grade_id ? 'selected': ''}} value="{{$grade->id}}">{{ $grade->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class=" col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Subject</label>
                                            <select name="subject_id" id="" class="select">
                                                <option value="">Select</option>
                                                @foreach($subjects as $subject)
                                                    <option {{$subject->id == $book->subject_id ? 'selected': ''}} value="{{$subject->id}}">{{ $subject->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class=" col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Publisher</label>
                                            <input type="text" name="publisher" class="form-control" value="{{$book->publisher}}">
                                        </div>
                                    </div>

                                    <div class=" col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Author</label>
                                            <input type="text" name="author" class="form-control" value="{{$book->author}}">
                                        </div>
                                    </div>
                                    <div class=" col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Qty</label>
                                            <input type="text" name="qty" class="form-control" value="{{$book->quantity}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-light me-3">Cancel</button>
                            <button type="submit" class="btn btn-primary">Edit Book</button>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>


@endsection




