<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\GradeDataTable;
use App\Http\Controllers\Controller;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GradeDataTable $dataTable)
    {
        return $dataTable->render('admin.grade.index');

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
            'name' => ['required', 'string', 'max:255', 'unique:grades'],
            'student_total' => ['required', 'integer'],
            'total_subject' => ['required', 'integer'],
        ]);

//        dd($request->all());


        $grade = new Grade();
        $grade->name = $request->input('name');
        $grade->student_total = $request->input('student_total');
        $grade->total_subject = $request->input('total_subject');
        $grade->save();

        toastr()->success('Class added successfully!');
        return redirect()->route('grade.index');
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
        $grade = Grade::query()->findOrFail($id);

        return view('admin.grade.edit', compact('grade'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:grades,name,'.$id],
            'student_total' => ['required', 'integer'],
            'total_subject' => ['required', 'integer'],
        ]);


        $grade = Grade::query()->findOrFail($id);
        $grade->name = $request->input('name');
        $grade->student_total = $request->input('student_total');
        $grade->total_subject = $request->input('total_subject');
        $grade->save();

        toastr()->success('Class updated successfully!');
        return redirect()->route('grade.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $grade = Grade::query()->findOrFail($id);

        if ($grade->students()->exists() || $grade->feeComponents()->exists() || $grade->books()->exists()) {
            return response()->json(['status' => 'error', 'message' => 'Grade Can not be deleted because it has related records.']);
        }
        $grade->delete();

        return response()->json(['status' => 'success', 'message' => 'Grade deleted successfully!']);
    }
}
