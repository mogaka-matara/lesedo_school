<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\AcademicYearDataTable;
use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AcademicYearDataTable $dataTable)
    {
        $year = AcademicYear::all();
        return $dataTable->render('admin.year.index', compact('year'));
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
            'name' => ['required', 'string', 'unique:academic_years,name'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'status' => ['required',]
        ]);

        if ($request->input('status') == 1) {
            AcademicYear::query()->update(['status' => 0]);
        }

        $academicYear = new AcademicYear();
        $academicYear->name = $request->input('name');
        $academicYear->start_date = Carbon::parse($request->input('start_date'))->format('Y-m-d');
        $academicYear->end_date = Carbon::parse($request->input('end_date'))->format('Y-m-d');
        $academicYear->status = $request->input('status');
        $academicYear->save();

        toastr()->success('Acameic Year added successfully.');

        return redirect(route('academic-year.index'));


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
        $academicYear = AcademicYear::query()->findOrFail($id);
        return view('admin.year.edit', compact('academicYear'));
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
