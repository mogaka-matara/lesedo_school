<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\TermDataTable;
use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Term;
use Illuminate\Http\Request;

class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TermDataTable $dataTable)
    {

        $grades = Grade::all();
        return $dataTable->render('admin.term.index', compact('grades'));
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
            'name' => ['required', 'string', 'max:255'],
            'tuition_fee' => ['required', 'numeric'],
            'lunch_fee' => ['nullable', 'numeric'],
            'tea_fee' => ['nullable', 'numeric'],
        ]);

        $term = new Term();
        $term->grade_id = $request->input('grade_id');
        $term->name = $request->input('name');
        $term->tuition_fee = $request->input('tuition_fee');
        $term->lunch_fee = $request->input('lunch_fee');
        $term->tea_fee = $request->input('tea_fee');
        $term->total_fee = 0;

        $term->save();

        return redirect()->route('term.index')->with('success', 'Term created successfully.');
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
