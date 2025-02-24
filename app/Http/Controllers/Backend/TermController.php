<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\TermDataTable;
use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Term;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TermDataTable $dataTable)
    {

        return $dataTable->render('admin.term.index');
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
            'name' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ]);

        $term = new Term();
        $term->name = $request->input('name');
        $term->start_date = Carbon::parse($request->input('start_date'))->format('Y-m-d');
        $term->end_date = Carbon::parse($request->input('end_date'))->format('Y-m-d');

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
        $term = Term::query()->findOrFail($id);

        return view('admin.term.edit', compact('term'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ]);

        $term = Term::query()->findOrFail($id);
        $term->name = $request->input('name');
        $term->start_date = Carbon::parse($request->input('start_date'))->format('Y-m-d');
        $term->end_date = Carbon::parse($request->input('end_date'))->format('Y-m-d');
        $term->save();

        toastr()->success('Term updated successfully.');

        return redirect()->route('term.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $term = Term::query()->findOrFail($id);
        if ($term->studentTermFees()->exists() || $term->feeComponents()->exists()) {
            return response()->json(['status' => 'error', 'message' => 'Term cannot be deleted because It has related records']);
        }
        $term->delete();
        return response()->json(['status' => 'success', 'message' => 'Term deleted successfully!']);

    }
}
