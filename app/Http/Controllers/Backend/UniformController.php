<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\UniformComponentDataTable;
use App\Http\Controllers\Controller;
use App\Models\UniformComponent;
use Illuminate\Http\Request;

class UniformController extends Controller
{
    public function index(UniformComponentDataTable $dataTable)
    {
        return $dataTable->render('admin.uniform.index');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'integer'],
            'price' => ['required', 'integer'],
        ]);

        $uniform = new UniformComponent();
        $uniform->name = $request->input('name');
        $uniform->quantity = $request->input('quantity');
        $uniform->price  = $request->input('price');

        $uniform->save();

        toastr()->success('Uniform added successfully!');

        return redirect()->route('uniform-component.index');
    }

}
