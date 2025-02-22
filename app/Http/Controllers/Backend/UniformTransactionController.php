<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\UniformTransactionDataTable;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\UniformComponent;
use App\Models\UniformTransaction;
use Illuminate\Http\Request;

class UniformTransactionController extends Controller
{
    public function index(UniformTransactionDataTable $dataTable)
    {
        return $dataTable->render('admin.uniform.issued-index');
    }
    public function create()
    {
        $students = Student::all();
        $uniformComponents = UniformComponent::all();
        return view('admin.uniform.issue-uniform', compact('students', 'uniformComponents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'components' => ['required', 'array'],
        ]);

        $studentId = $request->input('student_id');
        $components = $request->input('components');
        $issueDate = now();
        $totalPrice = 0;


        $uniformComponents = UniformComponent::all();
        $issuedComponents = [];

        foreach ($uniformComponents as $component) {
            $quantity = $components[$component->id] ?? 0;

            if ($quantity > 0) {
                toastr()->error($component->name . ' is not enough in stock');
            }

            $itemPrice = $quantity * $component->price;
            $totalPrice += $itemPrice;

            $component->deductStock($quantity);

            $issuedComponents[] = [
                'uniform_component_id' => $component->id,
                'quantity_issued' => $quantity,
                'price_per_item' => $itemPrice,
            ];
        }

        $transaction = new UniformTransaction();
        $transaction->student_id = $studentId;
        $transaction->components = $issuedComponents;
        $transaction->total_price = $totalPrice;
        $transaction->issue_date = $issueDate;
        $transaction->save();

        toastr()->success('Uniform issued successfully');
        return redirect()->back();
    }
}
