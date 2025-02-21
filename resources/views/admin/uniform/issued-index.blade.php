@extends('admin.layouts.master')
@section('title', 'All Grades')

@section('content')


    <div class="page-wrapper">
        <div class="content">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between mb-3">
                <div class="my-auto mb-2">
                    <h3 class="page-title mb-1">All Issued Uniforms</h3>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">Uniforms</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Issued Uniforms</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
                    <div class="mb-2">
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_uniform"><i
                                class="ti ti-square-rounded-plus-filled me-2"></i>Add Uniform Component</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Guardians List -->


                    {{ $dataTable->table() }}


            <!-- /Guardians List -->

        </div>
    </div>
@endsection


@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

