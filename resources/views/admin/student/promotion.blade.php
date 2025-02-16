@extends('admin.layouts.master')
@section('title', 'Student Promotion')

@section('content')

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-md-flex d-block align-items-center justify-content-between mb-3">
                        <div class="my-auto mb-2">
                            <h3 class="page-title mb-1">Student Promotion</h3>
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="javascript:void(0);">Students</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Student Promotion</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
                            <div class="pe-1 mb-2">
                                <a href="student-promotion.html#" class="btn btn-outline-light bg-white btn-icon me-1"
                                   data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Refresh"
                                   data-bs-original-title="Refresh">
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
                    <div
                        class="alert alert-outline-primary bg-primary-transparent p-2 d-flex align-items-center flex-wrap row-gap-2 mb-4">
                        <i class="ti ti-info-circle me-1"></i><strong>Note :</strong> Prompting Student from the
                        Present class to the Next Class will Create an enrollment of the student to the next Session
                    </div>


                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <div class="bg-light-gray p-3 rounded">
                                <h4>Promotion</h4>
                                <p>Select the current grade and academic year to promote students to the next grade and academic year.</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{route('promotion.store')}}" method="POST" id="promotion-form">
                                @csrf
                                <div class="d-md-flex align-items-center justify-content-between">
                                    <!-- Current Academic Year and Grade -->
                                    <div class="card flex-fill w-100 me-3">
                                        <div class="card-body pb-1">
                                            <div class="mb-3">
                                                <label class="form-label">Current Academic Year</label>
                                                <select name="current_academic_year_id" id="previous-academic-year" class="form-select" required>
                                                    <option value="" disabled selected>Select Academic Year</option>
                                                    @foreach($academicYears as $academicYear)
                                                        <option value="{{ $academicYear->id }}">{{ $academicYear->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div>
                                                <label class="form-label mb-2">Current Grade</label>
                                                <div class="d-block d-md-flex">
                                                    <div class="mb-3 flex-fill">
                                                        <label class="form-label">Grade</label>
                                                        <select name="current_grade_id" id="current-grade" class="form-select" required>
                                                            <option value="" disabled selected>Select Grade</option>
                                                            @foreach($grades as $grade)
                                                                <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Next Academic Year and Grade -->
                                    <div class="card flex-fill w-100">
                                        <div class="card-body pb-1">
                                            <div class="mb-3">
                                                <label class="form-label">Next Academic Year</label>
                                                <select name="next_academic_year_id" class="form-select" required>
                                                    <option value="" disabled selected>Select Academic Year</option>
                                                    @foreach($academicYears as $academicYear)
                                                        <option value="{{ $academicYear->id }}">{{ $academicYear->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div>
                                                <label class="form-label mb-2">Next Grade</label>
                                                <div class="d-block d-md-flex">
                                                    <div class="mb-3 flex-fill me-md-3 me-0">
                                                        <label class="form-label">Grade</label>
                                                        <select name="next_grade_id" class="form-select" required>
                                                            <option value="" disabled selected>Select Grade</option>
                                                            @foreach($grades as $grade)
                                                                <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Action Buttons -->
                                <div class="col-md-12 mt-4">
                                    <div class="manage-promote-btn d-flex justify-content-center flex-wrap row-gap-2">
                                        <button type="submit" class="btn btn-primary">Promote All Students</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Students Table -->
                    <div id="students-container" class="mt-4">
                        <table class="table table-striped" id="students-table">
                            <thead>
                            <tr>
                                <th>Admission No</th>
                                <th>Name</th>
                                <th>Grade</th>
                                <th>Academic Year</th>
                            </tr>
                            </thead>
                            <tbody id="students-list">
                            <!-- Students will be loaded here via JavaScript -->
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const gradeSelect = document.getElementById('current-grade');
            const academicYearSelect = document.getElementById('previous-academic-year');
            const studentsList = document.getElementById('students-list');

            function loadStudents() {
                const gradeId = gradeSelect.value;
                const academicYearId = academicYearSelect.value;

                if (gradeId && academicYearId) {
                    fetch(`/students-by-grade?grade_id=${gradeId}&academic_year_id=${academicYearId}`)
                        .then(response => response.json())
                        .then(data => {
                            studentsList.innerHTML = '';
                            data.forEach(student => {
                                studentsList.innerHTML += `
                                <tr>
                                    <td>${student.admission_no}</td>
                                    <td>${student.first_name} ${student.last_name}</td>
                                    <td>${student.grade.name}</td>
                                    <td>${student.academic_year.name}</td>
                                </tr>
                            `;
                            });
                        })
                        .catch(error => console.error('Error:', error));
                }
            }

            gradeSelect.addEventListener('change', loadStudents);
            academicYearSelect.addEventListener('change', loadStudents);
        });
    </script>
@endpush


