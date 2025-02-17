<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FeeDataTable;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentTermFee;
use App\Models\Term;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FeeDataTable $dataTable)
    {

        $feeInvoice = StudentTermFee::query()
            ->with(['student','term'])->get();
        return $dataTable->render('admin.fee-payment.index', compact('feeInvoice') );

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
//        dd($request->all());
        $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'term_id' => ['required', 'exists:terms,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'payment_mode' => ['required', 'string'],
            'receipt_number' => ['string'],


        ]);

        $student = Student::findOrFail($request->input('student_id'));
        $requestedTerm = Term::findOrFail($request->input('term_id'));

        $activeTerm = Term::getActiveTerm();

        if (!$activeTerm || $requestedTerm->id !== $activeTerm->id) {
            return back()->withErrors(['term' => 'The selected term is not the currently active term.']);
        }

        if ($student->term_id !== $activeTerm->id) {
            return back()->withErrors(['term' => 'The student is not assigned to the currently active term.']);
        }


        $fee = new StudentTermFee();
        $fee->invoice_id = 'LE-INV-'. rand(1, 999999);
        $fee->student_id = $student->id;
        $fee->term_id =  $activeTerm->id;
        $fee->payment_mode = $request->input('payment_mode');
        $fee->receipt_number = $request->input('receipt_number');
        $fee->amount = $request->input('amount');
        $fee->payment_date = now();

        $fee->save();

        $student->updateActiveTermPayments($request->input('amount'));

        toastr()->success('Fee Payment Successful');

        return redirect()->route('fees.index');
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
