<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Grade;
use App\Models\Promotion;
use App\Models\Student;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $academicYears = AcademicYear::all();
        $grades = Grade::all();

        return view('admin.student.promotion', compact('academicYears', 'grades'));
    }

    public function getStudentsByGrade(Request $request)
    {
        $gradeId = $request->query('grade_id');
        $academicYearId = $request->query('academic_year_id');

        $students = Student::where('grade_id', $gradeId)
            ->with(['grade', 'academicYear'])
            ->where('academic_year_id', $academicYearId)
            ->get();

        return response()->json($students);
    }





    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'current_grade_id' => 'required|exists:grades,id',
            'current_academic_year_id' => 'required|exists:academic_years,id',
            'next_grade_id' => 'required|exists:grades,id',
            'next_academic_year_id' => 'required|exists:academic_years,id',
        ]);

        // Retrieve input values
        $currentGradeId = $request->input('current_grade_id');
        $currentAcademicYearId = $request->input('current_academic_year_id');
        $nextGradeId = $request->input('next_grade_id');
        $nextAcademicYearId = $request->input('next_academic_year_id');

        // Fetch current and next academic years
        $currentAcademicYear = AcademicYear::findOrFail($currentAcademicYearId);
        $nextAcademicYear = AcademicYear::findOrFail($nextAcademicYearId);

        // Get the active term for the current academic year
        $activeTerm = Term::getActiveTerm();

        // Fetch current and next grades
        $currentGrade = Grade::findOrFail($currentGradeId);
        $nextGrade = Grade::findOrFail($nextGradeId);

        // Wrap the promotion logic in a transaction to ensure data consistency
        DB::transaction(function () use ($currentGrade, $nextGrade, $currentAcademicYear, $nextAcademicYear, $activeTerm) {
            // Get students in the current grade and academic year
            $students = Student::where('grade_id', $currentGrade->id)
                ->where('academic_year_id', $currentAcademicYear->id)
                ->get();

            // Create a new promotion record for the entire grade
            $promotion = new Promotion();
            $promotion->current_grade_id = $currentGrade->id;
            $promotion->next_grade_id = $nextGrade->id;
            $promotion->current_academic_year_id = $currentAcademicYear->id;
            $promotion->next_academic_year_id = $nextAcademicYear->id;
            $promotion->save();

            // Iterate over students and promote them
            foreach ($students as $student) {
                // Calculate the total fee for the active term
                $totalFee = $student->getActiveTermTotalFee();

                // Handle overpayment from the previous term
                if ($student->overpayment > 0) {
                    $termAmountPaid = $student->overpayment;
                    $termArrears = $totalFee - $termAmountPaid;
                    $overpayment = 0;
                    $termStatus = 'Pending';
                }
                // Handle arrears from the previous term
                elseif ($student->term_arrears > 0) {
                    $termAmountPaid = 0;
                    $totalFee += $student->term_arrears;
                    $termArrears = $totalFee;
                    $overpayment = 0;
                    $termStatus = 'Pending';
                }
                // No overpayment or arrears from the previous term
                else {
                    $termAmountPaid = 0;
                    $termArrears = $totalFee; // This will be updated by the boot method if needed
                    $overpayment = 0;
                    $termStatus = 'Pending';
                }

                // Update student records
                $student->update([
                    'grade_id' => $nextGrade->id,
                    'academic_year_id' => $nextAcademicYear->id,
                    'term_id' => $activeTerm->id,
                    'term_amount_paid' => $termAmountPaid,
                    'term_arrears' => $termArrears, // Initial value, may be adjusted by the boot method
                    'overpayment' => $overpayment,
                    'term_status' => $termStatus,
                ]);
            }
        });

        // Show success message and redirect
        toastr()->success('Promotion created successfully.');
        return redirect()->route('student.index')->with('success', 'All students in the selected grade have been promoted successfully.');
    }    /**
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
