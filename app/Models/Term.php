<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Term extends Model
{
    use HasFactory;

    protected $fillable = [
        'grade_id',
        'name',
        'tuition_fee',
        'lunch_fee',
        'tea_fee',
        'total_fee'
    ];

    public function getTotalFeeAttribute()
    {
        return $this->tuition_fee + ($this->lunch_fee ?? 0) + ($this->tea_fee ?? 0);
    }

    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }

    public function studentTermFees(): HasMany
    {
        return $this->hasMany(StudentTermFee::class);
    }
}
