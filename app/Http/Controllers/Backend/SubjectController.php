<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SubjectDataTable;
use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index(SubjectDataTable $dataTable)
    {
        return $dataTable->render('admin.library.subject.index');

    }

    public function getSubjects(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
        ]);

        $subjects = new Subject();
        $subjects->name = $request->input('name');
        $subjects->save();

        toastr()->success('Subject added successfully!');
        return redirect()->route('all.subjects');

    }
}
