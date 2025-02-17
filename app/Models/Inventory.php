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

    public function supplyItems($quantity)
    {
        if ($this->remaining_quantity >= $quantity) {
            $this->remaining_quantity >=  $quantity;
            $this->save();
            return true;
        }
        return false;
    }
}
