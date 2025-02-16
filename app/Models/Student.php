<?php

namespace App\Models;

use Carbon\Carbon;
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
        'academic_year_id',
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
        'overpayment'
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

   public function academicYear(): BelongsTo
   {
       return $this->belongsTo(AcademicYear::class, 'academic_year_id');

   }


    public function getActiveTermTotalFee()
    {
        $activeTerm = Term::getActiveTerm();
        if (!$activeTerm) {
            return 0; // Default to 0 if no active term exists
        }

        // Find the fee component for the student's grade and term
        $feeComponent = FeeComponent::where('grade_id', $this->grade_id)
            ->where('term_id', $activeTerm->id)
            ->first();

        if (!$feeComponent) {
            return 0; // Default to 0 if no fee component exists
        }

        // Calculate the total fee based on selected options
        $totalFee = $feeComponent->tuition_fee;

        if ($this->opt_in_lunch && $feeComponent->lunch_fee) {
            $totalFee += $feeComponent->lunch_fee;
        }

        if ($this->opt_in_tea && $feeComponent->tea_fee) {
            $totalFee += $feeComponent->tea_fee;
        }

        return $totalFee;
    }


    public function updateActiveTermPayments($newPayment = 0)
    {
        // Get the active term
        $activeTerm = Term::getActiveTerm();

        // Ensure the active term exists and matches the student's term
        if ($activeTerm && $this->term_id === $activeTerm->id) {
            // Initialize term_amount_paid if it's null
            if ($this->term_amount_paid === null) {
                $this->term_amount_paid = 0;
            }

            // Add the new payment to the term_amount_paid
            $this->term_amount_paid += $newPayment;

            // Fetch the total fee for the active term based on the student's grade and term
            $totalFee = $this->getActiveTermTotalFee() ?? 0; // Default to 0 if no fee component exists

            // Calculate arrears based on the updated payment
            $this->term_arrears = max(0, $totalFee - $this->term_amount_paid);

            // Handle overpayment if the student has paid more than the total fee
            if ($this->term_amount_paid > $totalFee) {
                $this->overpayment += ($this->term_amount_paid - $totalFee);
                $this->term_amount_paid = $totalFee; // Cap the paid amount to the total fee
                $this->term_arrears = 0;
                $this->term_status = 'Full Paid';
            } else {
                $this->term_status = $this->term_arrears > 0 ? 'Pending' : 'Full Paid';
            }

            // Save the updated payment details
            $this->save();
        } else {
            // Reset payment-related fields if the student is not assigned to the active term
            $this->term_amount_paid = 0;
            $this->term_arrears = 0;
            $this->overpayment = 0;
            $this->term_status = 'N/A';

            // Save the reset fields
            $this->save();
        }
    }
    public function applyOverpaymentToNextTerm()
    {
        $nextTerm = Term::where('grade_id', $this->grade_id)
            ->whereDate('start_date', '>', Carbon::today())
            ->orderBy('start_date')
            ->first();

        if ($nextTerm && $this->overpayment > 0) {
            $nextTermTotalFee = $this->getTermTotalFee($nextTerm);

            if ($nextTermTotalFee > 0) {
                $appliedAmount = min($this->overpayment, $nextTermTotalFee);

                $this->term_id = $nextTerm->id;
                $this->term_amount_paid = $appliedAmount;
                $this->term_arrears = $nextTermTotalFee - $appliedAmount;
                $this->term_status = $this->term_arrears > 0 ? 'Pending' : 'Full Paid';
                $this->overpayment -= $appliedAmount;

                $this->save();
            }
        }
    }

    private function getTermTotalFee($term)
    {
        $total = $term->tuition_fee;

        if ($this->opt_in_lunch && $term->lunch_fee) {
            $total += $term->lunch_fee;
        }

        if ($this->opt_in_tea && $term->tea_fee) {
            $total += $term->tea_fee;
        }

        return $total;
    }


    public function accountForward($activeTerm, $newGradeId)
    {
        $totalFee = $this->getActiveTermTotalFee();

        if ($this->term_arrears > 0) {
            $totalFee += $this->term_arrears;
        }

        if ($this->overpayment > 0) {
            $this->term_amount_paid += $this->overpayment;
            $totalFee -= $this->overpayment;
        }

        $this->update([
            'grade_id' => $newGradeId,
            'term_id' => $activeTerm->id,
            'term_amount_paid' => $this->term_amount_paid,
            'term_arrears' => max(0, $totalFee - $this->term_amount_paid),
            'overpayment' => max(0, $this->overpayment - $totalFee),
            'term_status' => $this->term_arrears > 0 ? 'Pending' : 'Full Paid',
        ]);
    }
}
