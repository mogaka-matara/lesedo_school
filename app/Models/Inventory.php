<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'item_name',
        'total_stock',
        'supplied_stock',
        'remaining_stock',
    ];

    public function updateStock($quantity, $action = 'supply')
    {
        if ($action === 'supply') {
            $this->supplied_stock += $quantity;
        } elseif ($action === 'restock') {
            $this->total_stock += $quantity;
        }

        $this->remaining_stock = $this->total_stock - $this->supplied_stock;

        $this->save();

        if ($action === 'supply') {
            SupplyHistory::create([
                'item_id' => $this->id,
                'quantity' => $quantity,
                'supply_date' => now(),
            ]);
        }
    }

    public function allocateToStudent($quantity)
    {
        if ($this->remaining_stock < $quantity) {
            return response()->json(['error' => 'Item out of stock.']);
        }

        $this->updateStock($quantity);

    }

}
