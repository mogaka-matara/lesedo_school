<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'grade_id',
        'term_id',
        'middle_name',
        'last_name',
        'first_name',
        'admission_no',
        'medical_condition',
        'address',
        'date_of_birth',
        'gender',
        'parent_name',
        'parent_contact',
        'parent_email',
        'guardian_name',
        'guardian_contact',
        'guardian_email',
        'opt_in_lunch',
        'opt_in_tea',
        'term_amount_paid',
        'term_arrears',
        'term_status',
    ];


    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }

    public function term(): BelongsTo
    {
        return $this->belongsTo(Term::class);
    }

    public function studentTermFees(): HasMany
    {
        return $this->hasMany(StudentTermFee::class);
    }


    public function getSelectedTotalFee()
    {
        if ($this->term) {
            $total = $this->term->tuition_fee;

            if ($this->opt_in_lunch && $this->term->lunch_fee) {
                $total += $this->term->lunch_fee;
            }

            if ($this->opt_in_tea && $this->term->tea_fee) {
                $total += $this->term->tea_fee;
            }

            return $total;
        }

        return 0;
    }

    public function updateTermPayments()
    {
        if ($this->term) {
            $this->term_amount_paid = $this->studentTermFees()->sum('amount');

            $this->term_arrears = $this->getSelectedTotalFee() - $this->term_amount_paid;

            $this->term_status = $this->term_arrears > 0 ? 'Pending' : 'Full Paid';

            $this->save();
        }
    }

}
