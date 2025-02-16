<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FeeComponent extends Model
{
    protected $fillable = [
        'grade_id',
        'term_id',
        'tuition_fee',
        'lunch_fee',
        'tea_fee',
        'total_fee'
    ];

    public function getTotalFeeAttribute($value)
    {
        if ($value === null) {
            return $this->tuition_fee + ($this->lunch_fee ?? 0) + ($this->tea_fee ?? 0);
        }
        return $value;
    }

    public function term(): BelongsTo
    {
        return $this->belongsTo(Term::class);
    }

    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }
}
