<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FeeComponentDataTable;
use App\Http\Controllers\Controller;
use App\Models\FeeComponent;
use App\Models\Grade;
use App\Models\Term;
use Illuminate\Http\Request;

class FeeComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FeeComponentDataTable $dataTable)
    {
        $grades = Grade::all();
        $terms = Term::all();
        return $dataTable->render('admin.fee-components.index', compact('grades', 'terms'));
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
            'grade_id' => ['required', 'exists:grades,id'],
            'term_id' => ['required', 'exists:terms,id'],
            'tuition_fee' => ['required'],
            'lunch_fee' => ['nullable'],
            'tea_fee' => ['nullable'],
        ]);

        $feeComponent = new FeeComponent();
        $feeComponent->grade_id = $request->input('grade_id');
        $feeComponent->term_id = $request->input('term_id');
        $feeComponent->tuition_fee = $request->input('tuition_fee');
        $feeComponent->lunch_fee = $request->input('lunch_fee');
        $feeComponent->tea_fee = $request->input('tea_fee');
        $feeComponent->total_fee = 0;
        $feeComponent->save();

        toastr()->success('Fee Component Created Successfully');
        return redirect()->route('fee-component.index');
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
