<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\StudentDataTable;
use App\Enum\GenderEnum;
use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Term;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(StudentDataTable $dataTable)
    {
        $students = Student::query()->with('studentTermFees')->get();
        return $dataTable->render('admin.student.index', compact('students'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $terms = Term::all();
        $grades = Grade::all();
        $genders = GenderEnum::cases();
        return view('admin.student.create', compact('grades', 'genders', 'terms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'term_id' => ['required','exists:terms,id'],
            'grade_id' => ['required', 'exists:grades,id'],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required'],
            'medical_condition' => ['required'],
            'address' => ['required'],
            'parent_name' => ['required', 'string', 'max:255'],
            'parent_contact' => ['required', 'string', 'max:255'],
            'parent_email' => ['nullable', 'string', 'email', 'max:255'],
            'guardian_name' => ['nullable', 'string', 'max:255'],
            'guardian_contact' => ['nullable', 'string', 'max:255'],
            'guardian_email' => ['nullable', 'string', 'email', 'max:255']

        ]);


        $student = new Student();
        $student->grade_id = $request->input('grade_id');
        $student->term_id = $request->input('term_id');
        $student->first_name = $request->input('first_name');
        $student->first_name = $request->input('middle_name');
        $student->last_name = $request->input('last_name');
        $student->gender = $request->input('gender');
        $student->admission_no = 'AD/No.' . date('Y') . '/' . rand(1000, 9999);
        $student->date_of_birth = Carbon::parse($request->input('date_of_birth'))->format('Y-m-d');
        $student->medical_condition = $request->input('medical_condition');
        $student->address = $request->input('address');
        $student->parent_name = $request->input('parent_name');
        $student->parent_contact = $request->input('parent_contact');
        $student->parent_email = $request->input('parent_email');
        $student->guardian_name = $request->input('guardian_name');
        $student->guardian_contact = $request->input('guardian_contact');
        $student->guardian_email = $request->input('guardian_email');
        $student->opt_in_lunch = $request->has('opt_in_lunch');
        $student->opt_in_tea = $request->has('opt_in_tea');
        $student->term_amount_paid = 0;
        $student->term_arrears = $student->getSelectedTotalFee();
        $student->term_status = 'Pending';


        $student->save();

        toastr()->success('Student added successfully!');

        return redirect()->route('student.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
