<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniformComponent extends Model
{
    protected $fillable = [
        'name',
        'quantity',
        'price',
    ];

    public function hasSufficientStock(int $quantity): bool
    {
        return $this->quantity >= $quantity;
    }

    public function deductStock(int $quantity): bool
    {
        if (!$this->hasSufficientStock($quantity)) {
            return false;
        }

        $this->decrement('quantity', $quantity);
        $this->save();
        return true;
    }

}
