<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Fee;
use App\Models\Student;
use App\Models\StudentTermFee;
use App\Models\Term;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

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
        $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'term_id' => ['required', 'exists:terms,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'payment_mode' => ['required', 'string'],
            'receipt_number' => ['string'],


        ]);

        $student = Student::findOrFail($request->input('student_id'));
        $term = Term::findOrFail($request->input('term_id'));

        if ($request->input('amount') > $student->term_arrears) {
            return back()->withErrors(['amount' => 'The payment amount cannot exceed the student\'s arrears.']);
        }

        $fee = new StudentTermFee();
        $fee->student_id = $student->id;
        $fee->term_id = $term->id;
        $fee->payment_mode = $request->input('payment_mode');
        $fee->receipt_number = $request->input('receipt_number');
        $fee->amount = $request->input('amount');
        $fee->payment_date = now();


        $fee->save();

        toastr()->success('Fee Payment Successful');

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
