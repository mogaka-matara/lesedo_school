<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\InventoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(InventoryDataTable $dataTable)
    {
        $item = Inventory::all();
        return $dataTable->render('admin.inventory.index', compact('item'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name' => ['required', 'string', 'max:255'],
            'total_stock' => ['required', 'integer'],
            'supplied_stock' => ['nullable', 'integer'],
            'remaining_stock' => ['nullable', 'integer'],
        ]);

        $inventory = new Inventory();

        $inventory->item_name = $request->input('item_name');
        $inventory->total_stock = $request->input('total_stock');
        $inventory->supplied_stock = $request->input('supplied_stock');
        $inventory->remaining_stock =$request->input('remaining_stock');
        $inventory->save();

        toastr()->success('Desks Added successfully.');

        return redirect()->route('inventory.index');
    }

    public function restockItem(Request $request)
    {

        $request->validate([
            'item_id' => ['required', 'integer'],
            'add_stock' => ['required', 'integer'],
        ]);

        $item = Inventory::query()->findOrFail($request->input('item_id'));

        $item->updateStock($request->input('add_stock'), 'restock');
        $item->save();
        toastr()->success('Item updated successfully.');
        return redirect()->route('inventory.index');
    }

    public function assignItem(Request $request)
    {
        $request->validate([
            'item_id' => ['required', 'integer'],
            'assign_item' => ['required', 'integer'],
        ]);

        $item = Inventory::findOrFail($request->input('item_id'));
        $item->allocateToStudent($request->input('assign_item'));
        $item->save();


        toastr()->success('Item updated successfully.');

        return redirect()->route('inventory.index');
    }


}
