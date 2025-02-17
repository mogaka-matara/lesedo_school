@extends('admin.layouts.master')
@section('title', 'All Borrowed Books')

@section('content')


    <div class="page-wrapper">
        <div class="content">

            <div class="d-md-flex d-block align-items-center justify-content-between mb-3">
                <div class="my-auto mb-2">
                    <h3 class="page-title mb-1">Borrowed Books</h3>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('library.index')}}">All Books </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Books Borrowed</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
                    <div class="mb-2">
                        <a href="{{route('library.index')}}" class="btn btn-primary" ><i class="fa fa-arrow-alt-circle-left me-2"></i>Back To Book List</a>
                    </div>
                </div>
            </div>



            {{ $dataTable->table() }}


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

