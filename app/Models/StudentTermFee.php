<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentTermFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'term_id',
        'amount',
        'receipt_number',
        'payment_date',
        'payment_mode'
    ];


    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function term(): BelongsTo
    {
        return $this->belongsTo(Term::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($fee) {
            if ($fee->student) {
                $fee->student->updateActiveTermPayments($fee->amount);
            }
        });
    }
}
