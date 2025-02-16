<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\StudentDataTable;
use App\Enum\GenderEnum;
use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\FeeComponent;
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
        $activeAcademicYear = AcademicYear::getActiveAcademicYear();
        $academicYears = $activeAcademicYear ? [$activeAcademicYear] : [];
        $genders = GenderEnum::cases();

        return view('admin.student.create', compact('grades', 'genders', 'terms', 'academicYears', 'activeAcademicYear'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
//            'term_id' => ['required','exists:terms,id'],
            'grade_id' => ['required', 'exists:grades,id'],
            'academic_year_id' => ['required', 'exists:academic_years,id'],
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

        // Ensure an active term exists
        $activeTerm = Term::getActiveTerm();
        if (!$activeTerm) {
            return back()->withErrors(['term' => 'No active term found. Please activate a term first.']);
        }

        $currentYear = date('Y');
        $latestAdmissionNumber = Student::query()->where('admission_no', 'LIKE', "AD/No.$currentYear/%")
            ->orderByDesc('admission_no')
            ->value('admission_no');

        $nextSequence = 1;

        if ($latestAdmissionNumber) {
            $sequence = (int) substr($latestAdmissionNumber, -4);
            $nextSequence = $sequence + 1;
        }

        $admissionNo = "AD/No.$currentYear/" . str_pad($nextSequence, 4, '0', STR_PAD_LEFT);

        $student = new Student();
        $student->grade_id = $request->input('grade_id');
        $student->academic_year_id = $request->input('academic_year_id');
        $student->term_id =  $activeTerm->id;
        $student->first_name = $request->input('first_name');
        $student->middle_name = $request->input('middle_name');
        $student->last_name = $request->input('last_name');
        $student->gender = $request->input('gender');
        $student->admission_no = $admissionNo;
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
        $student->term_arrears = $student->getActiveTermTotalFee();
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
        $student = Student::query()
            ->with('studentTermFees', 'grade')
            ->findOrFail($id);

        return view('admin.student.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::query()->findOrFail($id);
        $terms = Term::all();
        $academicYear= AcademicYear::getActiveAcademicYear();
        $grades = Grade::all();
        $genders = GenderEnum::cases();
        return view('admin.student.edit', compact('student', 'grades', 'genders', 'terms', 'academicYear'));
    }

    /**
     * Update the specified resource in storage.
     */


    public function update(Request $request, string $id)
    {
        // Validate the incoming request data
        $request->validate([
            'grade_id' => ['required', 'exists:grades,id'],
            'academic_year_id' => ['required', 'exists:academic_years,id'],
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
            'guardian_email' => ['nullable', 'string', 'email', 'max:255'],
            'opt_in_lunch' => ['nullable',],
            'opt_in_tea' => ['nullable',],
        ]);

        // Retrieve the student by ID
        $student = Student::findOrFail($id);

        // Get the active term
        $activeTerm = Term::getActiveTerm();
        if (!$activeTerm) {
            return back()->withErrors(['term' => 'No active term found.']);
        }

        // Retrieve fees from FeeComponent based on grade and term
        $feeComponent = FeeComponent::where('grade_id', $request->input('grade_id'))
            ->where('term_id', $activeTerm->id)
            ->first();

        if (!$feeComponent) {
            return back()->withErrors(['fees' => 'Fee structure not found for the selected grade and term.']);
        }

        // Base tuition fee (mandatory)
        $tuitionFee = $feeComponent->tuition_fee ?? 0;
        if ($tuitionFee === null) {
            return back()->withErrors(['fees' => 'Tuition fee is mandatory and not found for the selected grade and term.']);
        }

        $lunchFee = $feeComponent->lunch_fee ?? 0;
        $teaFee = $feeComponent->tea_fee ?? 0;

        // Determine selected optional fees
        $optInLunchBefore = $student->opt_in_lunch;
        $optInTeaBefore = $student->opt_in_tea;
        $optInLunch = $request->has('opt_in_lunch');
        $optInTea = $request->has('opt_in_tea');

        // Calculate new total fees
        $newTotalFee = $tuitionFee + ($optInLunch ? $lunchFee : 0) + ($optInTea ? $teaFee : 0);
        $previousTotalFee = $tuitionFee + ($optInLunchBefore ? $lunchFee : 0) + ($optInTeaBefore ? $teaFee : 0);

        // Calculate fee difference
        $feeDifference = $newTotalFee - $previousTotalFee;

        // Adjust overpayment and arrears based on fee difference
        if ($feeDifference > 0) { // Fees increased
            if ($student->overpayment >= $feeDifference) {
                $student->overpayment -= $feeDifference;
                $student->term_amount_paid += $feeDifference;
            } else {
                $remainingBalance = $feeDifference - $student->overpayment;
                $student->term_arrears += $remainingBalance;
                $student->term_amount_paid += $student->overpayment;
                $student->overpayment = 0;
            }
        } elseif ($feeDifference < 0) { // Fees decreased
            $refundAmount = abs($feeDifference);

            if ($student->overpayment > 0 || $student->term_amount_paid > $newTotalFee) {
                // If there's overpayment or paid amount exceeds new total fee, adjust accordingly
                if ($student->term_amount_paid > $newTotalFee) {
                    // Reduce term_amount_paid to match new total fee
                    $excessPaid = $student->term_amount_paid - $newTotalFee;
                    $student->term_amount_paid = $newTotalFee;

                    // Add the excess paid amount to overpayment
                    $student->overpayment += $excessPaid;
                }
            } else {
                // If no overpayment, reduce arrears first
                if ($student->term_arrears >= $refundAmount) {
                    $student->term_arrears -= $refundAmount;
                } else {
                    $remainingRefund = $refundAmount - $student->term_arrears;
                    $student->overpayment += $remainingRefund;
                    $student->term_arrears = 0;
                }
            }
        }

        // Update term status
        if ($student->term_amount_paid >= $newTotalFee) {
            $student->term_status = 'Full Paid';
            $student->term_arrears = 0;
        } else {
            $student->term_status = 'Pending';
            $student->term_arrears = max(0, $newTotalFee - $student->term_amount_paid);
        }

        // Update student details
        $student->grade_id = $request->input('grade_id');
        $student->academic_year_id = $request->input('academic_year_id');
        $student->term_id = $activeTerm->id;
        $student->first_name = $request->input('first_name');
        $student->middle_name = $request->input('middle_name');
        $student->last_name = $request->input('last_name');
        $student->gender = $request->input('gender');
        $student->date_of_birth = Carbon::parse($request->input('date_of_birth'))->format('Y-m-d');
        $student->medical_condition = $request->input('medical_condition');
        $student->address = $request->input('address');
        $student->parent_name = $request->input('parent_name');
        $student->parent_contact = $request->input('parent_contact');
        $student->parent_email = $request->input('parent_email');
        $student->guardian_name = $request->input('guardian_name');
        $student->guardian_contact = $request->input('guardian_contact');
        $student->guardian_email = $request->input('guardian_email');
        $student->opt_in_lunch = $optInLunch;
        $student->opt_in_tea = $optInTea;

//        dd($student);

        // Save the updated student record
        $student->save();

        // Show success message and redirect
        toastr()->success('Student updated successfully!');
        return redirect()->route('student.index');
    }


    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        //
    }
}
